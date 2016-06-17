<?php

namespace PabloLovera\ModulesLaravel\Traits;

use Carbon\Carbon;

trait CommandTrait
{
    /**
     * @return string
     */
    public function timestampToMigration()
    {
        return Carbon::now()->format('Y_m_d_His') . '_';
    }

    /**
     * Create the directory
     *
     * @param $path
     * @param int $permission
     */
    public function doDirectory($path, $permission = 0755)
    {
        if (is_dir($path))
            return;

        $this->laravel['files']->makeDirectory($path, $permission, true);

        return;
    }

    /**
     * @param $stubName
     * @return string
     */
    public function getContents($stubName)
    {
        return file_get_contents(config('module.path_stubs') . $stubName .'.stub');
    }

    /**
     * @param $dados
     * @param $toDirectory
     * @param $name
     * @param null $typeFile
     */
    public function writeFile($dados, $toDirectory, $name, $typeFile = null)
    {
        $fileName   = $this->getContextFileName($typeFile);

        $this->write($toDirectory . '/' . $name . $fileName . '.php', $dados);
    }

    /**
     * Write the simple file based on stub
     *
     * @param $dados
     * @param $toDirectory
     * @param $fileName
     */
    public function writeFileSimple($dados, $toDirectory, $fileName)
    {
        $this->write($toDirectory . '/' . $fileName, $dados);
    }

    /**
     * Write data in file
     *
     * @param $target
     * @param $data
     */
    private function write($target, $data)
    {
        $fp = fopen($target, 'w+');

        fputs($fp, $data);
        fclose($fp);
    }

    /**
     * @param $typeFile
     * @return mixed|string
     */
    private function getContextFileName($typeFile)
    {
        if (is_null($typeFile))
            return '';

        $file = str_replace('-', ' ', $typeFile);
        $file = ucwords(strtolower($file));
        $file = str_replace(' ', '', $file);

        return $file;
    }

    /**
     * @param $stubName
     * @return string
     */
    public function handleStubName($stubName)
    {
        $name = explode('_', $stubName);

        $file = $this->getContextFileName($name[1]);

        $path = $name[0];
        $path = str_replace('.', '', $path);
        $path = ucwords(strtolower($path));
        $path = str_replace(' ', '/', $path);

        $object = new \StdClass();
        $object->path = $path;
        $object->file = $file . '.php';

        return $object;
    }

    /**
     * @param $name
     * @param $content
     * @return mixed
     */
    public function replaceName($name, $content)
    {
        return str_replace('*NAME*', $name, $content);
    }

    /**
     * @param $name
     * @param $content
     * @return mixed
     */
    public function replaceNameLower($name, $content)
    {
        return str_replace('*NAMELOWER*', strtolower($name), $content);
    }

    /**
     * @param $module
     * @param $content
     * @return mixed
     */
    public function replaceModuleNameLower($module, $content)
    {
        return str_replace('*MODULENAMELOWER*', strtolower($module), $content);
    }

    /**
     * @param $module
     * @param $content
     * @return mixed
     */
    public function replaceModuleName($module, $content)
    {
        return str_replace('*MODULENAME*', $module, $content);
    }

    /**
     * @param $module
     * @param $content
     * @return mixed
     */
    public function replaceCamelModuleName($module, $content)
    {
        return str_replace('*CAMELMODULENAME*', camel_case($module), $content);
    }

    /**
     * @param $namespace
     * @param $content
     * @return mixed
     */
    public function replaceModuleNamespace($namespace, $content)
    {
        return str_replace('*NAMESPACE*', strtolower($namespace), $content);
    }

    /**
     * @param $module
     * @param $content
     * @return mixed
     */
    public function replaceRoutePrefix($module, $content)
    {
        return str_replace('*ROUTEPREFIX*', strtolower($module), $content);
    }

    /**
     * @param $module
     * @param $content
     * @return mixed
     */
    public function replaceTableName($module, $content)
    {
        return str_replace('*TABLENAME*', str_plural(strtolower($module)), $content);
    }

    /**
     * @param $name
     * @param $content
     * @return mixed
     */
    public function replaceMigrationName($name, $content)
    {
        $name = str_replace('_', ' ', $name);
        $name = ucwords(strtolower($name));
        $name = str_replace(' ', '', $name);

        return str_replace('*MIGRATIONNAME*', $name, $content);
    }
}