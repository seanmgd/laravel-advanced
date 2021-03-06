<?php

namespace App\Providers;

use App\Channel;
use App\Http\View\Composers\ChannelsComposer;
use App\Mixins\StrMixin;
use App\Services\BankPaymentGateway;
use App\Services\CreditPaymentGateway;
use App\Interfaces\PaymentGatewayInterface;
use App\Services\PostcardSendingService;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

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
        // Service Container
        $this->app->singleton(PaymentGatewayInterface::class, function () {
            if (request()->has('credit')) { // Simply add ?credit at the end of the url
                return new CreditPaymentGateway('usd');
            }
            return new BankPaymentGateway('usd');
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     * @throws \ReflectionException
     */
    public function boot()
    {
        //
        // Facades

        $this->app->singleton('Postcard', function () {
            return new PostcardSendingService('fra', 4, 6);
        });

        //
        // View composer

        // Option 1: Every single view - Do not share like this way unless if it is necessary
//        View::share('channels', Channel::orderBy('name')->get());

        // Option 2: Specify views with wildcards
//        View::composer(['channel.*', 'post.create'], function ($view) {
//            $view->with('channels', Channel::orderBy('name')->get());
//        });

        // Option 3: Dedicated class - see app/Http/View/Composers/ChannelsComposer.php
        View::composer(['partials.channels.*'], ChannelsComposer::class);
        // Move both channels vars on resources/views/partials/channels


        //
        // Macros
        Str::mixin(new StrMixin(), true); // if false, mixin will not override other maccros with the same name

        ResponseFactory::macro('errorJson', function($message = 'This is a custom error') {
            return [
                'message' => $message,
                'error_code' => 404
            ];
        });
    }
}
