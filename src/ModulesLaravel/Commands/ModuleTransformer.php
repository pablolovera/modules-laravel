<?php

namespace PabloLovera\ModulesLaravel\Commands;

class ModuleTransformer extends BaseModules
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-transformer {name} {module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Transformer extending of Abstract Transformer';

    /**
     * The stub name
     *
     * @var string
     * */
    protected $stub = 'transformer';

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
        $this->setToDirectory('Transformers');

        $this->handleContent();

        $this->fire();

        $this->info('The Module ' . $this->module .' has been received a new transformer: ' . $this->fileName . '. Be happy!');
    }

    /**
     * Handle de content file
     */
    private function handleContent()
    {
        $this->content  = $this->getContents($this->stub);

        $entityName     = $this->getEntityName($this->fileName);

        $this->content  = $this->replaceName($this->fileName, $this->content);
        $this->content  = $this->replaceModuleName($this->module, $this->content);
        $this->content  = $this->replaceEntityName($entityName, $this->content);

    }

    public function getEntityName($name)
    {
        return str_replace('Transformer', '', $name) . 'Entity';
    }
}
