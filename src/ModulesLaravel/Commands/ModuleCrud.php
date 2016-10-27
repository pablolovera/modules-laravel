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
    protected $description = 'Create a new module default crud structure';

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
        $name               = $this->argument('name');
        $module             = $this->argument('module');
        $migration          = 'create_' . strtolower($name) . '_table';

        $this->call('module:make-controller'            , ['name' => $name . 'Controller'           , 'module' => $module]);
        $this->call('module:make-entity'                , ['name' => $name . 'Entity'               , 'module' => $module]);
        $this->call('module:make-entity-contract'       , ['name' => $name . 'EntityContract'       , 'module' => $module]);
        $this->call('module:make-repository'            , ['name' => $name . 'Repository'           , 'module' => $module]);
        $this->call('module:make-repository-contract'   , ['name' => $name . 'RepositoryContract'   , 'module' => $module]);
        $this->call('module:make-service'               , ['name' => $name . 'Service'              , 'module' => $module]);
        $this->call('module:make-service-contract'      , ['name' => $name . 'ServiceContract'      , 'module' => $module]);
        $this->call('module:make-request'               , ['name' => $name . 'Request'              , 'module' => $module]);
        $this->call('module:make-transformer'           , ['name' => $name . 'Transformer'          , 'module' => $module]);
        $this->call('module:make-migration'             , ['name' => $migration                     , 'module' => $module]);
        $this->call('module:make-seeder'                , ['name' => $name . 'TableSeeder'          , 'module' => $module]);
        $this->call('module:make-permission-seeder'     , ['name' => $name . 'PermissionTableSeeder', 'context' => $name, 'module' => $module]);

        $this->info('The module crud to ' . $name . ' has been generated. Enjoy!');
    }
}
