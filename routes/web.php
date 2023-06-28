<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\HomeController;
use App\Http\Controllers\Admin\User\RoleController;
use App\Http\Controllers\Admin\Notify\SMSController;
use App\Http\Controllers\AuthOrg\RegisterController;
/////

use App\Http\Controllers\Admin\Content\FAQController;
use App\Http\Controllers\Admin\Event\EventController;
use App\Http\Controllers\Admin\Content\MenuController;
// use App\Http\Controllers\Admin\Content\PostController;
use App\Http\Controllers\Admin\Content\PageController;
use App\Http\Controllers\Admin\Market\BrandController;
use App\Http\Controllers\Admin\Market\OrderController;
use App\Http\Controllers\Admin\Market\StoreController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\Notify\EmailController;
use App\Http\Controllers\Admin\ticket\TicketController;
use App\Http\Controllers\Admin\User\CustomerController;
use App\Http\Controllers\UserPanel\UserPanelController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\Event\UserInfoController;
use App\Http\Controllers\Admin\Market\CommentController;
use App\Http\Controllers\Admin\Market\GalleryController;
use App\Http\Controllers\Admin\Market\PaymentController;
use App\Http\Controllers\Admin\Market\ProductController;
use App\Http\Controllers\Admin\Setting\BannerController;
use App\Http\Controllers\Admin\User\AdminUserController;
use App\Http\Controllers\Admin\Event\EventUserController;
use App\Http\Controllers\Admin\Event\MafiaRoleController;
use App\Http\Controllers\Admin\Market\CategoryController;
use App\Http\Controllers\Admin\Market\DeliveryController;
use App\Http\Controllers\Admin\Market\DiscountController;
use App\Http\Controllers\Admin\Market\PropertyController;
use App\Http\Controllers\Admin\Setting\SettingController;
use App\Http\Controllers\Admin\User\PermissionController;
use App\Http\Controllers\Admin\Notify\EmailFileController;
use App\Http\Controllers\Admin\Ticket\TicketAdminController;
use App\Http\Controllers\Customer\Profile\ProfileController;
use App\Http\Controllers\Admin\Market\ProductColorController;
use App\Http\Controllers\Admin\Market\PropertyValueController;
use App\Http\Controllers\Admin\Ticket\TicketCategoryController;
use App\Http\Controllers\Admin\Ticket\TicketPriorityController;
use App\Http\Controllers\Auth\Customer\LoginRegisterController;
use App\Http\Controllers\Admin\Event\EventNotificationController;
use App\Http\Controllers\Admin\Market\ProductGuaranteeController;
use App\Http\Controllers\UserPanel\Competition\CompetitionController;
use App\Http\Controllers\UserPanel\Role\RoleController as UserPanelRoleController;
use App\Http\Controllers\Admin\Content\CommentController as ContentCommentController;
use App\Http\Controllers\UserPanel\Profile\ProfileController as UserProfileController;
use App\Http\Controllers\Admin\Content\CategoryController as ContentCategoryController;
use App\Http\Controllers\UserPanel\Competition\PaymentController as PaymentCustomerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::prefix('admin')->namespace('Admin')->middleware('isAdmin')->group(function(){

    // Route::get('/', 'AdminDashboardController@index')->name('admin.home');
    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.home');
    Route::get('/logout', [AdminDashboardController::class, 'logout'])->name('admin.logout');


    Route::prefix('event')->namespace('Event')->group(function(){
     //event

        Route::get('/', [EventController::class, 'index'])->name('admin.event.index');
        Route::get('/over', [EventController::class, 'over'])->name('admin.event.over');
        Route::get('/ahead', [EventController::class, 'ahead'])->name('admin.event.ahead');
        Route::get('/create', [EventController::class, 'create'])->name('admin.event.create');
        Route::post('/store', [EventController::class, 'store'])->name('admin.event.store');
        Route::get('/edit/{event}', [EventController::class, 'edit'])->name('admin.event.edit');
        Route::put('/update/{event}', [EventController::class, 'update'])->name('admin.event.update');
        Route::get('/show/{event}', [EventController::class, 'show'])->name('admin.event.show');



        Route::put('/update/{event}', [EventController::class, 'update'])->name('admin.event.update');
        Route::delete('/destroy/{event}', [EventController::class, 'destroy'])->name('admin.event.destroy');
        Route::get('/status/{event}', [EventController::class, 'status'])->name('admin.event.status');
        Route::get('/complation_status/{event}', [EventController::class, 'complationStatus'])->name('admin.event.complation_status');
        Route::get('/game_status/{event}', [EventController::class, 'gameStatus'])->name('admin.event.game_status');

        Route::prefix('notification')->group(function() {
            Route::get('/' , [EventNotificationController::class , 'index'])->name('admin.event.notification');
            Route::get('/edit/{eventNotification}' , [EventNotificationController::class , 'edit'])->name('admin.event.notification.edit');
            Route::put('/update/{eventNotification}' , [EventNotificationController::class , 'update'])->name('admin.event.notification.update');
            Route::get('/create' , [EventNotificationController::class , 'create'])->name('admin.event.notification.create');
            Route::post('/store' , [EventNotificationController::class , 'store'])->name('admin.event.notification.store');
            Route::delete('/destroy/{eventNotification}' , [EventNotificationController::class , 'destroy'])->name('admin.event.notification.destroy');
            Route::get('/status/{notification}', [EventNotificationController::class, 'status'])->name('admin.event.notification.status');

        });


        Route::prefix('role')->group(function() {
            Route::get('/' , [MafiaRoleController::class , 'index'])->name('admin.event.role.index');
            Route::get('/create', [MafiaRoleController::class, 'create'])->name('admin.event.role.create');
            Route::post('/store', [MafiaRoleController::class, 'store'])->name('admin.event.role.store');
            Route::get('/edit/{role}', [MafiaRoleController::class, 'edit'])->name('admin.event.role.edit');
            Route::put('/update/{role}', [MafiaRoleController::class, 'update'])->name('admin.event.role.update');
            Route::delete('/destroy/{mafia}', [MafiaRoleController::class, 'destroy'])->name('admin.event.role.destroy');
            Route::get('/status/{mafia}', [MafiaRoleController::class, 'status'])->name('admin.event.role.status');
        });

        Route::prefix('/user')->group(function() {
           // event user
        Route::get('/{event}', [EventUserController::class, 'index'])->name('admin.event.user');
        Route::get('/toggle-payment/{event}/{user}', [EventUserController::class, 'togglePayment'])->name('admin.event.toggle-payment');
        Route::post('/{event}', [EventUserController::class, 'store'])->name('admin.event.user.store');
        Route::delete('/{event}/{user}', [EventUserController::class, 'destroy'])->name('admin.event.user.destroy');
        Route::get('/information/{event}/{user}', [UserInfoController::class, 'index'])->name('admin.event.user.add-user-info');
        Route::post('/information/store/{event}/{user}', [UserInfoController::class, 'store'])->name('admin.event.user.add-user-store');
        });
    });





    Route::prefix('user')->namespace('User')->group(function(){

        //admin-user
        Route::prefix('admin-user')->group(function(){
            Route::get('/', [AdminUserController::class, 'index'])->name('admin.user.admin-user.index');
            Route::get('/create', [AdminUserController::class, 'create'])->name('admin.user.admin-user.create');
            Route::post('/store', [AdminUserController::class, 'store'])->name('admin.user.admin-user.store');
            Route::get('/edit/{user}', [AdminUserController::class, 'edit'])->name('admin.user.admin-user.edit');
            Route::put('/update/{user}', [AdminUserController::class, 'update'])->name('admin.user.admin-user.update');
            Route::delete('/destroy/{user}', [AdminUserController::class, 'destroy'])->name('admin.user.admin-user.destroy');
            Route::get('/status/{user}', [AdminUserController::class, 'status'])->name('admin.user.admin-user.status');
            Route::get('/activation/{user}', [AdminUserController::class, 'activation'])->name('admin.user.admin-user.activation');
            Route::get('/role/{user}', [AdminUserController::class, 'role'])->name('admin.user.admin-user.role');
            Route::post('/role/{user}/store', [AdminUserController::class, 'roleStore'])->name('admin.user.admin-user.role.store');
            Route::get('/permission/{user}', [AdminUserController::class, 'permission'])->name('admin.user.admin-user.permission');
            Route::post('/permission/{user}/store', [AdminUserController::class, 'permissionStore'])->name('admin.user.admin-user.permission.store');
    });

        //customer
        Route::prefix('customer')->group(function(){


            Route::get('/', [CustomerController::class, 'index'])->name('admin.user.customer.index');
            Route::get('/create', [CustomerController::class, 'create'])->name('admin.user.customer.create');
            Route::post('/store', [CustomerController::class, 'store'])->name('admin.user.customer.store');
            Route::get('/edit/{user}', [CustomerController::class, 'edit'])->name('admin.user.customer.edit');
            Route::put('/update/{user}', [CustomerController::class, 'update'])->name('admin.user.customer.update');
            Route::delete('/destroy/{user}', [CustomerController::class, 'destroy'])->name('admin.user.customer.destroy');
            Route::get('/status/{user}', [CustomerController::class, 'status'])->name('admin.user.customer.status');
            Route::get('/activation/{user}', [CustomerController::class, 'activation'])->name('admin.user.customer.activation');
        });

    //role
        Route::prefix('role')->group(function(){
            Route::get('/', [RoleController::class, 'index'])->name('admin.user.role.index');
            Route::get('/create', [RoleController::class, 'create'])->name('admin.user.role.create');
            Route::post('/store', [RoleController::class, 'store'])->name('admin.user.role.store');
            // Route::get('/getPermission', [RoleController::class, 'getPermission'])->name('admin.user.role.getPermission');
            Route::get('/edit/{role}', [RoleController::class, 'edit'])->name('admin.user.role.edit');
            Route::get('/permission-edit/{role}', [RoleController::class, 'permissionEdit'])->name('admin.user.role.permission-edit');
            Route::put('/permission-update/{role}', [RoleController::class, 'permissionUpdate'])->name('admin.user.role.permission-update');
            Route::put('/update/{role}', [RoleController::class, 'update'])->name('admin.user.role.update');
            Route::delete('/destroy/{role}', [RoleController::class, 'destroy'])->name('admin.user.role.destroy');
            Route::get('/status/{role}', [RoleController::class, 'status'])->name('admin.user.role.status');

    });

    //permission
        Route::prefix('permission')->group(function(){
            Route::get('/', [PermissionController::class, 'index'])->name('admin.user.permission.index');
            Route::get('/create', [PermissionController::class, 'create'])->name('admin.user.permission.create');
            Route::post('/store', [PermissionController::class, 'store'])->name('admin.user.permission.store');
            Route::get('/edit/{permission}', [PermissionController::class, 'edit'])->name('admin.user.permission.edit');
            Route::put('/update/{permission}', [PermissionController::class, 'update'])->name('admin.user.permission.update');
            Route::delete('/destroy/{permission}', [PermissionController::class, 'destroy'])->name('admin.user.permission.destroy');
            Route::get('/status/{permission}', [PermissionController::class, 'status'])->name('admin.user.permission.status');
    });

    });


    Route::prefix('notify')->namespace('Notify')->group(function(){

        //email
        Route::prefix('email')->group(function(){
            Route::get('/', [EmailController::class, 'index'])->name('admin.notify.email.index');
            Route::get('/create', [EmailController::class, 'create'])->name('admin.notify.email.create');
            Route::post('/store', [EmailController::class, 'store'])->name('admin.notify.email.store');
            Route::get('/edit/{email}', [EmailController::class, 'edit'])->name('admin.notify.email.edit');
            Route::put('/update/{email}', [EmailController::class, 'update'])->name('admin.notify.email.update');
            Route::delete('/destroy/{email}', [EmailController::class, 'destroy'])->name('admin.notify.email.destroy');
            Route::get('/status/{email}', [EmailController::class, 'status'])->name('admin.notify.email.status');
        });
        //email-file
        Route::prefix('email-file')->group(function(){
            Route::get('/{email}', [EmailFileController::class, 'index'])->name('admin.notify.email-file.index');
            Route::get('/{email}/create', [EmailFileController::class, 'create'])->name('admin.notify.email-file.create');
            Route::post('/{email}/store', [EmailFileController::class, 'store'])->name('admin.notify.email-file.store');
            Route::get('/edit/{emailfile}', [EmailFileController::class, 'edit'])->name('admin.notify.email-file.edit');
            Route::put('/update/{emailfile}', [EmailFileController::class, 'update'])->name('admin.notify.email-file.update');
            Route::delete('/destroy/{emailfile}', [EmailFileController::class, 'destroy'])->name('admin.notify.email-file.destroy');
            Route::get('/status/{emailfile}', [EmailFileController::class, 'status'])->name('admin.notify.email-file.status');
            //feature
            // Route::get('/getDownload/{emailfile}', [EmailFileController::class, 'getDownload'])->name('admin.notify.email-file.getDownload');
        });

        //sms
        Route::prefix('sms')->group(function(){
            Route::get('/', [SMSController::class, 'index'])->name('admin.notify.sms.index');
            Route::get('/create', [SMSController::class, 'create'])->name('admin.notify.sms.create');
            Route::post('/store', [SMSController::class, 'store'])->name('admin.notify.sms.store');
            Route::get('/edit/{sms}', [SMSController::class, 'edit'])->name('admin.notify.sms.edit');
            Route::put('/update/{sms}', [SMSController::class, 'update'])->name('admin.notify.sms.update');
            Route::delete('/destroy/{sms}', [SMSController::class, 'destroy'])->name('admin.notify.sms.destroy');
            Route::get('/status/{sms}', [SMSController::class, 'status'])->name('admin.notify.sms.status');
        });

    });



    Route::prefix('setting')->namespace('Setting')->group(function(){
        Route::get('/', [SettingController::class, 'index'])->name('admin.setting.index');
        Route::get('/edit/{setting}', [SettingController::class, 'edit'])->name('admin.setting.edit');
        Route::put('/update/{setting}', [SettingController::class, 'update'])->name('admin.setting.update');
    });
    Route::post('/notification/read-noti', [NotificationController::class, 'readNoti'])->name('admin.notification.readNoti');
});


Route::get('/', [HomeController::class , 'home'])->name('customer.home');

Route::prefix('/user-panel')->middleware(['userRegister' , 'auth:sanctum'])->group(function () {
    Route::get('/' , [UserPanelController::class , 'index'])->name('user-panel.index');
    Route::get('/competition' , [CompetitionController::class , 'index'])->name('user-panel.competition');
    Route::get('/register-competition/{event}' , [CompetitionController::class , 'registerCompetition'])->name('user-panel.register-competition')->middleware('checkProfile');
    Route::post('/register-competition-submit/{event}' , [CompetitionController::class , 'registerCompetitionSubmit'])->name('user-panel.register-competition-submit')->middleware('checkProfile');
    Route::get('/leave-game/{event}' , [CompetitionController::class , 'leaveGame'])->name('user-panel.leave-game')->middleware('checkProfile');

    Route::prefix('profile')->group(function(){
        Route::get('/' , [UserProfileController::class , 'index'])->name('user-panel.profile');
        Route::get('/activity-info' , [UserProfileController::class , 'activityInfo'])->name('user-panel.profile-info');
        // Update Password
        Route::put('/update/password' , [UserProfileController::class , 'updatePassword'])->name('user-panel.profile.update-password');
        Route::put('/update/profile' , [UserProfileController::class , 'updateProfile'])->name('user-panel.profile.update-profile');

    });

    Route::prefix('/role')->group(function () {
        Route::get('/', [UserPanelRoleController::class , 'index'])->name('user-panel.role.index');
        Route::get('/show-role', [UserPanelRoleController::class , 'role'])->name('user-panel.role.show-role');
    });
    // payment
    // Route::get('/payment' , [PaymentCustomerController::class , 'payment'])->name('user-panel.competition.payment');
    // Route::post('/copan-discount' , [PaymentCustomerController::class , 'copanDiscount'])->name('user-panel.competition.copan-discount');
    // Route::post('/payment-submit/{event}' , [PaymentCustomerController::class , 'paymentSubmit'])->name('user-panel.competition.payment-submit');
    // Route::any('/payment-callback/{order}/{onlinePayment}', [PaymentCustomerController::class, 'paymentCallback'])->name('user-panel.competition.payment-call-back');
});

Route::namespace('Auth')->group(function(){
    // Route::get('/login-register',[LoginRegisterController::class , 'loginRegisterForm'])->name('auth.customer.login-register-form');
    // Route::post('/login-register',[LoginRegisterController::class , 'loginRegister'])->name('auth.customer.login-register');
    // Route::get('/login-confirm-form/{token}',[LoginRegisterController::class , 'loginConfirmForm'])->name('auth.customer.login-confirm-form');
    // Route::post('/login-confirm/{token}',[LoginRegisterController::class , 'loginConfirm'])->name('auth.customer.login-confirm');
    // Route::get('/login-resend-otp/{token}',[LoginRegisterController::class , 'loginResendOtp'])->name('auth.customer.login-resend-otp');
    // Route::get('/logout',[LoginRegisterController::class , 'logout'])->name('auth.customer.logout');
    Route::get('/logout',[LoginRegisterController::class , 'logout'])->name('auth.customer.logout');

});



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('user-panel.user-panel');
    })->name('dashboard');
});
