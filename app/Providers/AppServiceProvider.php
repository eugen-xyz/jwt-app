<?php

namespace App\Providers;

use App\DatabaseTypes\DateTimeWithMicrosecondsObject;
use App\DatabaseTypes\FindInSet;
use App\DatabaseTypes\MoneyObject;
use App\DatabaseTypes\PercentageObject;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\EntityManager;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Registers custom Doctrine DBAL data types.
     */
    private function registerCustomDbalTypes()
    {
        /** @var EntityManager $entityManager */
        $entityManager = $this->app['em'];

        try {
            Type::addType("MoneyObject", MoneyObject::class);
            $entityManager->getConnection()->getDatabasePlatform()->registerDoctrineTypeMapping(
                "MoneyObject",
                "MoneyObject"
            );

            Type::addType("PercentageObject", PercentageObject::class);
            $entityManager->getConnection()->getDatabasePlatform()->registerDoctrineTypeMapping(
                "PercentageObject",
                "PercentageObject"
            );

            Type::overrideType('datetime', DateTimeWithMicrosecondsObject::class);

        } catch (\Doctrine\DBAL\DBALException $e) {
            /** Do nothing - this makes this method idempotent */
        }

        $entityManager->getConfiguration()->addCustomStringFunction('FIND_IN_SET', FindInSet::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if($this->app->environment('production')) {
            \URL::forceScheme('https');
        }

        if (config('app.forceHttps')){
            \URL::forceScheme('https');
        }

        $this->registerCustomDbalTypes();
    }
}
