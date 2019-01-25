<?php

namespace Layout\Model;

use Think\Model;

class WeblogModel extends Model {

    protected $tableName = 'loan_weblog';

    //验证规则
    // 第四个参数： 0：存在字段就验证（默认） 1：必须验证 2：值不为空的时候验证    
    // 第六个参数： 规则什么时候生效： 1：添加时生效 2：修改时生效 3：所有情况都生效


    protected function _initialize() {
        parent::_initialize();
        $this->table = M("loan_weblog");
    }

//获取所有记录
    public function result() {
        $res = $this->table->select();
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
    public function logAdd($data) {
        $t = M("loan_weblog"); 
        $data['update'] = date("Y-m-d H:i:s");  
        $reg = $t->data($data)->add(); 
        if ($reg) {
            return $reg;
        } else {
            return $this->table->getError();
        }
//       if ($this->table->create($data)) {
//           } else {
//            // 验证通过 可以进行其他数据操作
//             return($this->table->getError());
//        }
        /*         * */
    }

}

?>