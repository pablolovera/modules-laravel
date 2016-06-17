<?php

namespace App\Core\Console\Commands;

use Illuminate\Console\Command;

class ModuleMigration extends Command
{
    use CommandTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-migration {name} {module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make a new Migration for module';

    protected $stub = 'migration';

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
        $toDirectory        = $moduleDirectory . $module . '/Database/migrations';

        $content            = $this->getContents($this->stub);

        $content            = $this->replaceMigrationName($name, $content);
        $content            = $this->replaceTableName($module, $content);

        $name               = $this->timestampToMigration() . $name;

        $this->doDirectory($toDirectory);

        $this->writeFile($content, $toDirectory, $name);

        $this->info('The Module ' . $module .' has been received a new migration: ' . $name . '. Be happy!');
    }
}
