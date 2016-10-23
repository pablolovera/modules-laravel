<?php

namespace App\Core\Console\Commands;

use Illuminate\Console\Command;
use App\Core\Console\Traits\CommandTrait;

class ModuleEntity extends Command
{
    use CommandTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-entity {name} {module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Entity extending of Core module';

    /**
     * The stub name
     *
     * @var string
     * */
    protected $stub = 'module-entity';

    /**
     * The directory stubs
     *
     * @var string
     * */
    protected $pathStubs = 'modules';

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
        $toDirectory        = $moduleDirectory . $module . '/Entities';

        $content            = $this->getContents($this->stub);

        $content            = $this->replaceName($name, $content);
        $content            = $this->replaceModuleName($module, $content);
        $content            = $this->replaceTableName($module, $content);

        $this->doDirectory($toDirectory);

        $this->writeFile($content, $toDirectory, $name, $this->stub);

        $this->info('The Module ' . $module .' has been received a new entity: ' . $name . '. Be happy!');
    }
}
