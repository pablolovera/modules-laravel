<?php

namespace PabloLovera\ModulesLaravel\Commands;

class ModuleMail extends BaseModules
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-mail {name} {module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Mail extending of Core module';

    /**
     * The stub name
     *
     * @var string
     * */
    protected $stub = 'module-mail';

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
        $this->setToDirectory('Mail');

        $this->handleContent();

        $this->fire();

        $this->checkBaseMail();

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
        $this->content      = $this->replaceLowerName(strtolower($this->module), $this->content);
    }

    public function checkBaseMail()
    {
        if ( file_exists(config('module.core_directory') . 'Mail/BaseMail.php') )
            return;

        $toDirectory = config('module.core_directory') . 'Mail';

        $this->doDirectory($toDirectory);

        $content     = $this->getContents('core.mail_base-mail');

        $this->writeFileSimple($content, $toDirectory, 'BaseMail.php');

        return;
    }
}
