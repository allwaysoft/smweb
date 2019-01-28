<?php

namespace Admin\Controller;

use Common\Common\Controller\AdminController;
class RoleController extends AdminController{
	public function roleindex(){
		$db=M('Role');
		$where='';
		if (session('role_id')!=1) {
			$where='is_sys=0 and id !=1';
		}
		$count=$db->where($where)->count();
		$page=new \Think\Page($count,15);
		$page->setConfig('prve', '上一页');
		$page->setConfig('next', '下一页');
		$page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		$show=$page->show();
		$list=$db->where($where)->order('id desc')->limit($page->firstRow.','.$page->listRows)->select();
		foreach ($list as $key=>$value)
		{
			$count=M('Admin')->where(array('role_id'=>$value['id']))->count();
			$list[$key]['count']=$count;
		}
		$this->list=$list;
		$this->page=$show;
		$this->display();
	}
	public function roleadd(){
		if($_POST){
			$db=M('Role');
			$isset=$db->where(array('name'=>$_POST['name']))->find();
			if($isset){
				$this->error('该角色名已存在');
			}else 
			{
				$db->create();
				$id=$db->add();
				if ($id) {
					$this->success('添加成功',U('Admin/Role/roleindex'));
				}else 
				{
					$this->error('添加失败');
				}
			}
		}else{
			
			$this->display();
		}
	}
	public function roledel(){
		$id=I('get.id');
		if (!$id) {
			$this->error('参数错误');
		}
		$isuser=M('Admin')->where(array('role_id'=>$id))->find();
		if ($isuser) {
			$this->error('请先删除该权限组下的管理员');
		}
		$isbool=M('Role')->delete($id);
		if ($isbool) {
			$this->success('删除成功',U('Role/roleindex'));
		}else 
		{
			$this->error('删除失败');
		}
		
	}
	public function roleedit(){
		if($_POST){
			$db=M('Role');
			$data=array('id'=>$_POST['id'],'name'=>$_POST['name']);
			$id=$db->save($data);
			if ($id) {
				$this->success('修改成功',U('Admin/Role/roleindex'));
			}else 
			{
				$this->error('修改失败');
			}
		}else 
		{
			$id=intval($_GET['id']);
			$db=M('Role');
			$role=$db->find($id);
			$this->role=$role;
			$this->display();
		}
	}
	public function roleset(){
		if($_POST)
		{
			$roleid=I('post.roleid',0,'intval');
			$nodeid=I('post.nodeid');
			if (!$nodeid) {
				$this->error('参数错误');
			}
			$AccessDB = D('Access');
			if (is_array($nodeid) && count($nodeid) > 0) {  //提交得有数据，则修改原权限配置
				$AccessDB -> delAccess(array('roleid'=>$roleid));  //先删除原用户组的权限配置
				$NodeDB = D('Node');
				$node = $NodeDB->getAllNode();
				foreach ($node as $_v) $node[$_v[id]] = $_v;
				foreach($nodeid as $k => $node_id){
					$data[$k] = $AccessDB -> get_nodeinfo($node_id,$node);
					$data[$k]['roleid'] = $roleid;
				}
// 				$min=array('controller'=>'Main','action'=>'index','nodeid'=>0,'roleid'=>$roleid);
// 				$top=array('controller'=>'Main','action'=>'top','nodeid'=>0,'roleid'=>$roleid);
// 				$left=array('controller'=>'Main','action'=>'left','nodeid'=>0,'roleid'=>$roleid);
// 				$loginout=array('controller'=>'Main','action'=>'loginout','nodeid'=>0,'roleid'=>$roleid);
// 				array_push($data,$min, $top,$left,$loginout);
// 				dump($data);
				//exit();
				$AccessDB->addAll($data);   // 重新创建角色的权限配置
			} else {    //提交的数据为空，则删除权限配置
				$AccessDB -> delAccess(array('role_id'=>$roleid));
			}
			$this->success('设置成功！',U('Admin/Role/roleindex'));
		}else 
		{
			$roleid =I('get.roleid',0,'intval');
			if(!$roleid) $this->error('参数错误!');
			
			/* $Tree = new \Org\Net\Tree;
			$Tree->icon = array('&nbsp;&nbsp;&nbsp;│ ','&nbsp;&nbsp;&nbsp;├─ ','&nbsp;&nbsp;&nbsp;└─ ');
			$Tree->nbsp = '&nbsp;&nbsp;&nbsp;';
			
			$NodeDB = D('Node');
			$node = $NodeDB->getAllNode();
			dump($node);
			$AccessDB = D('Access');
			$access = $AccessDB->getAllAccess('','roleid,controller,action');
			foreach ($node as $n=>$t) {
				$node[$n]['checked'] = ($AccessDB->is_checked($t,$roleid,$access))? ' checked' : '';
				$node[$n]['depth'] = $AccessDB->get_level($t['id'],$node);
				$node[$n]['pid_node'] = ($t['pid'])? ' class="tr lt child-of-node-'.$t['pid'].'"' : '';
			}
			$str  = "<tr id='node-\$id' \$pid_node>
                    <td style='padding-left:30px;'>\$spacer<input type='checkbox' name='nodeid[]' value='\$id' class='radio' level='\$depth' \$checked onclick='javascript:checknode(this);'/ > \$name </td>
                </tr>";
			
			$Tree->init($node);
			$html_tree = $Tree->get_tree(0, $str); */
			$db=M('Node');
			$html_tree='';
			$AccessDB = D('Access');
			$access = $AccessDB->getAllAccess('','roleid,controller,action');
			$one=$db->where(array('pid'=>1))->order('sort asc')->select();
			foreach ($one as $key=>$value){
				$checked=($AccessDB->is_checked($value,$roleid,$access))? "checked='checked'": '';
				$html_tree.="<tr><td width='100'><input type='checkbox' level='1' name='nodeid[]' ".$checked." value='".$value['id']."' onclick='javascript:checknode(this);'/>".$value['name']."</td><td colspan='2'></td></tr>";
				$two=$db->where(array('pid'=>$value['id']))->order('sort asc')->select();
				foreach ($two as $val)
				{
					$checked=($AccessDB->is_checked($val,$roleid,$access))?"checked='checked'": '';
					$html_tree.="<tr><td></td><td width='100'><input type='checkbox' level='2' name='nodeid[]' ".$checked." value='".$val['id']."' onclick='javascript:checknode(this);'/>".$val['name']."</td><td><ul>";
					$three=$db->where(array('pid'=>$val['id']))->order('sort asc')->select();
					foreach ($three as $v)
					{
						$checked=($AccessDB->is_checked($v,$roleid,$access))?"checked='checked'": '';
						$html_tree.="<li><input type='checkbox' level='3' name='nodeid[]' ".$checked." value='".$v['id']."' onclick='javascript:checknode(this);'/>".$v['name']."</li>";
					}
					
					$html_tree.="</ul></td></tr>";
				}
			}
			$this->assign('html_tree',$html_tree);
			
			$this->display();
		}
		
	}
}

?>