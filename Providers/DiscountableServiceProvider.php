<?php

namespace Modules\Discountable\Providers;

//use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Discountable\Events\Handlers\RegisterDiscountableSidebar;

class DiscountableServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
        $this->app['events']->listen(BuildingSidebar::class, RegisterDiscountableSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('discounts', array_dot(trans('discountable::discounts')));
            // append translations

        });

        //$this->registerEloquentFactoriesFrom(__DIR__ . '/../Database/factories');
    }

    public function boot()
    {
        $this->publishConfig('discountable', 'permissions');
        $this->publishConfig('discountable', 'config');

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\Discountable\Repositories\DiscountRepository',
            function () {
                $repository = new \Modules\Discountable\Repositories\Eloquent\EloquentDiscountRepository(new \Modules\Discountable\Entities\Discount());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Discountable\Repositories\Cache\CacheDiscountDecorator($repository);
            }
        );
// add bindings

    }
    /**
     * Register factories.
     *
     * @param  string  $path
     * @return void
     */
    /*protected function registerEloquentFactoriesFrom($path)
    {
        $this->app->make(EloquentFactory::class)->load($path);
    }*/
}
