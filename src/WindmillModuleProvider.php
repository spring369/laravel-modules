<?php
/** .-------------------------------------------------------------------
 * |      Site: www.hdcms.com
 * |      Date: 2018/6/25 下午3:13
 * |    Author: 向军大叔 <2300071698@qq.com>
 * '-------------------------------------------------------------------*/

namespace Windmill\Modules;

use Windmill\Modules\Traits\ConfigService;
use Windmill\Modules\Traits\MenusService;
use Windmill\Modules\Traits\ModuleService;
use Windmill\Modules\Traits\PermissionService;

/**
 * Class Facade
 *
 * @package Houdunwang\Module
 */
class WindmillModuleProvider
{
    use ConfigService, PermissionService, MenusService, ModuleService;
}
