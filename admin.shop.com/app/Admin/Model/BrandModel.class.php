<?php
/**
 * Created by PhpStorm.
 * User: 胡亚洲
 * Date: 2016/6/25
 * Time: 9:36
 */

namespace Admin\Model;


use Think\Image;
use Think\Model;
use Think\Page;
use Think\Upload;

class BrandModel extends Model
{
    protected $pathValidate = true; //开启批量验证
    protected $_validate = [
        ['name', 'require', '品牌名不能为空'],
        ['name', '', '品牌已存在', self::EXISTS_VALIDATE, 'unique'],
        ['status', '1, 0', '显示设置不合法', self::EXISTS_VALIDATE, 'in'],
        ['sort', 'number', '排序必须为数字'],
    ];


    public function autoPage($data)
    {
        $totalRows = $this->where($data)->count();
        $rows = $this->where($data)->page(I('get.p'), C('AUTO_PAGE')['pageSize'])->select();
        $pageModel = new Page($totalRows, C('AUTO_PAGE')['pageSize']);
        $pageModel->setConfig('theme', C('AUTO_PAGE')['pageTheme']);
        $pageHtml = $pageModel->show();
        return compact(['rows', 'pageHtml']);           //将数组键名作为变量名， 值为键对应的值

    }

    public function edit($data)
    {
        if ($data['logo']['name']){
            $option = C('UPLOAD_OPTION');
            $upload = new Upload($option);
            $info = $upload->uploadOne($data['logo']);
            if (!$info) {
                $this->error = $upload->getError();
                return false;
            }
            $path = $upload->rootPath . $info['savepath'] . $info['savename'];
            $img = new Image();
            $img->open($path);
            $img->thumb(150, 150, 2)->save($upload->rootPath . 'Admin/logo/' . $info['savename']);
            $this->data['logo'] = $info['savename'];
        }
        $re = $this->save();
        if ($re === false){
            return false;
        }
        return true;

    }

    public function remove($id)
    {
        $data = $this->find($id);
        if (empty($data)){
            $this->error = '品牌不存在';
            return false;
        }
        $data['name'] = $data['name'] . '_' . $id . '_del';
        $data['status'] = -1;
        if ($this->save($data) === false){
            return false;
        };
        return true;

    }

    public function addModel(array $arr)
    {
//        dump($arr['file']);
//        dump($arr['data']);
//        $data = $arr['data'];
//        $re = $this->create($data);
//        if (!$re){
//            return false;
//        }
        if ($arr['file']['logo']['name'] == null){
            $this->data['logo'] = C('logoName');
        } else {
            $option = C('UPLOAD_OPTION');
            $upload = new Upload($option);
            $info = $upload->uploadOne($arr['file']['logo']);
            if (!$info) {
                $this->error = $upload->getError();
                return false;
            }
            $path = $upload->rootPath . $info['savepath'] . $info['savename'];
            $img = new Image();
            $img->open($path);
            $img->thumb(150, 150, 2)->save($upload->rootPath . 'Admin/logo/' . $info['savename']);
            $this->data['logo'] = $info['savename'];
        }
        $re = $this->add();
        if ($re === false){
            return false;
        }
        return true;

    }
    
};