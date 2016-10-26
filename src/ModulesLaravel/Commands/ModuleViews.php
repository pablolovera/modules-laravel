<?php

namespace PabloLovera\ModulesLaravel\Commands;

class ModuleViews extends BaseModules
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-views {module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a views directory';


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

        $this->doDirectory($this->toDirectory);
        $this->doDirectory($this->toDirectory . '/assets');
        $this->doDirectory($this->toDirectory . '/assets/js');
        $this->doDirectory($this->toDirectory . '/assets/sass');
        $this->doDirectory($this->toDirectory . '/views');
        $this->doDirectory($this->toDirectory . '/views/errors');
        $this->doDirectory($this->toDirectory . '/views/vendor');
        $this->doDirectory($this->toDirectory . '/views/mails');

        $this->exportAppView();

        $this->call('module:make-view-form', ['module' => $this->module]);
        $this->call('module:make-view-list', ['module' => $this->module]);
        $this->call('module:make-view-show', ['module' => $this->module]);

        $this->info('The Module ' . $this->module .' has been received a new views. Be happy!');
    }

    private function exportAppView()
    {
        copy(__DIR__ . $this->pathStubs . 'view-app.stub', base_path('resources/views/layouts/app.blade.php'));
    }
}
