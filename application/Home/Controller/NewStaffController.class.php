<?php
namespace Home\Controller;

use Think\Controller;
class NewStaffController extends Controller
{
    public $tableName='newstaff_article';
    public function _initialize(){
        if(isMobile()==false){
            $this->msg='请在手机端打开链接';
            $this->display('error');
            exit;
        }
    }
    public function index(){
        $this->display();
    }
    public function article(){
        
        $Title=I('get.Title');
        $table=M($this->tableName);
        $info=$table->where(array('Title'=>$Title,'Status'=>1))->order('CreateTime desc')->find();
        if(!$info){
            $this->msg='该文章不存在';
            $this->display('error');
            exit;
        }
        $info['Contents']=htmlspecialchars_decode($info['Contents']);
        $this->info=$info;
        $this->display();
    }
}

?>