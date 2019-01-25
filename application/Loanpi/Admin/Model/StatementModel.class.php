<?php

namespace Admin\Model;

use Think\Model;

class StatementModel extends Model {

    protected $tableName = 'loan_statement';

    protected function _initialize() {
        parent::_initialize();
        $this->table = M("loan_statement");
        $this->table_log = M("loan_statement_log");
    }

//获取所有记录list
    public function result($where) {
        $res = $this->table->where($where)->select();
        if ($res) {
            return $res;
        } else {
            return $this->table->getError();
        }
    }

//添加纪录
    public function stAdd($data) {

        $data['add_time'] = date("Y-m-d H:i:s");
        $reg = $this->table->add($data);
        if ($reg) {
            return $reg;
        } else {
            return $this->table->getError();
        }
    }

//获取记录
    public function row($where) {
        $res = $this->table->where($where)->find();
        if ($res) {
            return $res;
        } else {
            return $this->table->getError();
        }
    }

    //获取log所有记录list
    public function log_result($where) {
        $res = $this->table_log->where($where)->select();
        if ($res) {
            return $res;
        } else {
            return $this->table_log->getError();
        }
    }

//获取log记录
    public function log_row($where) {
        $res = $this->table_log->where($where)->find();
        if ($res) {
            return $res;
        } else {
            return $this->table_log->getError();
        }
    }

}

?>