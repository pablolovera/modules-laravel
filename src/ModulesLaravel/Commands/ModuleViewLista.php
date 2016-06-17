<?php

namespace App\Core\Console\Commands;

use Illuminate\Console\Command;

class ModuleViewLista extends Command
{
    use CommandTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-view-lista {module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make a new List View';

    protected $stub = 'view-lista';

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
        $toDirectory        = $moduleDirectory . $module . '/Views';

        $content            = $this->getContents($this->stub);

        $content            = $this->replaceModuleNameLower($module, $content);
        $content            = $this->replaceCamelModuleName($module, $content);

        $this->doDirectory($toDirectory);

        $this->writeFile($content, $toDirectory, 'lista.blade');

        $this->info('The Module ' . $module .' has been received a new list view. Be happy!');
    }
}
