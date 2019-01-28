<?php

namespace Admin\Model;

use Think\Model;

class RepaymentModel extends Model {

    protected $tableName = 'loan_repayment';

    protected function _initialize() {
        parent::_initialize();
        $this->table = M("loan_repayment");
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

}

?>