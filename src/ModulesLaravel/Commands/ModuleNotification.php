<?php

namespace PabloLovera\ModulesLaravel\Commands;

class ModuleNotification extends BaseModules
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-notification {name} {module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Notification extending of Core module';

    /**
     * The stub name
     *
     * @var string
     * */
    protected $stub = 'module-notification';

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
        $this->setToDirectory('Notifications');

        $this->handleContent();

        $this->fire();

        $this->info('The Module ' . $this->module .' has been received a new notification: ' . $this->fileName . '. Be happy!');
    }

    /**
     * Handle de content file
     */
    private function handleContent()
    {
        $this->content      = $this->getContents($this->stub);

        $this->content      = $this->replaceName($this->fileName, $this->content);
        $this->content      = $this->replaceModuleName($this->module, $this->content);
    }
}
