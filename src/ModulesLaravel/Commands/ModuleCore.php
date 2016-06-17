<?php

namespace PabloLovera\ModulesLaravel\Commands;

use Illuminate\Console\Command;
use PabloLovera\ModulesLaravel\Traits\CommandTrait;

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
        'core.console.commands_inspire',
        'core.console.commands_kernel',
        'core.events_event',
        'core.exceptions_handler',
        'core.http.controllers.auth_auth-controller',
        'core.http.controllers.auth_password-controller',
        'core.http.controllers_controller',
        'core.http.middleware_authenticate',
        'core.http.middleware_encrypt-cookies',
        'core.http.middleware_redirect-if-authenticated',
        'core.http.middleware_verify-csrf-token',
        'core.http.requests_request',
        'core.http_kernel',
        'core.http_routes',
        'core.jobs_job',
        'core.providers_app-service-provider',
        'core.providers_auth-service-provider',
        'core.providers_event-service-provider',
        'core.providers_route-service-provider',
        'core.traits_common',
        'core.traits_uploads'
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

            $content = $this->getContents($stub);

            $stubHandled = $this->handleStubName($stub);

            $toDirectory        = 'app/' . $stubHandled->path;

            $this->doDirectory($toDirectory);

            $this->writeFileSimple($content, $toDirectory, $stubHandled->file);

        endforeach;

        $this->info('Your application has been received de Core module. Go work!');
    }
}
