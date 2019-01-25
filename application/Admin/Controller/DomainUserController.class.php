<?php

namespace Admin\Controller;

use Common\Common\Controller\AdminController;

class DomainUserController extends AdminController {

    public function DomainUserindex() {

        $db = M('Localuser');
    	$where['user_type']=1;
		$keyword = @$_GET['keyword'];
		$this->keyword = $keyword;
		if ($keyword!='') {
			$where['_string']='(user_name like "%'.$keyword.'%")OR(name like "%'.$keyword.'%")';
		}
		$condition=@$_GET['condition'];
		$this->condition=$condition;
		switch ($condition){
			case 'L_active':
				$where['login_state']=0;
				break;
			case 'L_free':
				$where['login_state']=1;
				break;
			case 'L_lock':
				$where['login_state']=2;
				break;
			case 'S_open':
				$where['states']=0;
				break;
			case 'S_lock':
				$where['states']=1;
				break;
		}
        $count = $db->where($where)->order('id desc')->count();
        $page = new \Think\Page($count, 20);
        $page->setConfig('prve', '上一页');
        $page->setConfig('next', '下一页');
        $page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $show = $page->show();
        $list = $db->where($where)->order('id desc')->limit($page->firstRow . ',' . $page->listRows)->select();
        foreach ($list as $key=>$val){
        	$log_ip=M('Local_loginlogs')->field('state')->where(array('uid'=>$val['id']))->order('id desc')->limit(50)->select();
        	$state=array();
        	foreach ($log_ip as $v){
        		$state[]=$v['state'];
        	}
        	if (in_array(1, $state)||in_array(2, $state)||in_array(3, $state)) {
				$list[$key]['qure']=1;
			}else{
				$list[$key]['qure']=0;
			}
        		
        }
        $this->list = $list;
        $this->page = $show;
        $this->display();
    }

    public function DomainUserimport() {
            $this->display();
        
    }
    public function DomainUserExcel() {
            if ($_POST) {
            vendor('PHPExcel.PHPExcel');
            $cacheMethod = \PHPExcel_CachedObjectStorageFactory::cache_in_memory_gzip;
            $cacheSettings = array();
            \PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);
            $objPHPExcel = new \PHPExcel();
            $objPHPExcel = \PHPExcel_IOFactory::load($_FILES["inputExcel"]["tmp_name"]);
            $indata = $objPHPExcel->getSheet(0)->toArray();
            unset($indata[1]);
            $db = M('Localuser');
            foreach ($indata as $arr) {
                $user_name = trim($arr[0]);
                $data['province'] = trim($arr[1]);
                $data['area1'] = trim($arr[2]);
                $data['area2'] = trim($arr[3]);
                $id = $db->where(array('user_name' => $user_name))->save($data);
            }
            $this->success('导入成功', U('DomainUser/DomainUserindex'));
        } else {
            $this->display();
        }
        
    }
    public function DomainUseradd() {
        if ($_POST) {
            $db = M('Localuser');
            $find = $db->where(array('user_name' => $_POST['username']))->find();
            if ($find) {
                $this->error('该用户名已存在');
            } else {
                $data['user_name'] = $_POST['username'];
                $data['name'] = $_POST['name'];
                $data['deptname'] = $_POST['deptname'];
                $data['province'] = $_POST['province'];
                if ($data['province'] == 1) {
                    $data['province'] = $_POST['p1'];
                }
                $data['area1'] = $_POST['area1'];
                if ($data['area1'] == 1) {
                    $data['area1'] = $_POST['a1'];
                }
                $data['area2'] = $_POST['area2'];
                if ($data['area2'] == 1) {
                    $data['area2'] = $_POST['a2'];
                }
                $data['email'] = $_POST['email'];
                $data['phone'] = $_POST['mobile'];
                $data['states'] = $_POST['states'];
                $data['create_time'] = time();
                $data['user_type'] = 1;
                $id = $db->add($data);
                if ($id) {
                    $this->success('添加成功', U('DomainUser/DomainUserindex'));
                } else {
                    $this->error('添加失败');
                }
            }
        } else {
            $listPro = M('Localuser')->field('province')->where()->group('province')->select();
            $listA1 = M('Localuser')->field('area1')->where()->group('area1')->select();
            $listA2 = M('Localuser')->field('area2')->where()->group('area2')->select();
            // var_dump($list);
            $this->listPro = $listPro;
            $this->listA1 = $listA1;
            $this->listA2 = $listA2;
            $this->display();
        }
    }

    public function DomainUseredit() {
        if ($_POST) {
        	
            $db = M('Localuser');
            $data['province'] = $_POST['province'];
            if ($data['province'] == 1) {
                $data['province'] = $_POST['p1'];
            }
            $data['area1'] = $_POST['area1'];
            if ($data['area1'] == 1) {
                $data['area1'] = $_POST['a1'];
            }
            $data['area2'] = $_POST['area2'];
            if ($data['area2'] == 1) {
                $data['area2'] = $_POST['a2'];
            }
            $data['email'] = $_POST['email'];
            $data['phone'] = $_POST['mobile'];
            $data['states'] = $_POST['states'];
            $data['user_type'] = 1;
            $id = $db->where(array('id' => $_POST['id']))->save($data);
            if ($id) {
                $this->success('修改成功', U('DomainUser/DomainUserindex'));
            } else {
                $this->error('修改失败');
            }
        } else {
            $id = intval($_GET['id']);
            $db = M('Localuser');
            $user = $db->find($id);
            $listPro = M('Localuser')->field('province')->where()->group('province')->select();
            $listA1 = M('Localuser')->field('area1')->where()->group('area1')->select();
            $listA2 = M('Localuser')->field('area2')->where()->group('area2')->select();
            // var_dump($list);
            $this->listPro = $listPro;
            $this->listA1 = $listA1;
            $this->listA2 = $listA2;
            $this->user = $user;
            $this->display();
        }
    }

    public function DomainUserdel() {
        if ($_GET) {
            $id = I('get.id', 0, 'intval');
        } elseif ($_POST) {
            $id = implode(',', $_POST['id']);
        }
        $db = M('Localuser');
        $isbool = $db->delete($id);
        if ($isbool) {
            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }
    }

    public function DomainUser() {
        $db = M('Localuser');
        $id = $db->delete($_GET['id']);
        if ($id) {
            $this->success('删除成功', U('DomianUser/DomianUserindex'));
        } else {
            $this->error('删除失败');
        }
    }
    
    public function logs(){
    	$where="b.id=a.uid and b.user_type=1";
    	if($_GET['id'])
    	{
    		$uid = I('get.id',0,'intval');
    		$where.=" and a.uid=$uid";
    	}
    	$keyword=@$_GET['keyword']!=''?$_GET['keyword']:'';
    	$this->keyword=$keyword;
    	$where.=@$_GET['keyword']!=''?' and b.user_name LIKE "%'.$keyword.'%"':'';
    	$db=M('Local_loginlogs');
    	$count=M()->table(array('tp_local_loginlogs' => 'a', 'tp_localuser' => 'b'))->where($where)->count();
    	$page=new \Think\Page($count,20);
    	$page->setConfig('prev', '上一页');
    	$page->setConfig('next', '下一页');
    	$page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
    	$show       = $page->show();
    	$list=M()->table(array('tp_local_loginlogs' => 'a', 'tp_localuser' => 'b'))->field('b.user_name as uname,a.*')->where($where)->limit($page->firstRow.','.$page->listRows)->order('time desc')->select();
    	$this->list=$list;
    	$this->page=$show;
    	$this->display();
    }
    public function logsdel(){
    	$id=implode(',', $_POST['id']);
    	$db=M('Local_loginlogs');
    	$isbool=$db->delete($id);
    	if ($isbool) {
    		$this->success('删除成功');
    	}else
    	{
    		$this->error('删除失败');
    	}
    }

    /*
     * 同步AD域用户
     */

    public function DomainUserIntoAd() {
        $ldapconn = ldap_connect("10.90.18.5");        //连接ad服务
        ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);    //设置参数
        $ldap_bd = ldap_bind($ldapconn, "AppSystem", "Semir@app");                    //打开ldap，正确则返回true。登陆
        if ($ldap_bd) {
            $justthese = array('samaccountname', "dn","displayname");
            $sr = ldap_search($ldapconn, "OU=森马集团,OU=Semir,dc=semir,dc=cn", "(&(objectClass=user)(!(UserPrincipalName= 'DC=Semir,DC=cn')))", $justthese, null, $sizelimit = 5000);

            $info = ldap_get_entries($ldapconn, $sr);
           // print_r($info);
            for ($i = 0; $i < $info["count"]; $i++) {
                //  echo $i;
              //  $val['samaccountname'][0]; ///////////////////////////
                //  echo "中文名为: " . $info[$i]["displayname"][0] . "<br>";
              // echo "email 为: " .$info[$i]['samaccountname'][0] . "<p>";
                $dn = explode(",", $info[$i]["dn"]);
                $name = explode("=", $dn[0]);
                $dept = explode("=", $dn[1]);
                $data['user_name'] = $info[$i]['samaccountname'][0];
                $data['name'] = $info[$i]["displayname"][0];
                $data['deptname'] = $dept[1];
                $data['email'] = $info[$i]['samaccountname'][0] . '@semir.com';
                $data['states'] = 0;
                $data['create_time'] = time();
                $data['user_type'] = 1;
                $userTemp = M('Localuser')->where(array('user_name' => $info[$i]['samaccountname'][0]))->save($data);
                if ($userTemp) {
                    $id = M('Localuser')->where(array('user_name' => $info[$i]['samaccountname'][0]))->save($data);
                } else {
                    $id = M('Localuser')->add($data);
                }
            }
            echo "导入用户成功，共有 " . $info["count"] . " 用户导入";


            ldap_close($ldapconn);
        } else {
            echo "<h4>无法连接到 LDAP 服务器</h4>";
        }
    }

    /*
     * 检测 本地是否已经有此用户 或 AD域是否有此用户，并load Ad userinformaton
     */

    public function adUserCheck() {
        $key = $_POST['k'];
        $locUser = M('Localuser')->where(array('user_name' => $key))->find();
        // print_r($locUser);
        if ($locUser) {
            $this->ajaxReturn(array('t' => 1, 'm' => '系统中已经有此用户了!!'), 'JSON');
        } else {
            // load AD 
            $ldapconn = ldap_connect("10.90.18.5");        //连接ad服务
            ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);    //设置参数
            $ldap_bd = ldap_bind($ldapconn, "AppSystem", "Semir@app");                    //打开ldap，正确则返回true。登陆
            if ($ldap_bd) {
                $justthese = array("samaccountname", "mail", "memberof", "department", "displayname", "telephonenumber", "primarygroupid", "objectsid");
                $result = ldap_search($ldapconn, "OU=Semir,DC=Semir,DC=cn", "(UserPrincipalName=$key)", $justthese);    //根据条件搜索，我这边搜索的是要查看ad域中是否有改字段。这是一个相当于or的搜索
                $info = ldap_get_entries($ldapconn, $result); //获取认证用户的信息
             //   print_r($info);
                if ($info['count'] == 1) {
                    $in = $info[0];
                    $dn = explode(",", $in['dn']);
                    $dn1 = explode("=", $dn[1]);
                    $adUserinfo = array('itname' => $key, 'cname' => $in['displayname'][0], 'deptname' => $dn1[1], 'email' => $in['mail'][0]);
                    $this->ajaxReturn(array('t' => 0, 'm' => $adUserinfo), 'JSON');
                } else {
                    $this->ajaxReturn(array('t' => 2, 'm' => 'AD 域无此用户!!'), 'JSON'); //AD 域无此用户
                }
                ldap_close($ldapconn); //关闭
            } else {
                $this->ajaxReturn(array('t' => 3, 'm' => '无法连接 AD 域!!'), 'JSON');
            }
        }
    }

}

?>