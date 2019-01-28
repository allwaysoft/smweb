<?php
namespace Admin\Controller;

use Think\Controller;
class ServerController extends Controller
{
    /**
     * 服务器信息列表
     *   */
    public function index(){
        $keyword=I('request.keyword');
        $where=array();
        if($keyword){
            $where['Name']=array('like',"%$keyword%");
        }
        $table=M('Servers');
        $count=$table->where($where)->order('CreateTime desc')->count();
        $page=new \Think\Page($count,20);
        $page->setConfig('prve', '上一页');
        $page->setConfig('next', '下一页');
        $page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $show       = $page->show();
        $list=$table->where($where)->order('id desc')->limit($page->firstRow.','.$page->listRows)->select();
        foreach($list as $key=>$val){
            $ExtranetUrl=explode('.',$val['ExtranetUrl']);
            $IntranetUrl=explode('.',$val['IntranetUrl']);
            $DatabaseUrl=explode('.',$val['DatabaseUrl']);
            $list[$key]['ExtranetUrl']='**.**.**.'.$ExtranetUrl[3];
            $list[$key]['IntranetUrl']='**.**.**.'.$IntranetUrl[3];
            $list[$key]['DatabaseUrl']='**.**.**.'.$DatabaseUrl[3];
        }
        
        $this->list=$list;
        $this->page=$show;
        $this->display();
    }
    public function add(){
        $this->display('info');
    }
    /**
     * 服务器信息
     *   */
    public function info(){
        $Id=I('get.Id');
        $info=M('Servers')->where(array('Id'=>$Id))->find();
        $this->info=$info;
        $this->display();
    }
    
    /**
     * 信息提交
     *   */
    public function set(){
        $db=M('Servers');
        $Id=I('post.Id');
        $data['Name']=I('post.Name');
        $data['ExtranetUrl']=I('post.ExtranetUrl');
        $data['IntranetUrl']=I('post.IntranetUrl');
//         $data['UserName']=I('post.UserName');
//         $data['PassWord']=I('post.PassWord');
        $data['DatabaseUrl']=I('post.DatabaseUrl');
//         $data['DbName']=I('post.DbName');
//         $data['Dbpwd']=I('post.Dbpwd');
        if($Id){
            //修改
            $data['EditTime']=date('Y-m-d H:i:s');
            $data['EditUser']=session('username');
            $bool=$db->where(array('Id'=>$Id))->save($data);
        }else{
            //新增
            $data['CreateTime']=date('Y-m-d H:i:s');
            $data['CreateUser']=session('username');
            $bool=$db->add($data);
        }
        if($bool){
            $this->success('编辑成功',U('Server/index'));
        }else{
            $this->error('编辑失败');
        }
    }
    /**
     * 删除
     *   */
    public function del(){
        $Id=I('request.Id');
        $db=M('Servers');
        $bool=$db->where(array('Id'=>array('in',$Id)))->delete();
        if($bool){
            $this->success('删除成功',U('index'));
        }else{
            $this->error('删除失败，请重试');
        }
    }
}

?>