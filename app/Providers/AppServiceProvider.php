<?php

namespace App\Providers;

use DB;
use App\User;
use Sentinel;
use App\Orders;
use App\Wishlist;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
        Blade::directive('currency', function ($expression) {
            return "Rp. <?php echo number_format($expression, 0, ',', '.'); ?>";
        });

        view()->composer(['*'], function ($view) {
            if(Sentinel::check()) {
                $getdatauser    = Sentinel::getUser()->id;
                $countwishlist  = Wishlist::select('id')->whereIn('userID', [$getdatauser])->count();
                $view->with('wishlistcount',$countwishlist);
            }
        });

        view()->composer(['*'], function ($view) {
            if(Sentinel::check()) {
                $getdatauser        = Sentinel::getUser()->id;
                $counttransaction   = Orders::select('id')->whereIn('user_id', [$getdatauser])->count();
                $view->with('transactioncount',$counttransaction);
            }
        });

        view()->composer(['*'], function ($view) {
            if(Sentinel::check()) {
                $getdatauser        = Sentinel::getUser()->id;
                $countpoint         = Orders::select('id')->whereIn('user_id', [$getdatauser])->where('payment_status', 'success')->sum('customer_point');
                $view->with('pointcount',$countpoint);
            }
        });
    }
}
