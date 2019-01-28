<?php

namespace Admin\Controller;

use Common\Common\Controller\AdminController;
class ToolsController extends AdminController{
	
    public function index(){
        $table=M('Tools');
		$count=$table->order('id desc')->count();
		$page=new \Think\Page($count,20);
		$page->setConfig('prev', '上一页');
		$page->setConfig('next', '下一页');
		$page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		$show       = $page->show();
		$list=$table->order('sort asc')->limit($page->firstRow.','.$page->listRows)->select();
		$this->list=$list;
		$this->page=$show;
		$this->display();
    }
    public function add(){
        if ($_POST) {
			$db=M('Tools');
			$data=array(
					'name'=>$_POST['name'],
					'image'=>$_POST['image'],
					'url'=>$_POST['url'],
					'isin'=>$_POST['isin'],
					'sort'=>$_POST['sort'],
			);
			$id=$db->add($data);
			if ($id) {
				$this->success('添加成功',U('Tools/index'));
			}else
			{
				$this->error('添加失败');
			}
		}else{
			$this->display();
		}
    }
    public function edit(){
        if ($_POST) {
			$db=M('Tools');
			$data=array(
					'name'=>$_POST['name'],
					'image'=>$_POST['image'],
					'url'=>$_POST['url'],
					'isin'=>$_POST['isin'],
					'sort'=>$_POST['sort'],
			);
			$id=$db->where(array('id'=>$_POST['id']))->save($data);
			if($id){
				$this->success('修改成功',U('Tools/index'));
			}else
			{
				$this->error('修改失败');
			}
		}else
		{
			$id=intval($_GET['id']);
			$db=M('Tools');
			$infos=$db->find($id);
			$this->infos=$infos;
			$this->display();
		}
    }
	public function del(){
		$id=$_POST['id'];
		$db=M('Tools');
		foreach ($id as $val)
		{
			$isbool=$db->delete($val);
		}
		if ($isbool) {
			$this->success('删除成功',U('Tools/index'));
		}else {
			$this->error('删除失败');
		}
	}
}

?>