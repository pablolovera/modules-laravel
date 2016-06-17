<?php

namespace PabloLovera\ModulesLaravel\Commands;

use Illuminate\Console\Command;
use PabloLovera\ModulesLaravel\Traits\CommandTrait;

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
     * The stub name
     *
     * @var string
     * */
    protected $stub = 'routes';

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
        $moduleDirectory    = config('module.modules_directory');
        $module             = $this->argument('module');
        $name               = 'routes';
        $toDirectory        = $moduleDirectory . $module . '/Http';

        $content            = $this->getContents($this->stub);

        $content            = $this->replaceModuleName($module, $content);

        $this->doDirectory($toDirectory);

        $this->writeFile($content, $toDirectory, $name);

        $this->info('The Module ' . $module .' has been received a new routes file: ' . $name . '. Be happy!');
    }
}
