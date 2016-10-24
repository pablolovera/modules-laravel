<?php

namespace PabloLovera\ModulesLaravel\Commands;

class ModuleEntity extends BaseModules
{
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
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->toDirectory  = $this->toDirectory . '/Entities';

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->handleContent();

        $this->fire();

        $this->info('The Module ' . $this->module .' has been received a new entity: ' . $this->fileName . '. Be happy!');
    }

    private function handleContent()
    {
        $this->content      = $this->getContents($this->stub);

        $this->content      = $this->replaceName($this->fileName, $this->content);
        $this->content      = $this->replaceModuleName($this->module, $this->content);
        $this->content      = $this->replaceTableName($this->module, $this->content);
    }
}
