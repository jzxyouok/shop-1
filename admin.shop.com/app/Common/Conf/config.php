<?php
define('BASE_URL', 'http://admin.shop.com/');

return array(
	//'配置项'=>'配置值'
    'SHOW_PAGE_TRACE'       => true,     //开启页面调试球
    /* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  '127.0.0.1', // 服务器地址
    'DB_NAME'               =>  'shop',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  '123456',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  '',    // 数据库表前缀
    'DB_PARAMS'          	=>  array(), // 数据库连接参数
    'DB_DEBUG'  			=>  TRUE, // 数据库调试模式 开启后可以记录SQL日志
    'DB_FIELDS_CACHE'       =>  false,        // 启用字段缓存
    'DB_CHARSET'            =>  'utf8',      // 数据库编码默认采用utf8
    'DB_DEPLOY_TYPE'        =>  0, // 数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)
    'DB_RW_SEPARATE'        =>  false,       // 数据库读写是否分离 主从式有效
    'DB_MASTER_NUM'         =>  1, // 读写分离后 主服务器数量
    'DB_SLAVE_NO'           =>  '', // 指定从服务器序号

    /* 自动分页设置 */
    'AUTO_PAGE'             =>array(
                                'pageSize'      => 5,
                                'pageTheme'     => '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%',
                            ),


    'URL_MODEL'             =>  2,       // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
    // 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE  模式); 3 (兼容模式)  默认为PATHINFO 模式

    'TMPL_PARSE_STRING' => array(
        '__CSS__' => BASE_URL . 'Admin/css',
        '__IMG__' => BASE_URL . 'Admin/img',
        '__JS__' => BASE_URL . 'Admin/js',
        '__LOGO__' => BASE_URL . 'Admin/logo',
        '__UPLOADIFY__' => BASE_URL . 'Admin/ext/uploadify',
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
);