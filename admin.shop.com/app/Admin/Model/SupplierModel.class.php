<?php
/**
 * Created by PhpStorm.
 * User: 胡亚洲
 * Date: 2016/6/24
 * Time: 13:21
 */

namespace Admin\Model;


use Think\Model;
use Think\Page;

class SupplierModel extends Model
{
//    private $pathValidate = true;
    protected $patchValidate = true;//开启批量验证
//   protected $_validate = array(
    protected $_validate = [
        ['name', 'require', '供货商不能为空', self::MUST_VALIDATE],
        ['name', '', '供货商已存在', self::EXISTS_VALIDATE, 'unique'],
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
        $rows = $this->find($data['id']);
        if ($rows['name'] === $data['name']){           //如果提交的供货商名称未发生变化
            array_splice($this->_validate, 1, 1);       //去掉供货商名称的重复性检查
        }
        $re = $this->create($data);
        if (!$re){
            return false;
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
            $this->error = '该供货商不存在';
            return false;
        }
        $data['name'] = $data['name'] . $id . '_del';
        $data['status'] = -1;
        if ($this->save($data) === false){
            return false;
        };
        return true;
        
    }

}