<?php

namespace Admin\Controller;

use Common\Common\Controller\AdminController;
class ProductController extends AdminController{
	public function index()
	{
		$db=M('Product');
		$keyword=@$_GET['keyword']!=''?$_GET['keyword']:'';
		$this->keyword=$keyword;
		$where='';
		if ($keyword!='') {
			$where.="styleID like '%".$keyword."%' or pname like '%".$keyword."%'";
		}
		$count=$db->where($where)->order('sort desc,id asc')->count();
		$page=new \Think\Page($count,20);
		$page->setConfig('prev', '上一页');
		$page->setConfig('next', '下一页');
		$page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		$show       = $page->show();
		$list=$db->where($where)->order('sort desc,time desc,id desc')->limit($page->firstRow.','.$page->listRows)->select();
		foreach ($list as $key=>$val)
		{
			$list[$key]['colorcode']=str_replace(',', '-', $val['colorcode']);
		}
		
		$this->list=$list;
		$this->page=$show;
		$this->display();
	}
	public function add(){
		
		if ($_POST) {
			$db=D('Product');
			$is_find=$db->where(array('styleID'=>$_POST['styleID']))->find();
			if ($is_find) {
				$this->error('该款号以添加，请重新确认！');
			}
			if ($db->create()) {
				$id=$db->add();
				if ($id) {
					$db_color=M('Color');
					$colorname=explode('-', trim($_POST['colorcode']));
					foreach ($colorname as $val)
					{
						$iscolor=$db_color->where(array('codename'=>$val))->find();
						if (!$iscolor) {
							$data['codename']=$val;
							$id=$db_color->add($data);
						}
					}
					$this->success('添加成功',U('Product/index'));
				}else 
				{
					$this->error('添加失败');
				}
			}
		}else 
		{
			/* 产品分类 */
			/* $db_type=M('Product_type');
			$ptype=$db_type->select();
			$this->ptype=$ptype; */
			/* 颜色 */
			/* $db_color=M('Color');
			$pcolor=$db_color->select();
			$this->pcolor=$pcolor; */
			/* 尺码 */
			/* $db_rule=M('Rule');
			$prule=$db_rule->select();
			$this->prule=$prule; */
			$this->display();
		}
		
	}
	public function edit(){
		if($_POST)
		{
			$db=D('Product');
			if ($db->create()) {
				$isbool=$db->save();
				if ($isbool) {
					$db_color=M('Color');
					$colorname=explode('-', trim($_POST['colorcode']));
					foreach ($colorname as $val)
					{
						$iscolor=$db_color->where(array('codename'=>$val))->find();
						if (!$iscolor) {
							$data['codename']=$val;
							$id=$db_color->add($data);
						}
					}
					$this->success('修改成功',U('Product/index'));
				}else 
				{
					$this->error('修改失败');
				}
			}
		}else{
			$id=I('get.id',0,'intval');
			if (!$id) {
				$this->error('参数不存在');
			}
			$db=M('Product');
			$thisInfo=$db->find($id);
			$thisInfo['colorcode']=str_replace(',', '-', $thisInfo['colorcode']);
			$thisInfo['rule']=str_replace(',', '-', $thisInfo['rule']);
			$this->thisInfo=$thisInfo;
			$this->colorname=explode('-', $thisInfo['colorcode']);
			$this->display();
		}
		
		
	}
	public function del(){
		if ($_GET)
		{
			$id=I('get.id',0,'intval');
		}elseif ($_POST){
			$id=implode(',', $_POST['id']);
		}
		$db=M('Product');
		$isbool=$db->delete($id);
		if ($isbool) {
			$this->success('删除成功');
		}else 
		{
			$this->error('删除失败');
		}
	}
	public function import(){
		if ($_POST) {
			vendor('PHPExcel.PHPExcel');
			$cacheMethod = \PHPExcel_CachedObjectStorageFactory::cache_in_memory_gzip;
			$cacheSettings = array();
			\PHPExcel_Settings::setCacheStorageMethod($cacheMethod,$cacheSettings);
			$objPHPExcel = new \PHPExcel();
			$objPHPExcel = \PHPExcel_IOFactory::load($_FILES["inputExcel"]["tmp_name"]);
			$indata = $objPHPExcel->getSheet(0)->toArray();
			unset($indata[0]);
			unset($indata[1]);
			$db=M('Product');
			$db_color=M('Color');
			foreach ($indata as $arr)
			{
				//0:款号，  1：名称 ，2：产品类别， 3：风格，4：颜色色码，5：尺码，6：价格，7：库存，8：设计师，9：年份，10：季节，11：定位，12：描述
				//2015-3-3   5、7、8、11、12为非必填
				if($arr[0]!=null&&$arr[1]!=null&&$arr[2]!=null&&$arr[3]!=null&&$arr[4]!=null&&$arr[6]!=null&&$arr[9]!=null&&$arr[10]!=null)
				{
					/* $colorname=explode('-', trim($arr[3]));
					foreach ($colorname as $val)
					{
						$iscolor=$db_color->where(array('codename'=>$val))->find();
						if (!$iscolor) {
							$data['codename']=$val;
							$id=$db_color->add($data);
						}
					} */
					$colorname=trim($arr[4]);
					$rulename=trim($arr[5]);
					$iscolor=$db_color->where(array('codename'=>$colorname))->find();
					if (!$iscolor) {
						$data['codename']=$colorname;
						$id=$db_color->add($data);
					}
							
					//判断此款号是否存在
					$is_styleID=$db->where(array('styleID'=>trim($arr[0])))->find();
					$db->styleID=trim($arr[0]);
					$db->pname=trim($arr[1]);
					$db->typename=trim($arr[2]);
					$db->typecode=trim($arr[3]);
					
					//$db->rule=str_replace('-', ',', trim($arr[5]));
					$db->price=trim($arr[6]);
					$db->stock=trim($arr[7]);
					$db->designer=trim($arr[8]);
					$db->year=trim($arr[9]);
					$db->season=trim($arr[10]);
					$db->position=trim($arr[11]);
					$db->contents=trim($arr[12]);
					$db->time=time();
					if ($is_styleID) {
						$colorlist=explode(',', $is_styleID['colorcode']);
						if (!in_array($colorname, $colorlist)) {
							array_push($colorlist,$colorname);
							$is_styleID['colorcode']=implode(',', $colorlist);
						}
						$db->colorcode=$is_styleID['colorcode'];
						
						$rulelist=explode(',', $is_styleID['rule']);
						if (!in_array($rulename, $rulelist)) {
							array_push($rulelist,$rulename);
							$is_styleID['rule']=implode(',', $rulelist);
						}
						$db->rule=$is_styleID['rule'];
						//存在更新
						$id=$db->save();
					}else 
					{
						//不存在新增
						$db->colorcode=trim($arr[4]);
						$db->rule=trim($arr[5]);
						$id=$db->add();
					}
					
				}
				
			}
			$this->success('导入成功',U('Product/index'));
			/* if ($id) {
				$this->success('导入成功',U('Product/index'));
			}else 
			{
				$this->error('导入失败');
			} */
		}else 
		{
			$this->display();
		}
		
	}
	
	public function type(){
		$db=M('Product_type');
		$count=$db->order('id asc')->count();
		$page=new \Think\Page($count,20);
		$page->setConfig('prev', '上一页');
		$page->setConfig('next', '下一页');
		$page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		$show       = $page->show();
		$list=$db->order('id asc')->limit($page->firstRow.','.$page->listRows)->select();
		$this->list=$list;
		$this->page=$show;
		$this->display();
	}
	public function typeadd(){
		if ($_POST) {
			$db=M('Product_type');
			if($db->create()==true){
				$id=$db->add();
				if ($id) {
					$this->success('添加成功',U('Product/type'));
				}
				else
				{
					$this->error('添加失败');
				}
			}
		}else
		{
			$this->display();
		}
	}
	public function typeedit(){
		if ($_POST) {
			$db=M('Product_type');
			if ($db->create()) {
				$id=$db->save();
				if ($id) {
					$this->success('修改成功',U('Product/type'));
				}
				else
				{
					$this->error('修改失败');
				}
			}
		}else {
			$id=I('get.id',0,'intval');
			$info=M('Product_type')->find($id);
			$this->info=$info;
			$this->display();
		}
	}
	public function typedel(){
		if ($_GET)
		{
			$id=I('get.id',0,'intval');
		}elseif ($_POST){
			$id=implode(',', $_POST['id']);
		}
		$db=M('Product_type');
		$isbool=$db->delete($id);
		if ($isbool) {
			$this->success('删除成功');
		}else 
		{
			$this->error('删除失败');
		}
	}
	public function color(){ 
		$db=M('Color');
		$count=$db->order('id asc')->count();
		$page=new \Think\Page($count,20);
		$page->setConfig('prev', '上一页');
		$page->setConfig('next', '下一页');
		$page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		$show       = $page->show();
		$list=$db->order('id asc')->limit($page->firstRow.','.$page->listRows)->select();
		$this->list=$list;
		$this->page=$show;
		$this->display();
	}
	public function coloradd(){
		if ($_POST) {
			$db=M('Color');
			if($db->create()==true){
				$id=$db->add();
				if ($id) {
					$this->success('添加成功',U('Product/color'));
				}
				else 
				{
					$this->error('添加失败');
				}
			}
		}else 
		{
			$this->display();
		}
	}
	public function coloredit(){
		if ($_POST) {
			$db=M('Color');
			if ($db->create()) {
				$id=$db->save();
				if ($id) {
					$this->success('修改成功',U('Product/color'));
				}
				else 
				{
					$this->error('修改失败');
				}
			}
		}else {
			$id=I('get.id',0,'intval');
			$info=M('Color')->find($id);
			$this->info=$info;
			$this->display();
		}
	}
	public function colordel(){
		if ($_GET)
		{
			$id=I('get.id',0,'intval');
		}elseif ($_POST){
			$id=implode(',', $_POST['id']);
		}
		$db=M('Color');
		$isbool=$db->delete($id);
		if ($isbool) {
			$this->success('删除成功');
		}else 
		{
			$this->error('删除失败');
		}
	}
	public function rule()
	{
		$db=M('Rule');
		$count=$db->order('id asc')->count();
		$page=new \Think\Page($count,20);
		$page->setConfig('prev', '上一页');
		$page->setConfig('next', '下一页');
		$page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		$show       = $page->show();
		$list=$db->order('id asc')->limit($page->firstRow.','.$page->listRows)->select();
		$this->list=$list;
		$this->page=$show;
		$this->display();
	}
	public function ruleadd(){
		if ($_POST) {
			$db=M('Rule');
			if($db->create()==true){
				$id=$db->add();
				if ($id) {
					$this->success('添加成功',U('Product/rule'));
				}
				else
				{
					$this->error('添加失败');
				}
			}
		}else
		{
			$this->display();
		}
	}
	public function ruleedit(){
		if ($_POST) {
			$db=M('Rule');
			if ($db->create()) {
				$id=$db->save();
				if ($id) {
					$this->success('修改成功',U('Product/rule'));
				}
				else
				{
					$this->error('修改失败');
				}
			}
		}else {
			$id=I('get.id',0,'intval');
			$info=M('Rule')->find($id);
			$this->info=$info;
			$this->display();
		}
	}
	public function ruledel(){
		$id=I('get.id',0,'intval');
		$db=M('Rule');
		$isbool=$db->delete($id);
		if ($isbool) {
			$this->success('删除成功',U('Product/rule'));
		}
		else
		{
			$this->error('删除失败');
		}
	}
	public function analysis(){
		$db=M('Product');
		//产品总点击率
		$sum=$db->sum('click');
		$this->sum=$sum;
		//点击率前十款
		$maxlist=$db->order('click desc')->limit(10)->select();
		$this->maxlist=$maxlist;
		//赞前十款
		$zan=$db->max('zan');
		$this->zan=$zan;
		$zanlist=$db->order('zan desc')->limit(10)->select();
		$this->zanlist=$zanlist;
		/* 筛选条件 */
		//设计师
		$designer=$db->where(array('designer'=>array('neq','')))->group('designer')->field('designer')->select();
		$this->designer=$designer;
		//分类
		$type=$db->group('typename')->field('typename')->select();
		$this->type=$type;
		//年份
		$year=$db->group('year')->field('year')->select();
		$this->year=$year;
		
		$this->display();
	}
	public function result(){
		$designer=$_POST['designer'];
		if ($designer!='') {
			$where['designer']=array('in',$designer);
		}
		$typename=$_POST['typename'];
		if ($typename!='') {
			$where['typename']=array('in',$typename);
		}
		$year=$_POST['year'];
		if ($year!='') {
			$where['year']=array('in',$year);
		}
		$db=M('Product');
		$list=$db->field('styleID,click')->where($where)->select();
		$json=array();
		foreach ($list as $val){
			$json['styleID'][]=$val['styleID'];
			$json['click'][]=$val['click'];
		}
		return $this->ajaxReturn($json,'JSON');
	}
	public function export_prod(){
		header("Content-Typ:text/html;charset=utf-8");
		$designer=$_GET['designer'];
		if ($designer!='') {
			$where['designer']=array('in',$designer);
		}
		$typename=$_GET['typename'];
		if ($typename!='') {
			$where['typename']=array('in',$typename);
		}
		$year=$_GET['year'];
		if ($year!='') {
			$where['year']=array('in',$year);
		}
		vendor('PHPExcel.PHPExcel');
		$objPHPExcel = new \PHPExcel();
		$objPHPExcel->getActiveSheet()->setCellValue('A1', "款号");//设置列的值
		$objPHPExcel->getActiveSheet()->setCellValue('B1', "名称");//设置列的值
		$objPHPExcel->getActiveSheet()->setCellValue('C1', "分类");//设置列的值
		$objPHPExcel->getActiveSheet()->setCellValue('D1', "颜色");//设置列的值
		$objPHPExcel->getActiveSheet()->setCellValue('E1', "设计师");//设置列的值
		$objPHPExcel->getActiveSheet()->setCellValue('F1', "年份");//设置列的值
		$objPHPExcel->getActiveSheet()->setCellValue('G1', "点击率");//设置列的值
		$db=M('Product');
		$list=$db->field('styleID,pname,typename,colorcode,designer,year,click')->where($where)->select();
		$i=2;
		foreach ($list as $val){
			$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A'.$i,$val['styleID'])   //注意这里没有分号结束
			->setCellValue('B'.$i,$val['pname'])
			->setCellValue('C'.$i,$val['typename'])
			->setCellValue('D'.$i,$val['colorcode'])
			->setCellValue('E'.$i,$val['designer'])
			->setCellValue('F'.$i,$val['year'])
			->setCellValue('G'.$i,$val['click']);
			$i++;
		}
	
		$objPHPExcel->getActiveSheet(0)->setTitle('产品分析数据统计');
		$objPHPExcel->setActiveSheetIndex(0);
		header('Content-Type:application/vnd.ms-excel');
		header('Content-Disposition:attachment;filename="产品分析数据统计.xls"');
		header('Cache-Control: max-age=0');
		$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
	}
	public function dataupdate(){
		$styleID= $_POST['styleID'];
		$pname=$_POST['pname'];
		$typename=$_POST['typename'];
		$typecode=$_POST['typecode'];
		$colorcode=$_POST['colorcode'];
		$rule=$_POST['rule'];
		$price=$_POST['price'];
		$stock=$_POST['stock'];
		$designer=$_POST['designer'];
		$year=$_POST['year'];
		$season=$_POST['season'];
		$position=$_POST['position'];
		$contents=$_POST['contents'];
		$db=M('Product');
		$db_color=M('Color');

// 		echo $styleID.'-'.$pname.'-'.$typename.'-'.$typecode.'-'.$colorcode.'-'.$rule.'-'.$price.'-'.$stock.'-'.$designer.'-'.$year.'-'.$season.'-'.$position.'-'.$contents;
		if ($styleID!='null'&&$pname!='null'&&$typename!='null'&&$typecode!='null'&&$colorcode!='null'&&$rule!='null'&&$price!='null') {
					$colorname=trim($colorcode);
					$rulename=trim($rule);
					$iscolor=$db_color->where(array('codename'=>$colorname))->find();
					if (!$iscolor) {
						$data['codename']=$colorname;
						$id=$db_color->add($data);
					}
							
					//判断此款号是否存在
					$is_styleID=$db->where(array('styleID'=>trim($styleID)))->find();
					$db->styleID=trim($styleID);
					$db->pname=trim($pname);
					$db->typename=trim($typename);
					$db->typecode=trim($typecode);
					$db->price=trim($price);
					$db->stock=trim($stock);
					$db->designer=trim($designer);
					$db->year=trim($year);
					$db->season=trim($season);
					$db->position=trim($position);
					$db->contents=trim($contents);
					$db->time=time();
					if ($is_styleID) {
						$colorlist=explode(',', $is_styleID['colorcode']);
						if (!in_array($colorname, $colorlist)) {
							array_push($colorlist,$colorname);
							$is_styleID['colorcode']=implode(',', $colorlist);
						}
						$db->colorcode=$is_styleID['colorcode'];
						
						$rulelist=explode(',', $is_styleID['rule']);
						if (!in_array($rulename, $rulelist)) {
							array_push($rulelist,$rulename);
							$is_styleID['rule']=implode(',', $rulelist);
						}
						$db->rule=$is_styleID['rule'];
						//存在更新
						$id=$db->save();
						if ($id) {
							echo '0';
						}
					}else 
					{
						//不存在新增
						$db->colorcode=trim($colorcode);
						$db->rule=trim($rule);
						$id=$db->add();
						if ($id) {
							echo '1';
						}
					}
		}else{
			echo '2';
		}
	}
}

?>