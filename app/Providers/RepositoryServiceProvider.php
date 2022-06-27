<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use  App\Interfaces\ProductInterface;
use  App\Repositories\ProductRepository;

use  App\Interfaces\OfferInterface;
use  App\Repositories\OfferRepository;

use App\Interfaces\TransactionInterface;
use  App\Repositories\TransactionRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProductInterface::class, ProductRepository::class);

        $this->app->bind(OfferInterface::class, OfferRepository::class);

        $this->app->bind(TransactionInterface::class, TransactionRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
