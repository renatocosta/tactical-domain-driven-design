<?php

namespace Domains\HostProperties\Infrastructure\Framework\Providers;

use Common\Application\Event\Bus\DomainEventBus;
use Common\Policy\IPolicy;
use Domains\HostProperties\Application\EventHandlers\Property\PropertyCreatedEventHandler;
use Domains\HostProperties\Application\EventHandlers\Property\PropertyRejectedEventHandler;
use Domains\HostProperties\Application\UseCases\Property\CreatePropertyUseCase;
use Domains\HostProperties\Application\UseCases\Property\ICreatePropertyUseCase;
use Domains\HostProperties\Application\UseCases\Property\Queries\GetAllAccountsQuery;
use Domains\HostProperties\Application\UseCases\Property\Queries\IGetAccountsQuery;
use Domains\HostProperties\Domain\Model\Property\IPropertyRepository;
use Domains\HostProperties\Domain\Model\Property\Policies\PropertyDuplicatedPolicy;
use Domains\HostProperties\Domain\Model\Property\Property;
use Domains\HostProperties\Domain\Model\Property\PropertyEntity;
use Domains\HostProperties\Domain\Model\Property\Room;
use Domains\HostProperties\Domain\Model\Property\Specifications\PropertyRoomDiscountBetweenSpecification;
use Domains\HostProperties\Infrastructure\Domain\Repositories\PropertyRepository;
use Domains\HostProperties\Infrastructure\Domain\Repositories\PropertyRepositoryFake;
use Domains\HostProperties\Infrastructure\Domain\Repositories\PropertyRepositoryInMemory;
use Domains\HostProperties\Infrastructure\Framework\Entities\PropertyModel;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class HostPropertiesServiceProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerFactories();
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->loadCrossDependencies();
        $this->loadUseCases();
    }

    public function loadCrossDependencies(): void
    {

        $this->app->singleton(DomainEventBus::class, function () {
            return new DomainEventBus();
        });

        //For only use cases under Property model
        $this->app->singleton(IPropertyRepository::class, function ($app) {
            $baseRepo = new PropertyRepository(new PropertyModel());
            //$cachingRepo = new PropertyRepositoryInMemory($baseRepo, $this->app['cache.store']);
            $fakeRepo = new PropertyRepositoryFake($app[Property::class]);
            return $fakeRepo;
        });

        $this->app->bind(PropertyRoomDiscountBetweenSpecification::class, function () {
            return new PropertyRoomDiscountBetweenSpecification(Room::MIN_WIDTH, Room::MAX_WIDTH);
        });

        $this->app->bind(IPolicy::class, function ($app) {
            return new PropertyDuplicatedPolicy($app[Property::class]);
        });

        $this->app->bind(Property::class, function ($app) {
            return new PropertyEntity($app[DomainEventBus::class]);
        });
    }

    public function loadUseCases(): void
    {
        ## Create a Property ##
        $this->app->bind(
            ICreatePropertyUseCase::class,
            function ($app) {
                $app[DomainEventBus::class]->subscribers([new PropertyCreatedEventHandler($app[IPolicy::class], $app[IPropertyRepository::class]), new PropertyRejectedEventHandler()]);
                return new CreatePropertyUseCase($app[Property::class], $app[PropertyRoomDiscountBetweenSpecification::class]);
            }
        );

        ## Querying all Properties ##
        $this->app->bind(
            IGetAccountsQuery::class,
            function ($app) {
                return new GetAllAccountsQuery($app[IPropertyRepository::class]);
            }
        );
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        if (!app()->environment('production') && $this->app->runningInConsole()) {
            app(Factory::class)->load(__DIR__ . '/../Database/factories');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
