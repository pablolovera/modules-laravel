<?php

namespace PabloLovera\ModulesLaravel\Providers;

use Illuminate\Support\ServiceProvider;

class ConsoleServiceProvider extends ServiceProvider
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
        'ModuleController',
        'ModuleCrud',
        'ModuleModel',
        'ModuleRequest',
        'ModuleRoutes',
        'ModuleServiceProvider',
        'ModuleTransformer',
        'ModuleViewDados',
        'ModuleViewLista',
        'ModuleMigrate',
        'ModuleMigration',
        'ModuleSeeder',
        'ModuleSeed',
//        'ModuleEntityContract',
//        'ModuleRepository',
//        'ModuleRepositoryContract',
//        'ModuleService',
//        'ModuleServiceContract',
    ];

    /**
     *
     */
    public function boot()
    {
        $this->publishes([__DIR__.'/../../resources/config/module.php' => config_path('module.php')], 'config');
    }

    /**
     * Register the commands.
     */
    public function register()
    {
        foreach ($this->commands as $command) {
            $this->commands($this->namespace.$command);
        }
    }

    /**
     * @return array
     */
    public function provides()
    {
        $provides = [];

        foreach ($this->commands as $command) {
            $provides[] = $this->namespace.$command;
        }

        return $provides;
    }
}