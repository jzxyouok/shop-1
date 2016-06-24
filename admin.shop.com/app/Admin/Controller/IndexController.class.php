<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $str = '后端首页';
        $this->assign('str', $str);
        $this->display();
    }
}