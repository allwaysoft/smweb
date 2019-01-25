<?php

namespace Wxqyh\Controller;

//use Wxqyh\Common\UserController;
//use Wxqyh\Common\UserController;
use Think\Controller;

class IndexController extends Controller {

    public function index() {
        $logUname = @cookie('logUname');
        //echo $_GET['sign'] . '<br>';
        //获取完整的url 
  //echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['REQUEST_URI'];
#http://localhost/blog/testurl.php?id=5
        //   exit;
         // dd user set
        $param = base64_decode($_GET['param']);
         //echo $param . '<br>';exit;
       // echo $param . 'zu2XTKWm7Pz0Ix4A<br>';
        $shatemp = sha1($param . 'zu2XTKWm7Pz0Ix4A');
      //   echo $shatemp;
        $userinfo = $this->convertUrlQuery($param);
       //exit;
        //echo $logUname;
        if ($logUname) {
            $this->redirect('Wxqyh/Main/index');
            //   exit;
        } else {
            // 获取微信用户名
            $code = @$_GET['code'];

            $url = 'user/getuserinfo';
            $reVal = $this->curl_get("code=$code", $url);
            if ($reVal->UserId) {
                $user_name = $reVal->UserId;
            }
            if ($userinfo['ddid']) {
                $user_name = $userinfo['uid'];
                //$UserInfot = M('Localuser')->where(array('user_name' => $user_name))->find();
            }

            $UserInfo = M('Localuser')->where(array('user_name' => $user_name))->find();
            if ($UserInfo) {
                $v = $this->checkloginUser($UserInfo, 'Null', 1);
                if ($v == 0) {
                    $this->redirect('Wxqyh/Main/index');
                } else {
                    $this->display();
                }
            } else {
                $this->display();
            }
        }
    }

    public function checklogin() {

        $uname = $_POST['sendname'];
        $password = $_POST['pword'];
        $localName = M('Localuser')->where(array('user_name' => $uname))->find(); // localhost 检测是否有用户名
        // save password
        $db = M('Localuser');
        $data['password'] = $_POST['password'];
        $db->where(array('user_name' => $uname))->save($data);

        // var_dump($localName);
        if ($localName) {

            if ($localName['user_type'] == 0) {
                $local = M('Localuser')->where(array('user_name' => $uname, 'password' => md5($password)))->find();
                if ($local) {
                    $this->checkloginUser($local, $password, $check);
                } else {
                    die('4'); // 密码错误
                }
            } elseif ($localName['user_type'] == 1) {
                // ad 域用户认证
                $adLoing = $this->adUserCheck($uname, $password, $check);
                // var_dump($adLoing);
                if ($adLoing) {
                    $local = M('Localuser')->where(array('user_name' => $uname))->find();
                    $this->checkloginUser($local, $password, $check);
                } else {
                    die('4'); // 密码错误
                }
            } elseif ($localName['user_type'] == 2) {
                // DRP 分销系统用户认证
                $drpLoing = $this->drpUserCheck(strtoupper($uname), $password);
                if ($drpLoing) {
                    $local = M('Localuser')->where(array('user_name' => $uname))->find();
                    $this->checkloginUser($local, $password, $check);
                } else {
                    // die('4'); // 密码错误
                    $local = M('Localuser')->where(array('user_name' => $uname, 'password' => md5($password)))->find();
                    if ($local) {
                        die('0');
                    } else {
                        die('4'); // 密码错误
                    }
                }
            }
        } else {
            //即时同步分销用户
            $loadFx = $this->IntoFenxiao(strtoupper($uname));
            // var_dump($loadFx);
            if ($loadFx) {
                // DRP 分销系统用户认证
                $drpLoing = $this->drpUserCheck(strtoupper($uname), $password);
                if ($drpLoing) {
                    $local = M('Localuser')->where(array('user_name' => $uname))->find();
                    $this->checkloginUser($local, $password, $check);
                } else {
                    // die('4'); // 密码错误
                    $local = M('Localuser')->where(array('user_name' => $uname, 'password' => md5($password)))->find();
                    if ($local) {
                        die('0');
                    } else {
                        die('4'); // 密码错误
                    }
                }
            } else {
                ////////
                die('5'); // 无此用户名
            }
        }
    }

    public function IntoFenxiao($uname) {
        set_time_limit(0);
        exit;
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
        //print_r($local);
        if ($local['login_state'] == 2) {
            //锁定
            echo '2';
        } else if ($local['states'] == 1) {
            //禁用
            echo '3';
        } else if ($days >= $lockdate && $local['last_time'] != 0) {
            M('Localuser')->where(array('user_name' => $local['user_name']))->save(array('login_state' => 2));
            echo '2';
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


            cookie("logUname", $local['user_name']);
            cookie("pw", $password);

            //  echo "3333=" . cookie("logUname");
            echo '0';
            // exit;
        }
    }

    /**
     * 检测 本地是否已经有此用户 或 AD域是否有此用户，并load Ad userinformaton
     */
    public function adUserCheck($username, $password) {
        // load AD 
        return TRUE;
        $ldapconn = ldap_connect("10.90.18.5");        //连接ad服务
        ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);    //设置参数
        $ldap_bd = ldap_bind($ldapconn, "AppSystem", "Semir@app");                    //打开ldap，正确则返回true。登陆
        if ($ldap_bd) {
            $bd = ldap_bind($ldapconn, $username . '@semir.cn', $password);
            if ($bd) {
                return TRUE;
            } else {
                return FALSE;
            }
            ldap_close($ldapconn); //关闭
        } else {
            return FALSE;
        }
    }

    /**
     * 检测 DRP 分销系统
     */
    public function drpUserCheck($username, $password) {
        // load DRP user 
        vendor('nusoap.nusoap');
        // 要访问的webservice路径
        //$NusoapWSDL = "http://ums.zj165.com:8888/sms_hb/services/Sms?wsdl";
        $NusoapWSDL = "http://10.90.104.110:8080/axis2/services/UserSvc?wsdl";
        // 生成客户端对象
        $client = new \SoapClient($NusoapWSDL);

        if ($client) {
            $param = array('brandId' => '03', // 企业码 
                'userCode' => $username, // 帐号
                'password' => $password // 密码
            );
            // 调用远程方法
            $result = $client->validatePassword($param);
            //print_r($result);
            if ($result->return == "T") {
                return TRUE;
            } else {
                // print_r($result);
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    /**
     * 获取服务器的session_id
     * */
    public function getSessionid() {
        $handle = opendir(session_save_path());
        $sessionid = array();
        while (false !== ($file = readdir($handle))) {
            if (!in_array($file, array('.', '..', 'session_dir'))) {
                $sessionid[] = substr($file, 5);
            }
        }
        closedir($handle);
        return $sessionid;
    }

    /**
     * 将字符串参数变为数组
     * @param $query
     * @return array array (size=10)
      'm' => string 'content' (length=7)
      'c' => string 'index' (length=5)
      'a' => string 'lists' (length=5)
      'catid' => string '6' (length=1)
      'area' => string '0' (length=1)
      'author' => string '0' (length=1)
      'h' => string '0' (length=1)
      'region' => string '0' (length=1)
      's' => string '1' (length=1)
      'page' => string '1' (length=1)
     */
    function convertUrlQuery($query) {
        $queryParts = explode('&', $query);
        $params = array();
        foreach ($queryParts as $param) {
            $item = explode('=', $param);
            $params[$item[0]] = $item[1];
        }
        return $params;
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
     * qyh class &&& tools
     */

    public function qyh_send_temp() {
        $code = array(
            'touser' => 'lizhendong',
            'toparty' => '',
            'totag' => '',
            'msgtype' => 'news',
            'agentid' => '7',
            'text' =>
            array(
                'content' =>
                array(
                    0 =>
                    array(
                        'title' => '测试一',
                        'description' => '详细内容',
                        'url' => 'http://w.semir.cn/wxqyh.php/Main/newsdetail/nid/5592.html',
                        'picurl' => '',
                    ),
                    1 =>
                    array(
                        'title' => '测试二',
                        'description' => '详细内容2',
                        'url' => 'http://w.semir.cn/wxqyh.php/Main/newsdetail/nid/5592.html',
                        'picurl' => '',
                    ),
                    2 =>
                    array(
                        'title' => '测试三',
                        'description' => '详细内容2',
                        'url' => 'http://w.semir.cn/wxqyh.php/Main/newsdetail/nid/5592.html',
                        'picurl' => '',
                    ),
                ),
            ),
        );
        $url = 'message/send';
        $reVal = $this->curl_post($code, $url);
        $reDd = json_decode($reVal);
        //  print_r($reQyh);
        if ($reDd->errcode > 0) {
            echo $reDd->errcode . ':' . $reDd->errmsg;
        } else {
            echo "success!";
        }
    }

    function curl_post($data, $url) {
        $ch = curl_init();
        $timeout = 5;
        //  $code = json_encode($data);
        $code = json_encode($data, JSON_UNESCAPED_UNICODE);
        // $code = preg_replace("#\\\u([a-f]+)#ie", "iconv('UCS-2', 'UTF-8', pack('H4', '\\1'))", $code);
        // print_r($code);
        $aToken = $this->qyh_gettoken();
        curl_setopt($ch, CURLOPT_URL, "https://qyapi.weixin.qq.com/cgi-bin/" . $url . "?access_token=" . $aToken);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // https请求 不验证证书和hosts
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $code);
        $file_contents = curl_exec($ch);
        curl_close($ch);
        //   print_r($file_contents);
        return $file_contents;
    }

    function curl_get($data, $url) {
        $ch = curl_init();

        //qyh_gettoken();
        // print_r("https://qyapi.weixin.qq.com/cgi-bin/" . $url . "?access_token=" . qyh_gettoken() . "&" . $data);
        curl_setopt($ch, CURLOPT_URL, "https://qyapi.weixin.qq.com/cgi-bin/" . $url . "?access_token=" . $this->qyh_gettoken() . "&" . $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // 获取数据返回  
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // https请求 不验证证书和hosts
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        $file_contents = curl_exec($ch);
        //  var_dump($file_contents);
        curl_close($ch);
        // var_dump($file_contents);
        return json_decode($file_contents);
        //  var_dump($reQyh);
    }

    function qyh_gettoken() {
        $ch = curl_init();
        $timeout = 5;
        $corpid = "wxdd4a8419cffdd0ea";
        $corpsecret = "577S1zIlBkUxscgeHH1fXoEa1TA_oA0_Mdnq1tTNz4XgfQ7tOPq4kcveAqql0NYz";
        curl_setopt($ch, CURLOPT_URL, 'https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=' . $corpid . '&corpsecret=' . $corpsecret);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // 获取数据返回  
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // https请求 不验证证书和hosts
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        // curl_setopt($ch, CURLOPT_BINARYTRANSFER, true); // 在启用 CURLOPT_RETURNTRANSFER 时候将获取数据返回  
        $output = curl_exec($ch);
        curl_close($ch);
        // print_r($output);
        $return = json_decode($output);
        if ($return->access_token) {
            return $return->access_token;
        } else {
            echo "1";
            exit();
        }
    }

}
