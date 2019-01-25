<?php

namespace Wxqyh\Controller;

use Wxqyh\Common\UserController;

class MainController extends UserController {

    public $area;

    public function _initialize() {
        parent::_initialize();
        $areaset = M('Areaset');
        $areasetinfo = $areaset->find();
        $thisuser = M('Localuser')->where(array('id' => $_SESSION['userid']))->find();
        $area = $thisuser[$areasetinfo['checkname']];
        $this->area = $area;
        $newnews = M('News')->order('time desc')->limit(5)->select();
        foreach ($newnews as $key => $val) {
            $newnews[$key]['image'] = str_replace('/', '_', $val['image']);
        }
        $this->newnews = $newnews;
        $this->nowtime = time();
    }

    public function index() {
        $db = M('News_type');
        $pinfo = $db->where(array('id' => 2))->find();

        $cateList = $db->where(array('pid' => 0))->order('sort asc')->select();
        foreach ($cateList as $key => $val) {
            $cateListc = $db->where(array('pid' => $val['id']))->order('sort asc')->select();
            $cateList[$key]['cateListc'] = $cateListc;
        }

        // 最新资讯
        // load page
        $count = M('News')->order('time desc')->count();

        $page = new \Think\Pagewxqyh($count, 15);
        $page->setConfig('prev', '上一页');
        $page->setConfig('next', '下一页');
        $page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $show = $page->show();

        //news list
        $new_c = M('News')->order('time desc')->limit($page->firstRow . ',' . $page->listRows)->select();
        foreach ($new_c as $key => $val) {
            $new_c[$key]['image'] = str_replace('/', '_', $val['image']);
        }

        $pinfo['name'] = '新闻中心';
        // print_r($cateList);
        $this->cateList = $cateList;
        $this->pinfo = $pinfo;

        $this->tinfo = $tinfo;
        $this->newslist = $new_c;
        $this->page = $show;
        $this->display();
    }

    // 登出
    public function loginout() {
        cookie("logUname", null);
        $_SESSION = array();
        $_COOKIE = array();

        if (empty($_SESSION) && empty($_COOKIE)) {
            $this->success('退出成功', U('Wxqyh/Index/index'));
        }
    }

    /*
     *  新闻首页
     */



    /*
     *  新闻大栏目首页
     */

    public function newcatgary() {
        $pid = $_GET['pid'];
        $db = M('News_type');
        $pinfo = $db->where(array('id' => $pid))->find(); 
        $cateList = $db->where(array('pid' => 0))->order('sort asc')->select();
        foreach ($cateList as $key => $val) {
            $cateListc = $db->where(array('pid' => $val['id']))->order('sort asc')->select();
            $cateList[$key]['cateListc'] = $cateListc;
        }
        //print_r($cateList);
        if ($pid) {

            // 最新资讯
            // load page
            $count = M('News')->where(array('type_id' => $pid))->order('time desc')->count();

            $page = new \Think\Pagewxqyh($count, 15);
            $page->setConfig('prev', '上一页');
            $page->setConfig('next', '下一页');
            $page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
            $show = $page->show();

            //news list
            $new_c = M('News')->where(array('type_id' => $pid))->order('time desc')->limit($page->firstRow . ',' . $page->listRows)->select();
            foreach ($new_c as $key => $val) {
                $new_c[$key]['image'] = str_replace('/', '_', $val['image']);
            }
             //  print_r($pinfo);
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

            $page = new \Think\Pagewxqyh($count, 15);
            $page->setConfig('prev', '上一页');
            $page->setConfig('next', '下一页');
            $page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
            $show = $page->show();

            //news list
            $new_c = M('News')->where(array('type_id' => $tid))->order('time desc')->limit($page->firstRow . ',' . $page->listRows)->select();
            foreach ($new_c as $k => $val) {
                $new_c[$k]['image'] = str_replace('/', '_', $val['image']);
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
        $db = M('News_type');

        // print_r($pinfo);
        $cateList = $db->where(array('pid' => 2))->order('sort asc')->select();
        $nid = $_GET['nid'];
        if ($nid) {
            $db = M('News');
            $newsinfo = $db->where(array('id' => $nid))->find();
            $db->id = $nid;
            $db->count = $newsinfo['count'] + 1;
            $db->save();
            if ($newsinfo) {
                $pinfo = M('News_type')->where(array('id' => $newsinfo['type_id']))->find();
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