<?php

namespace Admin\Controller;

//use Think\Controller;
use Admin\Common\CheckStaffController;

class StaffController extends CheckStaffController {

    public function __construct() {
        parent::__construct();
        define('RES', '/Tpl/Semir400');
        $this->stemp = 'Semir400/admin/staff';
        $this->Tooa = D('Tooa', 'Service');
    }

    public function service() {
        $this->theme($this->stemp)->display();
    }

    public function get_list() {
        $source = I('get.source');
        $where = array(
            '_string' =>"(com_status=1 and com_user is null) or (com_status = 2 and com_user ='".  $_SESSION['staffinfo']['user_name']."')",
//             'com_user' => $_SESSION['staffinfo']['user_name'],
//             '_logic' => 'or',
        );
        $list = M('400_' . $source)->where($where)->order('com_status ASC,add_time desc')->select();
        if ($list) {
            foreach ($list as $key => $val) {
                $list[$key]['add_time'] = date('Y-m-d H:i:s', $val['add_time']);
                if ($val['com_status'] == 1) {
                    $list[$key]['com_status'] = '新投诉';
                } elseif ($val['com_status'] == 2) {
                    $list[$key]['com_status'] = '处理中';
                } elseif ($val['com_status'] == 3) {
                    $list[$key]['com_status'] = '处理结束';
                    $traFq = M('400_' . $source.'_track')->where(array('com_code' => $val['com_code'], 'tra_type' => 99))->find();
                    if ($traFq) {
                        $list[$key]['com_status'] = '废弃';
                    }
                }
				
				if($val['sale_type']==0){
					$list[$key]['sale_type']='未销售';
				}elseif($val['sale_type']==1){
					$list[$key]['sale_type']='已销售';
				}

                $list[$key]['view_status'] = 0;
                // 客服是否阅读 
                if ($source == 'quality') {
                    $follow = M('400_quality_follow')->where(array('com_code' => $val['com_code'], 'view_status' => 1))->find();
                    $list[$key]['view_status'] = $follow['view_status'];
                    if ($follow['view_status'] != 1) {
                        $oa = M('400_quality_track_oa')->where(array('com_code' => $val['com_code'], 'view_status' => 1))->find();
                        $list[$key]['view_status'] = $oa['view_status'];
                    }
                }
                // 客服是否阅读
                if ($source == 'service') {
                    $oa = M('400_service_track_oa')->where(array('com_code' => $val['com_code'], 'view_status' => 1))->find();
                    $list[$key]['view_status'] = $oa['view_status'];
                }


                $list[$key]['agent_code'] =  $list[$key]['agent_storename'];//$list[$key]['agent_code'] . ' / ' .
                $list[$key]['agent_area'] =  $list[$key]['agent_area'];//$list[$key]['agent_name'] . '<br> ' . $list[$key]['agent_province'] . ' / ' .
                $list[$key]['agent_person'] = $list[$key]['agent_person'] . ' / ' . $list[$key]['agent_tel'];
                $list[$key]['style_id'] = $val['style_id'] ; // . '/' . $val['number'];. ' / ' . $val['color_id']
            }
            $data['data'] = $list;
        } else {
            $data['data'] = array();
        }
        $this->ajaxReturn($data, 'JSON');
    }

    public function serviceinfo() {
        $id = I('get.id', 0, 'intval');
        $info = M('400_service')->where(array('id' => $id))->find();
        $this->info = $info;
        $tracklist = M('400_service_track')->where(array('com_code' => $info['com_code']))->order('id desc')->select();
        foreach ($tracklist as $i => $val) {
            if ($val['tra_type'] == 2) {
                $tra_oa = M('400_service_track_oa')->where(array('tra_id' => $val['id']))->find();
                $val['tra_oa'] = $tra_oa;
            } else {
                $val['aaa'] = '';
            }
            $data[] = $val;
        }

        $this->tracklist = $data;
        $this->dictionary = M('400_track_dictionary')->where(array('type' => 1))->select();

        // 保存阅读
        M('400_service_track_oa')->where(array('com_code' => $info['com_code'], 'view_status' => 1))->setField('view_status', 2);


        $this->theme($this->stemp)->display();
    }

    public function quality() {
        $this->theme($this->stemp)->display();
    }

    public function qualityinfo() {
        $id = I('get.id', 0, 'intval');
        $info = M('400_quality')->where(array('id' => $id))->find();
        if ($info['com_pic']) {
            $info['com_pic'] = explode(',', $info['com_pic']);
        }
        $this->info = $info;
        $tracklist = M('400_quality_track')->where(array('com_code' => $info['com_code']))->order('id desc')->select();
        foreach ($tracklist as $i => $val) {
            if ($val['tra_type'] == 2) {
                $tra_oa = M('400_quality_track_oa')->where(array('tra_id' => $val['id']))->find();
                $val['tra_oa'] = $tra_oa;
            } else {
                $val['aaa'] = '';
            }
            $data[] = $val;
        }

        $this->tracklist = $data;
        //$this->tracklist = $tracklist;
        $follow = M('400_quality_follow')->where(array('com_code' => $info['com_code']))->order('id desc')->select();
        foreach ($follow as $key => $val) {
            if ($val['fol_pic']) {
                $follow[$key]['fol_pic'] = explode(',', $val['fol_pic']);
            }
        }
        $this->follow = $follow;
        $this->dictionary = M('400_track_dictionary')->where(array('type' => 2))->select();
        $this->titles = M('400_complain_title')->select();
        // 保存阅读
        M('400_quality_follow')->where(array('com_code' => $info['com_code'], 'view_status' => 1))->setField('view_status', 2);
        M('400_quality_track_oa')->where(array('com_code' => $info['com_code'], 'view_status' => 1))->setField('view_status', 2);

        $this->theme($this->stemp)->display();
    }

    public function terminal() {
        $this->theme($this->stemp)->display();
    }

    public function terminalinfo() {
        $id = I('get.id', 0, 'intval');
        $info = M('400_terminal')->where(array('id' => $id))->find();
        $this->info = $info;
        $tracklist = M('400_terminal_track')->where(array('com_code' => $info['com_code']))->order('id desc')->select();
        foreach ($tracklist as $key => $val) {
            if ($val['tra_type'] == 2) {
                $tra_oa = M('400_terminal_track_oa')->where(array('tra_id' => $val['id']))->find();
                $val[$key]['tra_oa'] = $tra_oa;
            }
        }
        //  print_r($tracklist);
        $this->tracklist = $tracklist;
        $this->dictionary = M('400_track_dictionary')->where(array('type' => 3))->select();


        $this->theme($this->stemp)->display();
    }

    public function reply() {
        $type = I('get.type');
        $tra_type = I('post.tra_type');
        #$tra_type service quality  terminal
        $_POST['com_user'] = $_SESSION['staffinfo']['user_name'];
        $_POST['add_time'] = time();
        $table = D('400_' . $type . '_track');
        if (!$table->create()) {
            $data = array(
                'info' => $table->getError(),
                'status' => false
            );
        } else {
            $id = $table->add(); /// 保存到表
            if ($id) {
                if ($tra_type == 2  || ($tra_type == 5 && $type == 'quality')) {
					if($tra_type == 5 && $type == 'quality'){
						$data2 = array(
                            'com_status' => 3
                        );
                        M('400_' . $type)->where(array('com_code' => I('post.com_code')))->save($data2);
						$com_code = I('post.com_code');
						$contents = array(
							'parameter' => $data2,
							'sql' => M()->_sql()
						);
						$this->addlog($com_code, $contents);
					}
                    //启动OA///////////////////////////////////////////////////
                    $tra_id = $id;
                    $com_code = I('post.com_code');
                    $updata['oa_remark'] = I('post.oa_remark');
                    $reDate = $this->send_oa($type, $tra_id, $com_code, $updata['oa_remark']);
                    //保存到track OA表   ///////////////////////////
                    $updata['add_time'] = time();
                    $updata['com_code'] = $com_code;
                    $updata['tra_id'] = $tra_id;
                    $updata['view_status'] = 2;
                    if ($reDate->rtnStatus == 1) {
                        $updata['oa_status'] = 1;
                        $updata['oa_number'] = $reDate->flowNo;
                    } else {
                        $updata['oa_status'] = 2;
                    }
                    $table = D('400_' . $type . '_track_oa');
                    D('400_' . $type . '_track_oa')->data($updata)->add();
                    //保存到track OA表   ///////////////////////////
                    //添加操作日志
                    $com_code = I('post.com_code');
                    $contents = array(
                        'info' => '启动OA',
                        'sql' => ''
                    );
                    $this->addlog($com_code, $contents);
                    $data = array(
                        'info' => '操作成功',
                        'status' => true
                    );
                } else {
                    if ($tra_type == 1 || ($tra_type == 3 && ($type == 'service' || $type == 'terminal'))) {
                        $data2 = array(
                            'com_status' => 3
                        );
                        M('400_' . $type)->where(array('com_code' => I('post.com_code')))->save($data2);
                    }
                    if ($tra_type == 99) {
                        $data2 = array(
                            'com_status' => 3
                        );
                        M('400_' . $type)->where(array('com_code' => I('post.com_code')))->save($data2);
                    }
                    $com_code = I('post.com_code');
                    $contents = array(
                        'parameter' => $data2,
                        'sql' => M()->_sql()
                    );
                    $this->addlog($com_code, $contents);
                    $data = array(
                        'info' => '回复成功',
                        'status' => true
                    );
                }
            } else {
                $data = array(
                    'info' => '回复失败',
                    'status' => false
                );
            }
        }
        $this->ajaxReturn($data, 'json');
    }

    public function attend() {
        $id = I('post.id', 0, 'intval');
        $source = I('post.source');
        $info = M('400_' . $source)->where(array('id' => $id))->find();
        if (!$info) {
            $data['info'] = '该投诉不存在';
            $data['status'] = false;
        } else {
            if ($info['com_user'] && $info['com_status'] != 1) {
                $data['info'] = '该投诉已被受理';
                $data['status'] = false;
            } else {
                $data = array(
                    'com_status' => 2,
                    'com_user' => $_SESSION['staffinfo']['user_name'],
                    'com_time' => time()
                );
                $isbool = M('400_' . $source)->where(array('id' => $id))
                        ->save($data);
                if ($isbool) {
                    $com_code = $info['com_code'];
                    $contents = array(
                        'parameter' => $data,
                        'sql' => M()->_sql()
                    );
                    $this->addlog($com_code, $contents);
                    $data['info'] = '受理成功';
                    $data['status'] = true;
                } else {
                    $data['info'] = '系统故障，请重试';
                    $data['status'] = false;
                }
            }
        }

        $this->ajaxReturn($data, 'json');
    }

    public function addlog($com_code, $contents) {
        $data = array(
            'user_name' => $_SESSION['staffinfo']['user_name'],
            'com_code' => $com_code,
            'contents' => serialize($contents),
            'create_time' => time()
        );
        M('400_user_staff_log')->add($data);
    }

    /*
     * send oa ,run API
     */

    function send_oa_agin() {
        //启动OA///////////////////////////////////////////////////
        $tra_id = $id;
        $com_code = I('post.com_code');
        $updata['oa_remark'] = I('post.oa_remark');
        ;
        $this->send_oa($type, $tra_id, $com_code, $updata['oa_remark']);
    }

    /*
     * send oa ,run API
     */

    function send_oa($type, $tra_id, $com_code, $oa_remark) {
        $info = M('400_' . $type)->where(array('com_code' => $com_code))->find();
        if ($type == 'service') {
            $info['type'] = "服务投诉";
            $info['com_type'] = '';
            $info['oa_remark'] = $oa_remark;
            $info['com_title'] = ''; // 质量投诉主题
            $info['com_quarter'] = ''; // 质量投诉季度
            $info['com_deadline'] = '';
            $info['style_id'] = '';
            $info['color_id'] = '';
            $info['number'] = '';
            $info['sale_type'] = '';
            $info['com_pic'] = '';
            $info['com_express'] = '';
            $info['com_express_number'] = '';
            $info['com_express_address'] = '';
            $info['sale_time'] = '';
        } elseif ($type == 'quality') {
            $info['type'] = "质量投诉";
            $info['oa_remark'] = $oa_remark;
            ///
            $track = M('400_quality_track')->where(array('id' => $tra_id))->find();
            $info['com_title'] = $track['com_title']; // 质量投诉主题
            $info['com_quarter'] = $track['com_quarter']; // 质量投诉季度
            $info['com_dept'] = $track['com_dept']; // 审批部门
            if ($info['sale_type'] == 1) {  // 销售类型  0 未销售  1已销售
                $info['sale_type'] = '已销售';
            } else {
                $info['sale_type'] = '未销售';
            }
            if ($track['com_deadline'] == 1) {  // 质量保质期内 ：1 是  2 否  
                $info['com_deadline'] = '是';
            } else {
                $info['com_deadline'] = '否';
            }
//            if ($follow) {
//                $info['com_type'] = $follow['com_type'];
//                $info['com_express'] = $follow['fol_express'];
//                $info['com_express_number'] = $follow['fol_express_number'];
//                $info['com_express_address'] = $follow['fol_express_address'];
//                if ($info['com_type'] == 1) {
//                    $info['com_pic'] = $follow['fol_pic'];
//                }
//            }
            ///
            $follow = M('400_quality_follow')->where(array('com_code' => $info['com_code']))->order('id desc')->find();
            if ($follow) {
                $info['com_type'] = $follow['com_type'];
                $info['com_express'] = $follow['fol_express'];
                $info['com_express_number'] = $follow['fol_express_number'];
                $info['com_express_address'] = $follow['fol_express_address'];
                if ($info['com_type'] == 1) {
                    $info['com_pic'] = $follow['fol_pic'];
                }
            }
            if ($info['com_type'] == 1) { // 图片鉴定
                if ($info['com_pic']) {
                    $picArray = explode(',', $info['com_pic']);
                    $picUrl = array();
                    for ($i = 0; $i < count($picArray); $i++) {
                        $picUrl[] = "<a href=http://w.semir.cn" . $picArray[$i] . " target=_blank>" . $picArray[$i] . "</a>";
                    }

                    $info['com_pic'] = implode('<br>', $picUrl);
                }
                $info['com_pic'] = "<a href=http://w.semir.cn//semir400.php/sales/info/si/" . $info['id'] . " target=_blank>点击查看本投诉的图片列表</a>";
                $info['com_type_msg'] = '图片鉴定';
            } else {
                $info['com_pic'] = '';
                $info['com_type_msg'] = '实物鉴定';
            }
        }
        // print_r($info);
        /// exit;
        $reApi = $this->Tooa->Sw400_toOA($info);

        return json_decode($reApi->return);
    }

    ////
    //soap test
    ///
    function soaptest() {
        $this->send_oa('service', '1', 'F20161219001');
    }

}

?>