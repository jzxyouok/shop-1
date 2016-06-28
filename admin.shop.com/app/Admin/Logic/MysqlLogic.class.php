<?php
/**
 * Created by PhpStorm.
 * User: 胡亚洲
 * Date: 2016/6/28
 * Time: 12:44
 */

namespace Admin\Logic;


use Ext\Logic\DbMysql;

class MysqlLogic implements DbMysql
{
    public function connect()
    {
        // TODO: Implement connect() method.
        echo __METHOD__;        //获得方法名
        dump( func_get_args());       //获得所有参数
        echo '<hr />';
        
    }

    public function disconnect()
    {
        // TODO: Implement disconnect() method.
        echo __METHOD__;        //获得方法名
        dump( func_get_args());       //获得所有参数
        echo '<hr />';

    }

    public function free($result)
    {
        // TODO: Implement free() method.
        echo __METHOD__;        //获得方法名
        dump( func_get_args());       //获得所有参数
        echo '<hr />';

    }

    public function query($sql, array $args = array())
    {
        // TODO: Implement query() method.
        $args = func_get_args();
        $sql = array_shift($args);
        $sqlArr = preg_split('/\?[FTN]/', $sql);
        $sql = '';
        foreach ($sqlArr as $key => $value){
            $sql .= $value . $args[$key];
        }

//        var_dump( M()->execute($sql));

        return M()->execute($sql);
        echo __METHOD__;        //获得方法名
        dump( func_get_args());       //获得所有参数
        echo '<hr />';


//        //获取所有的实参
//        $args   = func_get_args();
//        //获取sql语句
//        $sql    = array_shift($args);
//        //将sql语句分隔
//        $params = preg_split('/\?[NFT]/', $sql);
//        //删除最后一个空元素
//        array_pop($params);
//
//        //sql变量已经没用了， 我们用来拼凑完整的sql语句
//        $sql    = '';
//        foreach ($params as $key => $value) {
//            $sql .= $value . $args[$key];
//        }
//        //执行一个写操作
//        return M()->execute($sql);


    }

    public function insert($sql, array $args = array())
    {
        // TODO: Implement insert() method.
        $args = func_get_args();
        $sql = $args[0];
        $tableName = $args[1];
        $argus = $args[2];
        $tmp = [];
        foreach ($argus as $key => $value){
            if ($value != null){
                $tmp[] = '`' . $key . '` = "' . $value . '"';

            }
        }

        $sql = str_replace('?T', $tableName, $sql);
        $sql = str_replace('?%', (implode(',', $tmp)), $sql);
        return M()->execute($sql);
        echo __METHOD__;        //获得方法名
        dump( func_get_args());       //获得所有参数
        echo '<hr />';

    }

    public function update($sql, array $args = array())
    {
        // TODO: Implement update() method.
        echo __METHOD__;        //获得方法名
        dump( func_get_args());       //获得所有参数
        echo '<hr />';

    }

    public function getAll($sql, array $args = array())
    {
        // TODO: Implement getAll() method.

        echo __METHOD__;        //获得方法名
        dump( func_get_args());       //获得所有参数
        echo '<hr />';

    }

    public function getAssoc($sql, array $args = array())
    {
        // TODO: Implement getAssoc() method.
        echo __METHOD__;        //获得方法名
        dump( func_get_args());       //获得所有参数
        echo '<hr />';

    }

    public function getRow($sql, array $args = array())
    {
        // TODO: Implement getRow() method.
        $args = func_get_args();
        $sql = array_shift($args);
//        dump($sql);
//        dump($args);
        $sqlArr = preg_split('/\?[FTN]/', $sql);
        $sql = '';
        foreach ($sqlArr as $key => $value){
            $sql .= $value . $args[$key];
        }
        $rows = M()->query($sql);
        //我们只要第一行
        return array_shift($rows);
        echo __METHOD__;        //获得方法名
        dump( func_get_args());       //获得所有参数
        echo '<hr />';

    }

    public function getCol($sql, array $args = array())
    {
        // TODO: Implement getCol() method.
        echo __METHOD__;        //获得方法名
        dump( func_get_args());       //获得所有参数
        echo '<hr />';

    }

    public function getOne($sql, array $args = array())
    {
        // TODO: Implement getOne() method.


        $args = func_get_args();
        $sql = array_shift($args);

        $sqlArr = preg_split('/\?[FTN]/', $sql);
        $sql = '';
        foreach ($sqlArr as $key => $value){
            if ($value != null){
                $sql .= $value . $args[$key];
            }
        }
        $rows = M()->query($sql);
        //我们只要第一行
        return array_shift(array_shift($rows));

    }

}