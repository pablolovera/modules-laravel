<?php

namespace PabloLovera\ModulesLaravel\Commands;


class ModuleJob extends BaseModules
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-job {name} {module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Job extending of Core module';

    /**
     * The stub name
     *
     * @var string
     * */
    protected $stub = 'module-job';

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
        $this->setToDirectory('Jobs');

        $this->handleContent();

        $this->fire();

        $this->checkBaseMail();

        $this->info('The Module ' . $this->module .' has been received a new job: ' . $this->fileName . '. Be happy!');
    }

    private function handleContent()
    {
        $this->content      = $this->getContents($this->stub);

        $this->content      = $this->replaceName($this->fileName, $this->content);
        $this->content      = $this->replaceModuleName($this->module, $this->content);
    }

    public function checkBaseMail()
    {
        if ( file_exists(config('module.core_directory') . 'Jobs/BaseJob.php') )
            return;

        $toDirectory = config('module.core_directory') . 'Jobs';

        $this->doDirectory($toDirectory);

        $content            = $this->getContents('core/core.mail_base-job');

        $this->writeFileSimple($content, $toDirectory, 'BaseJob.php');

        return;
    }
}
