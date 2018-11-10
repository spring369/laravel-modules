<?php

namespace Windmill\Modules\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;

class ModuleUpdateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'windmill:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'windmill update modules in data !';

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
        $modules = \Windmill::getModulesLists(); //获取所有模块

        foreach ($modules as $module) {
            //创建模块数据
            $this->createModule(strtolower($module['name']));
            //添加模块权限
            $this->permission(strtolower($module['name']));
        }
        $this->info('模块列表更新成功');

        return true;
    }

    protected function createModule(string $name)
    {
        $config = \Windmill::config($name . '.config');
        $config['config'] = $config;
        $config['permission'] = $this->getModulePermission($name);
        $config['module'] = $name;
        return  (bool)\DB::table('admin_modules')->firstOrNew(['module' => $config['module']])->fill($config)->save();
    }

    //获取模块权限
    protected function getModulePermission(string $name)
    {
        return collect(\Windmill::config($name . '.permission'))->pluck('permissions')->toArray();
    }

    //设置模块权限数据
    protected function permission(string $name)
    {
        foreach ($this->getModulePermission($name) as $permissions) {
            foreach ($permissions as $perm){
                $item['guard_name']= $perm['guard'];
                Permission::firstOrNew(['name' => $perm['name']])->fill($perm)->save();
            }
        }
    }
}
