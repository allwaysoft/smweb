<?php

namespace Home\Controller;

use Common\Common\Controller\UserController;

class MainController extends UserController {

    public $area;

    public function _initialize() {
        parent::_initialize();
        $areaset = M('Areaset');
        $areasetinfo = $areaset->find();
        $thisuser = M('Localuser')->where(array('id' => $_SESSION['userid']))->find();
        $area=$thisuser[$areasetinfo['checkname']];
		$this->area = $area;
		$newnews = M('News')->order('time desc')->limit(5)->select();
		foreach ($newnews as $key=>$val){
			$newnews[$key]['image']=str_replace('/', '_', $val['image']);
		}
		$this->newnews = $newnews;
                $this->nowtime=time();
    }

    public function index() {
        $db = M('News_type');
        $list = $db->where(array('pid' => 0))->order('sort asc')->select();
        foreach ($list as $key => $value) {
            $new_c = $db->where(array('pid' => $value['id']))->order('sort asc')->select();
            foreach ($new_c as $k => $v) {
            	$newlist=M('News')->where(array('type_id' => $v['id']))->order('time desc')->select();
            	foreach ($newlist as $f=>$e)
            	{
            		$newlist[$f]['image']=str_replace('/', '_', $e['image']);
            	}
                $new_c[$k]['newlist'] = $newlist;
            }
            $list[$key]['new_c'] = $new_c;
        }
        // load products////////////////////////////////
        $piciList = M('Area_pici')->where(array('areaname' => $this->area))->field('id,quotatime,title')->order('quotatime desc,time desc')->limit('0,5')->select();
        //print_r($piciList);
        $where = "pici.areaname='$this->area' and pici.id=quota.pcID and quota.styleID=product.styleID";
        $pici = M('Area_pici')->where(array('areaname' => $this->area))->field('id,quotatime,title')->order('quotatime desc,time desc')->find();
        $where.=' and pici.id=' . $pici['id'];
        $listProducts = M()->table(array('tp_area_pici' => 'pici', 'tp_quota' => 'quota', 'tp_product' => 'product'))->where($where)->order('')->field('product.*,quota.pcID')->limit(20)->select();
         foreach ($listProducts as $key => $val) {
            $colorname = explode(',', $val['colorcode']);
            $listProducts[$key]['colorname'] = $colorname[0];
        }
       // print_r($listProducts);
        /////////////////////////////////
        $this->list = $list;
        // banner图
        $banner = M('Banner')->where('type_id = 1')->select();
        $this->banner = $banner;
        // 中部广告
        $ggcenter = M('Banner')->where('type_id = 3')->find();
        $this->piciList = $piciList;
        $this->listProducts = $listProducts;
        $this->ggcenter = $ggcenter;
        
        
        //店铺风采
        $gallery=M('Gallery')->field('id,title,type_id,cover_image')->where(array('is_display'=>1))->order('sort desc,addtime desc')->limit(4)->select();
        foreach ($gallery as $key=>$val)
        {
        	$gallery[$key]['cover_image']=str_replace('/', '_', $val['cover_image']);
        }
        $this->gallery=$gallery;
        //设置子Banner
        $sub_banner = M('subbanner')->find();
        $background = $sub_banner['backgroundimg'];
        if($background){
        	$isContain = strpos($background,"#");
        	if($isContain != 0){
        		$background = "url('$background')";
        	}
        }
        else {
        	$background = "#3F4D43";
        }
        $sub_banner['backgroundimg'] = $background;
        $this->assign("sub",$sub_banner);
        $this->display();
    }

    // 登出
    public function loginout() {
        $_SESSION = array();
        $_COOKIE = array();
        if (empty($_SESSION) && empty($_COOKIE)) {
            $this->success('退出成功', U('Home/Index/index'));
        }
    }

    /*
     *  新闻首页
     */

    public function newsindex() {
        $db = M('News_type');
        $pinfo = $db->where(array('id' => 0))->find();
        // print_r($pinfo);
        $cateList = $db->where(array('pid' => 0))->order('sort asc')->select();

        // 最新资讯
        
        // load page
        $count = M('News')->order('time desc')->count();

        $page = new \Think\Page($count, 15);
        $page->setConfig('prev', '上一页');
        $page->setConfig('next', '下一页');
        $page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $show = $page->show();

        //news list
        $new_c = M('News')->order('time desc')->limit($page->firstRow . ',' . $page->listRows)->select();
		foreach ($new_c as $key=>$val)
		{
			$new_c[$key]['image']=str_replace('/', '_', $val['image']);
		}
        // print_r($new_c);
        $this->cateList = $cateList;
        $this->pinfo = $pinfo;
        $this->tinfo = $tinfo;
        $this->newslist = $new_c;
        $this->page = $show;
        $this->display();
    }

    /*
     *  新闻大栏目首页
     */

    public function newcatgary() {
        $pid = $_GET['pid'];
        if ($pid) {
            $db = M('News_type');
            $pinfo = $db->where(array('id' => $pid))->find();
            // print_r($pinfo);
            $cateList = $db->where(array('pid' => $pid))->order('sort asc')->select();


            foreach ($cateList as $key => $value) {
                //$new_c = $db->where(array('pid' => $value['id']))->order('sort asc')->select();
                $new_c = M('News')->where(array('type_id' => $value['id']))->order('time desc')->select();
                foreach ($new_c as $k=>$val)
                {
                	$new_c[$k]['image']=str_replace('/', '_', $val['image']);
                }
                //  print_r($new_c);
                $cateList[$key]['new_c'] = $new_c;
            }
            // print_r($list);
            $this->cateList = $cateList;
            $this->pinfo = $pinfo;
            $this->display();
        } else {
            $this->redirect('Home/Main/index');
        }
    }

    /*
     *  读取新闻列表
     */

    public function newslist() {
        $pid = $_GET['pid'];
        $tid = $_GET['tid'];
        if ($pid && $tid) {
            $db = M('News_type');
            // first categary
            $pinfo = $db->where(array('id' => $pid))->find();
            $cateList = $db->where(array('pid' => $pid))->order('sort asc')->select();

            // send categary
            $tinfo = $db->where(array('id' => $tid))->find();
            // load page
            $count = M('News')->where(array('type_id' => $tid))->order('time desc')->count();

            $page = new \Think\Page($count, 15);
            $page->setConfig('prev', '上一页');
            $page->setConfig('next', '下一页');
            $page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
            $show = $page->show();

            //news list
            $new_c = M('News')->where(array('type_id' => $tid))->order('time desc')->limit($page->firstRow . ',' . $page->listRows)->select();
            foreach ($new_c as $k=>$val)
            {
            	$new_c[$k]['image']=str_replace('/', '_', $val['image']);
            }
            // print_r($new_c);
            $this->cateList = $cateList;
            $this->pinfo = $pinfo;
            $this->tinfo = $tinfo;
            $this->newslist = $new_c;
            $this->page = $show;
            $this->display();
        } else {
            $this->redirect('Home/Main/index');
        }
    }

    /*
     *  读取新闻的详细信息
     */

    public function newsdetail() {
        $nid = $_GET['nid'];
        if ($nid) {
        	$db=M('News');
            $newsinfo = $db->where(array('id' => $nid))->find();
            $db->id=$nid;
            $db->count=$newsinfo['count']+1;
            $db->save();
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

    /*
     *  读取新闻的所属栏目
     */

    public function localcategary($nid) {
        $ninfo = M('News')->where(array('id' => $nid))->find();
        $ptype = M('News_type')->where(array('id' => $ninfo['type_id']))->find();
        $pInfo[] = $ptype;
        $ptype1 = M('News_type')->where(array('id' => $ptype['pid']))->find();
        $pInfo[] = $ptype1;
        krsort($pInfo);
        return $pInfo;
    }
}

?>