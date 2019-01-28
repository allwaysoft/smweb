<?php
namespace Admin\Controller;

use Common\Common\Controller\AdminController;
class ReportcmsController extends AdminController
{
    public function index(){
        $Status=I('get.Status');
        $where=array();
        if($Status){
            $where['Status']=$Status;
        }
        $table=M('Report');
        $count=$table->where($where)->order('CreateTime desc')->count();
        $page=new \Think\Page($count,20);
        $page->setConfig('prve', '上一页');
        $page->setConfig('next', '下一页');
        $page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $show       = $page->show();
        $list=$table->where($where)->order('id desc')->limit($page->firstRow.','.$page->listRows)->select();
        $this->list=$list;
        $this->page=$show;
        $this->display();
    }
    
    public function detail(){
        $id=I('get.id');
        $db=M('Report');
        $info=$db->where(array('Id'=>$id))->find();
        $info['FilesUrl']=explode(';',$info['FilesUrl']);
        $info['Result']=M('report_handles')->where(array('ReportId'=>$id))->select();
        $this->info=$info;
        $this->display();
    }
    public function del(){
        $id=I('get.id');
        $db=M('Report');
		$id=$db->delete($id);
		if ($id) {
			$this->success('删除成功',U('Reportcms/index'));
		}else {
			$this->error('删除失败');
		}
    }
    public function edit(){
       $Id=I('post.Id');
       $Status=I('post.Status');
       
       $info=M('report')->where(array('Id'=>$Id))->find();
       if($info['Status']==2){
           $this->error('该投诉已处理');exit;
       }
       $bool=M('report')->where(array('Id'=>$Id))->save(array('Status'=>$Status,'UpdateTime'=>date('Y-m-d H:i:s')));
       if($bool){
           $data['ReportStatus']=$Status;
           $data['ReportId']=$Id;
           $data['HandleTime']=date('Y-m-d H:i:s');
           $data['HandleUser']=session('username');
           $data['HandleResult']=I('post.HandleResult');
           M('report_handles')->add($data);
           $this->success('处理成功',U('Reportcms/index'));
       }else{
           $this->error('处理失败');
       }
    }
}

?>