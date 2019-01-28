<?php

namespace Admin\Model;

use Think\Model;
class AccessModel extends Model{
	// 获取所有信息
	public function getAllAccess($where = '' ,$field = '*' ,  $limit='') {
		return $this->where($where)->field($field)->limit($limit)->select();
	}
	
	// 删除
	public function delAccess($where) {
		if($where){
			return $this->where($where)->delete();
		}else{
			return false;
		}
	}
	
	
	/**
	 * 获取菜单节点表信息
	 * @param int $node_id 菜单节点ID
	 * @param int $node 菜单节点数据
	 */
	public function get_nodeinfo($node_id,$node) {
		$info['controller'] = $node[$node_id]['controller'];
		$info['action']     = $node[$node_id]['action'];
		$info['nodeid']=$node[$node_id]['id'];
		return $info;
	}
	
	/**
	 *  检查指定菜单是否有权限
	 * @param array $node node表中某记录数组
	 * @param int $roleid 需要检查的角色ID
	 * @param int $access access表的所有数组记录
	 */
	public function is_checked($node,$roleid,$access) {
		$nodetemp = array(
				'roleid' =>$roleid,
				'controller' =>$node['controller'],
				'action' =>$node['action']
		);
		$info = in_array($nodetemp, $access);
		if($info){
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 * 获取菜单深度
	 * @param $id
	 * @param $array
	 * @param $i
	 */
	public function get_level($id,$array=array(),$i=0) {
		foreach($array as $n=>$value){
			if($value['id'] == $id)
			{
				if($value['pid']== '0') return $i;
				$i++;
				return $this->get_level($value['pid'],$array,$i);
			}
		}
	}
}

?>