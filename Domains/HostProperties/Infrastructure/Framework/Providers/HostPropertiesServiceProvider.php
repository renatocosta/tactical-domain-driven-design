<?php

namespace Domains\HostProperties\Infrastructure\Framework\Providers;

use Common\Application\Event\Bus\DomainEventBus;
use Common\DataConsistency\UnitOfWork;
use Common\Policy\IPolicy;
use Domains\HostProperties\Application\EventHandlers\Calendar\CalendarCreatedEventHandler;
use Domains\HostProperties\Application\EventHandlers\Calendar\CalendarMixPanelNotificationEventHandler;
use Domains\HostProperties\Application\EventHandlers\Calendar\CalendarRejectedEventHandler;
use Domains\HostProperties\Application\EventHandlers\Property\PropertyCreatedEventHandler;
use Domains\HostProperties\Application\EventHandlers\Property\PropertyRejectedEventHandler;
use Domains\HostProperties\Application\UseCases\Calendar\CreateCalendarUseCase;
use Domains\HostProperties\Application\UseCases\Calendar\ICreateCalendarUseCase;
use Domains\HostProperties\Application\UseCases\Calendar\Queries\GetAllCalendarsQuery;
use Domains\HostProperties\Application\UseCases\Calendar\Queries\IGetCalendarQuery;
use Domains\HostProperties\Application\UseCases\Property\CreatePropertyUseCase;
use Domains\HostProperties\Application\UseCases\Property\ICreatePropertyUseCase;
use Domains\HostProperties\Application\UseCases\Property\Queries\GetAllPropertyQuery;
use Domains\HostProperties\Application\UseCases\Property\Queries\IGetPropertyQuery;
use Domains\HostProperties\Domain\Model\Calendar\Calendar;
use Domains\HostProperties\Domain\Model\Calendar\CalendarEntity;
use Domains\HostProperties\Domain\Model\Calendar\ICalendarRepository;
use Domains\HostProperties\Domain\Model\Property\IPropertyRepository;
use Domains\HostProperties\Domain\Model\Property\Policies\PropertyDuplicatedPolicy;
use Domains\HostProperties\Domain\Model\Property\Property;
use Domains\HostProperties\Domain\Model\Property\PropertyEntity;
use Domains\HostProperties\Domain\Model\Property\Room;
use Domains\HostProperties\Domain\Model\Property\Specifications\PropertyRoomDiscountBetweenSpecification;
use Domains\HostProperties\Domain\Services\PropertyCalendarManageable;
use Domains\HostProperties\Domain\Services\PropertyCalendarManager;
use Domains\HostProperties\Infrastructure\Domain\Repositories\CalendarRepository;
use Domains\HostProperties\Infrastructure\Domain\Repositories\CalendarRepositoryFake;
use Domains\HostProperties\Infrastructure\Domain\Repositories\PropertyRepository;
use Domains\HostProperties\Infrastructure\Domain\Repositories\PropertyRepositoryFake;
use Domains\HostProperties\Infrastructure\Framework\Entities\CalendarModel;
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

        $this->app->singleton(IPropertyRepository::class, function ($app) {
            //$baseRepo = new PropertyRepository(new PropertyModel());
            //$cachingRepo = new PropertyRepositoryInMemory($baseRepo, $this->app['cache.store']);
            $fakeRepo = new PropertyRepositoryFake($app[Property::class]);
            return $fakeRepo;
        });

        $this->app->singleton(PropertyRoomDiscountBetweenSpecification::class, function () {
            return new PropertyRoomDiscountBetweenSpecification(Room::MIN_WIDTH, Room::MAX_WIDTH);
        });

        $this->app->singleton(IPolicy::class, function ($app) {
            return new PropertyDuplicatedPolicy($app[Property::class]);
        });

        $this->app->singleton(Property::class, function ($app) {
            return new PropertyEntity($app[DomainEventBus::class]);
        });

        $this->app->singleton(ICalendarRepository::class, function ($app) {
            //$baseRepo = new CalendarRepository(new CalendarModel());
            //$cachingRepo = new CalendarRepositoryInMemory($baseRepo, $this->app['cache.store']);
            $fakeRepo = new CalendarRepositoryFake($app[Calendar::class]);
            return $fakeRepo;
        });

        $this->app->singleton(Calendar::class, function ($app) {
            return new CalendarEntity($app[DomainEventBus::class]);
        });

        $this->app->singleton(PropertyCalendarManageable::class, function ($app) {
            return new PropertyCalendarManager($app[Calendar::class], $app[ICalendarRepository::class]);
        });
    }

    public function loadUseCases(): void
    {
        ## Create a Property ##
        $this->app->singleton(
            ICreatePropertyUseCase::class,
            function ($app) {
                $app[DomainEventBus::class]->subscribers([new PropertyCreatedEventHandler($app[IPolicy::class], $app[IPropertyRepository::class]), new PropertyRejectedEventHandler(new UnitOfWork())]);
                return new CreatePropertyUseCase($app[Property::class], $app[PropertyRoomDiscountBetweenSpecification::class]);
            }
        );

        ## Querying all Properties ##
        $this->app->singleton(
            IGetPropertyQuery::class,
            function ($app) {
                return new GetAllPropertyQuery($app[IPropertyRepository::class]);
            }
        );

        ## Create a Calendar ##
        $this->app->singleton(
            ICreateCalendarUseCase::class,
            function ($app) {
                $app[DomainEventBus::class]->subscribers([new CalendarCreatedEventHandler($app[ICalendarRepository::class]), new CalendarMixPanelNotificationEventHandler(), new CalendarRejectedEventHandler($app[ICalendarRepository::class])]);
                return new CreateCalendarUseCase($app[Calendar::class], $app[Property::class], $app[PropertyCalendarManageable::class]);
            }
        );

        ## Querying all Calendar ##
        $this->app->singleton(
            IGetCalendarQuery::class,
            function ($app) {
                return new GetAllCalendarsQuery($app[ICalendarRepository::class]);
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
