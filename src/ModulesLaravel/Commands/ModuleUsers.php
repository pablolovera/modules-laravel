<?php

namespace PabloLovera\ModulesLaravel\Commands;

class ModuleUsers extends BaseModules
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-users';

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
    protected $pathStubs = 'module-user';

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
        $toDirectory        = config('module.modules_directory') . '/Users/';

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

        copy($this->pathStubs . 'UsersEntityContract.stub', $toDirectory . 'Contracts/Entities/UsersEntityContract.php');
        copy($this->pathStubs . 'UsersRepositoryContract.stub', $toDirectory . 'Contracts/Repositories/UsersRepositoryContract.php');
        copy($this->pathStubs . 'UsersServiceContract.stub', $toDirectory . 'Contracts/Services/UsersServiceContract.php');
        copy($this->pathStubs . '2014_10_12_000000_create_users_table.stub', $toDirectory . 'Database/migrations/2014_10_12_000000_create_users_table.php');
        copy($this->pathStubs . '2014_10_12_100000_create_password_resets_table.stub', $toDirectory . 'Database/migrations/2014_10_12_100000_create_password_resets_table.php');
        copy($this->pathStubs . 'UsersTableSeeder.stub', $toDirectory . 'Database/seeds/UsersTableSeeder.php');
        copy($this->pathStubs . 'UsersEntity.stub', $toDirectory . 'Entities/UsersEntity.php');
        copy($this->pathStubs . 'APIUsersController.stub', $toDirectory . 'Http/Controllers/API/UsersController.php');
        copy($this->pathStubs . 'WebUsersController.stub', $toDirectory . 'Http/Controllers/Web/UsersController.php');
        copy($this->pathStubs . 'UsersRequest.stub', $toDirectory . 'Http/Requests/UsersRequest.php');
        copy($this->pathStubs . 'RouteServiceProvider.stub', $toDirectory . 'Providers/RouteServiceProvider.php');
        copy($this->pathStubs . 'UsersServiceProvider.stub', $toDirectory . 'Providers/UsersServiceProvider.php');
        copy($this->pathStubs . 'UsersRepository.stub', $toDirectory . 'Repositories/UsersRepository.php');
        copy($this->pathStubs . 'routes-api.stub', $toDirectory . 'Routes/api.php');
        copy($this->pathStubs . 'routes-web.stub', $toDirectory . 'Routes/web.php');
        copy($this->pathStubs . 'UsersService.stub', $toDirectory . 'Services/UsersService.php');
        copy($this->pathStubs . 'UsersTransformer.stub', $toDirectory . 'Transformers/UsersTransformer.php');

        $this->call('module:make-views', ['module' => 'Users']);

        copy($this->pathStubs . 'view-form.blade.stub', $toDirectory . 'Resources/views/form.blade.php');
        copy($this->pathStubs . 'view-list.blade.stub', $toDirectory . 'Resources/views/list.blade.php');
        copy($this->pathStubs . 'view-show.blade.stub', $toDirectory . 'Resources/views/show.blade.php');

        $this->info('The Module User has been created. Be happy!');
    }
}
