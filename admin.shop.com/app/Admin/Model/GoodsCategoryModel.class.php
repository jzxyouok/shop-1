<?php
/**
 * Created by PhpStorm.
 * User: 胡亚洲
 * Date: 2016/6/28
 * Time: 1:07
 */

namespace Admin\Model;


use Ext\Logic\NestedSets;
use Think\Model;

class GoodsCategoryModel extends Model
{

    public function addModel()
    {
//        dump($this->data());exit;
        $ORM = D('Mysql', 'Logic');
//        var_dump($this->trueTableName);exit;
        $NestedSets = new NestedSets($ORM, $this->trueTableName, 'lft', 'rght', 'parent_id', 'id', 'level');
        return $NestedSets->insert($this->data['parent_id'], $this->data(), 'bottom');
    }

    public function editModel()
    {
//        dump($this->data());
        $id = $this->getFieldById($this->data['id'], 'parent_id');
//        dump($id);
        if ($id != $this->data['parent_id']) {
            $ORM = D('Mysql', 'Logic');
            $NestedSets = new NestedSets($ORM, $this->trueTableName, 'lft', 'rght', 'parent_id', 'id', 'level');
            if ($NestedSets->moveUnder($this->data['id'], $this->data['parent_id'], 'bottom') === false){
                $this->error = '出错了么， 自己找原因呗';
                return false;
            };
        }
        return $this->save();
    }

    public function removeModel($id)
    {
        $ORM = D('Mysql', 'Logic');
        $NestedSets = new NestedSets($ORM, $this->trueTableName, 'lft', 'rght', 'parent_id', 'id', 'level');
        return $NestedSets->delete($id);
        
    }

}