<?php

namespace PabloLovera\ModulesLaravel\Commands;

use Illuminate\Console\Command;
use PabloLovera\ModulesLaravel\Traits\CommandTrait;

class ModuleCrud extends Command
{
    use CommandTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-crud {name} {module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new module crud structure basic with Controller, Model, Request.';

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
        $nome               = $this->argument('name');
        $module             = $this->argument('module');

        $this->call('module:make-controller'            , ['name' => $nome, 'module' => $module]);
        $this->call('module:make-model'                 , ['name' => $nome, 'module' => $module]);
        $this->call('module:make-request'               , ['name' => $nome, 'module' => $module]);

        $this->info('The module crud to ' . $nome . ' has been generated. Enjoy!');
    }
}
