<?php

namespace Home\Controller;

use Common\Common\Controller\UserController;

class DownController extends UserController {

    public function index() {
		$cateList = M('Down_type')->select();
		$db = M('Download');
		// 图片下载内容
		$plist = $db->where(array('type_id' => 1,'ispub' => 1))->limit(5)->order('addtime desc')->select();
		// 视频下载内容
		$vlist = $db->where(array('type_id' => 2,'ispub' => 1))->limit(5)->order('addtime desc')->select();
		// 音乐下载内容
		$mlist = $db->where(array('type_id' => 3,'ispub' => 1))->limit(5)->order('addtime desc')->select();
		// 个人下载内容
		$userid = $_SESSION['userid'];
		//$userid = 227;
		$map['userid'] = array('like',"%".$userid."%");
		$map['ispub']  = 0;
		$gelist = $db->where($map)->limit(5)->select();
		
		
		$this->plist = $plist;
		$this->vlist = $vlist;
		$this->mlist = $mlist;
		$this->gelist = $gelist;
        $this->cateList = $cateList;
        $this->display();
    }

	// 下载列表
    public function downlist() {
        $pid = $_GET['pid'];
        if($pid == 4){
			$tinfo['name'] = "个人下载";
			$userid = $_SESSION['userid'];
			//$userid = 227;
			$map['userid'] = array('like',"%".$userid."%");
			$map['ispub']  = 0;
			$downlist = M('Download')->where($map)->select();
			$this->cateList = $cateList;
            $this->tinfo = $tinfo;
            $this->downlist = $downlist;
            $this->display();
		}elseif($pid !=4) {
            $db = M('Down_type');
            // first categary
            $cateList = $db->select();
            // send categary
            $tinfo = $db->where(array('id' => $pid))->find();

            //news list
            $downlist = M('Download')->where(array('type_id' => $pid,'ispub' => 1))->order('addtime desc')->select();

            // print_r($list);
            $this->cateList = $cateList;
            $this->tinfo = $tinfo;
            $this->downlist = $downlist;
            $this->display();
        } else {
            $this->redirect('Home/Main/index');
        }
    }
	// 下载地址
    public function downdetail() {
        $pid = $_GET['pid'];
        $tid = $_GET['tid'];
        if ($pid && $tid) {
            $db = M('Down_type');
            // first categary
            $cateList = $db->select();

            // send categary
            $tinfo = $db->where(array('id' => $pid))->find();

            $download = M('Download')->where(array('id' => $tid))->find();
			$urls = explode(",",$download['url']);
			for($i=0; $i<count($urls)-1; $i++){
				$url[$i]['name'] = $i+1;
				$url[$i]['url']  = $urls[$i];
			}
            $this->cateList = $cateList;
            $this->pinfo = $pinfo;
            $this->tinfo = $tinfo;
            $this->download = $download;
            $this->url = $url;
            $this->display();
        } else {
            $this->redirect('Home/Main/index');
        }
    }
	// 音乐下载
    public function music() {
        $pid = $_GET['pid'];
        $tid = $_GET['tid'];
        if ($pid && $tid) {
            $db = M('News_type');
            // first categary
            $pinfo = $db->where(array('id' => $pid))->find();
            $cateList = $db->where(array('pid' => $pid))->order('sort asc')->select();

            // send categary
            $tinfo = $db->where(array('id' => $tid))->find();

            //news list
            $new_c = M('News')->where(array('type_id' => $tid))->order('time desc')->select();

            // print_r($list);
            $this->cateList = $cateList;
            $this->pinfo = $pinfo;
            $this->tinfo = $tinfo;
            $this->newslist = $new_c;
            $this->display();
        } else {
            $this->redirect('Home/Main/index');
        }
    }

    /*
     *  读取
     */

    public function newsdetail() {
        $nid = $_GET['nid'];
        if ($nid) {
            $newsinfo = M('News')->where(array('id' => $nid))->find();
            if ($newsinfo) {
                $pinfo = M('News_type')->where(array('id' => $newsinfo['type_id']))->find();
                // load first category
                $cateLink = M('News_type')->where(array('id' => $pinfo['pid']))->find();
                // locad category list
                $cateList = M('News_type')->where(array('pid' => $cateLink['id']))->order('sort asc')->select();
               // print_r($cateLink);
                // print_r($newsinfo);
                $this->cateLink = $cateLink;
                $this->cateList = $cateList;
                $this->pinfo = $pinfo;
                $this->newsinfo = $newsinfo;
                
                $this->display();
            } else {
                echo "信息已经过期或不存在。。。";
            }
        } else {
            echo "信息已经过期或不存在。。。";
        }
    }
}

?>