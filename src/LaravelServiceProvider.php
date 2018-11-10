<?php

namespace Windmill\Modules;

use Windmill\Modules\Commands\BuildCreateCommand;
use Windmill\Modules\Commands\ModelCreateCommand;
use Windmill\Modules\Commands\ModuleUpdateCommand;
use Windmill\Modules\Commands\PermissionCreateCommand;
use Windmill\Modules\Services\MenusService;
use Illuminate\Support\ServiceProvider;
use Windmill\Modules\Commands\ModuleCreateCommand;
use Windmill\Modules\Commands\ConfigCreateCommand;

class LaravelServiceProvider extends ServiceProvider
{
    public $singletons = [
        'windmill-menu' => MenusService::class,
    ];

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                ModuleCreateCommand::class,
                ModuleUpdateCommand::class,
                ConfigCreateCommand::class,
                PermissionCreateCommand::class,
                ModelCreateCommand::class,
                BuildCreateCommand::class,
            ]);
        }
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Windmill', function () {
            return new WindmillModuleProvider();
        });
    }
}
