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
        $migration          = 'create_' . strtolower($nome) . '_table';


        $this->doDirectory($moduleDirectory . $nome);

        $this->call('module:make-controller'            , ['name' => $nome . 'Controller'           , 'module' => $nome]);
        $this->call('module:make-entity'                , ['name' => $nome . 'Entity'               , 'module' => $nome]);
        $this->call('module:make-entity-contract'       , ['name' => $nome . 'EntityContract'       , 'module' => $nome]);
        $this->call('module:make-repository'            , ['name' => $nome . 'Repository'           , 'module' => $nome]);
        $this->call('module:make-repository-contract'   , ['name' => $nome . 'RepositoryContract'   , 'module' => $nome]);
        $this->call('module:make-service'               , ['name' => $nome . 'Service'              , 'module' => $nome]);
        $this->call('module:make-service-contract'      , ['name' => $nome . 'ServiceContract'      , 'module' => $nome]);
        $this->call('module:make-request'               , ['name' => $nome . 'Request'              , 'module' => $nome]);
        $this->call('module:make-transformer'           , ['name' => $nome . 'Transformer'          , 'module' => $nome]);
        $this->call('module:make-service-provider'      , ['name' => $nome . 'ServiceProvider'      , 'module' => $nome]);
        $this->call('module:make-route-service-provider', ['name' => 'RouteServiceProvider'         , 'module' => $nome]);
        $this->call('module:make-router'                , ['module' => $nome]);
        $this->call('module:make-migration'             , ['name' => $migration                     , 'module' => $nome]);
        $this->call('module:make-seeder'                , ['name' => $nome . 'TableSeeder'          , 'module' => $nome]);
        $this->call('module:make-permission-seeder'     , ['name' => $nome . 'PermissionTableSeeder', 'context' => $nome, 'module' => $nome]);
        $this->call('module:make-views'                 , ['module' => $nome]);

        $this->info('The module ' . $nome . ' has been generated. Enjoy!');
    }
}