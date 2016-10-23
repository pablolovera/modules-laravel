<?php

namespace App\Core\Console\Commands;

use Illuminate\Console\Command;
use App\Core\Console\Traits\CommandTrait;

class ModuleViews extends Command
{
    use CommandTrait;
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
     * The stub name
     *
     * @var string
     * */
    protected $stub = 'view-dados';

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
        $moduleDirectory    = config('module.modules_directory');
        $module             = $this->argument('module');
        $toDirectory        = $moduleDirectory . $module;

        $this->doDirectory($toDirectory . '/Resources');
        $this->doDirectory($toDirectory . '/Resources/assets');
        $this->doDirectory($toDirectory . '/Resources/assets/js');
        $this->doDirectory($toDirectory . '/Resources/assets/sass');
        $this->doDirectory($toDirectory . '/Resources/views');
        $this->doDirectory($toDirectory . '/Resources/views/errors');
        $this->doDirectory($toDirectory . '/Resources/views/vendor');
        $this->doDirectory($toDirectory . '/Resources/views/mails');

        $this->info('The Module ' . $module .' has been received a new inputs view. Be happy!');
    }
}
