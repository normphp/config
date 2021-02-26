<?php
/**
 * Created by PhpStorm.
 * User: pizepei
 * Date: 2018/7/25
 * Time: 13:44
 * @title 项目配置
 */
namespace normphp\config;

class Config
{
    /**
     * 网站信息
     */
    const PRODUCT_INFO = [
        'title'=>'Lifestyle',//网站标题  比如 阿里
        'name'=>'Lifestyle',//网站名称 比如阿里巴巴
        'describe'=>'一个非常适合团队协作的微型框架',//网站首页介绍
        'meta'=>'Lifestyle',//网站META关键词
        'extend'=>[
            'homeLoginLay'=>'',//首页登录页面的通知弹出
        ],//扩展信息
    ];
    /**
     * 为了确保空间唯一的
     * 本服务的uuid标识（分布式时可保证不同服务之间的空间唯一）
     */
    CONST __UUID_IDENTIFIER__ = 'normphp-1';
    /**
     * 全局盐
     */
    CONST __SALT__ ='d~ds@d980652#re1ss$%^ds43x';
    /**
     * 错误日志保存方式 file|db
     */
    CONST ERROR_LOG_SAVE = 'file';
    /**
     * 一般配置
     */
    CONST UNIVERSAL =[
        'cache' => [
            /**
             * 缓存类型（驱动drive）redis file
             */
            'driveType'=>'file',
            /**
             * 缓存路径（file类型下）
             *DIRECTORY_SEPARATOR 目录分割符
             */
            'targetDir' => '..'.DIRECTORY_SEPARATOR.'runtime'.DIRECTORY_SEPARATOR,
            /**
             *缓存类型目录
             */
            'CacheTypeDir'=>'',
        ],
        /**
         * 初始化
         */
        'init' =>[
            /**
             * json_encode 参数
             */
            'json_encode'=>JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES,
            /**
             * 默认自定义响应
             */
            'header'=>[
                'X-Powered-By'=>'ASP.NET',
                'Server'=>'Apache/2.4.23 (Win32) OpenSSL/1.0.2j mod_fcgid/2.3.9',
            ],
            /**
             * 设置返回详细的数据类型
             * http://tool.oschina.net/commons/
             */
            'HeaderType'=>[
                'pdf'=>['Content-Type'=>'application/pdf'],
            ],
            /**
             * 是否对请求参数进行过滤（删除不在注解中的参数key）
             */
            'requestParam'=>true,
            /**
             * 请求过来的xml 数据层级 限制（防止攻击）
             */
            'requestParamTier'=>50,
            /**
             *是否开启获取客户端详情true
             */
            'clientInfo'=>false,
            /**
             *设置返回信息内容(非开发模式下)
             */
            'SYSTEMSTATUS'=>[
                'controller',//路由控制器
                'function_method',// 请求方法 get post
                'request_method',//控制器方法
                'request_url',//完整路由（去除域名的url地址）
                'route',//解释路由
                'sql',//历史slq
                'clientInfo',//ip信息
                'system',//系统状态
                'memory',//内存状态
            ],
            /**
             * 成功返回格式
             */
            'SuccessReturnJsonCode'=>[
                'name'=>'code',
                'value'=>200,
            ],
            'ErrorReturnJsonCode'=>[
                'name'=>'code',
                'value'=>100,
            ],
            /**
             * 错误返回格式
             */
            'SuccessReturnJsonMsg'=>[
                'name'=>'msg',
                'value'=>'success',
            ],
            'ErrorReturnJsonMsg'=>[
                'name'=>'msg',
                'value'=>'error',
            ],
            /**
             * 返回的数据总体
             */
            'ReturnJsonData'=>'data',
            /**
             * 返回的数据数量
             */
            'ReturnJsonCount'=>'count',
            /**
             * 没有权限
             */
            'jurisdictionCode'=>40003,
            /**
             * 没有登录
             */
            'notLoggedCode'=>10001,
        ],
        /**
         * 路由配置
         */
        'route' => [
            /**
             * 路由类型
             * note 注解
             */
            'type' =>'note',
            /**
             * 默认 \ 路由的路径-》已经存在的注解地址
             */
            'index'=>'/demo/index.html',

            /**
             * 控制器return默认数据类型
             * json
             * html
             */
            'return' => 'json',
            /**
             * 自定义路由后缀在前后端完全分离时有用：nginx 配置中固定的后缀转发到后端
             */
            'postfix'       => [
                '.json',
                '.jsp',
                '.data'
            ],
            /**
             * returnSubjoin 自定义路由 数据格式
             */
            'returnSubjoin'=>[

            ],
        ],

    ];
    /**
     * 微服务核心配置
     */
    const MICROSERVICE_CONFIG = [
        'appid'          => '',
        'token'          => '',
        'appsecret'      => '',
        'encodingAesKey' => ''
    ];

}