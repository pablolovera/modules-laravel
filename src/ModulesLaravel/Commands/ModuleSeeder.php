<?php

namespace App\Core\Console\Commands;

use Illuminate\Console\Command;

class ModuleSeeder extends Command
{
    use CommandTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-seeder {name} {module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make a new Seed for a module';

    protected $stub = 'seeder';

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
        $toDirectory        = $moduleDirectory . $module . '/Database/seeds';

        $content            = $this->getContents($this->stub);

        $content            = $this->replaceName($name, $content);
        $content            = $this->replaceModuleName($module, $content);
        $content            = $this->replaceTableName($module, $content);

        $this->doDirectory($toDirectory);

        $this->writeFile($content, $toDirectory, $name);

        $this->info('The Module ' . $module .' has been received a new seeder: ' . $name . '. Be happy!');
    }
}
