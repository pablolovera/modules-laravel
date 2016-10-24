<?php

namespace PabloLovera\ModulesLaravel\Commands;

use Illuminate\Console\Command;
use PabloLovera\ModulesLaravel\Traits\CommandTrait;

class ModuleController extends Command
{
    use CommandTrait;

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
     * The directory stubs
     *
     * @var string
     * */
    protected $pathStubs = 'modules';

    /**
     * The directory modules
     *
     * @var string
     * */
    private $moduleDirectory;

    /**
     * The module name
     *
     * @var string
     * */
    private $module;

    /**
     * The directory target
     *
     * @var string
     * */
    private $toDirectory;

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
        $this->moduleDirectory    = config('module.modules_directory');
        $this->module             = $this->argument('module');
        $this->name               = $this->argument('name');

        $this->apiController();
        $this->webController();

        $this->info('The Module ' . $this->module .' has been received a new controller: ' . $this->name . '. Be happy!');
    }

    /**
     * Write the api routes
     *
     * @return void
     */
    private function apiController()
    {
        $content = $this->replaceContent($this->stubApi);

        $this->toDirectory        = $this->moduleDirectory . $this->module . '/Http/Controllers/API';

        $this->doDirectory($this->toDirectory);

        $this->writeFile($content, $this->toDirectory, $this->name);

        return;
    }

    /**
     * Write the web routes
     *
     * @return void
     */
    private function webController()
    {
        $content = $this->replaceContent($this->stubWeb);

        $this->toDirectory        = $this->moduleDirectory . $this->module . '/Http/Controllers/Web';

        $this->doDirectory($this->toDirectory);

        $this->writeFile($content, $this->toDirectory, $this->name);

        return;
    }

    /**
     * Replace de contents in the stub
     *
     * @param $stub
     * @return mixed|string
     */
    private function replaceContent($stub)
    {
        $content            = $this->getContents($stub);

        $requestName        = $this->getRequestName($this->name);
        $serviceName        = $this->getServiceName($this->name);
        $transformerName    = $this->getTransformerName($this->name);

        $content            = $this->replaceModuleName($this->module, $content);
        $content            = $this->replaceName($this->name, $content);
        $content            = $this->replaceRequestName($requestName, $content);
        $content            = $this->replaceServiceName($serviceName, $content);
        $content            = $this->replaceTransformerName($transformerName, $content);
        $content            = $this->replaceName($this->name, $content);
        $content            = $this->replaceLowerName(strtolower($this->name), $content);
        $content            = $this->replaceNamespace(strtolower($this->module), $content);
        $content            = $this->replaceModuleName($this->module, $content);

        return $content;
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
}
