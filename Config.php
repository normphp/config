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
    CONST UUID_IDENTIFIER = 'normphp-1';
    /**
     * 全局盐
     */
    CONST SALT ='d~ds@d980652#re1ss$%^ds43x';
    /**
     * 错误日志保存方式 file|db
     */
    CONST ERROR_LOG_SAVE = 'file';
    /**
     * 一般配置
     *  cache    缓存
     *      driveType 缓存类型（驱动drive）redis file
     *      targetDir 缓存路径（file类型下） DIRECTORY_SEPARATOR 目录分割符
     * init 初始化
     *      json_encode json_encode 参数
     *      header  默认自定义响应
     *      headerType   设置返回详细的数据类型 http://tool.oschina.net/commons/
     *      requestParam  是否对请求参数进行过滤（删除不在注解中的参数key）
     *      requestParamTier   请求过来的xml 数据层级 限制（防止攻击）
     *      clientInfo  是否开启获取客户端详情true
     *      SYSTEMSTATUS  设置返回信息内容(非开发模式下)
     *            'controller',//路由控制器
     *             'function_method',// 请求方法 get post
     *            'request_method',//控制器方法
     *            'request_url',//完整路由（去除域名的url地址）
     *            'route',//解释路由
     *            'sql',//历史slq
     *            'clientInfo',//ip信息
     *            'system',//系统状态
     *            'memory',//内存状态
     *     成功返回格式
     *      successReturnJsonCode
     *      errorReturnJsonCode
     *     失败返回格式
     *      successReturnJsonMsg
     *      errorReturnJsonMsg
     *      returnJsonData    返回的数据总体
     *      returnJsonCount  返回的数据数量
     *      jurisdictionCode  没有权限
     *      notLoggedCode     没有登录
     * 路由配置
     * route 路由
     *      type    路由类型  note 注解
     *      index   默认 \ 路由的路径-》已经存在的注解地址
     *      return  控制器return默认数据类型json html
     *      postfix  自定义路由后缀在前后端完全分离时有用：nginx 配置中固定的后缀转发到后端
     * returnSubjoin 自定义路由 数据格式
     */
    CONST UNIVERSAL =[
        'route' => [
            'type' =>'note',
            'index'=>'/demo/index.html',
            'return' => 'json',
            'postfix'       => [
                '.json',
                '.jsp',
                '.data'
            ],
            'returnSubjoin'=>[
            ],
        ],
        'cache' => [
            'driveType'=>'file',
            'targetDir' => '..'.DIRECTORY_SEPARATOR.'runtime'.DIRECTORY_SEPARATOR,
        ],
        'init' =>[
            'json_encode'=>JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES,
            'header'=>[
                'X-Powered-By'=>'ASP.NET',
                'Server'=>'Apache/2.4.23 (Win32) OpenSSL/1.0.2j mod_fcgid/2.3.9',
            ],
            'headerType'=>[
                'pdf'=>['Content-Type'=>'application/pdf'],
            ],
            'requestParam'=>true,
            'requestParamTier'=>50,
            'clientInfo'=>false,
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
            'successReturnJsonCode'=>[
                'name'=>'code',
                'value'=>200,
            ],
            'errorReturnJsonCode'=>[
                'name'=>'code',
                'value'=>100,
            ],
            'successReturnJsonMsg'=>[
                'name'=>'msg',
                'value'=>'success',
            ],
            'errorReturnJsonMsg'=>[
                'name'=>'msg',
                'value'=>'error',
            ],
            'returnJsonData'=>'data',
            'returnJsonCount'=>'count',
            'jurisdictionCode'=>40003,
            'notLoggedCode'=>10001,
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