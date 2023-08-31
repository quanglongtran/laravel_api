<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider as SP;

class ServiceProvider extends SP
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $contracts = collect(scandir(app_path('Services/Contracts')))->filter(fn ($dir) => !in_array($dir, ['.', '..']));

        $contracts->each(function ($file) {
            $repositoryPath = app_path('Services/' . str_replace('Contract', '', $file));
            $contractPath = app_path("Services/Contracts/$file");
            $contract = str_replace('.php', '', str_replace('/', '\\', str_replace(env('PWD') . '/a', 'A', $contractPath)));
            $repository = str_replace('.php', '', str_replace('/', '\\', str_replace(env('PWD') . '/a', 'A', $repositoryPath)));

            if (file_exists($repositoryPath) && file_exists($contractPath)) {
                $this->app->singleton($contract, $repository);
            }
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
