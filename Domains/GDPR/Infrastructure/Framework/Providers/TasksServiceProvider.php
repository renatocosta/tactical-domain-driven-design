<?php

namespace Domains\Tasks\Infrastructure\Framework\Providers;

use CrossCutting\Domain\Application\Event\Bus\DomainEventBus;
use Domains\Context\BankAccount\Application\EventHandlers\Account\AccountCreatedEventHandler;
use Domains\Context\BankAccount\Application\EventHandlers\Account\AccountRejectedEventHandler;
use Domains\Context\BankAccount\Application\UseCases\Account\CreateAccountUseCase;
use Domains\Context\BankAccount\Application\UseCases\Account\GetAllAccountsQuery;
use Domains\Context\BankAccount\Application\UseCases\Account\ICreateAccountUseCase;
use Domains\Context\BankAccount\Application\UseCases\Account\IGetAccounts;
use Domains\Context\BankAccount\Domain\Model\Account\Account;
use Domains\Context\BankAccount\Domain\Model\Account\AccountEntity;
use Domains\Context\BankAccount\Domain\Model\Account\AccountRepository;
use Domains\Context\BankAccount\Domain\Model\Account\AccountRepositoryInMemory;
use Domains\Context\BankAccount\Domain\Model\Account\IAccountRepository;
use Domains\Context\BankAccount\Infrastructure\Framework\Entities\AccountModel;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class TasksServiceProvider extends ServiceProvider
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
        $this->loadEssentials();
        $this->loadUseCases();
    }

    public function loadEssentials(): void
    {

        $this->app->singleton(DomainEventBus::class, function () {
            return new DomainEventBus();
        });

        //For only use cases under Account model
        $this->app->singleton(IAccountRepository::class, function () {
            $baseRepo = new AccountRepository(new AccountModel());
            $cachingRepo = new AccountRepositoryInMemory($baseRepo, $this->app['cache.store']);
            return $cachingRepo;
        });

        $this->app->singleton(Account::class, function (DomainEventBus $domainEventBus) {
            return new AccountEntity($domainEventBus);
        });
    }

    public function loadUseCases(): void
    {
        ## Create Account ##
        $this->app->singleton(
            ICreateAccountUseCase::class,
            function (DomainEventBus $domainEventBus, Account $account, IAccountRepository $accountRepository) {
                $domainEventBus->subscribers([new AccountCreatedEventHandler(), new AccountRejectedEventHandler(), new AccountCreatedNotificationEventHandler(), new AccountCreatedStreamEventHandler()]);
                return new CreateAccountUseCase($account, $accountRepository);
            }
        );

        ## Querying all Accounts ##
        $this->app->singleton(
            IGetAccounts::class,
            function (IAccountRepository $accountRepository) {
                return new GetAllAccountsQuery($accountRepository);
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
