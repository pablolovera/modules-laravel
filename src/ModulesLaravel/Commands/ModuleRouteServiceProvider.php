<?php

namespace PabloLovera\ModulesLaravel\Commands;

class ModuleRouteServiceProvider extends BaseModules
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-route-service-provider {name} {module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Route Service Provider for existing module';

    /**
     * The stub name
     *
     * @var string
     * */
    protected $stub = 'route-service-provider';

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
        $this->setModule($this->argument('module'));
        $this->setFileName($this->argument('name'));
        $this->setToDirectory('Providers');

        $this->handleContent();

        $this->fire();

        $this->info('The Module ' . $this->module .' has been received a new route service provider: ' . $this->fileName . '. Be happy!');
    }

    /**
     * Handle de content file
     */
    private function handleContent()
    {
        $this->content  = $this->getContents($this->stub);

        $this->content  = $this->replaceModuleName($this->module, $this->content);
        $this->content  = $this->replaceLowerName(strtolower($this->module), $this->content);
        $this->content  = $this->replaceRoutePrefix($this->module, $this->content);
    }
}
