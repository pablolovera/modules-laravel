## Modules for applications based on laravel 5.*

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
Create the `Core` module. It's very important!
```
php artisan module:make-core
```
Then... see the directory `app/Core/`

#### Create the other modules...

```
php artisan make:module <module-name>
```
Then... see the directory `app/Modules/<module-name>`

### Commands available

`php artisan ...`


##### Create Module
```
make:module <module-name>
```

So... created in `app/Modules/<module-name>`

##### Create Controller for existing module
```
module:make-controller <controller-name> <module-name>
```
So... created in `app/Modules/<module-name>/Http/Controllers/<controller-name>`


##### Create Model for existing module
```
module:make-model <model-name> <module-name>
```
So... created in `app/Modules/<module-name>/Models/<model-name>`


##### Create Request for existing module
```
module:make-request <request-name> <module-name>
```
So... created in `app/Modules/<module-name>/Http/Requests/<request-name>`


##### Create Seeder for existing module
```
module:make-seeder <seeder-name> <module-name>
```
So... created in `app/Modules/<module-name>/Database/seeds/<seeder-name>`


##### Create Migration for existing module
```
module:make-migration <migration-name> <module-name>
```
So... created in `app/Modules/<module-name>/Database/migrations/<migration-name>`


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
So... created in `app/Modules/<module-name>/Providers/<service-provider-name>`



##### Create Transformer for existing module
```
module:make-transformer <transformer-name> <module-name>
```
So... created in `app/Modules/<module-name>/Transformers/<transformer-name>`

##### Create Input View for existing module
```
module:make-view-dados <module-name>
```
So... created in `app/Modules/<module-name>/Views/<view-name>`

##### Create List View for existing module
```
module:make-view-lista <module-name>
```
So... created in `app/Modules/<module-name>/Views/<view-name>`

### Licence

[MIT Licence](https://github.com/pablolovera/modules-laravel/blob/master/LICENSE)
