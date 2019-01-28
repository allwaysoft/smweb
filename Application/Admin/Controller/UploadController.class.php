<?php

namespace Admin\Controller;

use Think\Controller;

class UploadController extends Controller {

    public function upload() {
        if (!empty($_FILES)) {
            //  echo $_FILES['Filedata']['tmp_name'];
            // exit();

            $upload = new \Think\Upload(); // 实例化上传类
            $upload->maxSize = 3145728; // 设置附件上传大小
            $upload->allowExts = array('jpg', 'gif', 'png', 'jpeg'); // 设置附件上传类型
            $upload->savePath = '/Uploads/';
            $upload->autoSub = true;
            $upload->subName = array('date', 'Ymd');
            $images = $upload->upload();
            //判断是否有图
            if ($images) {
                $info = $images['Filedata']['savepath'] . $images['Filedata']['savename'];
                //返回文件地址和名给JS作回调用
                echo $info;
            } else {
                $this->error($upload->getError()); //获取失败信息
            }
        }
    }
	public function gallery(){
		if (!empty($_FILES)) {
			$upload = new \Think\Upload(); // 实例化上传类
			$upload->maxSize = 3145728; // 设置附件上传大小
			$upload->allowExts = array('jpg'); // 设置附件上传类型
			$upload->savePath = '/Gallery/';
			$upload->autoSub = true;
			$upload->subName = array('date', 'Ymd');
			$images = $upload->upload();
			//判断是否有图
			if ($images) {
				$info = $images['Filedata']['savepath'] . $images['Filedata']['savename'];
				//返回文件地址和名给JS作回调用
				echo $info;
			} else {
				$this->error($upload->getError()); //获取失败信息
			}
		}
	}
    public function batchupload() {
        $catalog = $_POST['dirname'] == '' ? date('Ymd', time()) : $_POST['dirname'];
        $dirname = 'Upload/' . $catalog;
        if (file_exists($dirname)) {
            mkdir($dirname, 0777);
        }
        $targetPath = "/Upload/" . $catalog . '/';
        if (!empty($_FILES)) {
            $pname = substr($_FILES['Filedata']['name'],0,-4);
            $pname = explode('-', $pname);
            $styleID = $pname[0];
            $color=$pname[1];
            $db = M('Product');
            $thisprod=$db->field('colorcode')->where(array('styleID'=>$styleID))->find();
            $arr_colorcode=explode(',', $thisprod['colorcode']);
            foreach ($arr_colorcode as $key=>$v)
            {
            	if($v==$color)
            	{
            		unset($arr_colorcode[$key]);
            	}
            }
            array_unshift($arr_colorcode,$color);
            $db->colorcode=implode(',', $arr_colorcode);
            $db->catalog = $catalog;
            $db->where(array('styleID' => $styleID))->save();
            $upload = new \Think\Upload(); // 实例化上传类
            $upload->maxSize = 3145728; // 设置附件上传大小				
            $upload->allowExts = array('jpg'); // 设置附件上传类型				
            $upload->savePath = $targetPath; // 设置附件上传目录
            $upload->autoSub = false;
            /* $upload->subName = $styleID; */
            $upload->replace = true;
            $upload->saveName = '';

            $images = $upload->upload();
            if (!$images) {// 上传错误提示错误信息
                echo $upload->getError();
            } else {// 上传成功 获取上传文件信息
                $thumb = new \Think\Image();
                $filename = 'Upload/' . $catalog . '/' . $images['Filedata']['savename'];
                $savename1 = 'Upload/' . $catalog . '/'. '/B_' . $images['Filedata']['savename'];
                $savename2 = 'Upload/' . $catalog . '/'. '/M_' . $images['Filedata']['savename'];
                $savename3 = 'Upload/' . $catalog . '/'. '/S_' . $images['Filedata']['savename'];
                $thumb->open($filename);
                $thumb->thumb(400, 500)->save($savename1);
                $thumb->thumb(160, 200)->save($savename2);
                $thumb->thumb(68, 85)->save($savename3);
                /* $thumb->open($savename3);
                $thumb->crop(180, 340, 80, 0)->save($savename3); */
                echo $targetPath  . $images['Filedata']['savename'];
            }
        }
    }

}

?>