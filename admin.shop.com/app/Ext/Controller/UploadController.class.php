<?php
/**
 * Created by PhpStorm.
 * User: 胡亚洲
 * Date: 2016/6/27
 * Time: 12:37
 */

namespace Ext\Controller;


use Think\Controller;
use Think\Upload;

class UploadController extends Controller
{
    public function uploadImg()
    {
//        var_dump($_FILES['Filedata']);
        $option = C('UPLOAD_OPTION');
//        dump($option);
        $imgModel = new Upload($option);
        $imgInfo = $imgModel->upload();
//        dump($imgInfo);
        if ($imgInfo){
            if ($imgModel->driver == 'Qiniu'){
                $file_url = $imgInfo['Filedata']['url'];
            }else{
                $file_url = BASE_URL . $imgInfo['Filedata']['savepath'] . $imgInfo['Filedata']['savename'];
            }
            $return = [
                'file_url' => $file_url,
                'file_msg' => '上传成功',
                'status' => 1,
            ];
        } else {
            $return = [
                'file_url' =>'',
                'file_msg' => $imgModel->getError(),
                'status' => 0,
            ];
        }
        $this->ajaxReturn($return);
    }
}