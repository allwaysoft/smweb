<?php

namespace Index\Common;

class CheckUserController extends BaseController {

    protected function _initialize() {
        parent::_initialize();
        //$user=M('Localuser')->where(array('id'=>$_SESSION['userid']))->find();
        //$this->thisUser=$user;
        //  print_r($user);
        //  echo $_GET['pid'];
        // echo "sss=".$_SESSION['userid'];
        if (session('userid') == false) {
            header("Location:http://".$_SERVER["HTTP_HOST"]);
        }
        $user = M('Localuser')->where(array('id' => $_SESSION['userid']))->find();
        $this->thisUser = $user;
        if ($user['user_type'] > 0) {   // 0=代理商帐户
           // header("Content-type:text/html;charset=utf-8");
         //   echo "您无权访问此页面内容，请关闭窗口！";
          //  exit;
        }
    }

}

?>