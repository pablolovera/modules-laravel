<?php

namespace PabloLovera\ModulesLaravel\Commands;

class ModuleViewShow extends BaseModules
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-view-show {module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new show view';

    /**
     * The stub name
     *
     * @var string
     * */
    protected $stub = 'view-show.blade';

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
        $this->setToDirectory('Resources');

        $this->copyStubTo('/views/show.blade.php');

        $this->info('The Module ' . $this->module .' has been received a new show view. Be happy!');
    }
}
