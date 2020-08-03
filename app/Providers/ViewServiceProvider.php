<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Http\ViewComposers;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // admin
        View::composers([
            ViewComposers\FormDateComposer::class => [
                'admin.remind_mail.create',
                'admin.remind_mail.edit',
            ],
        ]);
    }
}
