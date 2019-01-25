<?php

namespace Admin\Controller;

//use Think\Controller;
use Admin\Common\CheckAdminController;

class UserController extends CheckAdminController {

    protected function _initialize() {
        $this->url = "user";
    }

    public function index() {

        $this->display();
    }

    /*
     * 获取贷款记录
     */

    public function user_list() {

        $where = "user_name <> 'admin'";
        $list = D('User')->result($where);
        if ($list) {
            
        } else {
            $list = array();
        }
        //print($row);
        $data['data'] = $list;
        $this->ajaxReturn($data, 'JSON');
    }

    /**
      +----------------------------------------------------------
     * 添加用户
      +----------------------------------------------------------
     */
    public function user_add() {
        $this->display();
    }

    /**
      +----------------------------------------------------------
     * 添加用户
      +----------------------------------------------------------
     */
    public function user_add_do() {
        $data = I('post.');
        $data['upwd'] = md5(I('post.upwd'));
        $D = D('User');
        $reg = $D->add($data); // save ,return id,  
        if ($reg) {
            // 提交PI 
            echo 0;
        } else {
            echo 101;
        }
    }

    /**
      +----------------------------------------------------------
     * 编辑用户
      +----------------------------------------------------------
     */
    public function user_edit() {
        $id = I('get.id');
        $D = D('User');
        $reg = $D->row('id = ' . $id); // save ,return id,   
        if ($reg) {
            $this->user = $reg;
            $this->display();
        } else {
            echo 101;
        }
    }

    /**
      +----------------------------------------------------------
     * 编辑用户
      +----------------------------------------------------------
     */
    public function user_edit_do() {
        $data = I('post.');
        $D = D('User');
        $reg = $D->update($data); // save ,return id,  
        if ($reg) {
            // 提交PI 
            echo 0;
        } else {
            echo 101;
        }
    }

    /**
      +----------------------------------------------------------
     * 删除用户
      +----------------------------------------------------------
     */
    public function user_del_do() {
        $data = I('post.id');
        $D = D('User');
        $reg = $D->del($data); // save ,return id,  
        if ($reg) {
            // 提交PI 
            echo 0;
        } else {
            echo 101;
        }
    }

    /**
      +----------------------------------------------------------
     * 编辑用户ps
      +----------------------------------------------------------
     */
    public function user_pass() {
        $id = I('get.id');
        $D = D('User');
        $reg = $D->row('id = ' . $id); // save ,return id,   
        if ($reg) {
            $this->user = $reg;
            $this->display();
        } else {
            echo 101;
        }
    }

    /**
      +----------------------------------------------------------
     * 编辑用户
      +----------------------------------------------------------
     */
    public function user_pass_do() {
        $data = I('post.');
        $data['upwd'] = md5(I('post.upwd')); 
        $D = D('User'); 
        $reg = $D->update($data); // save ,return id,  
        if ($reg) {
            // 提交PI 
            echo 0;
        } else {
            echo 101;
        }
    }

}
