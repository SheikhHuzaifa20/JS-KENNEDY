<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
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
        // Bootstrap pagination
        Paginator::useBootstrap();

        // Custom validation rule: block mailinator.com
        Validator::extend('no_mailinator', function ($attribute, $value, $parameters, $validator) {
            return !str_contains(strtolower($value), '@mailinator.com');
        });

        Validator::replacer('no_mailinator', function ($message, $attribute, $rule, $parameters) {
            return 'Email addresses from mailinator.com are not allowed.';
        });
    }
}
