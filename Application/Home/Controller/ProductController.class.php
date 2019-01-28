<?php

namespace Home\Controller;

use Common\Common\Controller\UserController;

class ProductController extends UserController {

    public $area;

    public function _initialize() {
        parent::_initialize();
        $areaset = M('Areaset');
        $areasetinfo = $areaset->find();
        $thisuser = M('Localuser')->where(array('id' => $_SESSION['userid']))->find();
        $area = $thisuser[$areasetinfo['checkname']];
        $this->area = $area;
        if ($area == '') {
            $this->redirect('Main/index');
        }
    }

    public function index() {

        $pici = M('Area_pici')->where(array('areaname' => $this->area))->field('id,quotatime,title')->order('quotatime desc,time desc')->select();
		//echo M()->_sql();
        $this->pici = $pici;
        $where = "pici.areaname='$this->area' and pici.id=quota.pcID and quota.styleID=product.styleID";
		#$where = "pici.areaname='$this->area' and pici.id=quota.pcID ";

        $this->pcid = isset($_GET['pcid']) ? $_GET['pcid'] : '0';
        if (isset($_GET['pcid'])) {
            if ($_GET['pcid'] != 0) {
                $where.=' and pici.id=' . $_GET['pcid'];
                $piciInfo = M('Area_pici')->where(array('id' => $_GET['pcid']))->field('id,quotatime,title')->find();  // lizd11
            } else {
                $piciInfo = "";
            }
        }
        /* 分类 */
        $typenamelist = M()->table(array('tp_area_pici' => 'pici', 'tp_quota' => 'quota', 'tp_product' => 'product'))->where($where)->group('typename')->field('typename')->select();
        $this->typenamelist = $typenamelist;
        /* 风格 */
        $typecodelist = M()->table(array('tp_area_pici' => 'pici', 'tp_quota' => 'quota', 'tp_product' => 'product'))->where($where)->group('typecode')->field('typecode')->select();
        $this->typecodelist = $typecodelist;
        /* 定位 */
        $positionlist = M()->table(array('tp_area_pici' => 'pici', 'tp_quota' => 'quota', 'tp_product' => 'product'))->where($where)->group('position')->field('position')->select();
        $this->positionlist = $positionlist;
        $order_c = 'pici.id desc';
        if (isset($_GET['condition'])) {
            //$key = iconv("gb2312", "utf-8", $_REQUEST["condition"]);
            $condition = explode('-', $_GET['condition']);
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
            $typename = $condition[4];
            if ($typename != '0') {
                $where.=' and(';
                $typename = explode(',', $typename);
                foreach ($typename as $val) {
                    $where.=' FIND_IN_SET("' . $val . '",product.typename) or';
                }
                $where = substr($where, 0, strlen($where) - 2);
                $where.=')';
                $this->typename = $typename;
            }
        }
        $count = M()->table(array('tp_area_pici' => 'pici', 'tp_quota' => 'quota', 'tp_product' => 'product'))->where($where)->count();

        $page = new \Think\Page($count, 40);
        $page->setConfig('prev', '上一页');
        $page->setConfig('next', '下一页');
        $page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $show = $page->show();
        $list = M()->table(array('tp_area_pici' => 'pici', 'tp_quota' => 'quota', 'tp_product' => 'product'))->where($where)->order($order_c)->limit($page->firstRow . ',' . $page->listRows)->field('product.*,quota.pcID')->select();
        foreach ($list as $key => $val) {
            $colorname = explode(',', $val['colorcode']);
            $list[$key]['colorname'] = $colorname[0];
            //get img
            // $pImg = $this->getImg($list[$key]['catalog'], $list[$key]['styleID'], $list[$key]['colorname'], 'M', '');
            $list[$key]['pimg'] = $pImg;
        }

        // banner图
        $banner = M('Banner')->where('type_id = 4')->order('id desc')->find();
        $this->banner = $banner;

        //  print_r($list);
        $this->piciInfo = $piciInfo;
        $this->list = $list;
        $this->page = $show;
        $this->display();
    }

    public function info() {
        $pcID = I('get.pcID');
        $styleID = I('get.styleID');
        /* 判断传入参数是否匹配 */
        //批次
        $pc = M('Area_pici')->where(array('areaname' => $this->area))->find($pcID);
        //配额
        $quota = M('Quota')->where(array('pcID' => $pcID, 'styleID' => $styleID))->find();
        if ($pc && $quota) {
            $this->pc = $pc;
            $db = M('Product');
            $info = $db->where(array('styleID' => $styleID))->find();
            if (!$info) {
                $this->error('该产品不存在');
            }
            $db->id = $info['id'];
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
            /* 同批次 取8条记录 */
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
            //新增浏览记录
            $record = $check_record->where(array('user_name' => session('user_name'), 'styleID' => $styleID, 'pcID' => $pcID))->find();
            $check_record->user_name = session('user_name');
            $check_record->styleID = $styleID;
            $check_record->pcID = $pcID;
            $check_record->time = time();
            if ($record) {
                //更新时间
                $check_record->save();
            } else {
                $check_record->add(); //新增记录
            }
            $this->display();
        } else {
            $this->error('参数错误');
        }
    }

    public function ucShow() {
        $styleID = I('get.styleID');
        if ($styleID) {
            $db = M('Product');
            $info = $db->where(array('styleID' => $styleID))->find();
            if (!$info) {
                $this->error('该产品不存在');
            }
            $db->id = $info['id'];
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
            /* 同批次 取8条记录 */
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
            //新增浏览记录
            $record = $check_record->where(array('user_name' => session('user_name'), 'styleID' => $styleID, 'pcID' => $pcID))->find();
            $check_record->user_name = session('user_name');
            $check_record->styleID = $styleID;
            $check_record->pcID = $pcID;
            $check_record->time = time();
            if ($record) {
                //更新时间
                $check_record->save();
            } else {
                $check_record->add(); //新增记录
            }
            $this->display();
        } else {
            $this->error('参数错误');
        }
    }

    public function p_score() {
        $score = $_POST['score'];
        $styleID = $_POST['styleID'];
        $db = M('Score');
        $db->styleID = $styleID;
        $db->score = $score;
        $db->user_name = session('user_name');
        $db->time = time();
        $id = $db->add();
    }

    public function p_zan() {
        $styleID = $_POST['styleID'];
        $db = M('Zan');
        $db->styleID = $styleID;
        $db->is_zan = 1;
        $db->user_name = session('user_name');
        $db->time = time();
        $id = $db->add();
        if ($id) {
            $db_prod = M('Product');
            $data['zan'] = array('exp', 'zan+1');
            $db_prod->where(array('styleID' => $styleID))->save($data);
            $zan = $db_prod->where(array('styleID' => $styleID))->find();
            echo $zan['zan'];
        } else {
            echo '失败';
        }
    }

    public function getImg($atalog, $styleID, $colorname, $type, $colorNumber) {

//读取图片文件，转换成base64编码格式
        $image_file = "./Upload/$atalog/$type_$styleID-$colorname.jpg";
        if (file_exists($image_file)) {
            $image_info = getimagesize($image_file);
            $base64_image_content = "data:{$image_info['mime']};base64," . chunk_split(base64_encode(file_get_contents($image_file)));
            return $base64_image_content;
            exit;
        } else {
            return '/Public/home/images/nopic.jpg';
            return FALSE;
        }
    }

    public function tImg() {
        require_once './phpthumb/ThumbLib.inc.php';
        $p = $_GET['p'];
        $key = explode('-', $p);
        echo $p;
        $key = explode('-', $p);
        $w = $key[3];
        $h = $key[4];
        $img = './Upload/' . $key[0] . '/' . 'M_' . $key[1] . '-' . $key[2] . '.jpg';
        $thumb = PhpThumbFactory::create($img);
        $thumb->adaptiveResize($w, $h);
        $thumb->show();
    }

}

?>