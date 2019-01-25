<?php

namespace Home\Controller;

use Think\Controller;
class ApiController extends Controller{
	public function userinfo(){
		if($_REQUEST){
			if($_REQUEST['key']!='75a9fa05c26ec5fdf80d6b1ee555789f')
			{
				$data=array(
					'code'=>1,
					'msg'=>'验证KEY错误'
				);
			}else 
			{
				$db=M('Localuser');
				$user_name=$_REQUEST['user_name'];
				$password=$_REQUEST['password'];
				$result=$db->where(array('user_name'=>$user_name))->find();
				
				
				if (!$result) {
					$data=array(
						'code'=>3,
						'msg'=>'账号不存在'
					);
				}else 
				{
					if ($result['user_type']==0) {
						//本地用户
						if ($result['password']==md5($password)) {
							$data=array(
								'code'=>0,
								'msg'=>'账号名、密码正确',
								'data'=>array(
									'user_name'=>$result['user_name'],
									'password'=>$result['password'],
									'name'=>$result['name'],
									'phone'=>$result['phone'],
									'email'=>$result['email'],
									'bumen'=>$result['deptname'],
									'shengfen'=>$result['province'],
									'daqu'=>$result['area1'],
									'xiaoqu'=>$result['area2']
								)
							);
						}else{
							$data=array(
									'code'=>2,
									'msg'=>'账号名或者密码错误'
							);
						}
					}elseif ($result['user_type']==1){
						//网域用户
						$ad=A('Index');
						if ($ad->adUserCheck($user_name,$password)) {
							$data=array(
								'code'=>0,
								'msg'=>'账号名、密码正确',
								'data'=>array(
									'user_name'=>$result['user_name'],
									'password'=>$result['password'],
									'name'=>$result['name'],
									'phone'=>$result['phone'],
									'email'=>$result['email'],
									'bumen'=>$result['deptname'],
									'shengfen'=>$result['province'],
									'daqu'=>$result['area1'],
									'xiaoqu'=>$result['area2']
								)
							);
						}else 
						{
							$data=array(
									'code'=>2,
									'msg'=>'账号名或者密码错误'
							);
						}
					}elseif($result['user_type']==2){
						//分销用户
						$drp=A('Index');
						if ($drp->drpUserCheck($user_name,$password)) {
							$data=array(
								'code'=>0,
								'msg'=>'账号名、密码正确',
								'data'=>array(
									'user_name'=>$result['user_name'],
									'password'=>$result['password'],
									'name'=>$result['name'],
									'phone'=>$result['phone'],
									'email'=>$result['email'],
									'bumen'=>$result['deptname'],
									'shengfen'=>$result['province'],
									'daqu'=>$result['area1'],
									'xiaoqu'=>$result['area2']
								)
							);
						}else 
						{
							$data=array(
									'code'=>2,
									'msg'=>'账号名或者密码错误'
							);
						}
						
					}
					
				}
			}
			$this->ajaxReturn($data,'JSON');
		}else{
                    echo "没有参数或参数错误！！！";
                }
			
		
	}
}

?>