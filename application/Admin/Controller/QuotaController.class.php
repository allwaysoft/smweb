<?php

namespace Admin\Controller;

use Common\Common\Controller\AdminController;
class QuotaController extends AdminController{
	public function index(){
		$db=M('Area');
		$where='';
		$keyword=@$_GET['keyword']!=''?$_GET['keyword']:'';
		$where.= @$_GET['keyword']!=''?" areaname LIKE '%".@$_GET['keyword']."%'":'';
		$this->keyword=$keyword;
		$count=$db->where($where)->order('id desc')->count();
		$page=new \Think\Page($count,10);
		$page->setConfig('prev', '上一页');
		$page->setConfig('next', '下一页');
		$page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		$show       = $page->show();
		$list=$db->where($where)->order('id asc')->limit($page->firstRow.','.$page->listRows)->select();
		foreach ($list as $key=>$val)
		{
			$list[$key]['urlname']=urlencode($val['areaname']);
		}
		$this->list=$list;
		$this->page=$show;
		$this->display();
	}
	public function addarea(){
		$areaname=$_POST['areaname'];
		$db=M('Area');
		if ($db->where(array('areaname'=>$areaname))->find()) {
			$this->error('该区域已存在，请重新确认');
		}
		$db->areaname=$areaname;
		$id=$db->add();
		if ($id) {
			$this->success('添加成功',U('Quota/index'));
		}else{
			$this->error('添加失败');
		}
	}
	public function delarea(){
		$areaname=$_GET['areaname'];
		if (M('Area_pici')->where(array('areaname'=>$areaname))->find()) {
			$this->error('无法删除，请先删除该区域的配额批次');
		}
		$isbool=M('Area')->where(array('areaname'=>$areaname))->delete();
		if ($isbool) {
			$this->success('区域删除成功',U('Quota/index'));
		}else{
			$this->error('删除失败');
		}
	}
	public function edititle(){
		$db=M('Area_pici');
		$title=$_POST['title'];
		$id=$_POST['id'];
		$data['title']=$title;
		$isbool=$db->where("id=$id")->save($data);
		$pici=$db->find($id);
		echo $pici['title'];
	}
	public function listinfo(){
		$id=I('get.id',0,'intval');
		if (!$id) {
			$this->error('参数错误');
		}
		$pici=M('Area_pici')->find($id);
		$this->pici=$pici;
		$db=M('Quota');
		$count=$db->where(array('pcID'=>$id))->count();
		$page=new \Think\Page($count,10);
		$page->setConfig('prev', '上一页');
		$page->setConfig('next', '下一页');
		$page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		$show       = $page->show();
		$list=$db->where(array('pcID'=>$id))->limit($page->firstRow.','.$page->listRows)->select();
		$this->list=$list;
		$this->page=$show;
		$this->display();
	}
	public function piciInfos(){
		$areaname=$_POST['areaname'];
		$db=M('Area_pici');
		$list=$db->where(array('areaname'=>$areaname))->order('quotatime desc,time desc')->select();
		foreach ($list as $key=>$val)
		{
			$list[$key]['quotatime']=date('Y年m月d日',$val['quotatime']);
			$list[$key]['time']=date('Y-m-d H:i:s',$val['time']);
		}
		$this->ajaxReturn($list,'JSON');
	}
	public function infodel(){
		$id=I('post.id',0,'intval');
		$isbool=M('Area_pici')->delete($id);
		if ($isbool) {
			M('Quota')->where(array('pcID'=>$id))->delete();
			echo '1';
		}else 
		{
			echo '0';
		}
	}
	public function del(){
		$id=$_POST['id'];
		$db=M('Quota');
		
		foreach ($id as $val)
		{
			$isbool=$db->where(array('styleID'=>$val))->delete();
		}
		if ($isbool) {
			$this->success('删除成功');
		}else {
			$this->error('删除失败');
		}
	}
	public function import(){
            if(!session('username')){
                $this->error('请重新登陆！！！');
            }
			if ($_POST) {
			/* 1212 */
			vendor('PHPExcel.PHPExcel');
			$cacheMethod = \PHPExcel_CachedObjectStorageFactory::cache_in_memory_gzip;
			$cacheSettings = array();
			\PHPExcel_Settings::setCacheStorageMethod($cacheMethod,$cacheSettings);
			$objPHPExcel = new \PHPExcel();
			$objPHPExcel = \PHPExcel_IOFactory::load($_FILES["inputExcel"]["tmp_name"]);
			$indata = $objPHPExcel->getSheet(0)->toArray();
			unset($indata[0]);
			unset($indata[1]);
			/* 1212 */
			$areaname=explode(',', $_POST['areaname']);
			$quotatime=strtotime($_POST['quotatime']);
			$title=$_POST['title'];
			$area_pici=M('Area_pici');
			$quota=D('Quota');;
                        // print_r($areaname);
			foreach ($areaname as $value)
			{
				
				$is_find=$area_pici->where(array('areaname'=>$value,'quotatime'=>$quotatime,'title'=>$title))->find();
                                
				if(!$is_find)
				{
					/* 批次不存在 */
                                        
					$arra['areaname']=$value;
					$arra['quotatime']=$quotatime;
					$arra['title']=$title;
					$arra['author']=session('username');
					$arra['time']=time();
					$id=$area_pici->add($arra);
					if ($id) {
						$data=array();
						foreach ($indata as $val)
						{
							if ($val[0]!=null) {
								//先删除这个区域下所有批次存在的这个款号
								$this->del_styleID($value, $val[0]);
								//再添加此款号
								$data[]=array('pcID'=>$id,'styleID'=>$val[0]);
							}
						}
						$id=$quota->addAll($data);
					}
				}else {
					/* 批次存在 */
					$data=array();
					foreach ($indata as $val)
					{
						//先删除这个区域下所有批次存在的这个款号
						$this->del_styleID($value, $val[0]);
						//再添加此款号
						$data[]=array('pcID'=>$is_find['id'],'styleID'=>$val[0]);
					}
					$id=$quota->addAll($data);
				}
			}
			if ($id) {
				$this->success('导入成功',U('Quota/index'));
			}else 
			{
				$this->error('导入失败');
			}
		}else 
		{
                    
			$this->quotatime=time();
            $areaname=$_GET['areaname'];
			if(is_array($areaname))
			{
				$areaname=implode(',', $areaname);
			}
			else {
				$areaname=urldecode($areaname);
			}
			if (!$areaname) {
				$this->error('无效参数');
			}
			$this->areaname=$areaname;
			$this->display();
		}
		
	}
	function del_styleID($areaname,$styleID){
		$area_pici=M('Area_pici');
		$quota=M('Quota');
		$allpici=$area_pici->where(array('areaname'=>$areaname))->select();
		foreach ($allpici as $value){
			$quota->where(array('pcID'=>$value['id'],'styleID'=>$styleID))->delete();
		}
	}
}

?>