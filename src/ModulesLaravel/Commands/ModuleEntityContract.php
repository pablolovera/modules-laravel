<?php

namespace PabloLovera\ModulesLaravel\Commands;

class ModuleEntityContract extends BaseModules
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-entity-contract {name} {module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Entity Contract extending of Core module';

    /**
     * The stub name
     *
     * @var string
     * */
    protected $stub = 'entity-contract';

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
        $this->setModule($this->argument('module'));
        $this->setFileName($this->argument('name'));
        $this->setToDirectory('Contracts/Entities');

        $this->handleContent();

        $this->fire();

        $this->info('The Module ' . $this->module .' has been received a new entity contract: ' . $this->fileName . '. Be happy!');
    }

    private function handleContent()
    {
        $this->content      = $this->getContents($this->stub);

        $this->content      = $this->replaceName($this->fileName, $this->content);
        $this->content      = $this->replaceModuleName($this->module, $this->content);
    }
}
