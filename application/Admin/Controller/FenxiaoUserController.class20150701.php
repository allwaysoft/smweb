<?php

namespace Admin\Controller;

use Common\Common\Controller\AdminController;

class FenxiaoUserController extends AdminController {
    /*
     * user list
     * user_type = 0, 0= 本机用户，1= 网域（AD）用户，2=分销系统(道讯)用户
     */

    public function index() {

        $db = M('Localuser');
    	$where['user_type']=2;
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

    public function import() {

        $this->display();
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

    public function edit() {
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
                $this->success('修改成功', U('/FenxiaoUser/index'));
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

    public function del() {
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
    public function logs(){
    	$where="b.id=a.uid and b.user_type=2";
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
     * 同步分销系统用户
     */

    public function IntoFenxiao() {
        set_time_limit(0);
        $conn = oci_connect('sm_web', 'sm_web', '10.91.5.93/smgerp'); // conn orcel service
        if ($conn) {
            $sql = "select  * from zv_cust_smweb";
            $ora_test = oci_parse($conn, $sql); //编译sql语句
            oci_set_prefetch($ora_test, 300);
            oci_execute($ora_test);
            $nrows = oci_fetch_all($ora_test, $res, 0, 30000, OCI_FETCHSTATEMENT_BY_ROW);
            // echo $nrows;
            //  echo "$nrows rows fetched<br>\n";
            //print_r($res);
            /// exit();
            $i = 0;
            foreach ($res as $row) {
                // echo $row['PRSNL_NUM'];
                $data['user_name'] = $row['PRSNL_NUM'];
                $data['name'] = mb_convert_encoding($row['FULL_NAME'], 'utf-8', 'gbk');
                $data['deptname'] = mb_convert_encoding($row['UNIT_NAME'], 'utf-8', 'gbk');
                $data['province'] = mb_convert_encoding($row['SHENGFEN'], 'utf-8', 'gbk');
                $data['area2'] = mb_convert_encoding($row['QUYU'], 'utf-8', 'gbk');
                $data['email'] = '';
                $data['states'] = 0;
                $data['create_time'] = time();
                $data['user_type'] = 2;
                $userTemp = M('Localuser')->where(array('user_name' => $row['PRSNL_NUM']))->find();
                if ($userTemp) {
                   // echo "";
                    // $id = M('Localuser')->where(array('user_name' => $row['PRSNL_NUM']))->save($data);
                } else {
                    $i++;
                     M('Localuser')->add($data);
                }

                // $i++;
//                if ($i > 4) {
//                    break;
//                }
            }
            $a = $nrows-$i;
            echo "导入用户成功，重复用户 ".$a.", 共有 " . $i. " 用户导入";
        } else {
            echo "<h4>无法连接到 分销系统 服务器</h4>";
        }
    }

}

?>