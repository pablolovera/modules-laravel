<?php

namespace PabloLovera\ModulesLaravel\Commands;

use Illuminate\Console\Command;
use PabloLovera\ModulesLaravel\Traits\CommandTrait;

class ModuleAuth extends Command
{
    use CommandTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-auth';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a module for auth';

    /**
     * The directory stubs
     *
     * @var string
     * */
    protected $pathStubs = 'module-auth';

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
        $toDirectory        = config('module.modules_directory') . 'Auth/';

        $this->pathStubs = __DIR__ . '/stubs/' . $this->pathStubs . '/';

        $this->doDirectory($toDirectory);

        $this->doDirectory($toDirectory . '/Http');
        $this->doDirectory($toDirectory . '/Http/Controllers');
        $this->doDirectory($toDirectory . '/Http/Controllers/Web');
        $this->doDirectory($toDirectory . '/Http/Requests');
        $this->doDirectory($toDirectory . '/Providers');
        $this->doDirectory($toDirectory . '/Routes');
        $this->doDirectory($toDirectory . '/Resources');
        $this->doDirectory($toDirectory . '/Resources/assets');
        $this->doDirectory($toDirectory . '/Resources/assets/js');
        $this->doDirectory($toDirectory . '/Resources/assets/sass');
        $this->doDirectory($toDirectory . '/Resources/views');
        $this->doDirectory($toDirectory . '/Resources/views/errors');
        $this->doDirectory($toDirectory . '/Resources/views/vendor');
        $this->doDirectory($toDirectory . '/Resources/views/mails');
        $this->doDirectory($toDirectory . '/Resources/views/passwords');


        copy($this->pathStubs . 'ForgotPasswordController.stub', $toDirectory . 'Http/Controllers/Web/ForgotPasswordController.php');
        copy($this->pathStubs . 'LoginController.stub', $toDirectory . 'Http/Controllers/Web/LoginController.php');
        copy($this->pathStubs . 'RegisterController.stub', $toDirectory . 'Http/Controllers/Web/RegisterController.php');
        copy($this->pathStubs . 'ResetPasswordController.stub', $toDirectory . 'Http/Controllers/Web/ResetPasswordController.php');
        copy($this->pathStubs . 'AuthenticationServiceProvider.stub', $toDirectory . 'Providers/AuthenticationServiceProvider.php');
        copy($this->pathStubs . 'AuthServiceProvider.stub', $toDirectory . 'Providers/AuthServiceProvider.php');
        copy($this->pathStubs . 'RouteServiceProvider.stub', $toDirectory . 'Providers/RouteServiceProvider.php');
        copy($this->pathStubs . 'routes-api.stub', $toDirectory . 'Routes/api.php');
        copy($this->pathStubs . 'routes-web.stub', $toDirectory . 'Routes/web.php');
        copy($this->pathStubs . '503.blade.stub', $toDirectory . 'Resources/views/errors/503.blade.php');
        copy($this->pathStubs . 'email.blade.stub', $toDirectory . 'Resources/views/passwords/email.blade.php');
        copy($this->pathStubs . 'reset.blade.stub', $toDirectory . 'Resources/views/passwords/reset.blade.php');
        copy($this->pathStubs . 'login.blade.stub', $toDirectory . 'Resources/views/login.blade.php');
        copy($this->pathStubs . 'register.blade.stub', $toDirectory . 'Resources/views/register.blade.php');

        $this->info('The Module Auth has been created. Be happy!');
    }
}
