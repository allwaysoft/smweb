<?php

namespace Admin\Controller;


use Common\Common\Controller\AdminController;
class PhotoController extends AdminController{
	public function index(){
		//获取本文件目录的文件夹地址
		$dirnames = $this->ReadFolder('Upload');
		// 数组降序排列
		rsort($dirnames);
		// 数组分页
		$count = count($dirnames);
		$page = new \Think\Page($count,10);
		$page->setConfig('prev', '上一页');
		$page->setConfig('next', '下一页');
		$page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		$lists = array_slice($dirnames, $page->firstRow,$page->listRows);
		$pages = $page->show();
		$this->page=$pages;
	
		//获取也就是扫描文件夹内的文件及文件夹名存入数组 $filesnames
	
		$this->dirnames=$lists;
		$this->display();
	}
	public function diradd(){
		if ($_POST['name']) {
			$dirname='Upload/'.$_POST['name'];
			/* 判断文件夹是否存在 */
			if(file_exists($dirname))
			{
				$this->error('该文件夹已存在');
			}
			if (mkdir($dirname,0777)) {
				$this->success('文件夹创建成功',U('Photo/index'));
			}
			else
			{
				$this->error('文件夹创建失败');
			}
		}else
		{
			$this->display();
		}
	}
	public function diredit(){
		if ($_POST) {
			$dirname='Upload/'.$_POST['dirname'];
			$name='Upload/'.$_POST['name'];
			if(file_exists($name))
			{
				$this->error('该文件夹已存在');
			}
			if (rename($dirname,$name)) {
				$this->success('文件夹修改成功',U('Photo/index'));
			}
			else
			{
				$this->error('文件夹修改失败');
			}
		}else
		{
			$this->dirname=$_GET['name'];
			$this->display();
		}
			
	}
	public function dirdel(){
		$name=$_GET['name'];
		if (!$name) {
			$this->error('参数错误');
		}
		$dir='Upload/'.$name;
		$files=$this->ReadFolder($dir);
	
		foreach ($files as $value)
		{
			unlink($dir.'/'.$value);
		}
	
		if (rmdir($dir)) {
			$this->success('删除成功',U('Photo/index'));
		}else
		{
			$this->error('删除失败');
		}
	}
	public function imageinfo(){
		$name=$_GET['name'];
		if (!$name) {
			$this->error('参数错误');
		}
		$this->name=$name;
		$dir='Upload/'.$name;
		$files=$this->ReadFolder($dir);
		foreach ($files as $key=>$val)
		{
			$prefix=$val[0].$val[1];
			if (($prefix=='B_')||($prefix=='M_')||($prefix=='S_')) {
				unset($files[$key]);
			}
		}
		$count = count($files);
		$page = new \Think\Page($count,20);
		$page->setConfig('prev', '上一页');
		$page->setConfig('next', '下一页');
		$page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		$lists = array_slice($files, $page->firstRow,$page->listRows);
		$pages = $page->show();
		$this->page=$pages;
		$this->dirnames=$lists;
		$this->display();
	}
	public function picdel(){
		$dir=$_GET['dir'];
		if (!$dir) {
			$this->error('无效参数');
		}
		$name=$_GET['name'];
		if (!$name) {
			$this->error('无效参数');
		}
		$path='Upload/'.$dir;
		if (is_array($name)) {
			foreach ($name as $val){
				unlink($path.'/'.$val);
				unlink($path.'/B_'.$val);
				unlink($path.'/M_'.$val);
				unlink($path.'/S_'.$val);
			}
		}else 
		{
			unlink($path.'/'.$name);
			unlink($path.'/B_'.$name);
			unlink($path.'/M_'.$name);
			unlink($path.'/S_'.$name);
		}
		$this->success('删除成功',U('Photo/imageinfo',array('name'=>$dir)));
	}
	/* 定义自定义函数 */
	/**
	 * 获取文件列表
	 *
	 * @param string  $dir  欲读取的目录路径
	 * @param boolean $mode 0：读取全部；1：仅读取文件；2：仅读取目录
	 * @return array
	 */
	function ReadFolder($dir, $mode = 0) {
		//如果打开目录句柄失败，则输出空数组
		if (!$handle = @opendir($dir)) return array();
		//定义文件列表数组
		$files = array();
		//遍历目录句柄中的条目
		while (false !== ($file = @readdir($handle))) {
			//跳过本目录以及上级目录
			if ('.' === $file || '..' === $file) continue;
			//是否仅读取目录
			if ($mode === 2) {
				if ($this->isDir($dir . '/' . $file)) $files[] = $file;
				//是否仅读取文件
			} elseif ($mode === 1) {
				if ($this->isFile($dir . '/' . $file)) $files[] = $file;
				//读取全部
			} else {
				$files[] = $file;
			}
		}
		//关闭打开的目录句柄
		@closedir($handle);
		//输出文件列表数组
		return $files;
	}
	/**
	 * 判断输入是否为目录
	 *
	 * @param string $dir
	 * @return boolean
	 */
	function isDir($dir) {
		return $dir ? is_dir($dir) : false;
	}
	/**
	 * 判断输入是否为文件
	 *
	 * @param string $file
	 * @return boolean
	 */
	function isFile($file) {
		return $file ? is_file($file) : false;
	}
	function deldir($dir) {
		//先删除目录下的文件：
		$dh=opendir($dir);
		$file=readdir($dir);
		foreach ($file as $value)
		{
			unlink($value);
		}
	
		closedir($dh);
		//删除当前文件夹：
		if(rmdir($dir)) {
			return true;
		} else {
			return false;
		}
	}
	public function batchupload(){
		$dirname=$_GET['name'];
		$this->dirname=$dirname;
		/* $time=date(DATE_RFC822);
		 $this->assign('time',$time); */
		$this->display();
	}
}

?>