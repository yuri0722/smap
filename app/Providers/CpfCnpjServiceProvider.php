<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Validation\CpfCnpjValidation;

class CpfCnpjServiceProvider extends ServiceProvider
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
        $this->app->validator->resolver(function($translator, $data, $rules, $messages)
        {
            return new CpfCnpjValidation($translator, $data, $rules, $messages);
        });
    }
}
