<?php

namespace PabloLovera\ModulesLaravel\Commands;

class ModuleController extends BaseModules
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-controller {name} {module} {--type?= : API or Web to generate once controller}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Controller extending of Core module';

    /**
     * The stub name for api controller
     *
     * @var string
     * */
    protected $stubApi = 'module-controller-api';

    /**
     * The stub name for web controller
     *
     * @var string
     * */
    protected $stubWeb = 'module-controller-web';

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

        $this->apiController();
        $this->webController();

        $this->info('The Module ' . $this->module .' has been received a new controller: ' . $this->fileName . '. Be happy!');
    }

    /**
     * Write the api routes
     *
     * @return void
     */
    private function apiController()
    {
        $this->setToDirectory('Http/Controllers/API');

        $this->content  = $this->getContents($this->stubApi);

        $this->handleContent();

        $this->fire();
    }

    /**
     * Write the web routes
     *
     * @return void
     */
    private function webController()
    {
        $this->setToDirectory('Http/Controllers/Web');

        $this->content  = $this->getContents($this->stubApi);

        $this->handleContent();

        $this->fire();
    }

    /**
     * Handle de content file
     */
    private function handleContent()
    {
        $requestName        = $this->getRequestName($this->fileName);
        $serviceName        = $this->getServiceName($this->fileName);
        $transformerName    = $this->getTransformerName($this->fileName);
        $routeName          = $this->getRouteName($this->fileName);

        $this->content      = $this->replaceModuleName($this->module, $this->content);
        $this->content      = $this->replaceName($this->fileName, $this->content);
        $this->content      = $this->replaceRequestName($requestName, $this->content);
        $this->content      = $this->replaceServiceName($serviceName, $this->content);
        $this->content      = $this->replaceTransformerName($transformerName, $this->content);
        $this->content      = $this->replaceName($this->fileName, $this->content);
        $this->content      = $this->replaceLowerName($routeName, $this->content);
        $this->content      = $this->replaceNamespace(strtolower($this->module), $this->content);
        $this->content      = $this->replaceModuleName($this->module, $this->content);
    }

    /**
     * @param $name
     * @return string
     */
    public function getRequestName($name)
    {
        return str_replace('Controller', '', $name) . 'Request';
    }

    /**
     * @param $name
     * @return string
     */
    public function getServiceName($name)
    {
        return str_replace('Controller', '', $name) . 'Service';
    }

    /**
     * @param $name
     * @return string
     */
    public function getTransformerName($name)
    {
        return str_replace('Controller', '', $name) . 'Transformer';
    }

    /**
     * @param $name
     * @return string
     */
    public function getRouteName($name)
    {
        return strtolower(str_replace('Controller', '', $name));
    }
}
