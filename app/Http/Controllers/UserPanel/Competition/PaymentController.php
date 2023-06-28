<?php

namespace App\Http\Controllers\UserPanel\Competition;

use Nette\Utils\Random;
use App\Models\Event\Event;
use App\Models\Market\Copan;
use App\Models\Market\Order;
use Illuminate\Http\Request;
use App\Models\Market\Payment;
use App\Models\Market\CartItem;
use App\Models\Market\OrderItem;
use App\Models\Market\CashPayment;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Market\OnlinePayment;
use Illuminate\Support\Facades\Auth;
use App\Models\Market\OfflinePayment;
use App\Http\Services\Payment\PaymentService;

class PaymentController extends Controller
{
    public function payment()
    {
        $order = Order::where([['user_id' , Auth::user()->id] , ['order_status' , 0]])->first(); 
        $cartItems = CartItem::where('user_id' , Auth::user()->id)->get();
        return view('customer.sales-process.payment' , compact('order','cartItems'));
    } 
    public function copanDiscount(Request $request)
    {
        $request->validate(['copan_id' => 'required']);

        $copan = Copan::where([['code' , $request->copan_id] , ['status' , 1] , ['start_date' , '<' , now()] , ['end_date' , '>' , now()]])->first(); 
        
        if($copan){
            if($copan->user_id != null){
                $copan = Copan::where([['status' , 1] , ['code' , $request->copan_id] , ['start_date' , '<' , now()] , ['end_date' , '>' , now()] , ['user_id' , auth()->user()->id]])->first(); 
            }
            if($copan == null){
                return redirect()->back()->with('swal-error' , 'کد تخفیف وارد شده اشتباه است .'); 
            }
           
            $order = Order::where([['user_id' , Auth::user()->id] , ['order_status' , 0] ,['copan_id' , null]])->first();
            $copanAmountDiscount = 0;
            if($order){
                if($copan->amount_type == 0){
                    $copanAmountDiscountPercentage = $order->order_final_amount * ($copan->amount / 100); 
                    
                    if($copanAmountDiscountPercentage > $copan->discount_ceiling){
                        $copanAmountDiscount = $copan->discount_ceiling;
                    }else{
                        $copanAmountDiscount = $copanAmountDiscountPercentage; 
                    }
                    }elseif($copan->amount_type == 1){
                        if($copan->amount > $copan->discount_ceiling){
                            $copanAmountDiscount = $copan->discount_ceiling;
                        }else{
                            $copanAmountDiscount = $copan->amount; 
                        }
                    }
                    $finalPrice = $order->order_final_amount - $copanAmountDiscount; 
                    $order->copan_id = $copan->id;
                    $order->order_copan_discount_amount = $copanAmountDiscount;
                    $order->order_final_amount = $finalPrice; 
                    $order->order_total_products_discount_amount = $order->order_total_products_discount_amount + $copanAmountDiscount;
                    $order->save();
                    return redirect()->back()->with(['swal-success' => 'کد تخفیف شما با موفقیت ثبت شد .']);
            }else{
                    return redirect()->back()->with('swal-error' , 'برای این سفارشات قبلا کد تخفیف استفاده شده .'); 
            }

        } 
        if($copan == null){
            return redirect()->back()->withErrors(['copan_id' => 'کد تخفیف وارد شده نامعتبر است .']);
        } 
    }

    public function paymentSubmit(Request $request ,Event $event , PaymentService $paymentService)
    {
        $request->validate([
            'payment_type' => 'required|numeric|in:3',
        ]); 
        $user = auth()->user();
        // dd($request->all());
        switch($request->payment_type){
            case 1;
            $targetMoedel = OnlinePayment::class;
            $type = 1;
            
            break;
            case 2;
            $targetMoedel = OfflinePayment::class;
            $type = 2;

            break;
            case 3;

            $targetMoedel = CashPayment::class;
            $type = 3;
            $cashReciver = $request->cash_receiver ?? null; 
            
            break;
            default :
            return redirect()->back()->with('swal-error' , 'لطفا دوباره تلاش نمایید .');
        }
        DB::transaction(function () use($targetMoedel , $user , $event , $cashReciver , $type ,$paymentService ,$request)  {
            $paymented = $targetMoedel::create([
                'amount' => $event->price,
                'user_id' => Auth::user()->id,
                'pay_date' => now(),
                'cash_receiver' => $cashReciver,
                'status' => 1
            ]); 
            $payment = Payment::create([
                'amount' => $event->price,
                'user_id' => Auth::user()->id,
                'event_id' => $event->id,
                'mafia_id' => null,
                'type' => $type,
                'paymentable_id' => $paymented->id,
                'random_code' => rand(10000,99999),
                'paymentable_type' => $targetMoedel,
            ]); 

            $event->users()->attach($user->id , ['random_code' => $payment->random_code]);
            return redirect()->route('user-panel.competition')->with('swal-success' , "درخواست شما با موفقیت ثبت شد کد ورود : {$payment->random_code} ");
        }); 
        return redirect()->route('user-panel.competition')->with('swal-error' , 'خطا در ثبت درخواست شما لطفا دوباره تلاش کنید .'); 
    }

    public function paymentCallback(Order $order, OnlinePayment $onlinePayment, paymentService $paymentService)
    {
        $amount = $onlinePayment->amount * 10;
        $result = $paymentService->zarinpalVerify($amount, $onlinePayment);
        $cartItems = CartItem::where('user_id', Auth::user()->id)->get();
        foreach ($cartItems as $cartItem) {
            $amazingDiscount = $cartItem->cartItemProductDiscount() ?? 0;
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'product' => $cartItem->product,
                'amazing_sale_id' => $cartItem->product->activeAmazingSales()->id ?? null,
                'amazing_sale_object' => $cartItem->product->activeAmazingSales() ?? null,
                'amazing_sale_discount_amount' => $cartItem->cartItemFinalDiscount() ?? null,
                'number' => $cartItem->number, 
                'final_product_price' => $cartItem->cartItemProductPrice() - $amazingDiscount,
                'final_total_price' => ($cartItem->cartItemProductPrice() * $cartItem->number) - ($amazingDiscount * $cartItem->number),
                'color_id' => $cartItem->color_id,
                'guarantee_id' => $cartItem->guarantee_id,
            ]);


            $cartItem->delete();
        }
        if ($result['success']) {
            $order->update(
                [
                    'order_status' => 2,
                    'payment_status' => 1
                ]
            );
            return redirect()->route('customer.home')->with('swal-success', 'سفارش شما با موفقیت ثبت شد');
        }
        $order->update(
            [
                'order_status' => 3,
                'payment_status' => 2 
            
            ]
        );
        return redirect()->route('customer.home')->with('swal-error' , 'پرداخت با خطا مواجه شد .');
    }
}
