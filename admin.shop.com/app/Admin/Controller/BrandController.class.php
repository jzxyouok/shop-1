<?php
/**
 * Created by PhpStorm.
 * User: 胡亚洲
 * Date: 2016/6/25
 * Time: 9:34
 */

namespace Admin\Controller;


use Think\Controller;

class BrandController extends Controller
{
    /**
     * @var \Admin\Model\BrandModel
     */
    private $_model = null;

    protected function _initialize()
    {
        $this->_model = D('Brand');
    }

    public function index()
    {
        $data = [
            'name' => ['like', '%' . I('get.keyword') . '%'],           //模糊查询条件
            'status' => ['egt', 0]
        ];
//        dump($data);
        $data = $this->_model->autoPage($data);
//        var_dump($rows);
        $this->assign($data);
        $this->display();
        
    }

    public function add()
    {
        if (!IS_POST){
//            $this->display();
            $this->display('add1');
        } else {

            $re = $this->_model->create();
            if ($re === false){
                $this->error(getError($this->_model), '' ,3);
            }
//            dump($this->_model->data());exit;
//            dump($_FILES);
//            $re = $this->_model->addModel(['data' => $this->_model->data(), 'file' => $_FILES]);
            $re = $this->_model->add();
            if ($re === false){
                $this->error(getError($this->_model), '' ,3);
            }
            $this->success('添加成功', U('index', 3));
        }

    }

    public function edit()
    {
//        dump(I('get.id'));
        if (!IS_POST) {
            $row = $this->_model->find(I('get.id'));
            $this->assign('row', $row);
            $this->display('add1');
        } else {
//            dump(I());
            $re = $this->_model->create();
            if ($re === false){
                $this->error(getError($this->_model), '' ,3);
            }
//            $re = $this->_model->edit($_FILES);
            $re = $this->_model->save();
            if ($re === false){
//                dump(getError($this->_model));
                $this->error(getError($this->_model), '' ,3);
            }
            $this->success('编辑成功', U('index', 3));
        }

    }

    public function remove()
    {
        $id = I('get.id');
        $re = $this->_model->remove($id);
        if (!$re){
            $this->error(getError($this->_model), '' ,3);
        }
        $this->success('删除成功', U('index', 3));
    }


}