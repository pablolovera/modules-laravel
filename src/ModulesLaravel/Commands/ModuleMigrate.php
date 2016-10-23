<?php

namespace App\Core\Console\Commands;

use Illuminate\Console\Command;
use App\Core\Console\Traits\CommandTrait;

class ModuleMigrate extends Command
{
    use CommandTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:migrate {module} {--seed=} {--database=} {--pretend} {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Execute migration';

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
        $module             = $this->argument('module');
        $moduleDirectory    = config('module.modules_directory') . $module . '/Database/migrations';

        $this->call('migrate', [
            '--path'        => $moduleDirectory,
            '--database'    => $this->option('database'),
            '--pretend'     => $this->option('pretend'),
            '--force'       => $this->option('force'),
        ]);

        if ($this->option('seed')) {
            $this->call('module:seed', ['module' => $module]);
        }

        $this->info('The Module ' . $module .' has been executed the migration. Be happy!');
    }
}
