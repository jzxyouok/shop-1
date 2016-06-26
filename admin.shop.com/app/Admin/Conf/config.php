<?php
define('BASE_URL', 'http://admin.shop.com/');
return array(
	//'配置项'=>'配置值'
    'TMPL_PARSE_STRING' => array(
        '__CSS__' => BASE_URL . 'Admin/css',
        '__IMG__' => BASE_URL . 'Admin/img',
        '__JS__' => BASE_URL . 'Admin/js',
        '__LOGO__' => BASE_URL . 'Admin/logo',
    ),
    //图片上传设置
    'UPLOAD_OPTION' => [
        'mimes' => 'image/jpeg,image/png', //允许上传的文件MiMe类型
        'maxSize' => 1024000, //上传的文件大小限制 (0-不做限制)
        'exts' => array('jpg','jpeg','png'), //允许上传的文件后缀
        'autoSub' => true, //自动子目录保存文件
        'subName' => array('date', 'Y-m'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
        'rootPath' => ROOT_PATH, //保存根路径
        'savePath' => './upload_img/', //保存路径
        'saveName' => array('uniqid', ''), //上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
        'saveExt' => '', //文件保存后缀，空则使用原后缀
        'replace' => false, //存在同名是否覆盖
        'hash' => true, //是否生成hash编码
    ],

    logoName => '576df2ad17282.jpg',        //默认logo文件
);