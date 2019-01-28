<?php

namespace Admin\Controller;

use Common\Common\Controller\AdminController;
class NodeController extends AdminController{
	public function nodeindex(){
		$Node = D('Node')->getAllNode();
		$array = array();
		// 构建生成树中所需的数据
		foreach($Node as $k => $r) {
			$r['id']      = $r['id'];
			$r['sort']   = $r['sort'];
			$r['name']    = $r['name'];
			$r['submenu'] = "<a href='".U('Node/nodeadd',array('pids'=>$r['id']))."'>添加子菜单</a>";
			$r['edit']    = "<a href='".U('Node/nodeedit',array('id'=>$r['id'],'pids'=>$r['pid']))."'>修改</a>";
			$r['del']     = "<a onClick=\"return confirm('确定删除吗？')\" href='".U('Node/nodedel',array('id'=>$r['id']))."'>删除</a>";
			switch ($r['display']) {
				case 0:
					$r['display'] = '不显示';
					break;
				case 1:
					$r['display'] = '显示';
					break;
			}
			
			$array[]      = $r;
		}
		
		$str  = "<tr class='tr'>
				    <td align='center'>\$id</td>
					<td align='center'>\$sort</td>
				    <td style='text-align:left'>\$spacer \$name</td>
				    <td align='center'>\$display</td>
					<td align='center'>
						\$submenu | \$edit | \$del
					</td>
				  </tr>";
		
		$Tree = new \Org\Net\Tree;
		$Tree->icon = array('&nbsp;&nbsp;&nbsp;│ ','&nbsp;&nbsp;&nbsp;├─ ','&nbsp;&nbsp;&nbsp;└─ ');
		$Tree->nbsp = '&nbsp;&nbsp;&nbsp;';
		$Tree->init($array);
		$html_tree = $Tree->get_tree(0, $str);
		$this->assign('html_tree',$html_tree);
		$this->display();
		
	}
	public function nodeadd(){
		if($_POST){
			$db=M('Node');
			if($db->create()==true)
			{
				$id=$db->add();
				if($id){
					$this->success('添加成功',U('Admin/Node/nodeindex'));
				}else 
				{
					$this->error('添加失败');
				}
			}else {
				$this->error($db->geterror());
			}
		}else {
			$Node = D('Node')->getAllNode();
			$pid =I('get.pids',0,'intval');	//选择子菜单
			$array = array();
			foreach($Node as $k => $r) {
				$r['id']         = $r['id'];
				$r['name']      = $r['name'];
				$array[$r['id']] = $r;
			}

			$str  = "<option value='\$id' \$selected >\$spacer \$name</option>";
			$Tree = new \Org\Net\Tree;
			$Tree->init($array);
			$select_categorys = $Tree->get_tree(0, $str, $pid);
			$this->assign('select_categorys',$select_categorys);
			$this->display();
		}
		
	}
	public function nodedel(){
		$id = I('get.id',0,'intval');
		if(!$id)$this->error('参数错误!');
		$NodeDB = D('Node');
		$info = $NodeDB -> getNode(array('id'=>$id),'id');
		if($NodeDB->childNode($info['id'])){
			$this->error('存在子菜单，不可删除!');
		}
		if($NodeDB->delNode('id='.$id)){
			$this->assign("jumpUrl",U('Node/nodeindex'));
			$this->success('删除成功！');
		}else{
			$this->error('删除失败!');
		}
	}
	public function nodeedit(){
		$NodeDB = D('Node');
		if($_POST) {
			//根据表单提交的POST数据创建数据对象
			if($NodeDB->create()){
				if($NodeDB->save()){
					$this->success('编辑成功！',U('Admin/Node/nodeindex'));
				}else{
					$this->error('编辑失败!');
				}
			}else{
				$this->error($NodeDB->getError());
			}
				
		}else{
			$id = I('get.id',0,'intval');
			$pid =I('get.pids',0,'intval');	//选择子菜单
			if(!$id || !$pid)$this->error('参数错误!');
			$allNode = $NodeDB->getAllNode();
			$array = array();
			foreach($allNode as $k => $r) {
				$r['id']         = $r['id'];
				$r['name']      = $r['name'];
				$array[$r['id']] = $r;
			}
			
			$str  = "<option value='\$id' \$selected  >\$spacer \$name</option>";
			$Tree = new \Org\Net\Tree;
			$Tree->init($array);
			$select_categorys = $Tree->get_tree(0, $str, $pid);
			$this->assign('select_categorys',$select_categorys);
			$this->assign('info', $NodeDB->getNode('id='.$id));
			$this->display();
		}
	}
}

?>