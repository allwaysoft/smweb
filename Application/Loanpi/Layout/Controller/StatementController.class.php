<?php

namespace Layout\Controller;

//use Think\Controller;
use Layout\Common\CheckUserController;

class StatementController extends CheckUserController {

    protected function _initialize() {
        parent::_initialize();
        $this->url = "Statement";
        //  
    }

    public function index() {

        $this->display();
        // $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>[ 您现在访问的是Layout模块的Index控制器 ]</div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
    }

    public function grid_list() {
        $time = time() - 15552000;
        $yb = date('Y-m-d', $time);
        $where = "add_time > '" . $yb . "'   and  agent_code= '" . $this->thisUser['user_name'] . "'  ";
        $list = D('Statement')->result($where);
        if ($list) {
            
        } else {
            $list = array();
        }
        // print($list);
        $data['data'] = $list;
        $this->ajaxReturn($data, 'JSON');
    }

    public function view() {
        $id = I('get.p');
        $where = "id = " . $id . "   and  agent_code= '" . $this->thisUser['user_name'] . "'  ";
        $list = D('Statement')->row($where);
        if ($list) {
            $list['agent_arar'] = number_format($list['agent_arar'], 2, '.', ',');
            $list['agent_arcr'] = number_format($list['agent_arcr'], 2, '.', ',');
            $list['agent_dkar'] = number_format($list['agent_dkar'], 2, '.', ',');
            $list['agent_dkcr'] = number_format($list['agent_dkcr'], 2, '.', ',');
            $list['agent_otap'] = number_format($list['agent_otap'], 2, '.', ',');
            $list['agent_otcr'] = number_format($list['agent_otcr'], 2, '.', ',');
            $this->data = $list;
            $this->display();
            $up['id'] = $id;
            $up['status'] = 1;
            D('Statement')->stUpdate($up);
        } else {
            echo "暂无信息！";
        }
    }

    /**
      +----------------------------------------------------------
     * 发起申请
      +----------------------------------------------------------
     */
    public function reg_add() {
        $this->sapLimit = $this->PI->get_limit($this->thisUser['user_name']); //获取额度
        $this->sapCycle = $this->PI->get_date($this->thisUser['user_name']); // 获取贷款天数
        $this->display('Register_add');
    }

    public function reg_add_do() {
        $data = I('post.');
        $D = D('Register');
        $data['reg_code'] = $this->thisUser['user_name'] . '-' . time();
        $data['dl_code'] = $this->thisUser['user_name'];
        $reg = $D->regAdd($data); // save ,return id,  
        if ($reg) {
            // 提交PI
            $uData['id'] = $reg;
            $retPi = $this->PI->to_register($data);
            if ($retPi['code'] == 0) {
                $uData['sap_code'] = $retPi['sap_code'];
                $regUp = $D->regUpdate($uData); // save ,return id, 
                echo 0;
            } else {
                echo 101;
            }
        } else {
            echo 101;
        }
    }

}
