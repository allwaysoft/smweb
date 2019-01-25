<?php

namespace Home\Controller;

use Common\Common\Controller\UserController;
class ThumbController extends UserController{
	public function index(){
		$src=substr(str_replace('_', '/', $_GET['thumb']), 1);
		$width=$_GET['w'];
		$height=$_GET['h'];
		$this->thumbs($src, $width, $height);
	}
	/**
	 * 图片缩略处理函数
	 * @ $src 原图片路径
	 * @ $width设置缩略图的宽度
	 * @ $height设置缩略图的高度
	 * */
	public function thumbs($src,$width,$height){
		$size=@getimagesize($src);
		$thumb=new \Org\Net\Easyphpthumbnail();
		$thumb->Thumbsize=200;
		if(($size[0]/$size[1])>=($width/$height))
		{
			$thumb->Thumbwidth=$width;
		}else{
			$thumb->Thumbheight=$height;
		}
		$thumb->Createthumb($src);
	}
}

?>