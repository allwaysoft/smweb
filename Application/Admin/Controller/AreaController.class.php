<?php

namespace Admin\Controller;

use Common\Common\Controller\AdminController;
class AreaController extends AdminController{
	public function set(){
		$db=M('Areaset');
		$areaset=$db->find();
		$this->areaset=$areaset;
		$this->display();
	}
	public function areacheck(){
		$checkname=$_POST['checkname'];
		$db=M('Areaset');
		$db->checkname=$checkname;
		$isbool=$db->where('id=1')->save();
		if ($isbool) {
			echo 'success';
		}else{
			echo 'fail';
		}
	}
	public function arealist(){
		$val=$_POST['val'];
		$style=$_POST['style'];
		$db=M('Localuser');
		$list=$db->field($val)->group($val)->select();
		$area=M('Area')->select();
		$area_arr=array();
		foreach ($area as $value){
			$area_arr[]=$value['areaname'];
		}
		foreach ($list as $key=>$v)
		{
			if (in_array($v[$val], $area_arr)) {
				if ($style==0) {
					$list[$key]['state']=1;
				}else
				{
					unset($list[$key]);
				}
			}else{
				$list[$key]['state']=0;
				
			}
		}
		$this->ajaxReturn($list,'JSON');
	}
	public function savearea(){
		$db_area=D('Area');
		$db_area->where('1')->delete();
		M('Quota')->where('1')->delete();
		M('Area_pici')->where('1')->delete();
		$val=$_POST['val'];
		$db=M('Localuser');
		$list=$db->field($val)->group($val)->select();
		foreach ($list as $value)
		{
			if ($value[$val]!=null) {
				
				/* $db_area->areaname=$value[$val];
				$id=$db_area->add(); */
				$data[]=array('areaname'=>$value[$val]);
			}
			
		}
		$id=$db_area->addAll($data);
		if ($id) {
			echo '保存成功';
		}
		else{
			echo '保存失败';
		}
	}
	public function saveNoarea(){
		$val=$_POST['val'];
		$db=M('Localuser');
		$list=$db->field($val)->group($val)->select();
		$area=M('Area')->select();
		$area_arr=array();
		foreach ($area as $value){
			$area_arr[]=$value['areaname'];
		}
		foreach ($list as $v){
			if (!in_array($v[$val], $area_arr)) {
				$data[]=array('areaname'=>$v[$val]);
			}
		}
		$db_area=D('Area');
		$id=$db_area->addAll($data);
		if ($id) {
			echo '保存成功';
		}
		else{
			echo '保存失败';
		}
	}
	public function addarea(){
		$areaname=$_POST['areaname'];
		$db=M('Area');
		$is_have=$db->where(array('areaname'=>$areaname))->find();
		if ($is_have) {
			die('该区域已存在') ;
		}
		$db->areaname=$areaname;
		$id=$db->add();
		if ($id) {
			die('添加成功');
		}else 
		{
			die('添加失败');
		}
	}
}

?>