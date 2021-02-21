<?php


namespace normphp\config;


use normphp\model\cache\Cache;
use normphp\model\db\Model;

/**
 *
 * 系统配置操作类
 * 各模块包以包名Config命名创建一个继承本类的类
 * 常量配置可直接通过常数获取方式获取
 * 本类更多的是提供标准化的从数据库获取配置和缓存配置的标准接口
 * Class SystemConfig
 * @package normphp\config
 */
class SystemConfig
{
    /**
     * @var null | Model
     */
    protected $Model = null;

    /**
     * 初始化
     * SystemConfig constructor.
     */
    public function __construct()
    {
        # 生命周期
        # 初始化缓存配置
        # 缓存加密
        # 常量参数的覆盖？
    }

    /**
     * @param Model $model 需要获取的模型
     * @param string $table 表名
     * @param bool $prefix 表名prefix
     * @throws \Exception
     */
    protected function setModel(Model $model,$table ='',$prefix=true)
    {
        /**
         * 依赖注入
         */
        $this->Model = $model::table($table,$prefix);
    }
    /**
     * 获取配置详情(开放对外的方法)
     * @param $key
     * @param bool $cache 是否使用缓存  为false 时强制从数据库获取并且
     */
    public function getValue($key,bool $cache =true,$info=false)
    {
        return Cache::get($key,'moduleSysConfi');
    }

    /**
     * 获取配置详情
     * @param $key
     * @param bool $cache 是否使用缓存  为false 时强制从数据库获取并且
     */
    protected function getCacheValue($key,bool $cache =true,$info=false)
    {
        return Cache::get($key,'moduleSysConfi');
    }

    /**
     * @param string|array $key 标识
     * @param string|array $data 数据
     * @param int $period 设置配置详情
     * @return mixed
     */
    protected function setCacheValue($key,$data,$period=0)
    {
        return Cache::set($key,$data,$period,'moduleSysConfi');
    }

}