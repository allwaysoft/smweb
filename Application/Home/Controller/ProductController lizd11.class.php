<?php

namespace Home\Controller;

use Common\Common\Controller\UserController;

class ProductController extends UserController {

    public function index() {
        $areaset = M('Areaset');
        $areasetinfo = $areaset->find();
        $thisuser = M('Localuser')->where(array('id' => $_SESSION['userid']))->find();
        switch ($areasetinfo['checkname']) {
            case 'province':
                $area = $thisuser['province'];
                break;
            case 'area1':
                $area = $thisuser['area1'];
                break;
            case 'area2':
                $area = $thisuser['area2'];
                break;
        }
        $this->area = $area;
        $pici = M('Area_pici')->where(array('areaname' => $area))->field('id,quotatime,title')->order('quotatime desc,time desc')->select();
            
        $this->pici = $pici;
        $where = "pici.areaname='$area' and pici.id=quota.pcID and quota.styleID=product.styleID";

        $this->pcid = isset($_GET['pcid']) ? $_GET['pcid'] : '0';
        if (isset($_GET['pcid'])) {
            if ($_GET['pcid'] != 0) {
                $where.=' and pici.id=' . $_GET['pcid'];
                $piciInfo = M('Area_pici')->where(array('id' => $_GET['pcid']))->field('id,quotatime,title')->find();  // lizd11
            }else{
               $piciInfo = ""; 
            }
        }
        /* 风格 */
        $typecodelist = M()->table(array('tp_area_pici' => 'pici', 'tp_quota' => 'quota', 'tp_product' => 'product'))->where($where)->group('typecode')->field('typecode')->select();
        $this->typecodelist = $typecodelist;
        /* 定位 */
        $positionlist = M()->table(array('tp_area_pici' => 'pici', 'tp_quota' => 'quota', 'tp_product' => 'product'))->where($where)->group('position')->field('position')->select();
        $this->positionlist = $positionlist;

        if (isset($_GET['condition'])) {
            $key = iconv("gb2312", "utf-8", $_REQUEST["condition"]);
            $condition = explode('-', $key);
            $order = $condition[0];
            if ($order != '0') {
                $order_c = $order;
            } else {
                $order_c = 'time desc';
            }
            $rule = $condition[1];
            if ($rule != '0') {
                $where.=' and(';
                $rule = explode(',', $rule);
                foreach ($rule as $val) {
                    $where.=' FIND_IN_SET("' . $val . '",product.rule) or';
                }
                $where = substr($where, 0, strlen($where) - 2);
                $where.=')';
                $this->rule = $rule;
            }
            $typecode = $condition[2];
            if ($typecode != '0') {
                $where.=' and(';
                $typecode = explode(',', $typecode);
                foreach ($typecode as $val) {
                    $where.=' FIND_IN_SET("' . $val . '",product.typecode) or';
                }
                $where = substr($where, 0, strlen($where) - 2);
                $where.=')';
                $this->typecode = $typecode;
            }

            $position = $condition[3];
            if ($position != '0') {
                $where.=' and(';
                $position = explode(',', $position);
                foreach ($position as $val) {
                    $where.=' FIND_IN_SET("' . $val . '",product.position) or';
                }
                $where = substr($where, 0, strlen($where) - 2);
                $where.=')';
                $this->position = $position;
            }
        }
        //print_r($where);
        $count = M()->table(array('tp_area_pici' => 'pici', 'tp_quota' => 'quota', 'tp_product' => 'product'))->where($where)->count();

        $page = new \Think\Page($count, 20);
        $page->setConfig('prev', '上一页');
        $page->setConfig('next', '下一页');
        $page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $show = $page->show();
        $list = M()->table(array('tp_area_pici' => 'pici', 'tp_quota' => 'quota', 'tp_product' => 'product'))->where($where)->order($order_c)->limit($page->firstRow . ',' . $page->listRows)->field('product.*')->select();
        foreach ($list as $key => $val) {
            $colorname = explode(',', $val['colorcode']);
            $list[$key]['colorname'] = $colorname[0];
        }
        // banner图
		$banner = M('Banner')->where('type_id = 4')->order('id desc')->find();
		$this->banner = $banner;
                
        // print_r($piciInfo);
        $this->piciInfo = $piciInfo;
        $this->list = $list;
        $this->page = $show;
        $this->display();
    }

    public function info() {
        $id = I('get.id', 0, 'intval');
        $db = M('Product');
        $info = $db->find($id);
        $db->click = $info['click'] + 1;
        $db->save();
        $colorcode = explode(',', $info['colorcode']);
        $colorname = array();
        foreach ($colorcode as $val) {
            $color = M('Color')->where(array('codename' => $val))->find();
            $colorname[] = array('name' => $color['name'], 'codename' => $color['codename']);
        }
        $info['colorname'] = $colorname;
        unset($info['colorcode']);
        $rule = explode(',', $info['rule']);
        $info['rule'] = $rule;
        $this->info = $info;
        $this->display();
    }

}

?>