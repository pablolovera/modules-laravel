<?php

namespace App\Core\Console\Commands;

use Illuminate\Console\Command;

class ModuleServiceProvider extends Command
{
    use CommandTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-service-provider {name} {module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make a new Service Provider extending of Core module';

    protected $stub = 'service-provider';

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
        $name               = $this->argument('name');
        $toDirectory        = $moduleDirectory . $module;

        $content            = $this->getContents($this->stub);

        $content            = $this->replaceName($name, $content);
        $content            = $this->replaceModuleName($module, $content);
        $content            = $this->replaceModuleNamespace($module, $content);
        $content            = $this->replaceRoutePrefix($module, $content);

        $this->doDirectory($toDirectory);

        $this->writeFile($content, $toDirectory, $name, $this->stub);

        $this->info('The Module ' . $module .' has been received a new service provider: ' . $name . '. Be happy!');
    }
}
