<?php

namespace Layout\Model;

use Think\Model;

class RepaymentModel extends Model {

    protected $tableName = 'loan_repayment';

    //验证规则
    // 第四个参数： 0：存在字段就验证（默认） 1：必须验证 2：值不为空的时候验证    
    // 第六个参数： 规则什么时候生效： 1：添加时生效 2：修改时生效 3：所有情况都生效


    protected function _initialize() {
        parent::_initialize();
        $this->table = M("loan_repayment");
    }

    //插入之前
//    protected function _before_insert(&$data, $option) {
//        $data['reg_date'] = time();
//    }
//
//    //插入之后
//    protected function _after_insert($data, $option) {
//        $res = I('post.');
//        $res['id'] = $data['id'];
//        $res && M('loan_register')->add($res);
//    }
// 
    public function createCheck($data) {
        if ($this->table->create($data)) {
            return TRUE;
        } else {
            // 验证通过 可以进行其他数据操作
            return FALSE;
        }
    }

//获取所有记录
    public function result($where) {
        $res = $this->table->where($where)->select();
        return $res;
    }

//获取还款总金额
    public function total($where) {
        $res = $this->table->where($where)->sum('rep_amount');
        if ($res) {
            return $res;
        } else {
            return $this->table->getError();
        }
    }

//添加纪录
    public function repAdd($data) {
        if ($this->table->create($data)) {
            $reg = $this->table->add();
            if ($reg) {
                return $reg;
            } else {
                return $this->table->getError();
            }
        } else {
            // 验证通过 可以进行其他数据操作
            return($this->table->getError());
        }
        /*         * */
    }

//编辑纪录纪录
    public function update($data) {
        $reg = $this->table->save($data);
        if ($reg) {
            return $reg;
        } else {
            return $this->table->getError();
        }
    }

}

?>