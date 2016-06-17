<?php

namespace PabloLovera\ModulesLaravel\Commands;

use Illuminate\Console\Command;
use PabloLovera\ModulesLaravel\Traits\CommandTrait;

class Module extends Command
{
    use CommandTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module {nome}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new module structure basic with Controller, Entity, Service, Provider, Request, Repository... All extending of Core module';

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
        $moduleDirectory    = 'app/Modules/';
        $nome               = $this->argument('nome');

        $this->doDirectory($moduleDirectory . $nome);

        $this->call('module:make-controller'            , ['name' => $nome, 'module' => $nome]);
        $this->call('module:make-model'                 , ['name' => $nome, 'module' => $nome]);
        $this->call('module:make-request'               , ['name' => $nome, 'module' => $nome]);
        $this->call('module:make-transformer'           , ['name' => $nome, 'module' => $nome]);
        $this->call('module:make-service-provider'      , ['name' => $nome, 'module' => $nome]);
        $this->call('module:make-router'                , ['module' => $nome]);
        $this->call('module:make-view-dados'            , ['module' => $nome]);
        $this->call('module:make-view-lista'            , ['module' => $nome]);
        $this->call('module:make-migration'             , ['name' => 'create_' . $nome .'_table', 'module' => $nome]);
        $this->call('module:make-seeder'                , ['name' => $nome, 'module' => $nome]);


        $this->error('The module ' . $nome . ' needs add App\Modules\\' . $nome . '\\' . $nome . 'ServiceProvider::class in config/app.php!');
        $this->info('The module ' . $nome . ' has been generated. Enjoy!');
    }
}
