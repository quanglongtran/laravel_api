<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;

class ValidatorProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Validator::extend('json_object', function ($attribute, $value, $parameters, $validator) {
            if (is_null($value)) {
                return true;
            }

            $data = json_decode($value);

            return is_object($data) && !is_array($data);
        });

        Validator::replacer('json_object', function ($message, $attribute, $rule, $parameters) {
            if ($message == "validation.$rule") {
                $message = 'Field :attribute must be an object';
            }

            return str_replace(':attribute', $attribute, $message);
        });
    }
}
