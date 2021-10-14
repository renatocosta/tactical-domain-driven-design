<?php

namespace Domains\HostProperties\Infrastructure\Framework\Providers;

use Common\Application\Event\Bus\DomainEventBus;
use Domains\Context\BankAccount\Application\UseCases\Account\CreatePropertyUseCase;
use Domains\HostProperties\Application\EventHandlers\Property\PropertyCreatedEventHandler;
use Domains\HostProperties\Application\EventHandlers\Property\PropertyRejectedEventHandler;
use Domains\HostProperties\Application\UseCases\Property\ICreatePropertyUseCase;
use Domains\HostProperties\Domain\Model\Property\IPropertyRepository;
use Domains\HostProperties\Domain\Model\Property\Property;
use Domains\HostProperties\Domain\Model\Property\PropertyEntity;
use Domains\HostProperties\Infrastructure\Domain\Repositories\PropertyRepository;
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
        $this->app->singleton(IPropertyRepository::class, function () {
            $baseRepo = new PropertyRepository(new PropertyModel());
            $cachingRepo = new PropertyRepositoryInMemory($baseRepo, $this->app['cache.store']);
            return $cachingRepo;
        });

        $this->app->singleton(Property::class, function (DomainEventBus $domainEventBus) {
            return new PropertyEntity($domainEventBus);
        });
    }

    public function loadUseCases(): void
    {
        ## Create a Property ##
        $this->app->singleton(
            ICreatePropertyUseCase::class,
            function (DomainEventBus $domainEventBus, Property $property, IPropertyRepository $propertyRepository) {
                $domainEventBus->subscribers([new PropertyCreatedEventHandler($propertyRepository), new PropertyRejectedEventHandler()]);
                return new CreatePropertyUseCase($property);
            }
        );

        ## Querying all Properties ##
        /*$this->app->singleton(
            IGetAccounts::class,
            function (IAccountRepository $accountRepository) {
                return new GetAllAccountsQuery($accountRepository);
            }
        );*/
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__ . '/../Config/config.php' => config_path('tasks.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__ . '/../Config/config.php',
            'tasks'
        );
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/tasks');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'tasks');
        } else {
            $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'tasks');
        }
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
