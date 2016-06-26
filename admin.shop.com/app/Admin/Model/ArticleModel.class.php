<?php
/**
 * Created by PhpStorm.
 * User: 胡亚洲
 * Date: 2016/6/25
 * Time: 11:35
 */

namespace Admin\Model;


use Think\Model;

class ArticleModel extends Model\RelationModel
{

    protected $_link = array(
//        'article_category'=> self::HAS_ONE,
//        'article_content' => self::HAS_ONE,
        'ArticleContent' => array(
            'mapping_type'      => self::HAS_ONE,
            'class_name'        => 'ArticleContent',
            'foreign_key'        =>'article_id',
        ),
        'ArticleCategory' => array(
            'mapping_type'      => self::BELONGS_TO,
            'class_name'        => 'ArticleCategory',
            'foreign_key'        =>'article_category_id',

        )
    );

    public function getAll()
    {
        $rows = $this->relation('ArticleCategory')->order('sort desc')->select();
        return $rows;
    }

    public function addModel($post)
    {
        $data = $this->data();
//        var_dump($data['id'] == null);
        $arr = [];
        foreach ($data as $key=>$row){
            if ($row != null){
                $arr[$key] = $row;
            }
        }
        $arr['ArticleContent']['content'] = $post['content'];
        return $this->relation('ArticleContent')->add($arr);

    }

    public function editModel($post)
    {
        $data = $this->data();
        $data['ArticleContent']['content'] = $post['content'];
        return $this->relation('ArticleContent')->save($data);
    }
}