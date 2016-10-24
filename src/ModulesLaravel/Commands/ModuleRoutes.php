<?php

namespace PabloLovera\ModulesLaravel\Commands;

class ModuleRoutes extends BaseModules
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-router {module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Router for module';

    /**
     * The stub name for api routes
     *
     * @var string
     * */
    protected $stubApi = 'module-routes-api';

    /**
     * The stub name for web routes
     *
     * @var string
     * */
    protected $stubWeb = 'module-routes-web';

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
        $this->setToDirectory('Routes');

        $this->apiRoutes();

        $this->webRoutes();

        $this->info('The Module ' . $this->module .' has been received a new routes. Be happy!');
    }

    /**
     * Write the api routes
     *
     * @return void
     */
    private function apiRoutes()
    {
        $this->setFileName('api');

        $this->content  = $this->getContents($this->stubApi);

        $this->handleContent();

        $this->fire();

        return;
    }

    /**
     * Write the web routes
     *
     * @return void
     */
    private function webRoutes()
    {
        $this->setFileName('web');

        $this->content  = $this->getContents($this->stubWeb);

        $this->handleContent();

        $this->fire();

        return;
    }

    /**
     * Handle de content file
     */
    private function handleContent()
    {
        $this->content  = $this->replaceName($this->fileName, $this->content);
        $this->content  = $this->replaceModuleName($this->module, $this->content);
        $this->content  = $this->replaceNamespace(strtolower($this->module), $this->content);
    }
}
