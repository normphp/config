<?php
/**
 * @Author: pizepei
 * @ProductName: PhpStorm
 * @Created: 2019/4/1 22:25
 * @title 文件上传配置
 */

namespace normphp\config;


class FilesUploadConfig
{


    /**
     * 计划
     *       文件上传以应用为授权单位  每个应用可以有多个授权域名
     *              签名  首先前端请求后端 获取签名（请求参数域名+appid） 返回sha1（域名+appid+AppSecret+时间戳+随机字符串）+时间戳+随机字符串
     *      文件被上传时 会根据域名创建目录（分布式可同时上传到所有服务器上）    在被请求时由nginx获取域名定位到域名目录下（没有绑定域名的就没有目录了）
     */
    CONST FILES_UPLOAD_APP = [
        'asdkjlk3434df674545l'=>[
                'appid'=>'asdkjlk3434df674545l',//以appid为分组名称  （目录名称）
                'AppSecret'=>'asdkjlsssfk3434df67455656345l',
                'token'=>'68uijkmsd454lfgjuwynvcv@',
                'period'=>20,//分钟单位
                'request_domain'=>[
                    '/^http:\/\/[A-Za-z0-9_-]+.oauth.heil.top/S',//通配符域名
                    '/^http:\/\/oauth.heil.top/S',//标准域名
                ],//支持的来源域名  正则表达式
                'show_domain'=>[
                    'http://oauth.heil.top',
                    'https://oauth.heil.top',
                ],
                'catalogue'=>'..'.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'files_upload'.DIRECTORY_SEPARATOR,//文件根目录
            ]
    ];
    /**
     * 模式
     */
    CONST FILES_UPLOAD_APP_SCHEMA = [
        'files-upload'=>[
            'type'=>[
                'image/png',
            ],//支持的文件格式
            'size'=>(1024*1024),//默认1M
        ],

    ];
}