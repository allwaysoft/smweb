<?php

namespace Admin\Controller;

use Common\Common\Controller\AdminController;
class BannerController extends AdminController{
	public $cate;
	public $alist;
	public $treeList = array();      //存放无限分类结果如果一页面有多个无限分类
	public function _initialize()
	{
		parent::_initialize();
		$this->cate = M('Banner_type');
		$list = $this->cate->order('pid asc, sort asc, id asc')->select();
		$this->alist = $this->tree($list);
		$this->assign('alist', $this->alist);
	}
    public function index(){
        $table=M('Banner');
		$where = "";
		if($_GET){
			$where['type_id'] = $_GET['type_id'];
			$this->type_id=$_GET['type_id'];
		}
		$count=$table->where($where)->order('id desc')->count();
		$page=new \Think\Page($count,20);
		$page->setConfig('prev', '上一页');
		$page->setConfig('next', '下一页');
		$page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		$show       = $page->show();
		$list=$table->where($where)->order('id desc')->limit($page->firstRow.','.$page->listRows)->select();
		foreach ($list as $key=>$value)
		{
			$type=M('Banner_type')->where(array('id'=>$value['type_id']))->find();
			$list[$key]['type_name']=$type['name'];
			unset($list[$key]['type_id']);
		}
		$this->list=$list;
		$this->page=$show;
		$this->display();
    }
    public function add(){
        if ($_POST) {
			$db=M('Banner');
			$data=array(
					'title'=>$_POST['title'],
					'type_id'=>$_POST['type_id'],
					'image'=>$_POST['image'],
					'sort'=>$_POST['sort'],
					'url'=>$_POST['url']
			);
			$id=$db->add($data);
			if ($id) {
				$this->success('添加成功',U('Banner/index'));
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
			$db=M('Banner');
			$data=array(
					'title'=>$_POST['title'],
					'type_id'=>$_POST['type_id'],
					'image'=>$_POST['image'],
					'sort'=>$_POST['sort'],
					'url'=>$_POST['url']
			);
			$id=$db->where(array('id'=>$_POST['id']))->save($data);
			if($id){
				$this->success('修改成功',U('Banner/index'));
			}else
			{
				$this->error('修改失败');
			}
		}else
		{
			$id=intval($_GET['id']);
			$db=M('Banner');
			$infos=$db->find($id);
			$this->infos=$infos;
			$this->display();
		}
    }
	public function del(){
		$id=$_POST['id'];
		$db=M('Banner');
		foreach ($id as $val)
		{
			$isbool=$db->delete($val);
		}
		if ($isbool) {
			$this->success('删除成功',U('Banner/index'));
		}else {
			$this->error('删除失败');
		}
	}
    public function type(){
        $this->assign('alist', $this->alist);
		$this->display();
    }
    public function typeadd(){
        if($_POST){
			$db=M('Banner_type');
			$ishave=$db->where(array('name'=>$_POST['name'],pid=>$_POST['pid']))->find();
			if ($ishave) {
				$this->error('该分类已存在');
			}
			$db->name=$_POST['name'];
			$db->pid=$_POST['pid'];
			$db->image=$_POST['image'];
			$db->sort=$_POST['sort'];
			$id=$db->add();
			if($id){
				$this->success('添加成功',U('Banner/type'));
			}else{
				$this->error('添加失败');
			}
		}else{
			$this->display();
		}
    }
    public function typeedit(){
        if($_POST){
			$db=M('Banner_type');
			$data=array(
					'name'=>$_POST['name'],
					'pid'=>$_POST['pid'],
					'image'=>$_POST['image'],
					'sort'=>$_POST['sort'],
			);
			$id=$db->where(array('id'=>$_POST['id']))->save($data);
			if ($id) {
				$this->success('修改成功',U('Banner/type'));
			}else{
				$this->error('修改失败');
			}
		}else
		{
			$id=I('get.id',0,'intval');
			$db=M('Banner_type');
			$info=$db->find($id);
			$this->info=$info;
			$this->display();
		}
    }
	public function typedel(){
		$id=I('get.id',0,'intval');
		$ishave=M('Banner')->where(array('type_id'=>$id))->find();
		if ($ishave) {
			$this->error('请先删除相关图片');
		}
		$id=M('Banner_type')->delete($id);
		if ($id) {
			$this->success('删除成功',U('Banner/type'));
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
                $count=M('Banner')->where(array('type_id'=>$value['id']))->count();
                $value['count']=$count;
                $this->treeList [] = $value;
                unset($data[$key]);
                $this->tree($data, $value['id'], $level + 1);
            }
        }
        return $this->treeList;
    }
    
    public function subset()
    {
    	$sub_banner = M('subbanner')->find();
    	$this->assign("sub",$sub_banner);
    	$this->display();
    }
    
    public function subset_edit(){
    	if ($_POST) {
    		$db=M('subbanner');
    		$data=array(
    				'type'=>$_POST['type'],
    				'text'=>$_POST['text'],
    				'image'=>$_POST['image'],
    				'backgroundimg'=>$_POST['backgroundimg'],
    				'url'=>$_POST['url']
    		);
    		$sub = $db->find();
    		$data['id'] = $sub['id'];
    		$id=$db->save($data);
    		if($id){
    			$this->success('修改成功',U('Banner/subset'));
    		}else
    		{
    			$this->error('修改失败');
    		}
    	}else
    	{
    		$db=M('subbanner');
    		$sub=$db->find();
    		$this->assign("sub",$sub);
    		$this->display();
    	}
    }
}
?>