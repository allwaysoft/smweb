<?php

namespace Home\Controller;

use Common\Common\Controller\UserController;
class SearchController extends UserController{
	public function results(){
		if($_GET){
			$model=$_GET['model'];
			$this->model=$model;
			$keyword=$_GET['keyword'];
			$this->keyword=$keyword;
			if ($model=='news') {
				
				$cateList = M('News_type')->where(array('pid' => 0))->order('sort asc')->select();
				$this->cateList=$cateList;
				$newnews = M('News')->order('time desc')->limit(5)->select();
				foreach ($newnews as $key=>$val){
					$newnews[$key]['image']=str_replace('/', '_', $val['image']);
				}
				$this->newnews = $newnews;
				
				$db=M('News');
				$where=array('title'=>array('like','%'.$keyword.'%'),'contents'=>array('like','%'.$keyword.'%'),'_logic'=>'or');
				$count=$db->where($where)->count();
				$page=new \Think\Page($count,20);
				$page->setConfig('prev', '上一页');
				$page->setConfig('next', '下一页');
				$page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
				$show       = $page->show();
				$list=$db->where($where)->order('addtime desc')->limit($page->firstRow.','.$page->listRows)->select();
				foreach ($list as $key=>$val)
				{
					$list[$key]['image']=str_replace('/', '_', $val['image']);
				}
				$this->newslist = $list;
				$this->empty='<li>抱歉，没有找到与“'.$keyword.'”相关新闻</li>';
				$this->page=$show;
				$this->display('news');
			}elseif ($model=='product')
			{
				$areaset = M('Areaset');
				$areasetinfo = $areaset->find();
				$thisuser = M('Localuser')->where(array('id' => $_SESSION['userid']))->find();
				$area=$thisuser[$areasetinfo['checkname']];
				if($area=='')
				{
					$this->redirect('Main/index');
				}
				$pici = M('Area_pici')->where(array('areaname' => $area))->field('id,quotatime,title')->order('quotatime desc,time desc')->select();
		        $this->pici = $pici;
		        $where = "pici.areaname='$area' and pici.id=quota.pcID and quota.styleID=product.styleID and (product.styleID like '%$keyword%' or product.pname like '%$keyword%')";
		
		        $this->pcid = isset($_GET['pcid']) ? $_GET['pcid'] : '0';
		        if (isset($_GET['pcid'])) {
		            if ($_GET['pcid'] != 0) {
		                $where.=' and pici.id=' . $_GET['pcid'];
		                $piciInfo = M('Area_pici')->where(array('id' => $_GET['pcid']))->field('id,quotatime,title')->find();  // lizd11
		            }else{
		               $piciInfo = ""; 
		            }
		        }
		        /* 分类 */
		        $typenamelist = M()->table(array('tp_area_pici' => 'pici', 'tp_quota' => 'quota', 'tp_product' => 'product'))->where($where)->group('typename')->field('typename')->select();
		        $this->typenamelist = $typenamelist;
		        /* 风格 */
		        $typecodelist = M()->table(array('tp_area_pici' => 'pici', 'tp_quota' => 'quota', 'tp_product' => 'product'))->where($where)->group('typecode')->field('typecode')->select();
		        $this->typecodelist = $typecodelist;
		        /* 定位 */
		        $positionlist = M()->table(array('tp_area_pici' => 'pici', 'tp_quota' => 'quota', 'tp_product' => 'product'))->where($where)->group('position')->field('position')->select();
		        $this->positionlist = $positionlist;
		        
		        if (isset($_GET['condition'])) {
		        	$condition = explode('-', $_GET['condition']);
		        	$order = $condition[0];
		        	if ($order != '0') {
		        		$order_c = $order;
		        	} else {
		        		$order_c = 'time desc';
		        	}
		        	$rule = $condition[1];
		        	if ($rule != '0') {
		        		$where.=' and(';
		        		$rule = explode(',', $rule);
		        		foreach ($rule as $val) {
		        			$where.=' FIND_IN_SET("' . $val . '",product.rule) or';
		        		}
		        		$where = substr($where, 0, strlen($where) - 2);
		        		$where.=')';
		        		$this->rule = $rule;
		        	}
		        	$typecode = $condition[2];
		        	if ($typecode != '0') {
		        		$where.=' and(';
		        		$typecode = explode(',', $typecode);
		        		foreach ($typecode as $val) {
		        			$where.=' FIND_IN_SET("' . $val . '",product.typecode) or';
		        		}
		        		$where = substr($where, 0, strlen($where) - 2);
		        		$where.=')';
		        		$this->typecode = $typecode;
		        	}
		        
		        	$position = $condition[3];
		        	if ($position != '0') {
		        		$where.=' and(';
		        		$position = explode(',', $position);
		        		foreach ($position as $val) {
		        			$where.=' FIND_IN_SET("' . $val . '",product.position) or';
		        		}
		        		$where = substr($where, 0, strlen($where) - 2);
		        		$where.=')';
		        		$this->position = $position;
		        	}
		        	$typename = $condition[4];
		        	if ($typename != '0') {
		        		$where.=' and(';
		        		$typename = explode(',', $typename);
		        		foreach ($typename as $val) {
		        			$where.=' FIND_IN_SET("' . $val . '",product.typename) or';
		        		}
		        		$where = substr($where, 0, strlen($where) - 2);
		        		$where.=')';
		        		$this->typename = $typename;
		        	}
		        }
		        
		        $count = M()->table(array('tp_area_pici' => 'pici', 'tp_quota' => 'quota', 'tp_product' => 'product'))->where($where)->count();
		
		        $page = new \Think\Page($count, 40);
		        $page->setConfig('prev', '上一页');
		        $page->setConfig('next', '下一页');
		        $page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		        $show = $page->show();
		        $list = M()->table(array('tp_area_pici' => 'pici', 'tp_quota' => 'quota', 'tp_product' => 'product'))->where($where)->order($order_c)->limit($page->firstRow . ',' . $page->listRows)->field('product.*,quota.pcID')->select();
		        foreach ($list as $key => $val) {
		            $colorname = explode(',', $val['colorcode']);
		            $list[$key]['colorname'] = $colorname[0];
		        }
		                
		        // print_r($piciInfo);
		        $this->empty='<div>抱歉，没有找到与“'.$keyword.'”相关产品</div>';
		        $this->piciInfo = $piciInfo;
		        $this->list = $list;
		        $this->page = $show;
		        $this->display('product');
			}
			
		}else{
			 $this->redirect('Home/Main/index');
		}
	}
}

?>