## Modules for applications based on laravel 5.3.*

### Install

```shell
composer require pablolovera/modules-laravel
```

#### Add ServiceProvider on config/app.php

```php
PabloLovera\ModulesLaravel\Providers\ModulesServiceProvider::class,
```

#### Publish config
```shell
php artisan vendor:publish --provider="PabloLovera\ModulesLaravel\Providers\ModulesServiceProvider"
```

### How to use...

#### First step (IMPORTANT)
Run the command to create the default scaffold of modules
```shell
php artisan module:start
```
Then... in the `app/` will be created two new folders `Core` and `Modules`

##### Register the service providers of modules that was created and dependencies
  
  `config/app.php``
  
  ```php
  'providers' => [
        // other providers ommited
        PabloLovera\ModulesLaravel\Providers\ModulesServiceProvider::class,
        
        App\Modules\Auth\Providers\AuthenticationServiceProvider::class,
        App\Modules\Auth\Providers\AuthServiceProvider::class,
        App\Modules\Auth\Providers\RouteServiceProvider::class,

        App\Modules\Dashboard\Providers\DashboardServiceProvider::class,
        App\Modules\Dashboard\Providers\RouteServiceProvider::class,

        App\Modules\Users\Providers\UsersServiceProvider::class,
        App\Modules\Users\Providers\RouteServiceProvider::class,
    ],
  ```
  

#### Create the other modules...

```shell
php artisan make:module <module-name>
```
Then... will be created `app/Modules/<module-name>`

### Commands available

`php artisan ...`


##### Create Module
```shell
make:module <module-name>
```

Then... will be created `app/Modules/<module-name>`

When a new module is created, you need add provider in `config/app.php`, like a `App\Modules\<module-name>\Providers\<module-name>ServiceProvider::class,`

##### Create Controller for existing module
```shell
module:make-controller <controller-name> <module-name>
```
Then... will be created `app/Modules/<module-name>/Http/Controllers/<controller-name>`


##### Create Model for existing module
```shell
module:make-model <model-name> <module-name>
```
Then... will be created `app/Modules/<module-name>/Models/<model-name>`


##### Create Request for existing module
```shell
module:make-request <request-name> <module-name>
```
Then... will be created `app/Modules/<module-name>/Http/Requests/<request-name>`


##### Create Seeder for existing module
```shell
module:make-seeder <seeder-name> <module-name>
```
Then... will be created `app/Modules/<module-name>/Database/seeds/<seeder-name>`


##### Create Migration for existing module
```shell
module:make-migration <migration-name> <module-name>
```
Then... will be created `app/Modules/<module-name>/Database/migrations/<migration-name>`


##### Executing Migration for existing module
```shell
module:migrate <module-name>
```
or
```shell
module:migrate <module-name> --seed
```

##### Create Service Provider for existing module
```shell
module:make-service-provider <service-provider-name> <module-name>
```
Then... will be created `app/Modules/<module-name>/Providers/<service-provider-name>`



##### Create Transformer for existing module
```shell
module:make-transformer <transformer-name> <module-name>
```
Then... will be created `app/Modules/<module-name>/Transformers/<transformer-name>`

##### Create Input View for existing module
```shell
module:make-view-dados <module-name>
```
Then... will be created `app/Modules/<module-name>/Views/<view-name>`

##### Create List View for existing module
```shell
module:make-view-lista <module-name>
```
Then... will be created `app/Modules/<module-name>/Views/<view-name>`

### The following packages are also used

* [artesaos/defender](https://github.com/artesaos/defender)
* [Cyvelnet/laravel5-fractal](https://github.com/Cyvelnet/laravel5-fractal)
* [owen-it/laravel-auditing](https://github.com/owen-it/laravel-auditing)
* [uxweb/sweet-alert](http://github.com/uxweb/sweet-alert)


### Licence

[MIT Licence](https://github.com/pablolovera/modules-laravel/blob/master/LICENSE)
