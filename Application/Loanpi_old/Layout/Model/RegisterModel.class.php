<?php

namespace Layout\Model;

use Think\Model;

class RegisterModel extends Model {

    protected $tableName = 'loan_register';
    protected $insertFields = array('reg_code','reg_amount', 'reg_cycle', 'reg_date');
   // protected $updateFields = array('nickname', 'email');
    //验证规则
    // 第四个参数： 0：存在字段就验证（默认） 1：必须验证 2：值不为空的时候验证    
    // 第六个参数： 规则什么时候生效： 1：添加时生效 2：修改时生效 3：所有情况都生效
    protected $_validate = array(
        array('reg_amount', 'require', 'amount', 1),
        array('reg_cycle', 'require', 'reg_cycle', 1),
        array('reg_date', 'require', '日期不能为空', 1, '', 1) 
    );

    protected function _initialize() {
        parent::_initialize();
        $this->register = M("loan_register");
        
    }

//获取所有记录list
    public function result($where) {
        $res = $this->register->where($where)->select();
        if ($res) {
            return $res;
        } else {
            return $this->register->getError();
        }
    }

//获取记录
    public function row($where) {
        $res = $this->register->where($where)->find();
        if ($res) {
            return $res;
        } else {
            return $this->register->getError();
        }
    }

//添加纪录
    public function regAdd($data) {  
        if ($this->register->create($data)) { 
            $this->register->reg_date = date("Y-m-d H:i:s");
            $reg = $this->register->add();
            if ($reg) {
                return $reg;
            } else {
                return $this->register->getError();
            }
        } else {
            // 验证通过 可以进行其他数据操作
            return($this->register->getError());
        }
    }

//编辑纪录纪录
    public function regUpdate($data) {
        $reg = $this->register->save($data);
       // var_dump($reg);
        if ($reg) {
            return $reg;
        } else {
            return $this->register->getError();
        }
    }

//DEMO 实现 分页 
    public function category() {
        $where = array();

        //编辑信息页面获取到的id
        I('get.id') && $where = array('id' => array('eq', I('get.id/d')));

        $count = $this->where($where)->count(); // 查询满足要求的总记录数
        $Page = new \Think\Page($count, 10); // 实例化分页类 传入总记录数和每页显示的记录数
        //设置
        $Page->setConfig('first', '首页');
        $Page->setConfig('last', '尾页');
        $Page->setConfig('next', '下一页');
        $Page->setConfig('prev', '上一页');

        $page = $Page->show(); // 分页显示输出    
        $limit = $Page->firstRow . ',' . $Page->listRows;

        $res = $this->where($where)
                ->order('id asc')
                ->limit($limit)
                ->select();

        return array(
            'page' => $page,
            'res' => $res
        );
    }

}

?>