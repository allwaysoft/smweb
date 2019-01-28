<?php

namespace Admin\Model;

use Think\Model;

class UserModel extends Model {

    protected $tableName = '400_user_staff';
    protected $insertFields = array();
    protected $updateFields = array();

    //验证规则
    // 第四个参数： 0：存在字段就验证（默认） 1：必须验证 2：值不为空的时候验证    
    // 第六个参数： 规则什么时候生效： 1：添加时生效 2：修改时生效 3：所有情况都生效

    protected function _initialize() {
        parent::_initialize();
        $this->itable = M("400_user_staff");
    }

//获取所有记录list
    public function result($where) {
        
        $res = $this->itable->where($where)->select();
        if ($res) {
            return $res;
        } else {
            return $this->itable->getError();
        }
    }

//获取记录
    public function row($where) {
        $res = $this->itable->where($where)->find();
        if ($res) {
            return $res;
        } else {
            return $this->itable->getError();
        }
    }

//添加纪录
    public function add($data) {
        if ($this->itable->create($data)) {
            $this->itable->create_time = time();
            $reg = $this->itable->add();
            if ($reg) {
                return $reg;
            } else {
                return $this->itable->getError();
            }
        } else {
            // 验证通过 可以进行其他数据操作
            return($this->itable->getError());
        }
    }

//编辑纪录纪录
    public function update($data) {
        if ($this->itable->create($data)) {  
            $reg = $this->itable->save();
            if ($reg) {
                return $reg;
            } else { 
                return $this->itable->getError();
            }
        } else { 
            return $this->itable->getError();
        }
    }
    //Delect function
    public function del($id) {
        if ($id) {  
            $reg = $this->itable->delete($id);
            if ($reg) {
                return $reg;
            } else { 
                return $this->itable->getError();
            }
        } else { 
            return FALSE;
        }
    }
    
    
    
    

}

?>