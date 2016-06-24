<?php
/**
 * Created by PhpStorm.
 * User: 胡亚洲
 * Date: 2016/6/24
 * Time: 19:09
 */
function getError(\Think\Model $sub)
{
    $error = $sub->getError();
    if (!is_array($error)){
        $error = [$error];
    }
    $errorHtml = '<ol>';
    foreach ($error as $row){
        $errorHtml .= '<li>' . $row . '</li>';
    }
    $errorHtml .= '</ol>';
    return $errorHtml;
}