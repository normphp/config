<?php
/**
 * Created by PhpStorm.
 * User: pizepei
 * Date: 2019/1/22
 * Time: 14:26
 * @title  服务Service包配置
 */

namespace normphp\config;


class Service
{
    /**
     * 短信配置
     */
    CONST SMS =[
        /**
         * 默认使用的
         */
        'default'=>'Aliyun',
        /**
         * 阿里云
         */
        'Aliyun'=>[
            /**
             * 通道名称（类名）
             */
            'aisleName'=>'Aliyun',

            'accessKeyId'=>'',

            'accessKeySecret'=>'',
            //地区
            'RegionId'=>'cn-hangzhou',

            //模式 注册
            'pattern'=>[

                'register'=>[
                        /**
                         * 签名名称
                         */
                        'SignName'=>'',
                        //模板id
                        'TemplateCode'=>'',
                        'parameter'=>[
                            'code'=>'验证码',
                            ],
                    ],

            ],
        ],

    ];


}