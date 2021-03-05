<?php

namespace App\Providers;

use App\Contracts\Factories\EventFactory as EventFactoryContract;
use App\Contracts\Factories\TicketFactory as TicketFactoryContract;
use App\Contracts\Repositories\EventRepository as EventRepositoryContract;
use App\Contracts\Repositories\TicketRepository as TicketRepositoryContract;
use App\Factories\EventFactory;
use App\Factories\TicketFactory;
use App\Repositories\EventRepository;
use App\Repositories\TicketRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /** @var array<string, string> */
    private array $factories = [
        EventFactoryContract::class => EventFactory::class,
        TicketFactoryContract::class => TicketFactory::class,
    ];

    /** @var array<string, string> */
    private array $repositories = [
        EventRepositoryContract::class => EventRepository::class,
        TicketRepositoryContract::class => TicketRepository::class,
    ];

    public function register(): void
    {
        $this->registerFactories();
        $this->registerRepositories();
    }

    public function boot(): void
    {
        //
    }

    private function registerFactories(): void
    {
        foreach ($this->factories as $factoryContract => $concreteFactory) {
            $this->app->singleton($factoryContract, $concreteFactory);
        }
    }

    private function registerRepositories(): void
    {
        foreach ($this->repositories as $repositoryContract => $concreteRepository) {
            $this->app->singleton($repositoryContract, $concreteRepository);
        }
    }
}
