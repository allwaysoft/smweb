<?php

namespace Admin\Controller;

use Common\Common\Controller\AdminController;
class GalleryController extends AdminController{
	public $cate;
	public $alist;
	public $treeList = array();      //存放无限分类结果如果一页面有多个无限分类
	public function _initialize()
	{
		$this->cate = M('Gallery_type');
		$list = $this->cate->order('pid asc, sort asc, id asc')->select();
		$this->alist = $this->tree($list);
		$this->assign('alist', $this->alist);
	}
	/**  
	 * 店铺列表
	 * */
	public function index(){
		$table=M('Gallery');
 		$where="";
 		$where.=@$_GET['type_id']!=''?"(type_id=".$_GET['type_id'].")":'';
		$keyword=@$_GET['keyword']!=''?$_GET['keyword']:'';
		if(@$_GET['type_id']!=''&&@$_GET['keyword']!=''){
			$where.='AND ';
		}
 		$where.= @$_GET['keyword']!=''?"title LIKE '%".@$_GET['keyword']."%'":'';
		$this->keyword=$keyword;
		$count=$table->where($where)->order('id desc')->count();
		$page=new \Think\Page($count,20);
		$page->setConfig('prev', '上一页');
		$page->setConfig('next', '下一页');
		$page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		$show       = $page->show();
		$list=$table->where($where)->order('id desc')->limit($page->firstRow.','.$page->listRows)->select();
		foreach ($list as $key=>$value)
		{
			$type=M('Gallery_type')->where(array('id'=>$value['type_id']))->find();
			$list[$key]['type_name']=$type['name'];
			unset($list[$key]['type_id']);
		}
		$this->list=$list;
		$this->page=$show;
		$this->display();
	}
	/**  
	 * 店铺添加
	 * */
	public function add(){
		if ($_POST) {
			$db=M('Gallery');
			$data=array(
					'title'=>$_POST['title'],
					'type_id'=>$_POST['type_id'],
					'cover_image'=>$_POST['cover_image'],
					'image'=>implode(',',$_POST['image']),
					'description'=>implode(',',$_POST['description']),
					'time'=>strtotime($_POST['time']),
					'endtime'=>strtotime($_POST['endtime']),
					'author'=>$_POST['author'],
					'sort'=>$_POST['sort'],
					'contents'	=>$_POST['contents'],
					'addtime'=>time(),
					'edittime'=>time(),
					'edituser'=>session('username'),
					'is_display'=>$_POST['is_display']
			);
			$id=$db->add($data);
			if ($id) {
				$this->success('添加成功',U('Gallery/index'));
			}else
			{
				$this->error('添加失败');
			}
		}else{
			$this->time=time();
			$this->endtime=time()+365*24*60*60;
			$this->display();
		}
	}
	/**  
	 * 店铺修改
	 * */
	public function edit(){
		if ($_POST) {
			$db=M('Gallery');
			$data=array(
					'title'=>$_POST['title'],
					'type_id'=>$_POST['type_id'],
					'cover_image'=>$_POST['cover_image'],
					'image'=>implode(',',$_POST['image']),
					'description'=>implode(',',$_POST['description']),
					'time'=>strtotime($_POST['time']),
					'endtime'=>strtotime($_POST['endtime']),
					'author'=>$_POST['author'],
					'sort'=>$_POST['sort'],
					'contents'	=>$_POST['contents'],
					'edittime'=>time(),
					'edituser'=>session('username'),
					'is_display'=>$_POST['is_display']
			);
			$id=$db->where(array('id'=>$_POST['id']))->save($data);
			if($id){
				$this->success('修改成功',U('gallery/index'));
			}else
			{
				$this->error('修改失败');
			}
		}else
		{
			$id=intval($_GET['id']);
			$db=M('Gallery');
			$infos=$db->find($id);
			$image=explode(',', $infos['image']);
			$description=explode(',', $infos['description']);
			foreach ($image as $key=>$val)
			{
				$infos['detail'][]=array('image'=>$val,'description'=>$description[$key]);
			}
			$this->infos=$infos;
			$this->display();
		}
	}
	/**  
	 * 店铺删除
	 * */
	public function del(){
		if ($_GET)
		{
			$id=I('get.id',0,'intval');
		}elseif ($_POST){
			$id=implode(',', $_POST['id']);
		}
		$db=M('Gallery');
		$isbool=$db->delete($id);
		if ($isbool) {
			$this->success('删除成功',U('Gallery/index'));
		}else
		{
			$this->error('删除失败');
		}
	}
	/**
	 * 图库分区列表  
	 * */
	public function type(){
		$this->assign('alist', $this->alist);
		$this->display();
	} 
	/**  
	 *图库分区添加 
	 * */
	public function typeadd(){
		if($_POST){
			$db=M('Gallery_type');
			$ishave=$db->where(array('name'=>$_POST['name'],pid=>$_POST['pid']))->find();
			if ($ishave) {
				$this->error('该分类已存在');
			}
			$db->name=$_POST['name'];
			$db->pid=$_POST['pid'];
			$db->image=$_POST['image'];
			$db->sort=$_POST['sort'];
			$db->description=$_POST['description'];
			$id=$db->add();
			if($id)
			{
				$this->success('添加成功',U('Gallery/type'));
			}else 
			{
				$this->error('添加失败');
			}
			
		}else{
			$this->display();
		}
	}
	/**
	 *图库分区修改
	 *   */
	public function typeedit(){
		if($_POST){
			$db=M('Gallery_type');
			$data=array(
					'name'=>$_POST['name'],
					'pid'=>$_POST['pid'],
					'image'=>$_POST['image'],
					'sort'=>$_POST['sort'],
					'description'=>$_POST['description'],
			);
			$id=$db->where(array('id'=>$_POST['id']))->save($data);
			if ($id) {
				$this->success('修改成功',U('Gallery/type'));
			}else{
				$this->error('修改失败');
			}
		}else
		{
			$id=I('get.id',0,'intval');
			$db=M('Gallery_type');
			$info=$db->find($id);
			$this->info=$info;
			$this->display();
		}
	}
	/**  
	 * 图库分区删除
	 * */
	public function typedel(){
		$id=I('get.id',0,'intval');
		$ishave=M('Gallery')->where(array('type_id'=>$id))->find();
		if ($ishave) {
			$this->error('请先删除相关店铺');
		}
		$id=M('Gallery_type')->delete($id);
		if ($id) {
			$this->success('删除成功',U('Gallery/type'));
		}else {
			$this->error('删除失败');
		}
	}
	/**
	 * 无限级分类
	 * @access public
	 * @param Array $data     //数据库里获取的结果集
	 * @param Int $pid
	 * @param Int $count       //第几级分类
	 * @return Array $treeList
	 */
	public function tree(&$data, $pid = 0, $level = 1)
	{
		foreach ($data as $key => $value) {
			if ($value['pid'] == $pid) {
				$value['level'] = $level;
				$count=M('Gallery')->where(array('type_id'=>$value['id']))->count();
				$value['count']=$count;
				$this->treeList [] = $value;
				unset($data[$key]);
				$this->tree($data, $value['id'], $level + 1);
			}
		}
		return $this->treeList;
	}
}

?>