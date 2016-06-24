<?php
define('BASE_URL', 'http://admin.shop.com/');
return array(
	//'配置项'=>'配置值'
    'TMPL_PARSE_STRING' => array(
        '__CSS__' => BASE_URL . 'Admin/css',
        '__IMG__' => BASE_URL . 'Admin/img',
        '__JS__' => BASE_URL . 'Admin/js',
    ),
);