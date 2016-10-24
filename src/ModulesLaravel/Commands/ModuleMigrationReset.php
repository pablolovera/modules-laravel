<?php

namespace PabloLovera\ModulesLaravel\Commands;

use Illuminate\Console\Command;
use PabloLovera\ModulesLaravel\Traits\CommandTrait;

class ModuleMigrationReset extends Command
{
    use CommandTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:migration-reset {module} {--database=} {--pretend} {--force}';

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

        $migrator = new MyMigrator();

        $migrated = $migrator->reset();


        if (count($migrated)) {
            foreach ($migrated as $migration) {
                $this->line("Rollback: <info>{$migration}</info>");
            }

            return;
        }

        $this->comment('Nothing to rollback.');

        $this->info('The Module ' . $module .' has been executed the migration. Be happy!');
    }
}
