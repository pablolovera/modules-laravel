<?php

namespace PabloLovera\ModulesLaravel\Commands;

class ModuleMigration extends BaseModules
{
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
    protected $description = 'Create a new Migration for module';

    /**
     * The stub name
     *
     * @var string
     * */
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
        $this->setModule($this->argument('module'));
        $this->setFileName($this->argument('name'));
        $this->setToDirectory('Database/migrations');

        $this->handleContent();

        $this->fire();

        $this->info('The Module ' . $this->module .' has been received a new migration: ' . $this->fileName . '. Be happy!');
    }

    /**
     * Handle de content file
     */
    private function handleContent()
    {
        $this->content  = $this->getContents($this->stub);

        $this->content  = $this->replaceMigrationName(strtolower($this->fileName), $this->content);
        $this->content  = $this->replaceTableName(strtolower($this->module), $this->content);

        $this->fileName = $this->timestampToMigration() . $this->fileName;
    }
}
