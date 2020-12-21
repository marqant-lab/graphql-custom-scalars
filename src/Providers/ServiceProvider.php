<?php

namespace Marqant\GraphQLCustomScalars\Providers;

use Illuminate\Support\ServiceProvider as MainServiceProvider;

/**
 * Class ServiceProvider
 *
 * @package Marqant\GraphQLCustomScalars\Providers
 */
class ServiceProvider extends MainServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerScalars();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // boot package
    }

    /**
     * Register scalars of this package.
     *
     * @return void
     */
    private function registerScalars(): void
    {
        config(['lighthouse.namespaces.scalars' => array_merge(
            (array) config('lighthouse.namespaces.scalars'),
            (array) 'Marqant\\GraphQLCustomScalars\\GraphQL\\Types\\Scalars'
        )]);
    }
}
