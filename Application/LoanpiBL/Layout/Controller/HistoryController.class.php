<?php

namespace Layout\Controller;

//use Think\Controller;
use Layout\Common\CheckUserController;

class HistoryController extends CheckUserController {

    protected function _initialize() {
        parent::_initialize(); 
        $this->url = "History";
        // 初始化数据& 更新审批状态
            
    }
            
    public function index() {
            
        $this->display();
        // $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>[ 您现在访问的是Layout模块的Index控制器 ]</div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
    }

    public function reg_list() {
        $time = time() - 15552000;
        $yb = date('Y-m-d', $time);
        $where = "(reg_date < '" . $yb . "' or  regpayment_status = 3 ) and  dl_code= '" . $this->thisUser['user_name'] . "'  ";
        $list = D('Register')->result($where);
        if ($list) {
            for ($i = 0; $i < count($list); $i++) {
                // 获取状态描述
                $list[$i]['reg_status_msg'] = $this->get_status_msg($list[$i]);
            }
        } else {
            $list = array();
        }
        //print($row);
        $data['data'] = $list;
        $this->ajaxReturn($data, 'JSON');
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

   /**
      +----------------------------------------------------------
     * 功能：获取状态描述
      +----------------------------------------------------------
     */
    public function get_status_msg($data) {
      //  return $v; 
        switch ($data['reg_status']) {
            case 1:
                return '申请中';
            case 2:
                return '审批中';
            case 4:
                return '拒绝:' . $data['sap_msg'];
            case 5:
                return '已审批'; // . $row->sap_msg;
            case 6:
                return '部分还款';
            case 8:
                return '全部还款 ';
            default:
                return '审批中';
        }
    }

    /**
      +----------------------------------------------------------
     * 功能：计算两个日期相差 年 月 日 
      +----------------------------------------------------------
     * @param date   $date1 起始日期 
     * @param date   $date2 截止日期日期 
      +----------------------------------------------------------
     * @return array     
     *  demo :  $this->DiffDate($list[$i]['sap_start_time'], $list[$i]['sap_end_time'], 'd');   
      +----------------------------------------------------------
     */
    function DiffDate($date1, $date2, $t) {
        // 导入日期类
        $Date = new \Org\Util\Date($date1);
        return $Date->dateDiff($date2, $t);  // 比较日期差
    }

}
