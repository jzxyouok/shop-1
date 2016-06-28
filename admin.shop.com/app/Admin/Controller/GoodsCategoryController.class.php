<?php
/**
 * Created by PhpStorm.
 * User: 胡亚洲
 * Date: 2016/6/28
 * Time: 1:06
 */

namespace Admin\Controller;


use Ext\Logic\NestedSets;
use Think\Controller;

class GoodsCategoryController extends Controller
{

    /**
     * @var \Admin\Model\GoodsCategoryModel
     */
    private $_model = null;

    protected function _initialize()
    {
        $this->_model = D('GoodsCategory');

    }
    
    public function index()
    {
        $data = $this->_model->order('lft')->select();
        $this->assign('rows', $data);
        $this->display();
    }
    
    public function add()
    {
        if (!IS_POST) {
            $data = $this->_model->order('lft')->select();
            array_unshift($data, ['id' => 0, 'name' => '顶级分类', 'parent_id' => 0]);
//            var_dump($data);exit;
            $data = json_encode($data);
//            array_unshift($data, ['id' => 0, 'name' => '顶级分类', 'parent_id' => 0]);
            $this->assign('goods_categories', $data);
            $this->display();
        } else {
            if ($this->_model->create() === false){
                $this->error(getError($this->_model));
            };
            if ($this->_model->addModel() === false){
                $this->error(getError($this->_model));
            };
            $this->success('增加成功', U('index') , 3);
        }
    }
    public function edit()
    {
        if (!IS_POST) {
            $data = $this->_model->order('lft')->select();
            array_unshift($data, ['id' => 0, 'name' => '顶级分类', 'parent_id' => 0]);
//            var_dump($data);exit;
            $data = json_encode($data);

            $row = $this->_model->find(I('get.id'));
            $this->assign('goods_categories', $data);
            $this->assign('row', $row);
            $this->display('add');
        } else {
            if ($this->_model->create() === false){
                $this->error(getError($this->_model));
            };
            if ($this->_model->editModel() === false){
                $this->error(getError($this->_model));
            };
            $this->success('增加成功', U('index') , 3);
        }
        
    }
    
    public function remove()
    {
        $re = $this->_model->removeModel(I('get.id'));
        if ($re === false){
            $this->error(getError($this->_model));
        };
        $this->success('删除成功', U('index') , 3);
    }
    
}