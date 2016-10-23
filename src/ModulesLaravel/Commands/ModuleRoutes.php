<?php

namespace App\Core\Console\Commands;

use Illuminate\Console\Command;
use App\Core\Console\Traits\CommandTrait;

class ModuleRoutes extends Command
{
    use CommandTrait;
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
    private $moduleDirectory = '';

    /**
     * The module name
     *
     * @var string
     * */
    private $module = '';

    /**
     * The directory target
     *
     * @var string
     * */
    private $toDirectory = '';

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
        $this->toDirectory        = $this->moduleDirectory . $this->module . '/Routes';

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
        $content            = $this->getContents($this->stubApi);

        $content            = $this->replaceModuleName($this->module, $content);

        $this->doDirectory($this->toDirectory);

        $this->writeFile($content, $this->toDirectory, 'api');

        return;
    }

    /**
     * Write the web routes
     *
     * @return void
     */
    private function webRoutes()
    {
        $content            = $this->getContents($this->stubWeb);

        $content            = $this->replaceModuleName($this->module, $content);
        $content            = $this->replaceNamespace(strtolower($this->module), $content);

        $this->doDirectory($this->toDirectory);

        $this->writeFile($content, $this->toDirectory, 'web');

        return;
    }
}
