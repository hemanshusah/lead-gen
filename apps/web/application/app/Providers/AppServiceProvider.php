<?php

namespace App\Providers;

use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider {
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(UrlGenerator $url) {

        //[mycrm] disable debug bar in production mode
        if (!env('APP_DEBUG_TOOLBAR')) {
            \Debugbar::disable();
        }

        //[mycrm] force SSL rul's
        if (env('ENFORCE_SSL', false)) {
            $url->forceScheme('https');
        }

        //[mycrm] - use bootstrap css for paginator
        Paginator::useBootstrap();

        //[grocrm] - custom views directory - used by imap email for embedded imaged, but can also be used for any temp blade filed 
        //Usage - view('temp::somefile');
        View::addNamespace('temp', path_storage('temp'));

        //[mycrm]
        $this->app->bind(Carbon::class, function (Container $container) {
            return new Carbon('now', 'Europe/Brussels');
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }
}
