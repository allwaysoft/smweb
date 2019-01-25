<?php
namespace Admin\Controller;

use Common\Common\Controller\AdminController;
class NewStaffcmsController extends AdminController
{
    public $tableName='newstaff_article';
    /**
     * 列表页
     *   */
    public function articlelist(){
        $keyword=I('request.keyword');
        $where['Status']=1;
        if($keyword){
            $where['Title']=array('like',"%$keyword%");
        }
        $table=M($this->tableName);
        $count=$table->where($where)->order('CreateTime desc')->count();
        $page=new \Think\Page($count,20);
        $page->setConfig('prve', '上一页');
        $page->setConfig('next', '下一页');
        $page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $show       = $page->show();
        $list=$table->where($where)->order('CreateTime desc')->limit($page->firstRow.','.$page->listRows)->select();
        foreach($list as $key=>$val){
            $list[$key]['ExtranetUrl']='http://'.$_SERVER['SERVER_NAME'].'/index.php/NewStaff/article/Id/'.$val['Id'];
        }
        
        $this->list=$list;
        $this->page=$show;
        $this->display();
    }
    /**
     * 添加
     *   */
    public function articleadd(){
        
        $this->display();
    }
    /**
     * 修改
     *   */
    public function articleedit(){
        $table=M($this->tableName);
        $Id=I('get.Id');
        $info=$table->where(array('Id'=>$Id))->find();
        $this->info=$info;
        $this->display('articleadd');
    }
    
    public function articlecommit(){
        $table=M($this->tableName);
        $data['Title']=I('post.Title');
        $data['Image']=I('post.Image');
        $data['Description']=I('post.Description');
        $data['Contents']=I('post.Contents');
        $Id=I('post.Id');
        if(!$Id){
            //新增
            $data['Id']=uniqid();
            $data['CreateTime']=date('Y-m-d H:i:s');
            $data['CreateUser']=session('username');
            $bool=$table->add($data);
        }else{
            $data['UpdateTime']=date('Y-m-d H:i:s');
            $data['UpdateUser']=session('username');
            $bool=$table->where(array('Id'=>$Id))->save($data);
        }
        if($bool){
            $this->success('编辑成功',U('articlelist'));
        }else{
            $this->error('编辑失败');
        }
    }
    
    /**
     * 删除
     *   */
    public function articledel(){
        $Ids=I('request.Id');
        $table=M($this->tableName);
        $info=$table->where(array('Id'=>array('in',$Ids),'Status'=>1))->select();
        if($info){
            $data['Status']=-1;
            $data['UpdateTime']=date('Y-m-d H:i:s');
            $data['UpdateUser']=session('username');
            $bool=$table->where(array('Id'=>array('in',$Ids)))->save($data);
            if($bool){
                $this->success('删除成功',U('articlelist'));
            }else{
                $this->error('删除失败');
            }
        }else{
            $this->error('删除失败');
        }
    }
}

?>