<?php
return array(
	//'配置项'=>'配置值'
	/* 数据库设置 */
    'DB_TYPE'               =>  'mysqli',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'tg',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  'root',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'tg_',    // 数据库表前缀
	'SHOW_PAGE_TRACE'       =>  true,	   //开启页面调试
    'DEFAULT_CHARSET'       =>  'utf-8', // 默认输出编码
    'URL_ROUTER_ON'         => true,
    'URL_MODEL'             =>2,

    /*配置邮件发送服务器*/
        'MAIL_HOST'     => 'smtp.163.com',          /*smtp服务器的名称、smtp.126.com*/
        'MAIL_SMTPAUTH' => TRUE,                    /*启用smtp认证*/
        'MAIL_DEBUG'    => false,                    /*是否开启调试模式*/
        'MAIL_USERNAME' => 'ljldianxiaoer@163.com',      /*邮箱名称*/
        'MAIL_FROM'     => 'ljldianxiaoer@163.com',      /*发件人邮箱*/
        'MAIL_FROMNAME' => '二货网|账号激活',                 /*发件人昵称*/
        'MAIL_PASSWORD' => 'dianxiao2',      /*发件人的授权码*/
        'MAIL_CHARSET'  => 'utf-8',                 /*字符集*/
        'MAIL_ISHTML'   => TRUE,                    /*是否HTML格式邮件*/
        'MAIL_PORT'     => 465,                     /*邮箱服务器端口*/
        'MAIL_SECURE'   => 'ssl',                   /*smtp服务器的验证方式，注意：要开启PHP中的openssl扩展*/
);