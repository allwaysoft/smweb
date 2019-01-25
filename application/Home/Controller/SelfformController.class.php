<?php

namespace Home\Controller;

use Common\Common\Controller\UserController;

class SelfformController extends UserController {

    public function index() {

        $db_type = M('Selfform_type');
        $where['starttime'] = array('elt', time());
        $where['endtime'] = array('egt', time());
        if (isset($_GET['pid'])) {
            $where['type_id'] = $_GET['pid'];
            /* 选中分类信息 */
            $tinfo = $db_type->where(array('id' => $_GET['pid']))->find();
            $this->tinfo = $tinfo;
        }
        $db = M('Selfform');
        $count = $db->where($where)->count();
        $page = new \Think\Page($count, 15);
        $page->setConfig('prev', '上一页');
        $page->setConfig('next', '下一页');
        $page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $show = $page->show();
        $list = $db->where($where)->order('sort desc,id desc')->select();
        foreach ($list as $key => $val) {
            $list[$key]['image'] = str_replace('/', '_', $val['image']);
        }
        $this->list = $list;
        $this->page = $show;

        /* 问卷分类 */
        $typelist = $db_type->where(array('pid' => 0))->order('sort asc,id asc')->select();
        $this->typelist = $typelist;
        $this->display();
    }

    public function infos() {
        $nid = I('get.nid');
        if (!$nid) {
            $this->error('参数错误');
        }
        $db = M('Selfform');
        $tselfform = $db->find($nid);
        if (!ishave) {
            $this->error('该问卷不存在');
        }
        $this->tselfform = $tselfform;
        $list = M('Selfform_input')->where(array('formid' => $nid))->order('sort asc')->select();
        foreach ($list as $key => $val) {
            if ($val['inputtype'] == 'text') {
                $optionstr = "<input type='text' name='" . $val['fieldname'] . "'/>";
            } elseif ($val['inputtype'] == 'textarea') {
                $optionstr = "<textarea style='width:100%;height:99px;overflow-y:visible' name='" . $val['fieldname'] . "'></textarea>";
            } elseif ($val['inputtype'] == 'radio') {
                $options = explode('|', $val['options']);
                $optionstr = "<ul>";
                foreach ($options as $k => $v) {
                    $optionstr.="<li><input type='radio' value='" . $v . "' name='" . $val['fieldname'] . "'/>$v</li>";
                }
                $optionstr.="</ul>";
            } elseif ($val['inputtype'] == 'checkbox') {
                $options = explode('|', $val['options']);
                $optionstr = "<ul>";
                foreach ($options as $k => $v) {
                    $optionstr.="<li><input type='checkbox' value='" . $v . "' name='" . $val['fieldname'] . "[]'/>$v</li>";
                }
                $optionstr.="</ul>";
            }
            $list[$key]['optionstr'] = $optionstr;
        }
        $this->list = $list;
        $this->tselfform = $tselfform;
        $tinfo = M('Selfform_type')->find($tselfform['type_id']);
        $this->tinfo = $tinfo;
        $this->display();
    }

    public function refer() {
        $formid = $_POST['formid'];
        $list = M('Selfform_input')->where(array('formid' => $formid))->order('sort asc')->select();
        $fields = array();
        if ($list) {
            foreach ($list as $key => $val) {
                if ($val['inputtype'] == 'checkbox') {
                    $_POST[$val['fieldname']] = implode(',', $_POST[$val['fieldname']]);
                }
                $fields[$val['fieldname']] = $_POST[$val['fieldname']];
            }
        }
        $data['user_name'] = session('user_name');
        $data['formid'] = $formid;
        $data['values'] = serialize($fields);
        $data['time'] = time();
        $id = M('Selfform_values')->add($data);
        if ($id) {
            $this->success('提交成功', U('Selfform/index'));
        } else {
            $this->error('提交失败');
        }
    }

}

?>