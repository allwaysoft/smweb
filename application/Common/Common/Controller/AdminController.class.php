<?php

namespace Common\Common\Controller;

use Think\Model;

class AdminController extends BaseController {

    protected function _initialize() {
        parent::_initialize();
        set_time_limit(0);
        if (session('uid') == false) {
            $this->redirect('Admin/Index/index');
        }

        $admin = M('Admin')->where(array('id' => $_SESSION['uid']))->find();
        $this->thisAdmin = $admin;
//		if(!isset($_COOKIE['uid'])){
//			
//		}else{
//			
//			$admin=M('Admin')->where(array('id'=>$_COOKIE['uid']))->find();
//			$this->thisAdmin=$admin;
//		}
        if ($admin['role_id'] == 1) {
            $menu = M('Node')->where(array('pid' => 1))->order('sort asc,id asc')->select();
            foreach ($menu as $key => $value) {
                $menu_c = M('Node')->where(array('pid' => $value['id'],'display'=>1))->order('sort asc,id asc')->select();
                $menu[$key]['menu_c'] = $menu_c;
            }
        } else {
            $controller = CONTROLLER_NAME;
            $action = ACTION_NAME;
            if ($controller!='Main') {
	            $priv = M('Access')->where(array('roleid' => $admin['role_id'], 'controller' => $controller, 'action' => $action))->find();
	            if (!$priv) {
	                $this->error('对不起，您没有权限执行此操作');
	                exit();
	            }
            }
            
            $db = new Model();
            $menu = $db->table('tp_node a')->join('inner join tp_access b on a.id=b.nodeid and a.display=1 and a.pid=1 and b.roleid=' . $admin['role_id'])->field('a.*')->order('sort asc,id asc')->select();
            foreach ($menu as $key => $value) {
                $menu_c = $db->table('tp_node a')->join('inner join tp_access b on a.id=b.nodeid and a.display=1 and a.pid=' . $value['id'] . ' and b.roleid=' . $admin['role_id'])->field('a.*')->order('sort asc,id asc')->select();
                $menu[$key]['menu_c'] = $menu_c;
            }
        }
        $this->menu = $menu;
        //dump($menu[1]['menu_c']);
    }

}

?>