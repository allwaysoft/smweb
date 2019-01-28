<?php

namespace Admin\Model;

use Think\Model;

class StatementModel extends Model {

    protected $tableName = 'loan_statement';
    

    protected function _initialize() {
        parent::_initialize();
        $this->table = M("loan_statement");
        
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

//获取记录
    public function row($where) {
        $res = $this->table->where($where)->find();
        if ($res) {
            return $res;
        } else {
            return $this->table->getError();
        }
    }
 
 
}

?>