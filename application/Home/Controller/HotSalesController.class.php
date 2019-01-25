<?php

namespace Home\Controller;

use Common\Common\Controller\UserController;
use Think\Model;

class HotSalesController extends UserController {

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
        $querySql = <<<EOD
    	select sa.*,po.price,po.catalog,ta.id as pcid from tp_hotsales sa left join tp_product po on sa.styleID = po.styleID left join tp_area ta on ta.areaname = sa.areaname 
EOD;
        $order = " order by sa.areaname asc, sa.rank asc";
        $condition = " where sa.gender='男'";
        $this->assign("gender", '男');
        $kind = M('hotsales')->distinct(true)->field('kind')->order('kind desc')->select();
        $this->assign("kind", $kind);
        if ($kind) {
            $kind_text = $kind[0]['kind'];
            $this->assign("kind_text", $kind_text);
            $condition .= " and sa.kind = '$kind_text' ";
        }
        $querySql .= $condition .= $order;
        $model = new Model();
        $datas = $model->query($querySql);
        $areaName = 'default';
        $updateDate = time();
        $count = 0;
        foreach ($datas as $k => $val) {
            $colorname = explode(',', $val['colorcode']);
            $colorname = $colorname[0];
            $pImg = "/index.php/Thumb/pimg/p/" . $val['catalog'] . "-" . $val['styleID'] . "-" . $colorname . "-160-200.html";
            $datas[$k]['pimg'] = $pImg;
            $thisArea = $val['areaname'];
            if ($k == 0) {
                $areaName = $thisArea;
                $datas[$k]['showarea'] = 'y';
                $count = 1;
                $updateDate = $val['createtime'];
                continue;
            }
            if ($areaName != $thisArea) {
                $datas[$k - 1]['turn'] = 'y';
                $datas[$k - 1]['count'] = $count % 5;
                $count = 1;
                $areaName = $thisArea;
                $datas[$k]['showarea'] = 'y';
            } else {
                $count++;
                if ($count % 5 == 0) {
                    $datas[$k]['turn'] = 'y';
                } else {
                    $datas[$k]['turn'] = 'n';
                }
            }
        }
        if (sizeof($datas) < 1) {
            $this->assign("nodata", 'y');
        }
        $this->assign("datas", $datas);
        $this->assign("updateDate", $updateDate);
        $sub_banner = M('subbanner')->where("id=2")->find();
        $background = $sub_banner['backgroundimg'];
        if ($background) {
            $isContain = strpos($background, "#");
            if ($isContain != 0) {
                $background = "url('$background')";
            }
        } else {
            $background = "#3F4D43";
        }
        $sub_banner['backgroundimg'] = $background;
        $this->assign("sub", $sub_banner);
        $this->display();
    }

    public function search() {
        $gender = $_GET['gender'];
        $kind_text = $_GET['kind_text'];
        $condition = " where 1=1 ";
        if ($gender && $gender != '无') {
            $condition .= " and sa.gender='$gender'";
            $this->assign("gender", $gender);
        }
        if ($kind_text && $kind_text != '无') {
            $condition .= " and sa.kind='$kind_text'";
            $this->assign("kind_text", $kind_text);
        }
        $order = " order by sa.areaname asc, sa.rank asc";
        $querySql = <<<EOD
    		select sa.*,po.price,po.catalog,ta.id as pcid from tp_hotsales sa left join tp_product po on sa.styleID = po.styleID left join tp_area ta on ta.areaname = sa.areaname 
EOD;
        $querySql .= $condition .= $order;
        $model = new Model();
        $datas = $model->query($querySql);
        $areaName = 'default';
        $updateDate = time();
        foreach ($datas as $k => $val) {
            $colorname = explode(',', $val['colorcode']);
            $colorname = $colorname[0];
            $pImg = "/index.php/Thumb/pimg/p/" . $val['catalog'] . "-" . $val['styleID'] . "-" . $colorname . "-160-200.html";
            $datas[$k]['pimg'] = $pImg;
            $thisArea = $val['areaname'];
            if ($k == 0) {
                $areaName = $thisArea;
                $datas[$k]['showarea'] = 'y';
                $count = 1;
                $updateDate = $val['createtime'];
                continue;
            }
            if ($areaName != $thisArea) {
                $datas[$k - 1]['turn'] = 'y';
                $datas[$k - 1]['count'] = $count % 5;
                $count = 1;
                $areaName = $thisArea;
                $datas[$k]['showarea'] = 'y';
            } else {
                $count++;
                if ($count % 5 == 0) {
                    $datas[$k]['turn'] = 'y';
                } else {
                    $datas[$k]['turn'] = 'n';
                }
            }
        }
        $this->assign("datas", $datas);
        $kind = M('hotsales')->distinct(true)->field('kind')->order('kind desc')->select();
        $this->assign("kind", $kind);
        $period = M('hotsales')->distinct(true)->field('period')->order('period asc')->select();
        $this->assign("updateDate", $updateDate);
        $this->display("index");
    }

    public function index_hana() {
        $querySql = <<<EOD
    	select sa.*,po.price,po.catalog,ta.id as pcid from tp_hotsales_hana sa left join tp_product po on sa.styleID = po.styleID left join tp_area ta on ta.areaname = sa.areaname 
EOD;
        $order = " order by sa.areaname asc, sa.rank asc";
        $condition = " where sa.gender='男'";
        $this->assign("gender", '男');
        $kind = M('hotsales_hana')->distinct(true)->field('kind')->order('kind desc')->select();
        $this->assign("kind", $kind);
        print_r($kind);
        if ($kind) {
            $kind_text = $kind[0]['kind'];
            $this->assign("kind_text", $kind_text);
            $condition .= " and sa.kind = '$kind_text' ";
        }
        $querySql .= $condition .= $order;
        echo $querySql;
        $model = new Model();
        $datas = $model->query($querySql);
        $areaName = 'default';
        $updateDate = time();
        $count = 0;
        var_dump($datas);
        foreach ($datas as $k => $val) {
            $colorname = explode(',', $val['colorcode']);
            $colorname = $colorname[0];
            $pImg = "/index.php/Thumb/pimg/p/" . $val['catalog'] . "-" . $val['styleID'] . "-" . $colorname . "-160-200.html";
            $datas[$k]['pimg'] = $pImg;
            $thisArea = $val['areaname'];
            if ($k == 0) {
                $areaName = $thisArea;
                $datas[$k]['showarea'] = 'y';
                $count = 1;
                $updateDate = $val['createtime'];
                continue;
            }
            if ($areaName != $thisArea) {
                $datas[$k - 1]['turn'] = 'y';
                $datas[$k - 1]['count'] = $count % 5;
                $count = 1;
                $areaName = $thisArea;
                $datas[$k]['showarea'] = 'y';
            } else {
                $count++;
                if ($count % 5 == 0) {
                    $datas[$k]['turn'] = 'y';
                } else {
                    $datas[$k]['turn'] = 'n';
                }
            }
        }
        if (sizeof($datas) < 1) {
            $this->assign("nodata", 'y');
        }
        $this->assign("datas", $datas);
        $this->assign("updateDate", $updateDate);
        $sub_banner = M('subbanner')->where("id=2")->find();
        $background = $sub_banner['backgroundimg'];
        if ($background) {
            $isContain = strpos($background, "#");
            if ($isContain != 0) {
                $background = "url('$background')";
            }
        } else {
            $background = "#3F4D43";
        }
        $sub_banner['backgroundimg'] = $background;
        $this->assign("sub", $sub_banner);
        $this->display();
    }

    public function search_hana() {
        $gender = $_GET['gender'];
        $kind_text = $_GET['kind_text'];
        $condition = " where 1=1 ";
        if ($gender && $gender != '无') {
            $condition .= " and sa.gender='$gender'";
            $this->assign("gender", $gender);
        }
        if ($kind_text && $kind_text != '无') {
            $condition .= " and sa.kind='$kind_text'";
            $this->assign("kind_text", $kind_text);
        }
        $order = " order by sa.areaname asc, sa.rank asc";
        $querySql = <<<EOD
    		select sa.*,po.price,po.catalog,ta.id as pcid from tp_hotsales_hana sa left join tp_product po on sa.styleID = po.styleID left join tp_area ta on ta.areaname = sa.areaname 
EOD;
        $querySql .= $condition .= $order;
        $model = new Model();
        $datas = $model->query($querySql);
        $areaName = 'default';
        $updateDate = time();
        foreach ($datas as $k => $val) {
            $colorname = explode(',', $val['colorcode']);
            $colorname = $colorname[0];
            $pImg = "/index.php/Thumb/pimg/p/" . $val['catalog'] . "-" . $val['styleID'] . "-" . $colorname . "-160-200.html";
            $datas[$k]['pimg'] = $pImg;
            $thisArea = $val['areaname'];
            if ($k == 0) {
                $areaName = $thisArea;
                $datas[$k]['showarea'] = 'y';
                $count = 1;
                $updateDate = $val['createtime'];
                continue;
            }
            if ($areaName != $thisArea) {
                $datas[$k - 1]['turn'] = 'y';
                $datas[$k - 1]['count'] = $count % 5;
                $count = 1;
                $areaName = $thisArea;
                $datas[$k]['showarea'] = 'y';
            } else {
                $count++;
                if ($count % 5 == 0) {
                    $datas[$k]['turn'] = 'y';
                } else {
                    $datas[$k]['turn'] = 'n';
                }
            }
        }
        $this->assign("datas", $datas);
        $kind = M('hotsales_hana')->distinct(true)->field('kind')->order('kind desc')->select();
        $this->assign("kind", $kind);
        $period = M('hotsales_hana')->distinct(true)->field('period')->order('period asc')->select();
        $this->assign("updateDate", $updateDate);
        $this->display("HotSales_index_hana");
    }

    public function info() {
        $pici = M('Area_pici')->where(array('areaname' => $this->area))->find();
        $pcID = $pici['id'];
        $styleID = I('get.styleID');
        $colorcode = I('get.colorcode');
        /* 判断传入参数是否匹配 */
        $this->pc = $pc;
        $db = M('Product');
        $info = $db->where(array('styleID' => $styleID))->find();
        if (!$info) {
            $this->error('该产品不存在');
        }
        $db->id = $info['id'];
        $db->click = $info['click'] + 1;
        $db->save();
        if (!empty($colorcode)) {
            $color = M('Color')->where(array('codename' => $colorcode))->find();
            $colorname = array($color);
            $colorcodes = explode(',', $info['colorcode']);
            foreach ($colorcodes as $val) {
                if ($val == $colorcode) {
                    continue;
                }
                $color = M('Color')->where(array('codename' => $val))->find();
                $colorname[] = array('name' => $color['name'], 'codename' => $color['codename']);
            }
        } else {
            $colorcode = explode(',', $info['colorcode']);
            $colorname = array();
            foreach ($colorcode as $val) {
                $color = M('Color')->where(array('codename' => $val))->find();
                $colorname[] = array('name' => $color['name'], 'codename' => $color['codename']);
            }
        }
        $info['colorname'] = $colorname;
        unset($info['colorcode']);
        $rule = explode(',', $info['rule']);
        $info['rule'] = $rule;
        $this->info = $info;
//     		/* 同批次 取8条记录 */
        $khlist = M('Quota')->where(array('pcID' => $pcID))->order('rand()')->select();
        $tklist = array();
        $j = 0;
        foreach ($khlist as $key => $value) {
            if ($j >= 8) {
                break;
            } else {
                $pinfo = $db->where(array('styleID' => $value['styleID']))->find();
                if ($pinfo) {
                    $colname = explode(',', $pinfo['colorcode']);

                    $tklist[] = array(
                        'pcID' => $pcID,
                        'id' => $pinfo['id'],
                        'styleID' => $value['styleID'],
                        'pname' => $pinfo['pname'],
                        'catalog' => $pinfo['catalog'],
                        'colorname' => $colname[0],
                    );
                    $j++;
                } else {
                    unset($khlist[$key]);
                }
            }
        }
        $this->tklist = $tklist;
        /* 评分 */
        $score = M('Score')->where(array('styleID' => $styleID, 'user_name' => session('user_name')))->find();
        $this->score = $score['score'] == null ? 0 : $score['score'];
        /* 赞 */
        $zan = M('Zan')->where(array('styleID' => $styleID, 'user_name' => session('user_name')))->find();
        $this->zan = $zan['is_zan'] == null ? 0 : $zan['is_zan'];
        /* 浏览记录 */
        $check_record = M('Check_record');
        //获取最新8条浏览记录
        $record = $check_record->where(array('user_name' => session('user_name')))->order('time desc')->select();
        $i = 0;
        foreach ($record as $key => $val) {
            if ($i >= 8) {
                break;
            } else {
                $is_prod = $db->where(array('styleID' => $val['styleID']))->find();
                if ($is_prod) {
                    $colorname = explode(',', $is_prod['colorcode']);
                    $record[$key]['catalog'] = $is_prod['catalog'];
                    $record[$key]['colorname'] = $colorname[0];
                    $record[$key]['pname'] = $is_prod['pname'];
                    $i++;
                } else {
                    unset($record[$key]);
                }
            }
        }
        $this->record = $record;
        $this->display();
    }

}

?>