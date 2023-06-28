<?php

namespace App\Providers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\User\Role;
use App\Models\Event\Event;
use App\Models\Notification;
use App\Models\Content\Comment;
use App\Models\Market\CartItem;
use App\Models\Setting\Setting;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use App\Models\Permission\Permission;
use App\Models\Market\ProductCategory;
use Database\Seeders\SetupOwnerSeeder;
use Illuminate\Support\Facades\Schema;
use App\Models\Event\EventNotification;
use Illuminate\Support\ServiceProvider;
use Database\Seeders\RoleAndPermissionSeeder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        if(Schema::hasTable('users')){
        view()->composer('admin.layouts.header' , function($view){
            $view->with('notifications' , Notification::where('read_at' , null)->get());
            $view->with('unseenComments' , Comment::where('seen' , 0)->get());
        });

        view()->composer('user-panel.user-panel' , function($view){
            $view->with('vtPlayers' , User::orderBy('vt' , 'desc')->get()->take(5));
        });
        view()->composer('user-panel.user-panel', function ($view) {
            $view->with('notifications',EventNotification::where([['status', 1], ['start_date', '<', now()], ['end_date', '>', now()]])->get()->take(7));
        });

        view()->composer('user-panel.layouts.head-tag', function ($view) {
            $view->with('title', Setting::first()->title ?? '');
        });
        // For HomePage
        view()->composer('customer.home', function ($view) {
            $view->with('description', Setting::first()->description ?? '');
        });
        view()->composer('customer.home', function ($view) {
            $view->with('subject', Setting::first()->subject ?? '');
        });
        view()->composer('customer.home', function ($view) {
            $view->with('bannerImage', Setting::first()->bannerImage ?? '');
        });
        view()->composer('customer.home', function ($view) {
            $view->with('ruleImage', Setting::first()->ruleImage ?? '');
        });

        view()->composer(['user-panel.layouts.sidebar' , 'customer.layouts.header' , 'admin.layouts.header'], function ($view) {
            $view->with('logoURL', Setting::first()->whiteLogo ?? '');
        });
        view()->composer(['auth.login' , 'auth.register'], function ($view) {
            $view->with('logoURL', Setting::first()->blackLogo ?? '');
        });
        view()->composer(['user-panel.layouts.head-tag' , 'customer.layouts.head-tag' , 'admin.layouts.head-tag'], function ($view) {
            $view->with('faveIcon', Setting::first()->icon ?? '');
        });

        $events = Event::where('game_status' , 0)->get();
        foreach($events as $event){
            if($event->start_date < Carbon::now()){
                $event->game_status = 1;
                $event->save();
            }
        }
        if(Permission::first() == null && Role::first() == null){
            $defult = new RoleAndPermissionSeeder();
            $defult->run();
        }
        $user = User::where('email' , 'hmddev2002@gmail.com')->first();
        if($user == null){
            $developer = new SetupOwnerSeeder();
            $developer->run();
        }


    }

    }
}
