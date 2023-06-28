<?php

namespace App\Models\Market;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartItem extends Model
{
    use HasFactory , SoftDeletes; 

    protected $fillable = ['user_id' , 'product_id' , 'color_id' , 'guarantee_id' , 'number'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function productColor()
    {
        return $this->belongsTo(ProductColor::class,'color_id');
    }
    public function guarantee()
    {
        return $this->belongsTo(Guarantee::class);
    }

     // productPrice + colorPrice + guranateePrice
     public function cartItemProductPrice(){
        $guaranteePriceIncrease = empty($this->guarantee_id) ? 0 : $this->guarantee->price_increase;
        $colorPriceIncrease = empty($this->color_id) ? 0 : $this->productColor->price_increase;
        return $this->product->price + $guaranteePriceIncrease + $colorPriceIncrease;
     }
      // productPrice * (discountPerecentage / 100)
     public function cartItemProductDiscount(){
        $carItemProductPrice =$this->cartItemProductPrice();
        $productDiscount = empty($this->product->activeAmazingSales()) ? 0 : $carItemProductPrice * ($this->product->activeAmazingSales()->percentage / 100) ;
        return $productDiscount;
    }


    // number * (productPrice + colorPrice + guranateePrice - discountPrice)
    public function cartItemFinalPrice(){
        $carItemProductPrice = $this->cartItemProductPrice();
        $cartItemProductDiscount = $this->cartItemProductDiscount();
        return $this->number * ($carItemProductPrice - $cartItemProductDiscount);
    }


    // number * productDiscount
    public function cartItemFinalDiscount(){
        $cartItemProductDiscount = $this->cartItemProductDiscount();
        return $this->number * $cartItemProductDiscount;
    }
}
