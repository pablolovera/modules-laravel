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
        $this->setModuleDirectory(config('module.modules_directory'));

        parent::__construct();
    }

    public function fire()
    {
        $this->doDirectory($this->getToDirectory());

        $this->writeFile($this->content, $this->getToDirectory(), $this->getFileName());
    }

    /**
     * @return string
     */
    public function getToDirectory()
    {
        return $this->toDirectory;
    }

    /**
     * @param string $toDirectory
     */
    public function setToDirectory($toDirectory)
    {
        $this->toDirectory = $this->getModuleDirectory() . $this->getModule() . '/' . $toDirectory;
    }

    /**
     * @return string
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * @param string $module
     */
    public function setModule($module)
    {
        $this->module = $module;
    }

    /**
     * @return string
     */
    public function getModuleDirectory()
    {
        return $this->moduleDirectory;
    }

    /**
     * @param string $moduleDirectory
     */
    public function setModuleDirectory($moduleDirectory)
    {
        $this->moduleDirectory = $moduleDirectory;
    }

    /**
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * @param string $fileName
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }
}