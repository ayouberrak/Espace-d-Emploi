<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Broadcast;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Broadcast::routes();
        require base_path('routes/channels.php');

        \Illuminate\Support\Facades\View::composer('*', function ($view) {
            if (auth()->check()) {
                $notifications = auth()->user()->notifications()->whereNull('read_at')->latest()->take(5)->get();
                $unreadCount = auth()->user()->notifications()->whereNull('read_at')->count();
                $view->with('notifications', $notifications)->with('unreadCount', $unreadCount);
            }
        });
    }
}
