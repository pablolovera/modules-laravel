<?php

namespace PabloLovera\ModulesLaravel\Providers;

use Illuminate\Support\ServiceProvider;

class ModulesServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Parent command namespace.
     *
     * @var string
     */
    protected $namespace = 'PabloLovera\\ModulesLaravel\\Commands\\';

    /**
     * The available command shortname.
     *
     * @var array
     */
    protected $commands = [
        'Module',
        'ModuleCore',
        'ModuleCrud',
        'ModuleController',
        'ModuleEntity',
        'ModuleEntityContract',
        'ModuleEvent',
        'ModuleJob',
        'ModuleListener',
        'ModuleMail',
        'ModuleMigrate',
        'ModuleMigration',
        'ModuleNotification',
        'ModulePermissionSeeder',
        'ModuleRepository',
        'ModuleRepositoryContract',
        'ModuleRequest',
        'ModuleRoutes',
        'ModuleRouteServiceProvider',
        'ModuleSeed',
        'ModuleSeeder',
        'ModuleService',
        'ModuleServiceContract',
        'ModuleServiceProvider',
        'ModuleTransformer',
        'ModuleViews',
        'ModuleViewForm',
        'ModuleViewList',
        'ModuleViewShow',
        'ModuleUsers',
        'ModuleDashboard',
        'ModuleAuth',
        'ModuleStart'
    ];

    /**
     *
     */
    public function boot()
    {
        $this->publishes([__DIR__.'/../../resources/config/module.php' => config_path('module.php')], 'config');
        $this->publishes([__DIR__.'/../../resources/config/fractal.php' => config_path('fractal.php')], 'config');
        $this->publishes([__DIR__.'/../../resources/config/defender.php' => config_path('defender.php')], 'config');

    }

    /**
     * Register the commands.
     */
    public function register()
    {
        foreach ($this->commands as $command)
            $this->commands($this->namespace.$command);
    }

    /**
     * @return array
     */
    public function provides()
    {
        $provides = [];

        foreach ($this->commands as $command)
            $provides[] = $this->namespace.$command;

        return $provides;
    }
}
