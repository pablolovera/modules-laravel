<?php

namespace App\Core\Console\Commands;

use Illuminate\Console\Command;

class ModuleModel extends Command
{
    use CommandTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-model {name} {module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make a new Model extending of Core module';

    protected $stub = 'model';

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
        $toDirectory        = $moduleDirectory . $module . '/Models';

        $content            = $this->getContents($this->stub);

        $content            = $this->replaceName($name, $content);
        $content            = $this->replaceModuleName($module, $content);
        $content            = $this->replaceTableName($module, $content);

        $this->doDirectory($toDirectory);

        $this->writeFile($content, $toDirectory, $name);

        $this->info('The Module ' . $module .' has been received a new entity: ' . $name . '. Be happy!');
    }
}
