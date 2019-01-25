<?php

namespace Admin\Model;

use Think\Model;

class RegisterModel extends Model {

    protected $tableName = 'loan_register';
    protected $insertFields = array('reg_code','reg_amount', 'reg_cycle', 'reg_date');
   // protected $updateFields = array('nickname', 'email');
    //验证规则
    // 第四个参数： 0：存在字段就验证（默认） 1：必须验证 2：值不为空的时候验证    
    // 第六个参数： 规则什么时候生效： 1：添加时生效 2：修改时生效 3：所有情况都生效
    
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
 
 //编辑纪录纪录
    public function regUpdate($data) {
        $reg = $this->register->save($data);
         
        if ($reg) {
            return $reg;
        } else {
            return $this->register->getError();
        }
    }
 

}

?>