## Modules for applications based on laravel 5.3.*

### Install

```
composer require pablolovera/modules-laravel
```

#### Add ServiceProvider on config/app.php

```
PabloLovera\ModulesLaravel\Providers\ModulesServiceProvider::class,
```

#### Publish config
```
php artisan vendor:publish --provider="PabloLovera\ModulesLaravel\Providers\ModulesServiceProvider"
```

### How to use...

#### First step (IMPORTANT)
Run the command to create the default scaffold of modules
```
php artisan module:start
```
Then... in the `app/` will be created tow new folders `Core` and `Modules`

#### Create the other modules...

```
php artisan make:module <module-name>
```
Then... will be created `app/Modules/<module-name>`

### Commands available

`php artisan ...`


##### Create Module
```
make:module <module-name>
```

Then... will be created `app/Modules/<module-name>`

When a new module is created, you need add provider in `config/app.php`, like a `App\Modules\<module-name>\Providers\<module-name>ServiceProvider::class,`

##### Create Controller for existing module
```
module:make-controller <controller-name> <module-name>
```
Then... will be created `app/Modules/<module-name>/Http/Controllers/<controller-name>`


##### Create Model for existing module
```
module:make-model <model-name> <module-name>
```
Then... will be created `app/Modules/<module-name>/Models/<model-name>`


##### Create Request for existing module
```
module:make-request <request-name> <module-name>
```
Then... will be created `app/Modules/<module-name>/Http/Requests/<request-name>`


##### Create Seeder for existing module
```
module:make-seeder <seeder-name> <module-name>
```
Then... will be created `app/Modules/<module-name>/Database/seeds/<seeder-name>`


##### Create Migration for existing module
```
module:make-migration <migration-name> <module-name>
```
Then... will be created `app/Modules/<module-name>/Database/migrations/<migration-name>`


##### Executing Migration for existing module
```
module:migrate <module-name>
```
or
```
module:migrate <module-name> --seed
```

##### Create Service Provider for existing module
```
module:make-service-provider <service-provider-name> <module-name>
```
Then... will be created `app/Modules/<module-name>/Providers/<service-provider-name>`



##### Create Transformer for existing module
```
module:make-transformer <transformer-name> <module-name>
```
Then... will be created `app/Modules/<module-name>/Transformers/<transformer-name>`

##### Create Input View for existing module
```
module:make-view-dados <module-name>
```
Then... will be created `app/Modules/<module-name>/Views/<view-name>`

##### Create List View for existing module
```
module:make-view-lista <module-name>
```
Then... will be created `app/Modules/<module-name>/Views/<view-name>`

### Licence

[MIT Licence](https://github.com/pablolovera/modules-laravel/blob/master/LICENSE)
