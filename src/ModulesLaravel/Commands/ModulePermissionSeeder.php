<?php

namespace PabloLovera\ModulesLaravel\Commands;

class ModulePermissionSeeder extends BaseModules
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-permission-seeder {name} {context} {module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Permisison Seeder for a module';

    /**
     * The stub name
     *
     * @var string
     * */
    protected $stub = 'permission-table-seeder';

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
        $this->setContext($this->argument('context'));
        $this->setToDirectory('Database/seeds');

        $this->handleContent();

        $this->fire();

        $this->info('The Module ' . $this->module .' has been received a new permission seeder: ' . $this->fileName . '. Be happy!');
    }

    /**
     * Handle de content file
     */
    private function handleContent()
    {
        $this->content  = $this->getContents($this->stub);

        $this->content  = $this->replaceName($this->fileName, $this->content);
        $this->content  = $this->replaceModuleName($this->module, $this->content);
        $this->content  = $this->replaceContext($this->context, $this->content);
    }
}
