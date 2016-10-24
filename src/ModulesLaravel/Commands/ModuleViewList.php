<?php

namespace PabloLovera\ModulesLaravel\Commands;

class ModuleViewList extends BaseModules
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-view-list {module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new List View';

    /**
     * The stub name
     *
     * @var string
     * */
    protected $stub = 'module-view';

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
        $this->setToDirectory('Resource');

        $this->copyStubTo('/views/list.blade.php');

        $this->info('The Module ' . $this->module .' has been received a new list view. Be happy!');
    }
}
