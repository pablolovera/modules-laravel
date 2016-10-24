<?php

namespace PabloLovera\ModulesLaravel\Commands;

class ModuleViewForm extends BaseModules
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-view-form {module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Form View';

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
        $this->setToDirectory('Views');

        $this->copyStubTo('Resource/views/form.blade.php');

        $this->info('The Module ' . $this->module .' has been received a new inputs view. Be happy!');
    }
}
