<?php

namespace Admin\Controller;

//use Think\Controller;
use Admin\Common\CheckAdminController;

class SystemController extends CheckAdminController {

    public function __construct() {
        parent::__construct();
        define('RES', '/Tpl/Semir400');
        $this->stemp = 'Semir400/admin/system';
    }

    public function index() {
        $this->display();
    }

    /*
     * 质量投诉主题管理
     * lizd11
     */

    public function subject() {

        $this->theme($this->stemp)->display();
    }

    public function subject_list() {
     
        $where = '';
        $list = M('400_complain_title')->where($where)->order('id  desc')->select();
        if ($list) {

            $data['data'] = $list;
        } else {
            $data['data'] = array();
        }
        $this->ajaxReturn($data, 'JSON');
    }

    public function subject_add() {
        $this->theme($this->stemp)->display();
    }

    public function subject_add_do() {
        $m = D('400_complain_title');
        if (!$m->create()) {
            echo "30001：保存数据错误！- " . $m->getError();
            exit;
        }
        $id = $m->add();
        if ($id) {
            echo 0;
        } else {
            echo "30002：保存数据错误！" . $m->getError();
        }
    }

    public function subject_edit() {
        $id = I('get.id', 0, 'intval');
        $info = M('400_complain_title')->where(array('id' => $id))->find();
        $this->info = $info;
        $this->theme($this->stemp)->display();
    }

    public function subject_edit_do() {
        $id = I('post.id');
        $post['title'] = I('post.title');
        $m = D('400_complain_title');
        $res = $m->where(array('id' => $id))->save($post);
        if ($res) {
            echo 0;
        } else {
            echo "30002：保存数据错误！" . $m->getError();
        }
    }

    public function subject_del_do() {
        $id = I('post.id');
        $m = D('400_complain_title');
        $reg = $m->delete($id);
        if ($reg) {
            echo 0;
        } else {
            echo "30002：保存数据错误！" . $m->getError();
        }
    }

    /*
     * 常用回复管理
     * lizd11
     */

    public function track() {

        $this->theme($this->stemp)->display();
    }

    public function track_list() {
        $where = '';
        $list = M('400_track_dictionary')->where($where)->order('id  desc')->select();
        if ($list) {
            foreach ($list as $key => $val) {
                if ($val['type'] == 1) {
                    $list[$key]['type'] = '服务投诉';
                } elseif ($val['type'] == 2) {
                    $list[$key]['type'] = '质量投诉';
                } elseif ($val['type'] == 3) {
                    $list[$key]['type'] = '终端服务';
                }
            }
            $data['data'] = $list;
        } else {
            $data['data'] = array();
        }
        $this->ajaxReturn($data, 'JSON');
    }

    public function track_add() {
        $this->theme($this->stemp)->display();
    }

    public function track_add_do() {
        $m = D('400_track_dictionary');
        if (!$m->create()) {
            echo "30001：保存数据错误！- " . $m->getError();
            exit;
        }
        $id = $m->add();
        if ($id) {
            echo 0;
        } else {
            echo "30002：保存数据错误！" . $m->getError();
        }
    }

    public function track_edit() {
        $id = I('get.id', 0, 'intval');
        $info = M('400_track_dictionary')->where(array('id' => $id))->find();
        $this->info = $info;
        $this->theme($this->stemp)->display();
    }

    public function track_edit_do() {
        $id = I('post.id');
        $post['type'] = I('post.type');
        $post['content'] = I('post.content');
        $m = D('400_track_dictionary');
        $res = $m->where(array('id' => $id))->save($post);
        if ($res) {
            echo 0;
        } else {
            echo "30002：保存数据错误！" . $m->getError();
        }
    }

    public function track_del_do() {
        $id = I('post.id');
        $m = D('400_track_dictionary');
        $reg = $m->delete($id);
        if ($reg) {
            echo 0;
        } else {
            echo "30002：保存数据错误！" . $m->getError();
        }
    }
/*
     * 地区管理
     * lizd11
     */

    public function area() {

        $this->theme($this->stemp)->display();
    }

    public function area_list() {
        $where = '';
        $list = M('400_area')->where($where)->order('id  desc')->select();
        if ($list) {

            $data['data'] = $list;
        } else {
            $data['data'] = array();
        }
        $this->ajaxReturn($data, 'JSON');
    }

    public function area_add() {
        $this->theme($this->stemp)->display();
    }

    public function area_add_do() {
        $m = D('400_area');
        if (!$m->create()) {
            echo "30001：保存数据错误！- " . $m->getError();
            exit;
        }
        $id = $m->add();
        if ($id) {
            echo 0;
        } else {
            echo "30002：保存数据错误！" . $m->getError();
        }
    }

    public function area_edit() {
        $id = I('get.id', 0, 'intval');
        $info = M('400_area')->where(array('id' => $id))->find();
        $this->info = $info;
        $this->theme($this->stemp)->display();
    }

    public function area_edit_do() {
        $id = I('post.id');
        $post['areaname'] = I('post.areaname');
        $m = D('400_area');
        $res = $m->where(array('id' => $id))->save($post);
        if ($res) {
            echo 0;
        } else {
            echo "30002：保存数据错误！" . $m->getError();
        }
    }

    public function area_del_do() {
        $id = I('post.id');
        $m = D('400_area');
        $reg = $m->delete($id);
        if ($reg) {
            echo 0;
        } else {
            echo "30002：保存数据错误！" . $m->getError();
        }
    }
    /*
     *  
     */
}
