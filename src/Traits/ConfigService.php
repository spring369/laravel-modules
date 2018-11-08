<?php
namespace Windmill\Modules\Traits;

/**
 * Class ModuleConfig
 *
 * @package Houdunwang\Module\Services
 */
trait ConfigService
{
    /**
     * 支持点语法的获取配置项
     *
     * @param $name
     *
     * @return mixed
     */
    public function config($name)
    {
        $exts = explode('.', $name);
        $file = config('modules.paths.modules') . '/' . ucfirst(array_shift($exts)) . '/Config/' . array_shift($exts) . '.php';
        if (is_file($file)) {
            $config = include $file;
            return $exts ? array_get($config, implode('.', $exts)) : $config;
        }
    }

    public function saveConfig(array $data = [], $name = 'config')
    {
        $module = \Windmill::currentModule();
        $config = array_merge(\Windmill::config($module . '.' . $name), $data);
        $file = \Windmill::getModulePath() . '/Config/' . $name . '.php';

        return file_put_contents($file, '<?php return ' . var_export($config, true) . ';');
    }
}
