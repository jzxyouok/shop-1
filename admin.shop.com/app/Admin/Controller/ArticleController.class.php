<?php
/**
 * Created by PhpStorm.
 * User: 胡亚洲
 * Date: 2016/6/25
 * Time: 11:35
 */

namespace Admin\Controller;


use Think\Controller;

class ArticleController extends Controller
{
    /**
     * @var \Admin\Model\ArticleModel
     */
    private $_model = null;

    protected function _initialize()
    {
        $this->_model = D('Article');

    }

    public function index()
    {
        $rows = $this->_model->getAll();
        $this->assign('rows', $rows);
        $this->display();
    }

    public function add()
    {
        if (!IS_POST) {
            $model = D('ArticleCategory');
            $rows = $model->select();
            $this->assign('rows', $rows);
            $this->display();
        } else {
            if (!$this->_model->create()) {
                $this->error(getError($this->_model), '', 3);
            };
            $re = $this->_model->addModel(I('post.'));
            if (!$re) {
                $this->error(getError($this->_model), '', 3);
            }
            $this->success('添加成功', U('index'), 3);
        }
    }

    public function edit()
    {
        if (!IS_POST) {
//            $row = $this->_model->find(I('get.id'));
//            $articleContent = M('ArticleContent');
//            $res = $articleContent->find(I('get.id'));
            $articleCategory = M('ArticleCategory');
            $rows = $articleCategory->select();
            $data = $this->_model->relation(true)->find(I('get.id'));
            $this->assign($data);
            $this->assign('rows', $rows);
            $this->display('add');
        } else {
            if (!$this->_model->create()) {
                echo 123;
                $this->error(getError($this->_model), '', 3);
            };
            $re = $this->_model->editModel(I('post.'));
            if (!$re) {
                echo 234;
                $this->error(getError($this->_model), '', 3);
            }
            $this->success('修改成功', U('index'), 3);
        }
    }

}



