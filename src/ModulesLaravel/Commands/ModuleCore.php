<?php

namespace App\Core\Console\Commands;

use Illuminate\Console\Command;
use App\Core\Console\Traits\CommandTrait;

class ModuleCore extends Command
{
    use CommandTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-core';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the Core module';

    /**
     * The stubs names
     *
     * @var array
     * */
    protected $stubs = [
//        'core.console.commands_inspire',
        'core.console_kernel',
        'core.contracts.entities_base-entity-contract',
        'core.contracts.repositories_base-repository-contract',
        'core.contracts.services_base-service-contract',
        'core.entities_base-entity',
//        'core.events_event',
        'core.exceptions_handler',
        'core.exceptions_repository-exception',
        'core.http.controllers_controller',
        'core.http.controllers_oauth-controller',
        'core.http.middleware_authenticate',
        'core.http.middleware_cors',
        'core.http.middleware_encrypt-cookies',
        'core.http.middleware_redirect-if-authenticated',
        'core.http.middleware_verify-csrf-token',
        'core.http.requests_request',
        'core.http_kernel',
//        'core.http_routes',
//        'core.jobs_job',
//        'core.mail_base-mail.stub',
        'core.providers_app-service-provider',
        'core.providers_auth-service-provider',
        'core.providers_event-service-provider',
        'core.providers_route-service-provider',
        'core.repositories_base-repository',
        'core.services_base-service',
        'core.services_o-auth-password-grant',

    ];
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ( is_dir(config('module.core_directory')) )
            return $this->warn('The Core module already exists!');


        foreach ($this->stubs as $stub) :

            $content        = $this->getContents($stub);

            $stubHandled    = $this->handleStubName($stub);

            $toDirectory    = 'app/' . $stubHandled->path;

            $this->doDirectory($toDirectory);

            $this->writeFileSimple($content, $toDirectory, $stubHandled->file);

        endforeach;

        $this->info('Your application has been received de Core module. Go work!');
    }

    public function handleBootstrapApp()
    {
        $this->backupFile('bootstrap', 'app.php');

        $stub           = 'bootstrap_app';

        $content        = $this->getContents($stub);

        $stubHandled    = $this->handleStubName($stub, true);

        $toDirectory    = $stubHandled->path;

        $this->writeFileSimple($content, $toDirectory, $stubHandled->file);
    }

    public function handleConfigApp()
    {
        $this->backupFile('config', 'app.php');

        $content = $this->getConfigAppContents();


        $old = '
        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,';


        $new = '
        /*
         * Application Service Providers...
         */
        App\Core\Providers\AppServiceProvider::class,
        App\Core\Providers\AuthServiceProvider::class,
        App\Core\Providers\EventServiceProvider::class,
        App\Core\Providers\RouteServiceProvider::class,

        /*
         * Packages Service Providers...
         */
        PabloLovera\ModulesLaravel\Providers\ModulesServiceProvider::class,
        LucaDegasperi\OAuth2Server\Storage\FluentStorageServiceProvider::class,
        LucaDegasperi\OAuth2Server\OAuth2ServerServiceProvider::class,
        Cyvelnet\Laravel5Fractal\Laravel5FractalServiceProvider::class,

        /*
         * Modules Service Providers...
         */';

        $content = str_replace('PabloLovera\ModulesLaravel\Providers\ModulesServiceProvider::class,', '', $content);


        $content = str_replace($old, $new, $content);


        $toDirectory    = 'config';

        $this->writeFileSimple($content, $toDirectory, 'app.php');
    }
}
