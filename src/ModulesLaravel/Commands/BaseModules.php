<?php

namespace PabloLovera\ModulesLaravel\Commands;

use Illuminate\Console\Command;
use PabloLovera\ModulesLaravel\Traits\CommandTrait;

class BaseModules extends Command
{
    use CommandTrait;

    /**
     * The stub name
     *
     * @var string
     * */
    protected $stub;

    /**
     * The directory stubs
     *
     * @var string
     * */
    protected $pathStubs = 'modules';

    /**
     * The directory modules
     *
     * @var string
     * */
    protected $moduleDirectory;

    /**
     * The module name
     *
     * @var string
     * */
    protected $module;

    /**
     * The file name
     *
     * @var string
     * */
    protected $fileName;

    /**
     * The command options
     *
     * @var string
     * */
    protected $commandOptions;

    /**
     * The directory target
     *
     * @var string
     * */
    protected $toDirectory;

    /**
     * The content file
     *
     * @var string
     */
    protected $content;

    /**
     * BaseModules constructor.
     */
    public function __construct()
    {
        $this->moduleDirectory  = config('module.modules_directory');

        $this->module           = $this->hasArgument('module') ? $this->argument('module') : '';
        $this->fileName         = $this->hasArgument('name') ? $this->argument('name') : '';

        $this->toDirectory      = $this->moduleDirectory . $this->module;


        parent::__construct();
    }

    public function fire()
    {
        $this->doDirectory($this->toDirectory);

        $this->writeFile($this->content, $this->toDirectory, $this->fileName);
    }

}