<?php

namespace Home\Controller;

use Common\Common\Controller\UserController;

class ThumbController extends UserController {

    public function index() {
        $src = substr(str_replace('_', '/', $_GET['thumb']), 1);
        $width = $_GET['w'];
        $height = $_GET['h'];
        $this->thumbs($src, $width, $height);
    }

    public function pimg() {
        //$src = substr(str_replace('_', '/', $_GET['thumb']), 1);
        $f = $_GET['p'];
        $key = explode('-', $f);
        $w = $key[3];
        $h = $key[4];
        $img = 'M_' . $key[1] . '-' . $key[2] . '.jpg';
        $loc = str_replace(chr(92), chr(47), getcwd()) . '/Upload/' . $key[0] . '/';
        if (file_exists($loc.$img)) {
            // echo $loc; /Upload/20151013/M_10415011002-0182.jpg
            //echo $loc.$img;
            $this->thumbs($loc . $img, $w, $h);
        } else {
            
        }
    }

    /**
     * 图片缩略处理函数
     * @ $src 原图片路径
     * @ $width设置缩略图的宽度
     * @ $height设置缩略图的高度
     * */
    public function thumbs($src, $width, $height) {
        $size = @getimagesize($src);
        $thumb = new \Org\Net\Easyphpthumbnail();
        $thumb->Thumbsize = 200;
        if (($size[0] / $size[1]) >= ($width / $height)) {
            $thumb->Thumbwidth = $width;
        } else {
            $thumb->Thumbheight = $height;
        }
        $thumb->Createthumb($src);
    }

}

?>