<?php

namespace PabloLovera\ModulesLaravel\Commands;

use Illuminate\Console\Command;
use PabloLovera\ModulesLaravel\Traits\CommandTrait;

class ModuleDashboard extends Command
{
    use CommandTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-dashboard';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new module for users context extending of Core module';

    /**
     * The directory stubs
     *
     * @var string
     * */
    protected $pathStubs = 'module-dashboard';

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
        $toDirectory        = config('module.modules_directory') . 'Dashboard/';

        $this->pathStubs = config('module.path_stubs') . $this->pathStubs . '/';

        $this->doDirectory($toDirectory);
        $this->doDirectory($toDirectory . '/Contracts');
        $this->doDirectory($toDirectory . '/Contracts/Entities');
        $this->doDirectory($toDirectory . '/Contracts/Repositories');
        $this->doDirectory($toDirectory . '/Contracts/Services');
        $this->doDirectory($toDirectory . '/Database');
        $this->doDirectory($toDirectory . '/Database/migrations');
        $this->doDirectory($toDirectory . '/Database/seeds');
        $this->doDirectory($toDirectory . '/Entities');
        $this->doDirectory($toDirectory . '/Http');
        $this->doDirectory($toDirectory . '/Http/Controllers');
        $this->doDirectory($toDirectory . '/Http/Controllers/API');
        $this->doDirectory($toDirectory . '/Http/Controllers/Web');
        $this->doDirectory($toDirectory . '/Http/Requests');
        $this->doDirectory($toDirectory . '/Providers');
        $this->doDirectory($toDirectory . '/Repositories');
        $this->doDirectory($toDirectory . '/Routes');
        $this->doDirectory($toDirectory . '/Services');
        $this->doDirectory($toDirectory . '/Transformers');

        copy($this->pathStubs . 'DashboardEntityContract.stub', $toDirectory . 'Contracts/Entities/DashboardEntityContract.php');
        copy($this->pathStubs . 'DashboardRepositoryContract.stub', $toDirectory . 'Contracts/Repositories/DashboardRepositoryContract.php');
        copy($this->pathStubs . 'DashboardServiceContract.stub', $toDirectory . 'Contracts/Services/DashboardServiceContract.php');
        copy($this->pathStubs . '2016_10_21_190417_create_dashboard_table.stub', $toDirectory . 'Database/migrations/2016_10_21_190417_create_dashboard_table.php');
        copy($this->pathStubs . 'DashboardTableSeeder.stub', $toDirectory . 'Database/seeds/DashboardTableSeeder.php');
        copy($this->pathStubs . 'DashboardEntity.stub', $toDirectory . 'Entities/DashboardEntity.php');
        copy($this->pathStubs . 'DashboardController.stub', $toDirectory . 'Http/Controllers/Web/DashboardController.php');
        copy($this->pathStubs . 'DashboardRequest.stub', $toDirectory . 'Http/Requests/DashboardRequest.php');
        copy($this->pathStubs . 'RouteServiceProvider.stub', $toDirectory . 'Providers/RouteServiceProvider.php');
        copy($this->pathStubs . 'DashboardServiceProvider.stub', $toDirectory . 'Providers/DashboardServiceProvider.php');
        copy($this->pathStubs . 'DashboardRepository.stub', $toDirectory . 'Repositories/DashboardRepository.php');
        copy($this->pathStubs . 'routes-api.stub', $toDirectory . 'Routes/api.php');
        copy($this->pathStubs . 'routes-web.stub', $toDirectory . 'Routes/web.php');
        copy($this->pathStubs . 'DashboardService.stub', $toDirectory . 'Services/DashboardService.php');
        copy($this->pathStubs . 'DashboardTransformer.stub', $toDirectory . 'Transformers/DashboardTransformer.php');

        $this->call('module:make-views', ['module' => 'Dashboard']);

        copy($this->pathStubs . 'dashboard.blade.stub', $toDirectory . 'Resources/views/dashboard.blade.php');

        $this->info('The Module User has been created. Be happy!');
    }
}
