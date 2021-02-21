<?php
/**
 * @Author: pizepei
 * @ProductName: PhpStorm
 * @Created: 2019/3/3 17:40
 * @title redis 配置
 */

namespace normphp\config;


class RedsiConfig
{
    /**
     * redis配置
     */
    CONST REDIS =[
        'host'         => '127.0.0.1', // redis主机
        'port'         => 6379, // redis端口
        'password'     => '', // 密码
        'select'       => 0, // 操作库
        'expire'       => 3600, // 有效期(秒)
        'timeout'      => 0, // 超时时间(秒)
        'persistent'   => true, // 是否长连接
        'session_name' => '', // sessionkey前缀
        'prefix'   => 'redis_1', // 缓存名称前缀
    ];
}