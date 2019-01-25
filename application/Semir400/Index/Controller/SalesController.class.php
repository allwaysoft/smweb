<?php

namespace Index\Controller;

use Think\Controller;

class SalesController extends Controller {

    public function __construct() {
        parent::__construct();
        define('RES', '/Tpl/Semir400');
    }

    /*
     * 处理人员链接
     */

    public function info() {
        $url = $_SERVER["HTTP_REFERER"]; //获取完整的来路URL 
        $str = str_replace("http://", "", $url); //去掉http:// 
        $strdomain = explode("/", $str); // 以“/”分开成数组 
        $domain = $strdomain[0]; //取第一个“/”以前的字符
        if ($domain == 'oa.semir.com') {
            
        } else {
            header("Content-type: text/html; charset=utf-8");
            echo "非法的访问地址！" . $domain;
            exit;
        }
        $id = I('get.si', 0, 'intval');
        $info = M('400_quality')->where(array('id' => $id))->find();
        if ($info) {
            $info['com_pic'] = explode(',', $info['com_pic']);
            $follow = M('400_quality_follow')->where(array('com_code' => $info['com_code']))->order('id desc')->select();
            foreach ($follow as $key => $val) {
                if ($val['fol_pic']) {
                    $follow[$key]['fol_pic'] = explode(',', $val['fol_pic']);
                }
            }
            $this->follow = $follow;
            $this->info = $info;
            $this->feedback = M('400_quality_track')->where(array('com_code' => $info['com_code']))->order('id desc')->select();
            M('400_quality_track')->where(array('com_code' => $info['com_code'], 'view_status' => 1))->setField('view_status', 2);
            $this->display();
        } else {
            header("Content-type: text/html; charset=utf-8");
            echo "请确认您的访问信息是否正确！！" . $domain;
        }
    }

    public function download() {
        $url = $_SERVER["HTTP_REFERER"]; //获取完整的来路URL 
        $str = str_replace("http://", "", $url); //去掉http:// 
        $strdomain = explode("/", $str); // 以“/”分开成数组 
        $domain = $strdomain[0]; //取第一个“/”以前的字符
        if ($domain == 'oa.semir.com') {
            
        } else {
            header("Content-type: text/html; charset=utf-8");
            echo "非法的访问地址！" . $domain;
            //  exit;
        }
        $id = I('get.si', 0, 'intval');
        $info = M('400_quality')->where(array('id' => $id))->find();
        print_r($info);
        if ($info) {
            $pic = explode(',', $info['com_pic']);
            //  print_r($pic);
            $tempPic = "";
            for ($i = 0; $i < count($pic); $i++) {
                //echo $pic[$i];
                $tt = explode('/', $pic[$i]);
                $tempPic[] = $tt[5];
                copy("." . $pic[$i], $tt[5]) ? '成功' : '失败';
            }

            $this->zipcode($info['style_id'], $tempPic);
        } else {
            header("Content-type: text/html; charset=utf-8");
            echo "请确认您的访问信息是否正确！！" . $domain;
        }
    }

    public function zipcode($sid = '400', $tempPic) {
        /**
         * 没有写成class 或者 function ，需要的朋友自己写，就这么几行。。     
         */
        //$filename = $sid . ".zip"; //最终生成的文件名（含路径）   
        $filename = "400pic.zip"; //最终生成的文件名（含路径）   
        if (file_exists($filename)) {
//重新生成文件   
            $zip = new \ZipArchive(); //使用本类，linux需开启zlib，windows需取消php_zip.dll前的注释   
            if ($zip->open($filename, \ZipArchive::OVERWRITE) !== TRUE) {
                exit('无法打开文件，或者文件创建失败');
            }
            //print_r($tempPic);
            foreach ($tempPic as $val) {

                $attachfile = $val; //获取原始文件路径   
                if (file_exists($attachfile)) {
                    $zip->addFile($attachfile); //第二个参数是放在压缩包中的文件名称，如果文件可能会有重复，就需要注意一下   
                }
                // unlink($val);//删除文件
            }
            $zip->close(); //关闭   
        }
        if (!file_exists($filename)) {
            exit("无法找到文件"); //即使创建，仍有可能失败。。。。   
        }

        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header('Content-disposition: attachment; filename=' . basename($filename)); //文件名   
        header("Content-Type: application/zip"); //zip格式的   
        header("Content-Transfer-Encoding: binary"); //告诉浏览器，这是二进制文件    
        header('Content-Length: ' . filesize($filename)); //告诉浏览器，文件大小   
        ob_clean();
        flush();
        readfile($filename);

        foreach ($tempPic as $valf) {
            //  echo $valf;
            unlink($valf); //删除文件
        }
    }

}

?>