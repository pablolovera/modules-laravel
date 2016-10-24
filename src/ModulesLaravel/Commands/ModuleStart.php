<?php

namespace PabloLovera\ModulesLaravel\Commands;

use Illuminate\Console\Command;
use PabloLovera\ModulesLaravel\Traits\CommandTrait;

class ModuleStart extends Command
{
    use CommandTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a base structure for modules';

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
        $this->call('module:make-core');
        $this->call('module:make-users');
        $this->call('module:make-auth');
        $this->call('module:make-dashboard');

        $this->info('The Modules structure has been created. Be happy!');
    }
}
