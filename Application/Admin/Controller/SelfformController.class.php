<?php

namespace Admin\Controller;

use Common\Common\Controller\AdminController;
class SelfformController extends AdminController{
	public $cate;
	public $alist;
	public $treeList = array();      //存放无限分类结果如果一页面有多个无限分类
	public function _initialize()
	{
		$this->cate = M('Selfform_type');
		$list = $this->cate->order('pid asc, sort asc, id asc')->select();
		$this->alist = $this->tree($list);
		$this->assign('alist', $this->alist);
	}
	/**
	 * 问卷列表
	 * */
	public function index(){
		$table=M('Selfform');
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
			$type=M('Selfform_type')->where(array('id'=>$value['type_id']))->find();
			$list[$key]['type_name']=$type['name'];
			unset($list[$key]['type_id']);
		}
		$this->list=$list;
		$this->page=$show;
		$this->display();
	}
	
	public function add(){
		if ($_POST) {
			$db=M('Selfform');
			$data=array(
					'title'=>$_POST['title'],
					'type_id'=>$_POST['type_id'],
					'image'=>$_POST['image'],
					'description'=>$_POST['description'],
					'starttime'=>strtotime($_POST['starttime']),
					'endtime'=>strtotime($_POST['endtime']),
					'author'=>$_POST['author'],
					'sort'=>$_POST['sort'],
					'addtime'=>time(),
					'edittime'=>time(),
					'edituser'=>session('username')
			);
			$id=$db->add($data);
			if ($id) {
				$this->success('添加成功',U('Selfform/index'));
			}else
			{
				$this->error('添加失败');
			}
		}else{
			$this->starttime=time();
			$this->endtime=time()+30*24*60*60;
			$this->display();
		}
	}
	/**
	 *问卷修改
	 * */
	public function edit(){
		if ($_POST) {
			$db=M('Selfform');
			$data=array(
					'title'=>$_POST['title'],
					'type_id'=>$_POST['type_id'],
					'image'=>$_POST['image'],
					'description'=>$_POST['description'],
					'starttime'=>strtotime($_POST['starttime']),
					'endtime'=>strtotime($_POST['endtime']),
					'author'=>$_POST['author'],
					'sort'=>$_POST['sort'],
					'edittime'=>time(),
					'edituser'=>session('username')
			);
			$id=$db->where(array('id'=>$_POST['id']))->save($data);
			if($id){
				$this->success('修改成功',U('Selfform/index'));
			}else
			{
				$this->error('修改失败');
			}
		}else
		{
			$id=intval($_GET['id']);
			$db=M('Selfform');
			$infos=$db->find($id);
			$this->infos=$infos;
			$this->display();
		}
	}
	/**
	 * 问卷删除
	 * */
	public function del(){
		if ($_GET)
		{
			$id=I('get.id',0,'intval');
		}elseif ($_POST){
			$id=implode(',', $_POST['id']);
		}
		$db=M('Selfform');
		$isbool=$db->delete($id);
		if ($isbool) {
			$this->success('删除成功',U('Selfform/index'));
		}else
		{
			$this->error('删除失败');
		}
	}
	/**  
	 * 问卷提交项列表
	 * */
	public function infos(){
		$id=I('get.id');
		if (!$id) {
			$this->error('参数错误');
		}
		$forminfo=M('Selfform')->find($id);
		$this->forminfo=$forminfo;
		$inputs=M('Selfform_input')->field('displayname,fieldname')->where(array('formid'=>$id))->select();
		$this->inputs=$inputs;
		$count=M('Selfform_values')->where(array('formid'=>$id))->count();
		$page=new \Think\Page($count,20);
		$page->setConfig('prev', '上一页');
		$page->setConfig('next', '下一页');
		$page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		$show       = $page->show();
		$values=M('Selfform_values')->where(array('formid'=>$id))->order('time desc')->limit($page->firstRow . ',' . $page->listRows)->select();
		foreach ($values as $key=>$val){
			$value=unserialize($val['values']);
			if ($inputs) {
				foreach ($inputs as $k=>$v)
				{
					$values[$key][$v['fieldname']]=$value[$v['fieldname']];
				}
			}
			$values[$key]['time']=date('Y-m-d H:i:s',$val['time']);
			unset($values[$key]['formid']);
			unset($values[$key]['values']);
		}
		$this->values=$values;
		$this->page=$show;
		$this->display();
	}
	/** 
	 * 问卷提交项删除
	 *  */
	public function valuesdel(){
		if ($_GET)
		{
			$id=I('get.id',0,'intval');
		}elseif ($_POST){
			$id=implode(',', $_POST['id']);
		}
		$db=M('Selfform_values');
		$isbool=$db->delete($id);
		if ($isbool) {
			$this->success('删除成功');
		}else
		{
			$this->error('删除失败');
		}
	}
	/**  
	 * 问卷输入项列表
	 * */
	public function input(){
		$id=I('get.id');
		if (!$id) {
			$this->error('参数错误');
		}
		$forminfo=M('Selfform')->find($id);
		$this->forminfo=$forminfo;
		$db=M('Selfform_input');
		$count=$db->where(array('formid'=>$id))->count();
		$page=new \Think\Page($count,20);
		$page->setConfig('prev', '上一页');
		$page->setConfig('next', '下一页');
		$page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		$show       = $page->show();
		$list=$db->where(array('formid'=>$id))->order('sort desc,id asc')->limit($page->firstRow.','.$page->listRows)->select();
		$this->list=$list;
		$this->page=$show;
		$this->display();
	}
	/**
	 * 问卷输入项添加
	 *   */
	public function inputadd(){
		if (IS_POST) {
			$db=M('Selfform_input');
			$db->formid=$_POST['formid'];
			$db->displayname=$_POST['displayname'];
			$db->fieldname=$_POST['fieldname'];
			$db->inputtype=$_POST['inputtype'];
			$db->options=$_POST['options'];
			$db->sort=$_POST['sort'];
			$db->time=time();
			$db->author=session('username');
			$id=$db->add();
			if ($id) {
				$this->success('添加成功',U('Selfform/input',array('id'=>$_POST['formid'])));
			}else 
			{
				$this->error('添加失败');
			}
		}else 
		{
			$formid=I('get.formid');
			if (!$formid) {
				$this->error('参数错误');
			}
			$forminfo=M('Selfform')->find($formid);
			$this->forminfo=$forminfo;
			$this->inputTypeOptions();
			$this->display();
		}
		
	}
	/**
	 * 问卷输入项修改
	 *   */
	public function inputedit(){
		if (IS_POST) {
			$db=M('Selfform_input');
			$db->formid=$_POST['formid'];
			$db->displayname=$_POST['displayname'];
			$db->fieldname=$_POST['fieldname'];
			$db->inputtype=$_POST['inputtype'];
			$db->options=$_POST['options'];
			$db->sort=$_POST['sort'];
			$db->time=time();
			$db->author=session('username');
			$isbool=$db->where(array('formid'=>$_POST['formid'],'id'=>$_POST['id']))->save();
			if ($isbool) {
				$this->success('修改成功',U('Selfform/input',array('id'=>$_POST['formid'])));
			}else 
			{
				$this->error('修改成功');
			}
		}else 
		{
			$formid=I('get.formid');
			$id=I('get.id');
			if ($formid && $id) {
				$forminfo=M('Selfform')->find($formid);
				$this->forminfo=$forminfo;
				$thisinfos=M('Selfform_input')->where(array('formid'=>$formid,'id'=>$id))->find();
				if(!$thisinfos)
				{
					$this->error('该信息不存在');
				}
				$this->thisinfos=$thisinfos;
				$this->inputTypeOptions($thisinfos['inputtype']);
				$this->display();
			}else 
			{
				$this->error('参数错误');
			}
		}
	}
	
	public function inputdel(){
		if ($_GET)
		{
			$id=I('get.id',0,'intval');
		}elseif ($_POST){
			$id=implode(',', $_POST['id']);
		}
		$db=M('Selfform_input');
		$isbool=$db->delete($id);
		if ($isbool) {
			$this->success('删除成功');
		}else
		{
			$this->error('删除失败');
		}
	}
	/**
	 * 问卷分类列表
	 * */
	public function type(){
		$this->assign('alist', $this->alist);
		$this->display();
	}
	/**
	 *问卷分类添加
	 * */
	public function typeadd(){
		if($_POST){
			$db=M('Selfform_type');
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
				$this->success('添加成功',U('Selfform/type'));
			}else
			{
				$this->error('添加失败');
			}
				
		}else{
			$this->display();
		}
	}
	/**
	 *问卷分类修改
	 *   */
	public function typeedit(){
		if($_POST){
			$db=M('Selfform_type');
			$data=array(
					'name'=>$_POST['name'],
					'pid'=>$_POST['pid'],
					'image'=>$_POST['image'],
					'sort'=>$_POST['sort'],
					'description'=>$_POST['description'],
			);
			$id=$db->where(array('id'=>$_POST['id']))->save($data);
			if ($id) {
				$this->success('修改成功',U('Selfform/type'));
			}else{
				$this->error('修改失败');
			}
		}else
		{
			$id=I('get.id',0,'intval');
			$db=M('Selfform_type');
			$info=$db->find($id);
			$this->info=$info;
			$this->display();
		}
	}
	/**
	 * 问卷分类删除
	 * */
	public function typedel(){
		$id=I('get.id',0,'intval');
		$ishave=M('Selfform')->where(array('type_id'=>$id))->find();
		if ($ishave) {
			$this->error('请先删除相关问卷');
		}
		$id=M('Selfform_type')->delete($id);
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
				$count=M('Selfform')->where(array('type_id'=>$value['id']))->count();
				$value['count']=$count;
				$this->treeList [] = $value;
				unset($data[$key]);
				$this->tree($data, $value['id'], $level + 1);
			}
		}
		return $this->treeList;
	}
	public function inputTypeOptions($selected=''){
		$options=array(
				array('value'=>'','text'=>'请选择'),
				array('value'=>'text','text'=>'文本输入框'),
				array('value'=>'textarea','text'=>'多行文本输入框'),
				array('value'=>'radio','text'=>'单选'),
				array('value'=>'checkbox','text'=>'多选')
		);
		$str='';
		foreach ($options as $o){
			$selectedStr='';
			if ($selected==$o['value']){
				$selectedStr=' selected';
			}
			$str.='<option value="'.$o['value'].'"'.$selectedStr.'>'.$o['text'].'</option>';
		}
		$this->assign('inputTypeOptions',$str);
	}
}

?>