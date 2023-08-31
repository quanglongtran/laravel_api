<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $contracts = collect(scandir(app_path('Repositories/Contracts')))->filter(fn ($dir) => !in_array($dir, ['.', '..']));

        $contracts->each(function ($file) {
            $repositoryPath = app_path('Repositories/' . str_replace('Contract', '', $file));
            $contractPath = app_path("Repositories/Contracts/$file");
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
