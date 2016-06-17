<?php

namespace PabloLovera\ModulesLaravel\Commands;

use Illuminate\Console\Command;
use PabloLovera\ModulesLaravel\Traits\CommandTrait;

class ModuleSeed extends Command
{
    use CommandTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:seed {module} {--class=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Seed for a module';

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
        $moduleDirectory    = config('module.modules_directory') . $module . '/Database/seeds/';

        if ( $class = $this->option('class') )

            $this->seedOne($module, $class);

        else
            $this->seedAll($moduleDirectory, $module);

    }

    /**
     * @param $module
     * @param $class
     */
    private function seed($module, $class)
    {
        $this->call('db:seed', [
            '--class' => 'App\Modules\\' . $module . '\Database\seeds\\' . $class
        ]);

        $this->info('Seeded ' . $class .'!');
    }

    /**
     * @param $module
     * @param $class
     */
    protected function seedOne($module, $class)
    {
        $this->seed($module, $class);

        $this->info('The Module ' . $module .' has been seeded. Be happy!');
    }

    /**
     * @param $moduleDirectory
     * @param $module
     */
    protected function seedAll($moduleDirectory, $module)
    {
        foreach ( $this->classes($moduleDirectory) as $class ) :

            $this->seed($module, $class);

        endforeach;

        $this->info('The Module ' . $module .' has been seeded. Be happy!');
    }

    /**
     * @param $directory
     * @return array
     */
    protected function classes($directory)
    {
        $arquivos = new \DirectoryIterator($directory);

        $classes = [];
        foreach ($arquivos as $arquivo) :

            if ( $arquivo->getExtension() == 'php') :

                $classes[] = explode('.php', $arquivo->getFilename())[0];

            endif;

        endforeach;

        return $classes;
    }
}
