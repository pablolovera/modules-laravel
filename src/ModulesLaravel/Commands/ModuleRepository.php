<?php

namespace PabloLovera\ModulesLaravel\Commands;

class ModuleRepository extends BaseModules
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-repository {name} {module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Repository extending of Core module';

    /**
     * The stub name
     *
     * @var string
     * */
    protected $stub = 'repository';

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
        $this->setToDirectory('Repositories');

        $this->handleContent();

        $this->fire();

        $this->info('The Module ' . $this->module .' has been received a new repository: ' . $this->fileName . '. Be happy!');
    }

    /**
     * Handle de content file
     */
    private function handleContent()
    {
        $entityName     = $this->getEntityName($this->fileName);

        $this->content  = $this->getContents($this->stub);

        $this->content  = $this->replaceEntityName($entityName, $this->content);

        $this->content  = $this->replaceName($this->fileName, $this->content);
        $this->content  = $this->replaceModuleName($this->module, $this->content);
    }

    public function getEntityName($name)
    {
        return str_replace('Repository', '', $name) . 'Entity';
    }
}
