<?php

namespace Admin\Controller;

//use Think\Controller;
use Admin\Common\CheckStaffController;

class StaffserController extends CheckStaffController {

    public function __construct() {
        parent::__construct();
        $this->arealist = M('400_area')->field('areaname')->select();
        define('RES', '/Tpl/Semir400');
         $this->stemp = 'Semir400/admin/staff';
    }

    public function index() {
        $this->theme($this->stemp)->display();
    }

    /*
     * 获取贷款记录
     */

    public function service() {
        $this->theme($this->stemp)->display();
    }

    public function get_list() {
        $data = I('get.');
        $reData = $this->service_result($data);
        $this->ajaxReturn($reData, 'JSON');
    }

   

    public function service_result($data) {
        $keyword = $data['keyword'];
        if ($keyword) {
            $where['agent_code'] = array('like', '%' . $keyword . '%');
            $where['agent_name'] = array('like', '%' . $keyword . '%');
            $where['agent_tel'] = array('like', '%' . $keyword . '%');
            $where['agent_person'] = array('like', '%' . $keyword . '%');
            $where['com_contents'] = array('like', '%' . $keyword . '%');
            $where['_logic'] = 'or';
            $map['_complex'] = $where;
        }
        $agent_area = $data['agent_area']; //I('get.agent_area');
        if ($agent_area) {
            $map['agent_area'] = array('eq', $agent_area);
        }
        $start_time = $data['start_time']; //I('get.start_time');
        if ($start_time) {
            $map['tp_400_service.add_time'] = array('gt', strtotime($start_time));
        }
        $end_time = $data['end_time']; // I('get.end_time');
        if ($end_time) {
            $map['tp_400_service.add_time'] = array('lt', strtotime($end_time));
        }
        $tra_type = $data['tra_type']; //I('get.tra_type');
        if ($tra_type) {
            $map['tp_400_service_track.tra_type'] = array('eq', $tra_type);
        }
        
        //$where = '';
        $mb = M('400_service');
        $list = $mb
                ->field('tp_400_service.*,tp_400_service_track.tra_type,tp_400_service_track.tra_contents')
                ->join('tp_400_service_track ON tp_400_service.com_code = tp_400_service_track.com_code ', 'LEFT')
                ->where($map)
                ->group('tp_400_service.id')
                ->order('com_status ASC,tp_400_service.add_time desc')
                ->select();
        //  echo $list;
        // $list = $mb->join($join)->where($map)->order('com_status ASC,add_time desc')->select(); 
        if ($list) {
            foreach ($list as $key => $val) {
                $list[$key]['add_time'] = date('Y-m-d H:i:s', $val['add_time']);

                if ($val['com_status'] == 1) {
                    $list[$key]['com_status'] = '新投诉';
                } elseif ($val['com_status'] == 2) {
                    $list[$key]['com_status'] = '处理中';
                } elseif ($val['com_status'] == 3) {
                    $list[$key]['com_status'] = '处理结束';
                      $traFq = M('400_service_track')->where(array('com_code' => $val['com_code'], 'tra_type' => 99))->find();
                    if ($traFq) {
                        $list[$key]['com_status'] = '废弃';
                    }
                }
				if($val['sale_type']==0){
					$list[$key]['sale_type']='未销售';
				}elseif($val['sale_type']==1){
					$list[$key]['sale_type']='已销售';
				}
                $tracklist = M('400_service_track')->where(array('com_code' => $val['com_code']))->order('add_time desc')->find();
                if ($tracklist) {
                    $val['tra_type'] = $tracklist['tra_type'];
                }
                if ($val['tra_type'] == 1) {
                    $list[$key]['tra_type'] = '拒接';
                } elseif ($val['tra_type'] == 2) {
                    $list[$key]['tra_type'] = '启动OA流程';
                } elseif ($val['tra_type'] == 3) {
                    $list[$key]['tra_type'] = '接收';
                }
                if ($val['com_time']) {
                    $list[$key]['com_time'] = date('Y-m-d H:i:s', $val['com_time']);
                }
                $list[$key]['agent_code'] = $list[$key]['agent_code'] . '/' . $list[$key]['agent_storename'];
                $list[$key]['agent_area'] = $list[$key]['agent_province'] . '/' . $list[$key]['agent_area'];
                $list[$key]['agent_person'] = $list[$key]['agent_person'] . '/' . $list[$key]['agent_tel'];
            }
            $data['data'] = $list;
        } else {
            $data['data'] = array();
        }
        return $data;
    }

    public function serviceinfo() {
        $id = I('get.id', 0, 'intval');
        $info = M('400_service')->where(array('id' => $id))->find();
        $this->info = $info;
        $tracklist = M('400_service_track')->where(array('com_code' => $info['com_code']))->order('id desc')->select();
        $this->tracklist = $tracklist;
        $this->dictionary = M('400_track_dictionary')->where(array('type' => 1))->select();
        $this->theme($this->stemp)->display();
    }

    public function quality() {
        $this->theme($this->stemp)->display();
    }

    public function quality_get_list() {
        $data = I('get.');
        $reData = $this->quality_result($data);
        $this->ajaxReturn($reData, 'JSON');
    }

    

    public function quality_result($data) {
        $keyword = $data['keyword'];
        if ($keyword) {
            $where['agent_code'] = array('like', '%' . $keyword . '%');
            $where['agent_name'] = array('like', '%' . $keyword . '%');
            $where['agent_tel'] = array('like', '%' . $keyword . '%');
            $where['agent_person'] = array('like', '%' . $keyword . '%');
            $where['com_contents'] = array('like', '%' . $keyword . '%');
            $where['style_id'] = array('like', '%' . $keyword . '%');
            $where['color_id'] = array('like', '%' . $keyword . '%');
            $where['_logic'] = 'or';
            $map['_complex'] = $where;
        }
        $com_type = $data['com_type']; //I('get.agent_area');
        if ($com_type) {
            $map['com_type'] = array('eq', $com_type);
        }
        $agent_area = $data['agent_area']; //I('get.agent_area');
        if ($agent_area) {
            $map['agent_area'] = array('eq', $agent_area);
        }
        $start_time = $data['start_time']; //I('get.start_time');
        if ($start_time) {
            $map['tp_400_quality.add_time'] = array('gt', strtotime($start_time));
        }
        $end_time = $data['end_time']; // I('get.end_time');
        if ($end_time) {
            $map['tp_400_quality.add_time'] = array('lt', strtotime($end_time));
        }
        $tra_type = $data['tra_type']; //I('get.tra_type');
        if ($tra_type) {
            $map['tp_400_quality_track.tra_type'] = array('eq', $tra_type);
        }
        // print_r($map);
        //$where = '';
        $mb = M('400_quality');
        $list = $mb
                ->field('tp_400_quality.*,tp_400_quality_track.tra_type,tp_400_quality_track.tra_contents,tp_400_quality_track.com_title,tp_400_quality_track.com_quarter,tp_400_quality_track.com_quarter')
                ->join('tp_400_quality_track ON tp_400_quality.com_code = tp_400_quality_track.com_code ', 'LEFT')
                ->where($map)
                ->group('tp_400_quality.id')
                ->order('com_status ASC,tp_400_quality.add_time desc')
                ->select();
        //  echo $list 
        // $list = $mb->join($join)->where($map)->order('com_status ASC,add_time desc')->select();
        if ($list) {
            foreach ($list as $key => $val) {
                $list[$key]['add_time'] = date('Y-m-d H:i:s', $val['add_time']);
                if ($val['com_type'] == 1) {
                    $list[$key]['com_type'] = '图片鉴定';
                } elseif ($val['com_type'] == 2) {
                    $list[$key]['com_type'] = '实物鉴定';
                }
                if ($val['com_deadline'] == 1) {
                    $list[$key]['com_deadline'] = '是';
                } elseif ($val['com_deadline'] == 2) {
                    $list[$key]['com_deadline'] = '否';
                }
                if ($val['sale_type'] == 1) {
                    $list[$key]['sale_type'] = '是';
                } else {
                    $list[$key]['sale_type'] = '否';
                }
                if ($val['com_status'] == 1) {
                    $list[$key]['com_status'] = '新投诉';
                } elseif ($val['com_status'] == 2) {
                    $list[$key]['com_status'] = '处理中';
                } elseif ($val['com_status'] == 3) {
                    $list[$key]['com_status'] = '处理结束';
                     $traFq = M('400_quality_track')->where(array('com_code' => $val['com_code'], 'tra_type' => 99))->find();
                    if ($traFq) {
                        $list[$key]['com_status'] = '废弃';
                    }
                }

                $tracklist = M('400_quality_track')->where(array('com_code' => $val['com_code']))->order('add_time desc')->find();
                if ($tracklist) {
                    $val['tra_type'] = $tracklist['tra_type'];
                    $list[$key]['com_title'] = $tracklist['com_title'];
                }
                if ($val['tra_type'] == 1) {
                    $list[$key]['tra_type'] = '拒绝';
                } elseif ($val['tra_type'] == 2) {
                    $list[$key]['tra_type'] = '启动OA流程';
                } elseif ($val['tra_type'] == 3) {
                    $list[$key]['tra_type'] = '图片鉴定';
                } elseif ($val['tra_type'] == 4) {
                    $list[$key]['tra_type'] = '实物鉴定';
                } elseif ($val['tra_type'] == 5) {
                    $list[$key]['tra_type'] = '接收';
                }
                if ($val['com_time']) {
                    $list[$key]['com_time'] = date('Y-m-d H:i:s', $val['com_time']);
                }
                $list[$key]['agent_code'] = $list[$key]['agent_code'] . '/' . $list[$key]['agent_storename'];
                $list[$key]['agent_area'] = $list[$key]['agent_province'] . '/' . $list[$key]['agent_area'];
                $list[$key]['agent_person'] = $list[$key]['agent_person'] . '/' . $list[$key]['agent_tel'];
            //    $list[$key]['style_id'] = $val['style_id'] . '/' . $val['color_id'] . '/' . $val['number'];

                // 字表数据
                $info = M('400_quality_track_oa')->where(array('com_code' => $val['com_code']))->find();
                if ($info) {
                    if ($val['oa_400'] == 1) {
                        $list[$key]['oa_400'] = '是 ';
                    } elseif ($val['oa_400'] == 2) {
                        $list[$key]['oa_400'] = '否';
                    }
                }
            }
            $data['data'] = $list;
        } else {
            $data['data'] = array();
        }
        return $data;
    }

    public function qualityinfo() {
        $id = I('get.id', 0, 'intval');
        $info = M('400_quality')->where(array('id' => $id))->find();
        if ($info['com_pic']) {
            $info['com_pic'] = explode(',', $info['com_pic']);
        }
        $this->info = $info;
        
        $tracklist = M('400_quality_track')->where(array('com_code' => $info['com_code']))->order('id desc')->select();
        $this->tracklist = $tracklist;
           $follow = M('400_quality_follow')->where(array('com_code' => $info['com_code']))->order('id desc')->select();
        foreach ($follow as $key => $val) {
            if ($val['fol_pic']) {
                $follow[$key]['fol_pic'] = explode(',', $val['fol_pic']);
            }
        }
        $this->follow = $follow;
        
        $this->dictionary = M('400_track_dictionary')->where(array('type' => 2))->select();
        $this->titles = M('400_complain_title')->select();
        $this->theme($this->stemp)->display();
    }

    public function terminal() {
        $this->theme($this->stemp)->display();
    }

    public function terminal_get_list() {
        $data = I('get.');
        $reData = $this->terminal_result($data);
        $this->ajaxReturn($reData, 'JSON');
    }
 

    public function terminal_result($data) {
        $keyword = $data['keyword'];
        if ($keyword) {
            $where['agent_code'] = array('like', '%' . $keyword . '%');
            $where['agent_name'] = array('like', '%' . $keyword . '%');
            $where['agent_tel'] = array('like', '%' . $keyword . '%');
            $where['agent_person'] = array('like', '%' . $keyword . '%');
            //$where['com_contents'] = array('like', '%' . $keyword . '%');
            $where['style_id'] = array('like', '%' . $keyword . '%');
            $where['color_id'] = array('like', '%' . $keyword . '%');
            $where['_logic'] = 'or';
            $map['_complex'] = $where;
        }
        $agent_area = $data['agent_area']; //I('get.agent_area');
        if ($agent_area) {
            $map['agent_area'] = array('eq', $agent_area);
        }
        $start_time = $data['start_time']; //I('get.start_time');
        if ($start_time) {
            $map['tp_400_terminal.add_time'] = array('gt', strtotime($start_time));
        }
        $end_time = $data['end_time']; // I('get.end_time');
        if ($end_time) {
            $map['tp_400_terminal.add_time'] = array('lt', strtotime($end_time));
        }
        $tra_type = $data['tra_type']; //I('get.tra_type');
        if ($tra_type) {
            $map['tp_400_terminal_track.tra_type'] = array('eq', $tra_type);
        }
        
        //$where = '';
        $mb = M('400_terminal');
        $list = $mb
                ->field('tp_400_terminal.*,tp_400_terminal_track.tra_type,tp_400_terminal_track.tra_contents')
                ->join('tp_400_terminal_track ON tp_400_terminal.com_code = tp_400_terminal_track.com_code ', 'LEFT')
                ->where($map)
                ->group('tp_400_terminal.id')
                ->order('com_status ASC,tp_400_terminal.add_time desc')
                ->select();
        //  echo $list 
        // $list = $mb->join($join)->where($map)->order('com_status ASC,add_time desc')->select(); 
        if ($list) {
            foreach ($list as $key => $val) {
                $list[$key]['add_time'] = date('Y-m-d H:i:s', $val['add_time']);

                if ($val['com_status'] == 1) {
                    $list[$key]['com_status'] = '新投诉';
                } elseif ($val['com_status'] == 2) {
                    $list[$key]['com_status'] = '处理中';
                } elseif ($val['com_status'] == 3) {
                    $list[$key]['com_status'] = '处理结束';
                      $traFq = M('400_terminal_track')->where(array('com_code' => $val['com_code'], 'tra_type' => 99))->find();
                    if ($traFq) {
                        $list[$key]['com_status'] = '废弃';
                    }
                }
                $tracklist = M('400_terminal_track')->where(array('com_code' => $val['com_code']))->order('add_time desc')->find();
                if ($tracklist) {
                    $val['tra_type'] = $tracklist['tra_type'];
                }
               
                if ($val['tra_type'] == 1) {
                    $list[$key]['tra_type'] = '拒绝';
                } elseif ($val['tra_type'] == 2) {
                    $list[$key]['tra_type'] = '启动OA流程';
                } elseif ($val['tra_type'] == 3) {
                    $list[$key]['tra_type'] = '接收';
                }
                if ($val['com_time']) {
                    $list[$key]['com_time'] = date('Y-m-d H:i:s', $val['com_time']);
                }
                $list[$key]['agent_code'] = $list[$key]['agent_code'] . '/' . $list[$key]['agent_storename'];
                $list[$key]['agent_area'] = $list[$key]['agent_province'] . '/' . $list[$key]['agent_area'];
                $list[$key]['agent_person'] = $list[$key]['agent_person'] . '/' . $list[$key]['agent_tel'];
                $list[$key]['style_id'] = $val['style_id'] . '/' . $val['color_id'] . '/' . $val['number'];
            }
            $data['data'] = $list;
        } else {
            $data['data'] = array();
        }
        return $data;
    }

    public function terminalinfo() {
        $id = I('get.id', 0, 'intval');
        $info = M('400_terminal')->where(array('id' => $id))->find();
        $this->info = $info;
        $tracklist = M('400_terminal_track')->where(array('com_code' => $info['com_code']))->order('id desc')->select();
        $this->tracklist = $tracklist;
        $this->dictionary = M('400_track_dictionary')->where(array('type' => 3))->select();
        $this->theme($this->stemp)->display();
    }

}
