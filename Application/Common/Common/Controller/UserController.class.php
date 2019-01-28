<?php

namespace Common\Common\Controller;

use Think\Model;
class UserController extends BaseController{
	protected function _initialize(){
		parent::_initialize();
		$user=M('Localuser')->where(array('id'=>$_SESSION['userid']))->find();
		$this->thisUser=$user;
		if(session('userid')==false)
		{
			$this->redirect('Home/Index/index');
		}
		// 右边栏广告图
		$gg = M('Banner')->where('type_id = 2')->find();
		$this->gg = $gg;
		//获取选择的区域
		$areaTyle=M('Areaset')->find();
		$areaname=$areaTyle['checkname'];
		$area_check=$user[$areaname];
		$this->area_check=$area_check;
		// 顶部链接  type_id=1
		$toplist = M('Links')->where('type_id = 1 AND display=0')->order('sort asc')->select();
		foreach ($toplist as $key=>$val){
			if ($val['isarea']==1&&$area_check=='')
			{
				unset($toplist[$key]);
			}
		}
		$this->toplist = $toplist;
		// 底部链接  type_id=2
		$botlist = M('Links')->where('type_id = 2  AND display=0')->order('sort asc')->select();
		foreach ($botlist as $key=>$val){
			if ($val['isarea']==1&&$area_check=='')
			{
				unset($botlist[$key]);
			}
		}
		$this->botlist = $botlist;
		// 右侧链接  type_id=3
		$riglist = M('Links')->where('type_id = 3  AND display=0')->order('sort asc')->select();
		foreach ($riglist as $key=>$val){
			if ($val['isarea']==1&&$area_check=='')
			{
				unset($riglist[$key]);
			}
		}
		$this->riglist = $riglist;
		// 实用工具  type_id=4
		$tools = M('Links')->where('type_id = 4  AND display=0')->order('sort asc')->select();
		foreach ($tools as $key=>$val){
			if ($val['isarea']==1&&$area_check=='')
			{
				unset($tools[$key]);
			}
		}
		$this->tools = $tools;
	}
}

?>