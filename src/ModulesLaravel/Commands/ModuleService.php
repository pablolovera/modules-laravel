<?php

namespace PabloLovera\ModulesLaravel\Commands;

class ModuleService extends BaseModules
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-service {name} {module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Service extending of Core module';

    /**
     * The stub name
     *
     * @var string
     * */
    protected $stub = 'service';

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
        $this->setToDirectory('Services');

        $this->handleContent();

        $this->fire();

        $this->info('The Module ' . $this->module .' has been received a new service: ' . $this->fileName . '. Be happy!');
    }

    /**
     * Handle de content file
     */
    private function handleContent()
    {
        $this->content  = $this->getContents($this->stub);

        $repositoryName = $this->getRepositoryName($this->fileName);

        $this->content  = $this->replaceName($this->fileName, $this->content);
        $this->content  = $this->replaceModuleName($this->module, $this->content);
        $this->content  = $this->replaceRepositoryName($repositoryName, $this->content);
    }

    public function getRepositoryName($name)
    {
        return str_replace('Service', '', $name) . 'Repository';
    }
}
