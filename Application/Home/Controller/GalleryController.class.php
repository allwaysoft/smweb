<?php

namespace Home\Controller;

use Common\Common\Controller\UserController;

class GalleryController extends UserController {

    public function _initialize() {
        parent::_initialize();
        $db = M('Gallery');
        $newStore = $db->field('id,type_id,title,cover_image,addtime')->order('addtime desc')->limit(5)->select();
        foreach ($newStore as $key => $val) {
            $newStore[$key]['cover_image'] = str_replace('/', '_', $val['cover_image']);
        }
        $this->newStore = $newStore;
    }

    public function index() {
        $db = M('Gallery');
        $db_type = M('Gallery_type');
        /* 全部 */
        $count = $db->order('addtime desc')->count();
        $page = new \Think\Page($count, 15);
        $page->setConfig('prev', '上一页');
        $page->setConfig('next', '下一页');
        $page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $show = $page->show();
        $galleryAll = $db->field('id,type_id,title,cover_image,addtime')->order('addtime desc')->limit($page->firstRow . ',' . $page->listRows)->select();
        foreach ($galleryAll as $key => $val) {
            $galleryAll[$key]['cover_image'] = str_replace('/', '_', $val['cover_image']);
        }

        $this->galleryAll = $galleryAll;
        $this->page = $show;

        /* 店铺分区 */
        $cateList = $db_type->where(array('pid' => 0))->order('sort asc')->select();
        $this->cateList = $cateList;
        $this->display();
    }

    public function storecatgary() {
        $pid = $_GET['pid'];
        if ($pid) {
            $db = M('Gallery_type');
            $pinfo = $db->where(array('id' => $pid))->find();
            // print_r($pinfo);
            $cateList = $db->where(array('pid' => $pid))->order('sort asc')->select();
            foreach ($cateList as $key => $value) {
                //$new_c = $db->where(array('pid' => $value['id']))->order('sort asc')->select();
                $new_c = M('Gallery')->where(array('type_id' => $value['id']))->order('time desc')->select();
                foreach ($new_c as $k => $val) {
                    $new_c[$k]['cover_image'] = str_replace('/', '_', $val['cover_image']);
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

    public function storelist() {
        $pid = $_GET['pid'];
        $tid = $_GET['tid'];
        if ($pid && $tid) {
            $db = M('Gallery_type');
            // first categary
            $pinfo = $db->where(array('id' => $pid))->find();
            $cateList = $db->where(array('pid' => $pid))->order('sort asc')->select();

            // send categary
            $tinfo = $db->where(array('id' => $tid))->find();
            // load page
            $count = M('Gallery')->where(array('type_id' => $tid))->order('addtime desc')->count();

            $page = new \Think\Page($count, 15);
            $page->setConfig('prev', '上一页');
            $page->setConfig('next', '下一页');
            $page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
            $show = $page->show();

            //news list
            $new_c = M('Gallery')->where(array('type_id' => $tid))->order('addtime desc')->limit($page->firstRow . ',' . $page->listRows)->select();
            foreach ($new_c as $k => $val) {
                $new_c[$k]['cover_image'] = str_replace('/', '_', $val['cover_image']);
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

    public function storeInfo() {
        $nid = $_GET['nid'];
        if ($nid) {
            $storeinfo = M('Gallery')->where(array('id' => $nid))->find();

            if ($storeinfo) {
                $pinfo = M('Gallery_type')->where(array('id' => $storeinfo['type_id']))->find();
                // load first category
                $cateLink = M('Gallery_type')->where(array('id' => $pinfo['pid']))->find();
                // locad category list
                $cateList = M('Gallery_type')->where(array('pid' => $cateLink['id']))->order('sort asc')->select();
                // print_r($cateLink);
                // print_r($newsinfo);
                $this->cateLink = $cateLink;
                $this->cateList = $cateList;
                $this->pinfo = $pinfo;
                $this->storeinfo = $storeinfo;
                $image = explode(',', $storeinfo['image']);
                $description = explode(',', $storeinfo['description']);
                $detail[0] = array('image' => $storeinfo['cover_image'], 'description' => '', 'simage' => str_replace('/', '_', $storeinfo['cover_image']));
                foreach ($image as $key => $val) {
                    $detail[] = array('image' => $val, 'description' => $description[$key], 'simage' => str_replace('/', '_', $val));
                }
                $this->detail = $detail;
                $this->count_i = count($detail);
                /* 上一条 */
                $storeprev = M('Gallery')->field('id,title,cover_image')->where(array('id' => array('gt', $nid)))->order('addtime asc')->limit(1)->find();
                if ($storeprev) {
                    $storeprev['cover_image'] = str_replace('/', '_', $storeprev['cover_image']);
                }
                $this->storeprev = $storeprev;
               // print_r($storeprev);
                /* 下一条 */
                $storenext = M('Gallery')->field('id,title,cover_image')->where(array('id' => array('lt', $nid)))->order('addtime desc')->limit(1)->find();
                if($storenext){
                $storenext['cover_image'] = str_replace('/', '_', $storenext['cover_image']);
                }
                $this->storenext = $storenext;
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