<?php
/**
 * Created by PhpStorm.
 * User: pizepei
 * Date: 2019/3/1
 * Time: 9:20
 */

namespace normphp\config;


class WechatConfig
{
    //开放平台微信接口配置
    const OPEN_WECHAT_CONFIG = [
        'pattern'=>'third',//
        'appid'=>'',
        'appsecret'=>'',
        'encodingAesKey'=>'',
        'token'=>'',
        'prefix'   => 'wechat_third', // 缓存名称前缀
    ];
    /**
     * 微信相关配置  开发者配置
     */
    CONST WECHAT_CONFIG = [
        'pattern'=>'tradition',//third 第三方  tradition 传统模式
        'appid'=>'',
        'appsecret'=>'',
        'token'=>'',
        'encodingAesKey'=>'',
        'cache_type'=> 'redis',//自定义 微信token存储方式 支持  redis  file
        'cache_keyword_type'=> 'mysql',//自定义 关键字  存储方式 支持  redis  mysql
        'prefix'   => 'wechat_tradition', // 缓存名称前缀
    ];
}