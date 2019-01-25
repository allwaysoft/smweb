<?php

namespace Admin\Model;

use Think\Model;

class WeblogModel extends Model {

    protected $tableName = 'loan_weblog';

    protected function _initialize() {
        parent::_initialize();
        $this->table = M("loan_weblog");
    }

//获取所有记录
    public function result() {
        $res = $this->table->select();
        return $res;
    }

// 
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