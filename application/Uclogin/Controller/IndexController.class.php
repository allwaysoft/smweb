<?php

namespace Uclogin\Controller;

use Think\Controller;

class IndexController extends Controller {

    public function index() {
        // 用户中心API验证 
        $con = 0;
        $openid = @$_GET['openid'];
        $oToken = @$_GET['token'];
        $p = @$_GET['p'];
        if ($p) {
            $pnumber = $p;
        } else {
            $pnumber = 0;
        }

        if ($_SESSION['userid']) {
            if ($pnumber) {
                header('location:/index.php/Product/ucShow/styleID/' . $pnumber);
            } else {
                //  $this->redirect('/Main/index');
                header("location:/index.php/Main/index");
            }
        }


        if ($openid == false || $oToken == FALSE) {
            $data['ret_code'] = 10;
            $data['msg'] = 'URL参数错误！';
        } else {
            // 验证openid 和 token 是否合法
            $reValt = $this->uc_check($openid, $oToken, 'user_check');
            $reVal = json_decode($reValt);
            // print_r($reVal);
            if ($reVal->ret_code == 0) {  // 验证成功
                $con = 1;
                $t = $reUser->data;
                $token = $t->token;
            } else {
                $data = (array) $reVal;
            }

            if ($con == 1) {
                // 通过用户中心获取user_name
                $reUser = $this->uc_check($openid, $token, 'user_info');
                $reUser = json_decode($reUser);
                if ($reUser->ret_code == 0) {  // 验证成功
                    $accut = $reUser->data;
                    $uname = 'lizhendong'; //$accut->account;
                    $data = $this->checklogin($uname);
                } else {
                    $data = (array) $reVal;
                }
            }
        }
        // print_r($data);
        $this->pnumber = $pnumber;
        $this->data = $data;
        $this->display('Uclogin/index');
    }

    public function checklogin($uname) {
        $uname = $uname;
        $localName = M('Localuser')->where(array('user_name' => $uname))->find(); // localhost 检测是否有用户名 
        //var_dump($localName);
        if ($localName) {
            $data = $this->checkloginUser($localName, $password, $check);
        } else {
            //即时同步分销用户
            $loadFx = $this->IntoFenxiao(strtoupper($uname));
            //  var_dump($loadFx);
            if ($loadFx) {
                // DRP  
                $localName = M('Localuser')->where(array('user_name' => $uname))->find();
                $data = $this->checkloginUser($localName, $password, $check);
            } else {
                $data['ret_code'] = 11;
                $data['msg'] = '分销系统用户同步错误！';
            }
        }
        return $data;
    }

    public function IntoFenxiao($uname) {
        set_time_limit(0);
        $conn = oci_connect('sm_web', 'sm_web', '10.91.5.137/server_taf'); // conn orcel service 10.91.5.137--server_taf 10.91.5.93/smgerp
        if ($conn) {
            $sql = "select  * from zv_cust_smweb where PRSNL_NUM = '" . $uname . "'";
            $ora_test = oci_parse($conn, $sql); //编译sql语句
            oci_set_prefetch($ora_test, 300);
            oci_execute($ora_test);
            $nrows = oci_fetch_all($ora_test, $res, 0, 30000, OCI_FETCHSTATEMENT_BY_ROW);
            // echo $nrows;
            //  echo "$nrows rows fetched<br>\n";
            //  print_r($res);
            //  exit();
            if ($res) {
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
                }
                return true;
            } else {
                return FALSE;
            }
            //$a = $nrows - $i;
            // echo "导入用户成功，重复用户 " . $a . ", 共有 " . $i . " 用户导入";
        } else {
            //  echo "sdfdf";
            //var_dump($conn);
            $e = oci_error();   // For oci_connect errors pass no handle
            //  echo var_dump($e);
            // echo var_dump(htmlentities($e['message'], ENT_QUOTES));
            // echo "<h4>无法连接到 分销系统 服务器</h4>";
            return FALSE;
        }
    }

    /**
     * 
     */
    public function checkloginUser($local, $password, $check) {
        $days = (time() - $local['last_time']) / (3600 * 24);
        switch ($local['user_type']) {   // 用户状态限制获取
            case 0:
                $activedate = C('local_active');
                $freedate = C('local_free');
                $lockdate = C('local_lock');
                break;
            case 1:
                $activedate = C('domain_active');
                $freedate = C('domain_free');
                $lockdate = C('domain_lock');
                break;
            case 2:
                $activedate = C('drp_active');
                $freedate = C('drp_free');
                $lockdate = C('drp_lock');
                break;
        }
        //   print_r($local);
        if ($local['login_state'] == 2) {
            //锁定
            $data['ret_code'] = 12;
            $data['msg'] = '分销系统用户被锁定！';
            return $data;
            die();
        } else if ($local['states'] == 1) {
            //禁用
            $data['ret_code'] = 13;
            $data['msg'] = '分销系统用户被禁用！';
            return $data;
            die();
        } else if ($days >= $lockdate && $local['last_time'] != 0) {
            M('Localuser')->where(array('user_name' => $local['user_name']))->save(array('login_state' => 2));
            $data['ret_code'] = 14;
            $data['msg'] = '分销系统用户被商务网锁定！';
            return $data;
            die();
        } else {

            //$ip = get_client_ip(); // thinkphp 获取ip地址
            $ip = $_SERVER["HTTP_CDN_SRC_IP"]; // cdn加速后获取的真实IP地址
            $logs = M('Local_loginlogs');
            $logs->uid = $local['id'];
            $logs->ip = $ip;
            $ipInfos = $this->getIPLoc_sina($ip);
            if ($ipInfos->country != '' || $ipInfos->province != '') {
                $logs->ip_add = $ipInfos->country . '-' . $ipInfos->province . '-' . $ipInfos->city . '-' . $ipInfos->district;
                if ($local['province'] != '' && $local['city'] != '') {
                    if ($local['province'] == $ipInfos->province && $local['city'] == $ipInfos->city) {
                        $logs->state = 0;  //IP正常
                    } else {
                        $logs->state = 1;  //IP异常
                    }
                } elseif ($local['province'] != '' && $local['city'] == '') {
                    if ($local['province'] == $ipInfos->province) {
                        $logs->state = 0;  //IP正常
                    } else {
                        $logs->state = 1;  //IP异常
                    }
                } elseif ($local['province'] == '' && $local['city'] == '') {
                    $logs->state = 2; //IP无法匹对
                }
            } else {
                $logs->ip_add = '本地局域网';
                $logs->state = 3; //IP无法解析
            }


            $logs->time = time();
            $id = $logs->add();
            $data['last_time'] = time();
            $data['session_id'] = session_id();
            if ($days >= $freedate && $days < $lockdate) {
                $data['login_state'] = 1;
            } elseif ($days >= $activedate) {
                $data['login_state'] = 0;
            }
            M('Localuser')->where(array('user_name' => $local['user_name']))->save($data);

            session('userid', $local['id']);
            session('user_name', $local['user_name']);
            session('user_type', $local['user_type']);

            if ($check == 1) {
                cookie("uname", $local['user_name']);
                cookie("pw", $password);
            }

            $data['ret_code'] = 0;
            $data['msg'] = '登录成功！';
            return $data;
        }
    }

    /**
     * 新浪IP解析
     * @param $queryIP IP地址
     * @return IP所有参数  */
    function getIPLoc_sina($queryIP) {
        $url = 'http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&ip=' . $queryIP;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_ENCODING, 'utf8');
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // 获取数据返回
        $location = curl_exec($ch);
        $location = json_decode($location);
        curl_close($ch);
        return $location;
    }

    /*
     * 用户中心测试
     */

    public function uc_urlRed() {
        $uname = $_SESSION['user_name'];
        //$uname = 'abcd';
        // 上报登录信息
        $reValt = $this->uc_login($uname);
        $reVal = json_decode($reValt);
        print_r($reValt);
    }

    function uc_check($openid, $token, $type) {
        $ch = curl_init();
        $timeout = 5;
        $up['appid'] = 3;
        $appKey = '55143ff8b6676d1302ef1d81cc2ec190';
        $up['timestamp'] = time();
        //print_r($up);
        $up['app_signature'] = md5($appKey . $up['timestamp']);
        $up['service_type'] = $type;
        $up['service_args'] = array(
            "openid" => $openid,
            "token" => $token
        );

        $code = json_encode($up, JSON_UNESCAPED_UNICODE);
        // print_r($code);
        curl_setopt($ch, CURLOPT_URL, "http://122.144.142.195:8088/webAPI/webapi");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // https请求 不验证证书和hosts
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "data=$code");
        $file_contents = curl_exec($ch);

        curl_close($ch);
        // print_r($file_contents);
        return $file_contents;
    }

    function uc_login($uname) {
        $ch = curl_init();
        $timeout = 5;
        $up['appid'] = 3;
        $appKey = '55143ff8b6676d1302ef1d81cc2ec190';
        $up['timestamp'] = time();

        $up['app_signature'] = md5($appKey . $up['timestamp']);
        $up['service_type'] = "user_login";
        $up['service_args'] = array(
            "account" => $uname,
            "openid" => ""
        ); 
        $code = json_encode($up, JSON_UNESCAPED_UNICODE); 
        // exit;
        curl_setopt($ch, CURLOPT_URL, "http://dlsinfo.semir.cn/webAPI/webapi");
        // echo"sdf";
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // https请求 不验证证书和hosts
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "data=$code");
        // print_r($ch);
        $file_contents = curl_exec($ch);

        curl_close($ch);
       // print_r($file_contents);
        return $file_contents;
    }

}
