
<?php
//phpinfo();
 exit;
/* ---------------------------------------------------- */
/* ��������: PHP̽��-Yahei
  /* ������: ̽��ϵͳ��Web���������л���
  /* ���򿪷�: Yahei.Net
  /* ��ϵ��ʽ: info@Yahei.net
  /* Date: 1970-01-01 / 2012-07-08
  /* ---------------------------------------------------- */
/* ʹ������:
  /* 1.���������ʹ��.
  /* 2.��ֹ�κ������汾.
  /* ---------------------------------------------------- */
/* ��л��������Ϊ̽�������Ĺ���:
  /* zyypp,���������,���ǳ�,�ջ�����,����,Clare Lou,hotsnow
  /* ����,yexinzhu,wangyu1314,Kokgog,gibyasus,�S�ӫ|,A��,huli
  /* С��,charwin
  /* ����������һ��?
  /* ---------------------------------------------------- */
error_reporting(0); //�������д�����Ϣ
@header("content-Type: text/html; charset=utf-8"); //����ǿ��
ob_start();
date_default_timezone_set('Asia/Shanghai'); //�˾���������ʱ���

$title = '�ź�PHP̽��[�����]';

$version = "v0.4.5"; //�汾��



define('HTTP_HOST', preg_replace('~^www\.~i', '', $_SERVER['HTTP_HOST']));



$time_start = microtime_float();

function memory_usage() {

    $memory = (!function_exists('memory_get_usage')) ? '0' : round(memory_get_usage() / 1024 / 1024, 2) . 'MB';

    return $memory;
}

// ��ʱ

function microtime_float() {

    $mtime = microtime();

    $mtime = explode(' ', $mtime);

    return $mtime[1] + $mtime[0];
}

//��λת��
function formatsize($size) {
    $danwei = array(' B ', ' K ', ' M ', ' G ', ' T ');
    $allsize = array();
    $i = 0;

    for ($i = 0; $i < 4; $i++) {
        if (floor($size / pow(1024, $i)) == 0) {
            break;
        }
    }

    for ($l = $i - 1; $l >= 0; $l--) {
        $allsize1[$l] = floor($size / pow(1024, $l));
        $allsize[$l] = $allsize1[$l] - $allsize1[$l + 1] * 1024;
    }

    $len = count($allsize);

    for ($j = $len - 1; $j >= 0; $j--) {
        $strlen = 4 - strlen($allsize[$j]);
        if ($strlen == 1)
            $allsize[$j] = "<font color='#FFFFFF'>0</font>" . $allsize[$j];
        elseif ($strlen == 2)
            $allsize[$j] = "<font color='#FFFFFF'>00</font>" . $allsize[$j];
        elseif ($strlen == 3)
            $allsize[$j] = "<font color='#FFFFFF'>000</font>" . $allsize[$j];

        $fsize = $fsize . $allsize[$j] . $danwei[$j];
    }
    return $fsize;
}

function valid_email($str) {

    return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
}

//���PHP���ò���

function show($varName) {

    switch ($result = get_cfg_var($varName)) {

        case 0:

            return '<font color="red">��</font>';

            break;


        case 1:

            return '<font color="green">��</font>';

            break;


        default:

            return $result;

            break;
    }
}

//�������������ܲ��Խ��

$valInt = isset($_POST['pInt']) ? $_POST['pInt'] : "δ����";

$valFloat = isset($_POST['pFloat']) ? $_POST['pFloat'] : "δ����";

$valIo = isset($_POST['pIo']) ? $_POST['pIo'] : "δ����";



if ($_GET['act'] == "phpinfo") {

    phpinfo();

    exit();
} elseif ($_POST['act'] == "���Ͳ���") {

    $valInt = test_int();
} elseif ($_POST['act'] == "�������") {

    $valFloat = test_float();
} elseif ($_POST['act'] == "IO����") {

    $valIo = test_io();
}
//���ٲ���-��ʼ
elseif ($_POST['act'] == "��ʼ����") {
    ?>
    <script language="javascript" type="text/javascript">
        var acd1;
        acd1 = new Date();
        acd1ok = acd1.getTime();
    </script>
    <?php
    for ($i = 1; $i <= 100000; $i++) {
        echo "<!--567890#########0#########0#########0#########0#########0#########0#########0#########012345-->";
    }
    ?>
    <script language="javascript" type="text/javascript">
        var acd2;
        acd2 = new Date();
        acd2ok = acd2.getTime();
        window.location = '?speed=' + (acd2ok - acd1ok) + '#w_networkspeed';
    </script>
    <?php
}
//���ٲ���-����
elseif ($_GET['act'] == "Function") {
    $arr = get_defined_functions();

    Function php() {
        
    }

    echo "<pre>";
    Echo "������ʾϵͳ��֧�ֵ����к���,���Զ��庯��\n";
    print_r($arr);
    echo "</pre>";
    exit();
} elseif ($_GET['act'] == "disable_functions") {
    $disFuns = get_cfg_var("disable_functions");
    if (empty($disFuns)) {
        $arr = '<font color=red>��</font>';
    } else {
        $arr = $disFuns;
    }

    Function php() {
        
    }

    echo "<pre>";
    Echo "������ʾϵͳ�����õĺ���\n";
    print_r($arr);
    echo "</pre>";
    exit();
}



//MySQL���

if ($_POST['act'] == 'MySQL���') {

    $host = isset($_POST['host']) ? trim($_POST['host']) : '';

    $port = isset($_POST['port']) ? (int) $_POST['port'] : '';

    $login = isset($_POST['login']) ? trim($_POST['login']) : '';

    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    $host = preg_match('~[^a-z0-9\-\.]+~i', $host) ? '' : $host;

    $port = intval($port) ? intval($port) : '';

    $login = preg_match('~[^a-z0-9\_\-]+~i', $login) ? '' : htmlspecialchars($login);

    $password = is_string($password) ? htmlspecialchars($password) : '';
} elseif ($_POST['act'] == '�������') {

    $funRe = "����" . $_POST['funName'] . "֧��״���������" . isfun1($_POST['funName']);
} elseif ($_POST['act'] == '�ʼ����') {

    $mailRe = "�ʼ����ͼ����������";
    if ($_SERVER['SERVER_PORT'] == 80) {
        $mailContent = "http://" . $_SERVER['SERVER_NAME'] . ($_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME']);
    } else {
        $mailContent = "http://" . $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] . ($_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME']);
    }
    $mailRe .= (false !== @mail($_POST["mailAdd"], $mailContent, "This is a test mail!")) ? "���" : "ʧ��";
}


//�����ٶȲ���
if (isset($_POST['speed'])) {
    $speed = round(100 / ($_POST['speed'] / 1000), 2);
} elseif ($_GET['speed'] == "0") {
    $speed = 6666.67;
} elseif (isset($_GET['speed']) and $_GET['speed'] > 0) {
    $speed = round(100 / ($_GET['speed'] / 1000), 2); //�����ٶȣ�$speed kb/s
} else {
    $speed = "<font color=\"red\">&nbsp;δ̽��&nbsp;</font>";
}

// ��⺯��֧��

function isfun($funName = '') {

    if (!$funName || trim($funName) == '' || preg_match('~[^a-z0-9\_]+~i', $funName, $tmp))
        return '����';

    return (false !== function_exists($funName)) ? '<font color="green">��</font>' : '<font color="red">��</font>';
}

function isfun1($funName = '') {
    if (!$funName || trim($funName) == '' || preg_match('~[^a-z0-9\_]+~i', $funName, $tmp))
        return '����';
    return (false !== function_exists($funName)) ? '��' : '��';
}

//����������������

function test_int() {

    $timeStart = gettimeofday();

    for ($i = 0; $i < 3000000; $i++) {

        $t = 1 + 1;
    }

    $timeEnd = gettimeofday();

    $time = ($timeEnd["usec"] - $timeStart["usec"]) / 1000000 + $timeEnd["sec"] - $timeStart["sec"];

    $time = round($time, 3) . "��";

    return $time;
}

//����������������

function test_float() {

    //�õ�Բ����ֵ

    $t = pi();

    $timeStart = gettimeofday();



    for ($i = 0; $i < 3000000; $i++) {

        //��ƽ��

        sqrt($t);
    }



    $timeEnd = gettimeofday();

    $time = ($timeEnd["usec"] - $timeStart["usec"]) / 1000000 + $timeEnd["sec"] - $timeStart["sec"];

    $time = round($time, 3) . "��";

    return $time;
}

//IO��������

function test_io() {

    $fp = @fopen(PHPSELF, "r");

    $timeStart = gettimeofday();

    for ($i = 0; $i < 10000; $i++) {

        @fread($fp, 10240);

        @rewind($fp);
    }

    $timeEnd = gettimeofday();

    @fclose($fp);

    $time = ($timeEnd["usec"] - $timeStart["usec"]) / 1000000 + $timeEnd["sec"] - $timeStart["sec"];

    $time = round($time, 3) . "��";

    return($time);
}

function GetCoreInformation() {
    $data = file('/proc/stat');
    $cores = array();
    foreach ($data as $line) {
        if (preg_match('/^cpu[0-9]/', $line)) {
            $info = explode(' ', $line);
            $cores[] = array('user' => $info[1], 'nice' => $info[2], 'sys' => $info[3], 'idle' => $info[4], 'iowait' => $info[5], 'irq' => $info[6], 'softirq' => $info[7]);
        }
    }return $cores;
}

function GetCpuPercentages($stat1, $stat2) {
    if (count($stat1) !== count($stat2)) {
        return;
    }$cpus = array();
    for ($i = 0, $l = count($stat1); $i < $l; $i++) {
        $dif = array();
        $dif['user'] = $stat2[$i]['user'] - $stat1[$i]['user'];
        $dif['nice'] = $stat2[$i]['nice'] - $stat1[$i]['nice'];
        $dif['sys'] = $stat2[$i]['sys'] - $stat1[$i]['sys'];
        $dif['idle'] = $stat2[$i]['idle'] - $stat1[$i]['idle'];
        $dif['iowait'] = $stat2[$i]['iowait'] - $stat1[$i]['iowait'];
        $dif['irq'] = $stat2[$i]['irq'] - $stat1[$i]['irq'];
        $dif['softirq'] = $stat2[$i]['softirq'] - $stat1[$i]['softirq'];
        $total = array_sum($dif);
        $cpu = array();
        foreach ($dif as $x => $y)
            $cpu[$x] = round($y / $total * 100, 2);$cpus['cpu' . $i] = $cpu;
    }return $cpus;
}

$stat1 = GetCoreInformation();
sleep(1);
$stat2 = GetCoreInformation();
$data = GetCpuPercentages($stat1, $stat2);
$cpu_show = $data['cpu0']['user'] . "%us,  " . $data['cpu0']['sys'] . "%sy,  " . $data['cpu0']['nice'] . "%ni, " . $data['cpu0']['idle'] . "%id,  " . $data['cpu0']['iowait'] . "%wa,  " . $data['cpu0']['irq'] . "%irq,  " . $data['cpu0']['softirq'] . "%softirq";

function makeImageUrl($title, $data) {
    $api = 'http://api.yahei.net/tz/cpu_show.php?id=';
    $url.=$data['user'] . ',';
    $url.=$data['nice'] . ',';
    $url.=$data['sys'] . ',';
    $url.=$data['idle'] . ',';
    $url.=$data['iowait'];
    $url.='&chdl=User|Nice|Sys|Idle|Iowait&chdlp=b&chl=';
    $url.=$data['user'] . '%25|';
    $url.=$data['nice'] . '%25|';
    $url.=$data['sys'] . '%25|';
    $url.=$data['idle'] . '%25|';
    $url.=$data['iowait'] . '%25';
    $url.='&chtt=Core+' . $title;
    return $api . base64_encode($url);
}

if ($_GET['act'] == "cpu_percentage") {
    echo "<center><b><font face='Microsoft YaHei' color='#666666' size='3'>ͼƬ�������������ĵȴ���</font></b><br /><br />";
    foreach ($data as $k => $v) {
        echo '<img src="' . makeImageUrl($k, $v) . '" style="width:360px;height:240px;border: #CCCCCC 1px solid;background: #FFFFFF;margin:5px;padding:5px;" />';
    }echo "</center>";
    exit();
}



// ���ݲ�ͬϵͳȡ��CPU�����Ϣ

switch (PHP_OS) {

    case "Linux":

        $sysReShow = (false !== ($sysInfo = sys_linux())) ? "show" : "none";

        break;


    case "FreeBSD":

        $sysReShow = (false !== ($sysInfo = sys_freebsd())) ? "show" : "none";

        break;
    /* 	

      case "WINNT":

      $sysReShow = (false !== ($sysInfo = sys_windows()))?"show":"none";

      break;
     */

    default:

        break;
}

//linuxϵͳ̽��

function sys_linux() {

    // CPU

    if (false === ($str = @file("/proc/cpuinfo")))
        return false;

    $str = implode("", $str);

    @preg_match_all("/model\s+name\s{0,}\:+\s{0,}([\w\s\)\(\@.-]+)([\r\n]+)/s", $str, $model);

    @preg_match_all("/cpu\s+MHz\s{0,}\:+\s{0,}([\d\.]+)[\r\n]+/", $str, $mhz);

    @preg_match_all("/cache\s+size\s{0,}\:+\s{0,}([\d\.]+\s{0,}[A-Z]+[\r\n]+)/", $str, $cache);

    @preg_match_all("/bogomips\s{0,}\:+\s{0,}([\d\.]+)[\r\n]+/", $str, $bogomips);

    if (false !== is_array($model[1])) {

        $res['cpu']['num'] = sizeof($model[1]);
        /*

          for($i = 0; $i < $res['cpu']['num']; $i++)

          {

          $res['cpu']['model'][] = $model[1][$i].'&nbsp;('.$mhz[1][$i].')';

          $res['cpu']['mhz'][] = $mhz[1][$i];

          $res['cpu']['cache'][] = $cache[1][$i];

          $res['cpu']['bogomips'][] = $bogomips[1][$i];

          } */
        if ($res['cpu']['num'] == 1)
            $x1 = '';
        else
            $x1 = ' ��' . $res['cpu']['num'];
        $mhz[1][0] = ' | Ƶ��:' . $mhz[1][0];
        $cache[1][0] = ' | ��������:' . $cache[1][0];
        $bogomips[1][0] = ' | Bogomips:' . $bogomips[1][0];
        $res['cpu']['model'][] = $model[1][0] . $mhz[1][0] . $cache[1][0] . $bogomips[1][0] . $x1;

        if (false !== is_array($res['cpu']['model']))
            $res['cpu']['model'] = implode("<br />", $res['cpu']['model']);

        if (false !== is_array($res['cpu']['mhz']))
            $res['cpu']['mhz'] = implode("<br />", $res['cpu']['mhz']);

        if (false !== is_array($res['cpu']['cache']))
            $res['cpu']['cache'] = implode("<br />", $res['cpu']['cache']);

        if (false !== is_array($res['cpu']['bogomips']))
            $res['cpu']['bogomips'] = implode("<br />", $res['cpu']['bogomips']);
    }


    // NETWORK
    // UPTIME

    if (false === ($str = @file("/proc/uptime")))
        return false;

    $str = explode(" ", implode("", $str));

    $str = trim($str[0]);

    $min = $str / 60;

    $hours = $min / 60;

    $days = floor($hours / 24);

    $hours = floor($hours - ($days * 24));

    $min = floor($min - ($days * 60 * 24) - ($hours * 60));

    if ($days !== 0)
        $res['uptime'] = $days . "��";

    if ($hours !== 0)
        $res['uptime'] .= $hours . "Сʱ";

    $res['uptime'] .= $min . "����";


    // MEMORY

    if (false === ($str = @file("/proc/meminfo")))
        return false;

    $str = implode("", $str);

    preg_match_all("/MemTotal\s{0,}\:+\s{0,}([\d\.]+).+?MemFree\s{0,}\:+\s{0,}([\d\.]+).+?Cached\s{0,}\:+\s{0,}([\d\.]+).+?SwapTotal\s{0,}\:+\s{0,}([\d\.]+).+?SwapFree\s{0,}\:+\s{0,}([\d\.]+)/s", $str, $buf);
    preg_match_all("/Buffers\s{0,}\:+\s{0,}([\d\.]+)/s", $str, $buffers);


    $res['memTotal'] = round($buf[1][0] / 1024, 2);

    $res['memFree'] = round($buf[2][0] / 1024, 2);

    $res['memBuffers'] = round($buffers[1][0] / 1024, 2);
    $res['memCached'] = round($buf[3][0] / 1024, 2);

    $res['memUsed'] = $res['memTotal'] - $res['memFree'];

    $res['memPercent'] = (floatval($res['memTotal']) != 0) ? round($res['memUsed'] / $res['memTotal'] * 100, 2) : 0;


    $res['memRealUsed'] = $res['memTotal'] - $res['memFree'] - $res['memCached'] - $res['memBuffers']; //��ʵ�ڴ�ʹ��
    $res['memRealFree'] = $res['memTotal'] - $res['memRealUsed']; //��ʵ����
    $res['memRealPercent'] = (floatval($res['memTotal']) != 0) ? round($res['memRealUsed'] / $res['memTotal'] * 100, 2) : 0; //��ʵ�ڴ�ʹ����

    $res['memCachedPercent'] = (floatval($res['memCached']) != 0) ? round($res['memCached'] / $res['memTotal'] * 100, 2) : 0; //Cached�ڴ�ʹ����

    $res['swapTotal'] = round($buf[4][0] / 1024, 2);

    $res['swapFree'] = round($buf[5][0] / 1024, 2);

    $res['swapUsed'] = round($res['swapTotal'] - $res['swapFree'], 2);

    $res['swapPercent'] = (floatval($res['swapTotal']) != 0) ? round($res['swapUsed'] / $res['swapTotal'] * 100, 2) : 0;


    // LOAD AVG

    if (false === ($str = @file("/proc/loadavg")))
        return false;

    $str = explode(" ", implode("", $str));

    $str = array_chunk($str, 4);

    $res['loadAvg'] = implode(" ", $str[0]);


    return $res;
}

//FreeBSDϵͳ̽��

function sys_freebsd() {

    //CPU

    if (false === ($res['cpu']['num'] = get_key("hw.ncpu")))
        return false;

    $res['cpu']['model'] = get_key("hw.model");

    //LOAD AVG

    if (false === ($res['loadAvg'] = get_key("vm.loadavg")))
        return false;

    //UPTIME

    if (false === ($buf = get_key("kern.boottime")))
        return false;

    $buf = explode(' ', $buf);

    $sys_ticks = time() - intval($buf[3]);

    $min = $sys_ticks / 60;

    $hours = $min / 60;

    $days = floor($hours / 24);

    $hours = floor($hours - ($days * 24));

    $min = floor($min - ($days * 60 * 24) - ($hours * 60));

    if ($days !== 0)
        $res['uptime'] = $days . "��";

    if ($hours !== 0)
        $res['uptime'] .= $hours . "Сʱ";

    $res['uptime'] .= $min . "����";

    //MEMORY

    if (false === ($buf = get_key("hw.physmem")))
        return false;

    $res['memTotal'] = round($buf / 1024 / 1024, 2);


    $str = get_key("vm.vmtotal");

    preg_match_all("/\nVirtual Memory[\:\s]*\(Total[\:\s]*([\d]+)K[\,\s]*Active[\:\s]*([\d]+)K\)\n/i", $str, $buff, PREG_SET_ORDER);

    preg_match_all("/\nReal Memory[\:\s]*\(Total[\:\s]*([\d]+)K[\,\s]*Active[\:\s]*([\d]+)K\)\n/i", $str, $buf, PREG_SET_ORDER);


    $res['memRealUsed'] = round($buf[0][2] / 1024, 2);

    $res['memCached'] = round($buff[0][2] / 1024, 2);

    $res['memUsed'] = round($buf[0][1] / 1024, 2) + $res['memCached'];

    $res['memFree'] = $res['memTotal'] - $res['memUsed'];

    $res['memPercent'] = (floatval($res['memTotal']) != 0) ? round($res['memUsed'] / $res['memTotal'] * 100, 2) : 0;


    $res['memRealPercent'] = (floatval($res['memTotal']) != 0) ? round($res['memRealUsed'] / $res['memTotal'] * 100, 2) : 0;


    return $res;
}

//ȡ�ò���ֵ FreeBSD

function get_key($keyName) {

    return do_command('sysctl', "-n $keyName");
}

//ȷ��ִ���ļ�λ�� FreeBSD

function find_command($commandName) {

    $path = array('/bin', '/sbin', '/usr/bin', '/usr/sbin', '/usr/local/bin', '/usr/local/sbin');

    foreach ($path as $p) {

        if (@is_executable("$p/$commandName"))
            return "$p/$commandName";
    }

    return false;
}

//ִ��ϵͳ���� FreeBSD

function do_command($commandName, $args) {

    $buffer = "";

    if (false === ($command = find_command($commandName)))
        return false;

    if ($fp = @popen("$command $args", 'r')) {

        while (!@feof($fp)) {

            $buffer .= @fgets($fp, 4096);
        }

        return trim($buffer);
    }

    return false;
}

//windowsϵͳ̽��

function sys_windows() {

    if (PHP_VERSION >= 5) {

        $objLocator = new COM("WbemScripting.SWbemLocator");

        $wmi = $objLocator->ConnectServer();

        $prop = $wmi->get("Win32_PnPEntity");
    } else {
        return false;
    }



    //CPU

    $cpuinfo = GetWMI($wmi, "Win32_Processor", array("Name", "L2CacheSize", "NumberOfCores"));

    $res['cpu']['num'] = $cpuinfo[0]['NumberOfCores'];

    if (null == $res['cpu']['num']) {

        $res['cpu']['num'] = 1;
    }/*

      for ($i=0;$i<$res['cpu']['num'];$i++)
      {

      $res['cpu']['model'] .= $cpuinfo[0]['Name']."<br />";

      $res['cpu']['cache'] .= $cpuinfo[0]['L2CacheSize']."<br />";

      } */
    $cpuinfo[0]['L2CacheSize'] = ' (' . $cpuinfo[0]['L2CacheSize'] . ')';
    if ($res['cpu']['num'] == 1)
        $x1 = '';
    else
        $x1 = ' ��' . $res['cpu']['num'];
    $res['cpu']['model'] = $cpuinfo[0]['Name'] . $cpuinfo[0]['L2CacheSize'] . $x1;

    // SYSINFO

    $sysinfo = GetWMI($wmi, "Win32_OperatingSystem", array('LastBootUpTime', 'TotalVisibleMemorySize', 'FreePhysicalMemory', 'Caption', 'CSDVersion', 'SerialNumber', 'InstallDate'));

    $sysinfo[0]['Caption'] = iconv('GBK', 'UTF-8', $sysinfo[0]['Caption']);

    $sysinfo[0]['CSDVersion'] = iconv('GBK', 'UTF-8', $sysinfo[0]['CSDVersion']);

    $res['win_n'] = $sysinfo[0]['Caption'] . " " . $sysinfo[0]['CSDVersion'] . " ���к�:{$sysinfo[0]['SerialNumber']} ��" . date('Y��m��d��H:i:s', strtotime(substr($sysinfo[0]['InstallDate'], 0, 14))) . "��װ";

    //UPTIME

    $res['uptime'] = $sysinfo[0]['LastBootUpTime'];


    $sys_ticks = 3600 * 8 + time() - strtotime(substr($res['uptime'], 0, 14));

    $min = $sys_ticks / 60;

    $hours = $min / 60;

    $days = floor($hours / 24);

    $hours = floor($hours - ($days * 24));

    $min = floor($min - ($days * 60 * 24) - ($hours * 60));

    if ($days !== 0)
        $res['uptime'] = $days . "��";

    if ($hours !== 0)
        $res['uptime'] .= $hours . "Сʱ";

    $res['uptime'] .= $min . "����";


    //MEMORY

    $res['memTotal'] = round($sysinfo[0]['TotalVisibleMemorySize'] / 1024, 2);

    $res['memFree'] = round($sysinfo[0]['FreePhysicalMemory'] / 1024, 2);

    $res['memUsed'] = $res['memTotal'] - $res['memFree']; //���������Ѿ�����1024,���в����ٳ���

    $res['memPercent'] = round($res['memUsed'] / $res['memTotal'] * 100, 2);


    $swapinfo = GetWMI($wmi, "Win32_PageFileUsage", array('AllocatedBaseSize', 'CurrentUsage'));


    // LoadPercentage

    $loadinfo = GetWMI($wmi, "Win32_Processor", array("LoadPercentage"));

    $res['loadAvg'] = $loadinfo[0]['LoadPercentage'];


    return $res;
}

function GetWMI($wmi, $strClass, $strValue = array()) {

    $arrData = array();


    $objWEBM = $wmi->Get($strClass);

    $arrProp = $objWEBM->Properties_;

    $arrWEBMCol = $objWEBM->Instances_();

    foreach ($arrWEBMCol as $objItem) {

        @reset($arrProp);

        $arrInstance = array();

        foreach ($arrProp as $propItem) {

            eval("\$value = \$objItem->" . $propItem->Name . ";");

            if (empty($strValue)) {

                $arrInstance[$propItem->Name] = trim($value);
            } else {

                if (in_array($propItem->Name, $strValue)) {

                    $arrInstance[$propItem->Name] = trim($value);
                }
            }
        }

        $arrData[] = $arrInstance;
    }

    return $arrData;
}

//������

function bar($percent) {
    ?>

    <div class="bar"><div class="barli" style="width:<?php echo $percent ?>%">&nbsp;</div></div>

    <?php
}

$uptime = $sysInfo['uptime']; //����ʱ��

$stime = date('Y-m-d H:i:s'); //ϵͳ��ǰʱ��
//Ӳ��

$dt = round(@disk_total_space(".") / (1024 * 1024 * 1024), 3); //��
$df = round(@disk_free_space(".") / (1024 * 1024 * 1024), 3); //����
$du = $dt - $df; //����
$hdPercent = (floatval($dt) != 0) ? round($du / $dt * 100, 2) : 0;

$load = $sysInfo['loadAvg']; //ϵͳ����
//�ж��ڴ����С��1G������ʾM��������ʾG��λ
if ($sysInfo['memTotal'] < 1024) {
    $memTotal = $sysInfo['memTotal'] . " M";
    $mt = $sysInfo['memTotal'] . " M";
    $mu = $sysInfo['memUsed'] . " M";
    $mf = $sysInfo['memFree'] . " M";
    $mc = $sysInfo['memCached'] . " M"; //cache���ڴ�
    $mb = $sysInfo['memBuffers'] . " M"; //����
    $st = $sysInfo['swapTotal'] . " M";
    $su = $sysInfo['swapUsed'] . " M";
    $sf = $sysInfo['swapFree'] . " M";
    $swapPercent = $sysInfo['swapPercent'];
    $memRealUsed = $sysInfo['memRealUsed'] . " M"; //��ʵ�ڴ�ʹ��
    $memRealFree = $sysInfo['memRealFree'] . " M"; //��ʵ�ڴ����
    $memRealPercent = $sysInfo['memRealPercent']; //��ʵ�ڴ�ʹ�ñ���
    $memPercent = $sysInfo['memPercent']; //�ڴ���ʹ����
    $memCachedPercent = $sysInfo['memCachedPercent']; //cache�ڴ�ʹ����
} else {
    $memTotal = round($sysInfo['memTotal'] / 1024, 3) . " G";
    $mt = round($sysInfo['memTotal'] / 1024, 3) . " G";
    $mu = round($sysInfo['memUsed'] / 1024, 3) . " G";
    $mf = round($sysInfo['memFree'] / 1024, 3) . " G";
    $mc = round($sysInfo['memCached'] / 1024, 3) . " G";
    $mb = round($sysInfo['memBuffers'] / 1024, 3) . " G";
    $st = round($sysInfo['swapTotal'] / 1024, 3) . " G";
    $su = round($sysInfo['swapUsed'] / 1024, 3) . " G";
    $sf = round($sysInfo['swapFree'] / 1024, 3) . " G";
    $swapPercent = $sysInfo['swapPercent'];
    $memRealUsed = round($sysInfo['memRealUsed'] / 1024, 3) . " G"; //��ʵ�ڴ�ʹ��
    $memRealFree = round($sysInfo['memRealFree'] / 1024, 3) . " G"; //��ʵ�ڴ����
    $memRealPercent = $sysInfo['memRealPercent']; //��ʵ�ڴ�ʹ�ñ���
    $memPercent = $sysInfo['memPercent']; //�ڴ���ʹ����
    $memCachedPercent = $sysInfo['memCachedPercent']; //cache�ڴ�ʹ����
}


//��������

$strs = @file("/proc/net/dev");



for ($i = 2; $i < count($strs); $i++) {
    preg_match_all("/([^\s]+):[\s]{0,}(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)/", $strs[$i], $info);
    $NetInput[$i] = formatsize($info[2][0]);
    $NetOut[$i] = formatsize($info[10][0]);
}


//ajax����ʵʱˢ��

if ($_GET['act'] == "rt") {

    $arr = array('useSpace' => "$du", 'freeSpace' => "$df", 'hdPercent' => "$hdPercent", 'barhdPercent' => "$hdPercent%", 'TotalMemory' => "$mt", 'UsedMemory' => "$mu", 'FreeMemory' => "$mf", 'CachedMemory' => "$mc", 'Buffers' => "$mb", 'TotalSwap' => "$st", 'swapUsed' => "$su", 'swapFree' => "$sf", 'loadAvg' => "$load", 'uptime' => "$uptime", 'freetime' => "$freetime", 'bjtime' => "$bjtime", 'stime' => "$stime", 'memRealPercent' => "$memRealPercent", 'memRealUsed' => "$memRealUsed", 'memRealFree' => "$memRealFree", 'memPercent' => "$memPercent%", 'memCachedPercent' => "$memCachedPercent", 'barmemCachedPercent' => "$memCachedPercent%", 'swapPercent' => "$swapPercent", 'barmemRealPercent' => "$memRealPercent%", 'barswapPercent' => "$swapPercent%", 'NetOut2' => "$NetOut[2]", 'NetOut3' => "$NetOut[3]", 'NetOut4' => "$NetOut[4]", 'NetOut5' => "$NetOut[5]", 'NetOut6' => "$NetOut[6]", 'NetOut7' => "$NetOut[7]", 'NetOut8' => "$NetOut[8]", 'NetOut9' => "$NetOut[9]", 'NetOut10' => "$NetOut[10]", 'NetInput2' => "$NetInput[2]", 'NetInput3' => "$NetInput[3]", 'NetInput4' => "$NetInput[4]", 'NetInput5' => "$NetInput[5]", 'NetInput6' => "$NetInput[6]", 'NetInput7' => "$NetInput[7]", 'NetInput8' => "$NetInput[8]", 'NetInput9' => "$NetInput[9]", 'NetInput10' => "$NetInput[10]");

    $jarr = json_encode($arr);

    echo $_GET['callback'], '(', $jarr, ')';

    exit;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <title><?php echo $title . $version; ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <!-- Powered by: Yahei.Net -->

        <style type="text/css">
            <!--
            * {font-family: "Microsoft Yahei",Tahoma, Arial; }
            body{text-align: center; margin: 0 auto; padding: 0; background-color:#fafafa;font-size:12px;font-family:Tahoma, Arial}
            h1 {font-size: 26px; padding: 0; margin: 0; color: #333333; font-family: "Lucida Sans Unicode","Lucida Grande",sans-serif;}
            h1 small {font-size: 11px; font-family: Tahoma; font-weight: bold; }
            a{color: #666; text-decoration:none;}
            a.black{color: #000000; text-decoration:none;}
            table{width:100%;clear:both;padding: 0; margin: 0 0 10px;border-collapse:collapse; border-spacing: 0;
                  box-shadow: 1px 1px 1px #CCC;
                  -moz-box-shadow: 1px 1px 1px #CCC;
                  -webkit-box-shadow: 1px 1px 1px #CCC;
                  -ms-filter: "progid:DXImageTransform.Microsoft.Shadow(Strength=2, Direction=135, Color='#CCCCCC')";}
            th{padding: 3px 6px; font-weight:bold;background:#dedede;color:#626262;border:1px solid #cccccc; text-align:left;}
            tr{padding: 0; background:#FFFFFF;}
            td{padding: 3px 6px; border:1px solid #CCCCCC;}
            .w_logo{height:25px;text-align:center;color:#333;FONT-SIZE: 15px; width:13%; }
            .w_top{height:25px;text-align:center; width:8.7%;}
            .w_top:hover{background:#dadada;}
            .w_foot{height:25px;text-align:center; background:#dedede;}
            input{padding: 2px; background: #FFFFFF; border-top:1px solid #666666; border-left:1px solid #666666; border-right:1px solid #CCCCCC; border-bottom:1px solid #CCCCCC; font-size:12px}
            input.btn{font-weight: bold; height: 20px; line-height: 20px; padding: 0 6px; color:#666666; background: #f2f2f2; border:1px solid #999;font-size:12px}
            .bar {border:1px solid #999999; background:#FFFFFF; height:5px; font-size:2px; width:89%; margin:2px 0 5px 0;padding:1px; overflow: hidden;}
            .bar_1 {border:1px dotted #999999; background:#FFFFFF; height:5px; font-size:2px; width:89%; margin:2px 0 5px 0;padding:1px; overflow: hidden;}
            .barli_red{background:#ff6600; height:5px; margin:0px; padding:0;}
            .barli_blue{background:#0099FF; height:5px; margin:0px; padding:0;}
            .barli_green{background:#36b52a; height:5px; margin:0px; padding:0;}
            .barli_black{background:#333; height:5px; margin:0px; padding:0;}
            .barli_1{background:#999999; height:5px; margin:0px; padding:0;}
            .barli{background:#36b52a; height:5px; margin:0px; padding:0;}
            #page {width: 960px; padding: 0 auto; margin: 0 auto; text-align: left;}
            #header{position:relative; padding:5px;}
            .w_small{font-family: Courier New;}
            .w_number{color: #f800fe;}
            .sudu {padding: 0; background:#5dafd1; }
            .suduk { margin:0px; padding:0;}
            .resYes{}
            .resNo{color: #FF0000;}
            .word{word-break:break-all;}
            -->
        </style>

        <script language="JavaScript" type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>

        <script type="text/javascript">

<!--

    $(document).ready(function () {
        getJSONData();
    });

    function getJSONData()

    {

        setTimeout("getJSONData()", 1000);

        $.getJSON('?act=rt&callback=?', displayData);

    }

    function displayData(dataJSON)

    {
        $("#useSpace").html(dataJSON.useSpace);

        $("#freeSpace").html(dataJSON.freeSpace);
        $("#hdPercent").html(dataJSON.hdPercent);
        $("#barhdPercent").width(dataJSON.barhdPercent);

        $("#TotalMemory").html(dataJSON.TotalMemory);

        $("#UsedMemory").html(dataJSON.UsedMemory);

        $("#FreeMemory").html(dataJSON.FreeMemory);

        $("#CachedMemory").html(dataJSON.CachedMemory);
        $("#Buffers").html(dataJSON.Buffers);

        $("#TotalSwap").html(dataJSON.TotalSwap);

        $("#swapUsed").html(dataJSON.swapUsed);

        $("#swapFree").html(dataJSON.swapFree);

        $("#swapPercent").html(dataJSON.swapPercent);

        $("#loadAvg").html(dataJSON.loadAvg);

        $("#uptime").html(dataJSON.uptime);

        $("#freetime").html(dataJSON.freetime);

        $("#stime").html(dataJSON.stime);

        $("#bjtime").html(dataJSON.bjtime);

        $("#memRealUsed").html(dataJSON.memRealUsed);
        $("#memRealFree").html(dataJSON.memRealFree);
        $("#memRealPercent").html(dataJSON.memRealPercent);

        $("#memPercent").html(dataJSON.memPercent);
        $("#barmemPercent").width(dataJSON.memPercent);

        $("#barmemRealPercent").width(dataJSON.barmemRealPercent);
        $("#memCachedPercent").html(dataJSON.memCachedPercent);
        $("#barmemCachedPercent").width(dataJSON.barmemCachedPercent);

        $("#barswapPercent").width(dataJSON.barswapPercent);

        $("#NetOut2").html(dataJSON.NetOut2);

        $("#NetOut3").html(dataJSON.NetOut3);

        $("#NetOut4").html(dataJSON.NetOut4);

        $("#NetOut5").html(dataJSON.NetOut5);

        $("#NetOut6").html(dataJSON.NetOut6);

        $("#NetOut7").html(dataJSON.NetOut7);

        $("#NetOut8").html(dataJSON.NetOut8);

        $("#NetOut9").html(dataJSON.NetOut9);

        $("#NetOut10").html(dataJSON.NetOut10);
        $("#NetInput2").html(dataJSON.NetInput2);
        $("#NetInput3").html(dataJSON.NetInput3);
        $("#NetInput4").html(dataJSON.NetInput4);
        $("#NetInput5").html(dataJSON.NetInput5);
        $("#NetInput6").html(dataJSON.NetInput6);
        $("#NetInput7").html(dataJSON.NetInput7);
        $("#NetInput8").html(dataJSON.NetInput8);
        $("#NetInput9").html(dataJSON.NetInput9);
        $("#NetInput10").html(dataJSON.NetInput10);

    }

-->

        </script>

    </head>

    <body>
        <a name="w_top"></a>

        <div id="page">


            <table>
                <tr>
                    <th class="w_logo">�ź�PHP̽��</th>
                    <th class="w_top"><a href="#w_php">PHP����</a></th>
                    <th class="w_top"><a href="#w_module">���֧��</a></th>
                    <th class="w_top"><a href="#w_module_other">���������</a></th>
                    <th class="w_top"><a href="#w_db">���ݿ�֧��</a></th>
                    <th class="w_top"><a href="#w_performance">���ܼ��</a></th>
                    <th class="w_top"><a href="#w_networkspeed">���ټ��</a></th>
                    <th class="w_top"><a href="#w_MySQL">MySQL���</a></th>
                    <th class="w_top"><a href="#w_function">�������</a></th>
                    <th class="w_top"><a href="#w_mail">�ʼ����</a></th>
                    <th class="w_top"><a href="http://www.yahei.net/tz/tz.zip">̽������</a></th>
                </tr>
            </table>



            <!--��������ز���-->

            <table>

                <tr><th colspan="4">����������</th></tr>

                <tr>

                    <td>����������/IP��ַ</td>

                    <td colspan="3"><?php echo @get_current_user(); ?> - <?php echo $_SERVER['SERVER_NAME']; ?>(<?php if ('/' == DIRECTORY_SEPARATOR) {
    echo $_SERVER['SERVER_ADDR'];
} else {
    echo @gethostbyname($_SERVER['SERVER_NAME']);
} ?>)&nbsp;&nbsp;���IP��ַ�ǣ�<?php echo @$_SERVER['REMOTE_ADDR']; ?></td>

                </tr>

                <tr>

                    <td>��������ʶ</td>

                    <td colspan="3"><?php if ($sysInfo['win_n'] != '') {
    echo $sysInfo['win_n'];
} else {
    echo @php_uname();
}; ?></td>

                </tr>

                <tr>

                    <td width="13%">����������ϵͳ</td>

                    <td width="37%"><?php $os = explode(" ", php_uname());
echo $os[0]; ?> &nbsp;�ں˰汾��<?php if ('/' == DIRECTORY_SEPARATOR) {
    echo $os[2];
} else {
    echo $os[1];
} ?></td>

                    <td width="13%">��������������</td>

                    <td width="37%"><?php echo $_SERVER['SERVER_SOFTWARE']; ?></td>

                </tr>

                <tr>

                    <td>����������</td>

                    <td><?php echo getenv("HTTP_ACCEPT_LANGUAGE"); ?></td>

                    <td>�������˿�</td>

                    <td><?php echo $_SERVER['SERVER_PORT']; ?></td>

                </tr>

                <tr>

                    <td>������������</td>

                    <td><?php if ('/' == DIRECTORY_SEPARATOR) {
    echo $os[1];
} else {
    echo $os[2];
} ?></td>

                    <td>����·��</td>

                    <td><?php echo $_SERVER['DOCUMENT_ROOT'] ? str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']) : str_replace('\\', '/', dirname(__FILE__)); ?></td>

                </tr>

                <tr>

                    <td>����Ա����</td>

                    <td><?php echo $_SERVER['SERVER_ADMIN']; ?></td>

                    <td>̽��·��</td>

                    <td><?php echo str_replace('\\', '/', __FILE__) ? str_replace('\\', '/', __FILE__) : $_SERVER['SCRIPT_FILENAME']; ?></td>

                </tr>	

            </table>



            <?if("show"==$sysReShow){?>

            <table>

                <tr><th colspan="6">������ʵʱ����</th></tr>

                <tr>

                    <td width="13%" >��������ǰʱ��</td>

                    <td width="37%" ><span id="stime"><?php echo $stime; ?></span></td>

                    <td width="13%" >������������ʱ��</td>

                    <td width="37%" colspan="3"><span id="uptime"><?php echo $uptime; ?></span></td>

                </tr>
                <tr>

                    <td width="13%">CPU�ͺ� [<?php echo $sysInfo['cpu']['num']; ?>��]</td>

                    <td width="87%" colspan="5"><?php echo $sysInfo['cpu']['model']; ?></td>

                </tr>
                <tr>
                    <td>CPUʹ��״��</td>
                    <td colspan="5"><?php if ('/' == DIRECTORY_SEPARATOR) {
    echo $cpu_show . " | <a href='" . $phpSelf . "?act=cpu_percentage' target='_blank' class='static'>�鿴ͼ��</a>";
} else {
    echo "��ʱֻ֧��Linuxϵͳ";
} ?>
                    </td>
                </tr>
                <tr>
                    <td>Ӳ��ʹ��״��</td>
                    <td colspan="5">
                        �ܿռ� <?php echo $dt; ?>&nbsp;G��
                        ���� <font color='#333333'><span id="useSpace"><?php echo $du; ?></span></font>&nbsp;G��
                        ���� <font color='#333333'><span id="freeSpace"><?php echo $df; ?></span></font>&nbsp;G��
                        ʹ���� <span id="hdPercent"><?php echo $hdPercent; ?></span>%
                        <div class="bar"><div id="barhdPercent" class="barli_black" style="width:<?php echo $hdPercent; ?>%" >&nbsp;</div> </div>
                    </td>
                </tr>
                <tr>

                    <td>�ڴ�ʹ��״��</td>

                    <td colspan="5">

<?php
$tmp = array(
    'memTotal', 'memUsed', 'memFree', 'memPercent',
    'memCached', 'memRealPercent',
    'swapTotal', 'swapUsed', 'swapFree', 'swapPercent'
);

foreach ($tmp AS $v) {

    $sysInfo[$v] = $sysInfo[$v] ? $sysInfo[$v] : 0;
}
?>

                        �����ڴ棺��

                        <font color='#CC0000'><?php echo $memTotal; ?> </font>

                        , ����

                        <font color='#CC0000'><span id="UsedMemory"><?php echo $mu; ?></span></font>

                        , ����

                        <font color='#CC0000'><span id="FreeMemory"><?php echo $mf; ?></span></font>

                        , ʹ����

                        <span id="memPercent"><?php echo $memPercent; ?></span>

                        <div class="bar"><div id="barmemPercent" class="barli_green" style="width:<?php echo $memPercent ?>%" >&nbsp;</div> </div>
<?php
//�ж����cacheΪ0������ʾ
if ($sysInfo['memCached'] > 0) {
    ?>		
                            Cache���ڴ�Ϊ <span id="CachedMemory"><?php echo $mc; ?></span>
                            , ʹ���� 
                            <span id="memCachedPercent"><?php echo $memCachedPercent; ?></span>
                            %	| Buffers����Ϊ  <span id="Buffers"><?php echo $mb; ?></span>
                            <div class="bar"><div id="barmemCachedPercent" class="barli_blue" style="width:<?php echo $memCachedPercent ?>%" >&nbsp;</div></div>

                            ��ʵ�ڴ�ʹ��
                            <span id="memRealUsed"><?php echo $memRealUsed; ?></span>
                            , ��ʵ�ڴ����
                            <span id="memRealFree"><?php echo $memRealFree; ?></span>
                            , ʹ����
                            <span id="memRealPercent"><?php echo $memRealPercent; ?></span>
                            %
                            <div class="bar_1"><div id="barmemRealPercent" class="barli_1" style="width:<?php echo $memRealPercent ?>%" >&nbsp;</div></div> 
                            <?php
                        }
//�ж����SWAP��Ϊ0������ʾ
                        if ($sysInfo['swapTotal'] > 0) {
                            ?>	
                            SWAP������
                            <?php echo $st; ?>
                            , ��ʹ��
                            <span id="swapUsed"><?php echo $su; ?></span>
                            , ����
                            <span id="swapFree"><?php echo $sf; ?></span>
                            , ʹ����
                            <span id="swapPercent"><?php echo $swapPercent; ?></span>
                            %
                            <div class="bar"><div id="barswapPercent" class="barli_red" style="width:<?php echo $swapPercent ?>%" >&nbsp;</div> </div>

    <?php
}
?>		  

                    </td>

                </tr>
                <tr>
                    <td>ϵͳƽ������</td>
                    <td colspan="5" class="w_number"><span id="loadAvg"><?php echo $load; ?></span></td>
                </tr>

            </table>

            <?}?>



                        <?php if (false !== ($strs = @file("/proc/net/dev"))) : ?>

                <table>

                    <tr><th colspan="3">����ʹ��״��</th></tr>

    <?php for ($i = 2; $i < count($strs); $i++) : ?>

        <?php preg_match_all("/([^\s]+):[\s]{0,}(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)/", $strs[$i], $info); ?>

                        <tr>

                            <td width="13%"><?php echo $info[1][0] ?> : </td>

                            <td width="43%">�ѽ��� : <font color='#CC0000'><span id="NetInput<?php echo $i ?>"><?php echo $NetInput[$i] ?></span></font></td>

                            <td width="43%">�ѷ��� : <font color='#CC0000'><span id="NetOut<?php echo $i ?>"><?php echo $NetOut[$i] ?></span></font></td>

                        </tr>

                            <?php endfor; ?>

                </table>

                        <?php endif; ?>



            <table width="100%" cellpadding="3" cellspacing="0" align="center">

                <tr>

                    <th colspan="4">PHP�ѱ���ģ����</th>

                </tr>

                <tr>

                    <td colspan="4"><span class="w_small">

<?php
$able = get_loaded_extensions();

foreach ($able as $key => $value) {

    if ($key != 0 && $key % 13 == 0) {

        echo '<br />';
    }

    echo "$value&nbsp;&nbsp;";
}
?></span>

                    </td>

                </tr>

            </table>

            <a name="w_php"></a>

            <table>

                <tr><th colspan="4">PHP��ز���</th></tr>

                <tr>

                    <td width="32%">PHP��Ϣ��phpinfo����</td>

                    <td width="18%">

<?php
$phpSelf = $_SERVER[PHP_SELF] ? $_SERVER[PHP_SELF] : $_SERVER[SCRIPT_NAME];

$disFuns = get_cfg_var("disable_functions");
?>

            <?php echo (false !== eregi("phpinfo", $disFuns)) ? '<font color="red">��</font>' : "<a href='$phpSelf?act=phpinfo' target='_blank'>PHPINFO</a>"; ?>

                    </td>

                    <td width="32%">PHP�汾��php_version����</td>

                    <td width="18%"><?php echo PHP_VERSION; ?></td>

                </tr>

                <tr>

                    <td>PHP���з�ʽ��</td>

                    <td><?php echo strtoupper(php_sapi_name()); ?></td>

                    <td>�ű�ռ������ڴ棨memory_limit����</td>

                    <td><?php echo show("memory_limit"); ?></td>

                </tr>

                <tr>

                    <td>PHP��ȫģʽ��safe_mode����</td>

                    <td><?php echo show("safe_mode"); ?></td>

                    <td>POST�����ύ������ƣ�post_max_size����</td>

                    <td><?php echo show("post_max_size"); ?></td>

                </tr>

                <tr>

                    <td>�ϴ��ļ�������ƣ�upload_max_filesize����</td>

                    <td><?php echo show("upload_max_filesize"); ?></td>

                    <td>������������ʾ����Чλ����precision����</td>

                    <td><?php echo show("precision"); ?></td>

                </tr>

                <tr>

                    <td>�ű���ʱʱ�䣨max_execution_time����</td>

                    <td><?php echo show("max_execution_time"); ?>��</td>

                    <td>socket��ʱʱ�䣨default_socket_timeout����</td>

                    <td><?php echo show("default_socket_timeout"); ?>��</td>

                </tr>

                <tr>

                    <td>PHPҳ���Ŀ¼��doc_root����</td>

                    <td><?php echo show("doc_root"); ?></td>

                    <td>�û���Ŀ¼��user_dir����</td>

                    <td><?php echo show("user_dir"); ?></td>

                </tr>

                <tr>

                    <td>dl()������enable_dl����</td>

                    <td><?php echo show("enable_dl"); ?></td>

                    <td>ָ�������ļ�Ŀ¼��include_path����</td>

                    <td><?php echo show("include_path"); ?></td>

                </tr>

                <tr>

                    <td>��ʾ������Ϣ��display_errors����</td>

                    <td><?php echo show("display_errors"); ?></td>

                    <td>�Զ���ȫ�ֱ�����register_globals����</td>

                    <td><?php echo show("register_globals"); ?></td>

                </tr>

                <tr>

                    <td>���ݷ�б��ת�壨magic_quotes_gpc����</td>

                    <td><?php echo show("magic_quotes_gpc"); ?></td>

                    <td>"&lt;?...?&gt;"�̱�ǩ��short_open_tag����</td>

                    <td><?php echo show("short_open_tag"); ?></td>

                </tr>

                <tr>

                    <td>"&lt;% %&gt;"ASP����ǣ�asp_tags����</td>

                    <td><?php echo show("asp_tags"); ?></td>

                    <td>�����ظ�������Ϣ��ignore_repeated_errors����</td>

                    <td><?php echo show("ignore_repeated_errors"); ?></td>

                </tr>

                <tr>

                    <td>�����ظ��Ĵ���Դ��ignore_repeated_source����</td>

                    <td><?php echo show("ignore_repeated_source"); ?></td>

                    <td>�����ڴ�й©��report_memleaks����</td>

                    <td><?php echo show("report_memleaks"); ?></td>

                </tr>

                <tr>

                    <td>�Զ��ַ���ת�壨magic_quotes_gpc����</td>

                    <td><?php echo show("magic_quotes_gpc"); ?></td>

                    <td>�ⲿ�ַ����Զ�ת�壨magic_quotes_runtime����</td>

                    <td><?php echo show("magic_quotes_runtime"); ?></td>

                </tr>

                <tr>

                    <td>��Զ���ļ���allow_url_fopen����</td>

                    <td><?php echo show("allow_url_fopen"); ?></td>

                    <td>����argv��argc������register_argc_argv����</td>

                    <td><?php echo show("register_argc_argv"); ?></td>

                </tr>
                <tr>
                    <td>Cookie ֧�֣�</td>
                    <td><?php echo isset($_COOKIE) ? '<font color="green">��</font>' : '<font color="red">��</font>'; ?></td>
                    <td>ƴд��飨ASpell Library����</td>
                    <td><?php echo isfun("aspell_check_raw"); ?></td>
                </tr>
                <tr>
                    <td>�߾�����ѧ���㣨BCMath����</td>
                    <td><?php echo isfun("bcadd"); ?></td>
                    <td>PREL�����﷨��PCRE����</td>
                    <td><?php echo isfun("preg_match"); ?></td>
                    <tr>
                        <td>PDF�ĵ�֧�֣�</td>
                        <td><?php echo isfun("pdf_close"); ?></td>
                        <td>SNMP�������Э�飺</td>
                        <td><?php echo isfun("snmpget"); ?></td>
                    </tr> 
                    <tr>
                        <td>VMailMgr�ʼ�������</td>
                        <td><?php echo isfun("vm_adduser"); ?></td>
                        <td>Curl֧�֣�</td>
                        <td><?php echo isfun("curl_init"); ?></td>
                    </tr> 
                    <tr>
                        <td>SMTP֧�֣�</td>
                        <td><?php echo get_cfg_var("SMTP") ? '<font color="green">��</font>' : '<font color="red">��</font>'; ?></td>
                        <td>SMTP��ַ��</td>
                        <td><?php echo get_cfg_var("SMTP") ? get_cfg_var("SMTP") : '<font color="red">��</font>'; ?></td>
                    </tr> 

                    <tr>
                        <td>Ĭ��֧�ֺ�����enable_functions����</td>
                        <td colspan="3"><a href='<?php echo $phpSelf; ?>?act=Function' target='_blank' class='static'>�������鿴��ϸ��</a></td>		
                    </tr>
                    <tr>
                        <td>�����õĺ�����disable_functions����</td>
                        <td colspan="3" class="word">
<?php
$disFuns = get_cfg_var("disable_functions");
if (empty($disFuns)) {
    echo '<font color=red>��</font>';
} else {
    //echo $disFuns;
    $disFuns_array = explode(',', $disFuns);
    foreach ($disFuns_array as $key => $value) {
        if ($key != 0 && $key % 5 == 0) {
            echo '<br />';
        }
        echo "$value&nbsp;&nbsp;";
    }
}
?>
                        </td>
                    </tr>

            </table>

            <a name="w_module"></a>

            <!--�����Ϣ-->

            <table>

                <tr><th colspan="4" >���֧��</th></tr>

                <tr>

                    <td width="32%">FTP֧�֣�</td>

                    <td width="18%"><?php echo isfun("ftp_login"); ?></td>

                    <td width="32%">XML����֧�֣�</td>

                    <td width="18%"><?php echo isfun("xml_set_object"); ?></td>

                </tr>

                <tr>

                    <td>Session֧�֣�</td>

                    <td><?php echo isfun("session_start"); ?></td>

                    <td>Socket֧�֣�</td>

                    <td><?php echo isfun("socket_accept"); ?></td>

                </tr>

                <tr>

                    <td>Calendar֧��</td>

                    <td><?php echo isfun('cal_days_in_month'); ?>
                    </td>

                    <td>����URL���ļ���</td>

                    <td><?php echo show("allow_url_fopen"); ?></td>

                </tr>

                <tr>

                    <td>GD��֧�֣�</td>

                    <td>

                            <?php
                            if (function_exists(gd_info)) {

                                $gd_info = @gd_info();

                                echo $gd_info["GD Version"];
                            } else {
                                echo '<font color="red">��</font>';
                            }
                            ?></td>

                    <td>ѹ���ļ�֧��(Zlib)��</td>

                    <td><?php echo isfun("gzclose"); ?></td>

                </tr>

                <tr>

                    <td>IMAP�����ʼ�ϵͳ�����⣺</td>

                    <td><?php echo isfun("imap_close"); ?></td>

                    <td>�������㺯���⣺</td>

                    <td><?php echo isfun("JDToGregorian"); ?></td>

                </tr>

                <tr>

                    <td>�������ʽ�����⣺</td>

                    <td><?php echo isfun("preg_match"); ?></td>

                    <td>WDDX֧�֣�</td>

                    <td><?php echo isfun("wddx_add_vars"); ?></td>

                </tr>

                <tr>

                    <td>Iconv����ת����</td>

                    <td><?php echo isfun("iconv"); ?></td>

                    <td>mbstring��</td>

                    <td><?php echo isfun("mb_eregi"); ?></td>

                </tr>

                <tr>

                    <td>�߾�����ѧ���㣺</td>

                    <td><?php echo isfun("bcadd"); ?></td>

                    <td>LDAPĿ¼Э�飺</td>

                    <td><?php echo isfun("ldap_close"); ?></td>

                </tr>

                <tr>

                    <td>MCrypt���ܴ�����</td>

                    <td><?php echo isfun("mcrypt_cbc"); ?></td>

                    <td>��ϡ���㣺</td>

                    <td><?php echo isfun("mhash_count"); ?></td>

                </tr>

            </table>

            <a name="w_module_other"></a>
            <!--�����������Ϣ-->
            <table>
                <tr><th colspan="4" >���������</th></tr>
                <tr>
                    <td width="32%">Zend�汾</td>
                    <td width="18%"><?php $zend_version = zend_version();
                        if (empty($zend_version)) {
                            echo '<font color=red>��</font>';
                        } else {
                            echo $zend_version;
                        } ?></td>
                    <td width="32%">
<?php
$PHP_VERSION = PHP_VERSION;
$PHP_VERSION = substr($PHP_VERSION, 2, 1);
if ($PHP_VERSION > 2) {
    echo "ZendGuardLoader[����]";
} else {
    echo "Zend Optimizer";
}
?>
                    </td>
                    <td width="18%"><?php if ($PHP_VERSION > 2) {
    echo (get_cfg_var("zend_loader.enable")) ? '<font color=green>��</font>' : '<font color=red>��</font>';
} else {
    if (function_exists('zend_optimizer_version')) {
        echo zend_optimizer_version();
    } else {
        echo (get_cfg_var("zend_optimizer.optimization_level") || get_cfg_var("zend_extension_manager.optimizer_ts") || get_cfg_var("zend.ze1_compatibility_mode") || get_cfg_var("zend_extension_ts")) ? '<font color=green>��</font>' : '<font color=red>��</font>';
    }
} ?></td>
                </tr>
                <tr>
                    <td>eAccelerator</td>
                    <td><?php if ((phpversion('eAccelerator')) != '') {
    echo phpversion('eAccelerator');
} else {
    echo "<font color=red>��</font>";
} ?></td>
                    <td>ioncube</td>
                    <td><?php if (extension_loaded('ionCube Loader')) {
    $ys = ioncube_loader_iversion();
    $gm = "." . (int) substr($ys, 3, 2);
    echo ionCube_Loader_version() . $gm;
} else {
    echo "<font color=red>��</font>";
} ?></td>
                </tr>
                <tr>
                    <td>XCache</td>
                    <td><?php if ((phpversion('XCache')) != '') {
    echo phpversion('XCache');
} else {
    echo "<font color=red>��</font>";
} ?></td>
                    <td>APC</td>
                    <td><?php if ((phpversion('APC')) != '') {
    echo phpversion('APC');
} else {
    echo "<font color=red>��</font>";
} ?></td>
                </tr>
            </table>

            <a name="w_db"></a>

            <!--���ݿ�֧��-->

            <table>

                <tr><th colspan="4">���ݿ�֧��</th></tr>

                <tr>

                    <td width="32%">MySQL ���ݿ⣺</td>

                    <td width="18%"><?php echo isfun("mysql_close"); ?>

                        <?php
                        if (function_exists("mysql_get_server_info")) {

                            $s = @mysql_get_server_info();

                            $s = $s ? '&nbsp; mysql_server �汾��' . $s : '';

                            $c = '&nbsp; mysql_client �汾��' . @mysql_get_client_info();

                            echo $s;
                        }
                        ?>

                    </td>

                    <td width="32%">ODBC ���ݿ⣺</td>

                    <td width="18%"><?php echo isfun("odbc_close"); ?></td>

                </tr>

                <tr>

                    <td>Oracle ���ݿ⣺</td>

                    <td><?php echo isfun("ora_close"); ?></td>

                    <td>SQL Server ���ݿ⣺</td>

                    <td><?php echo isfun("mssql_close"); ?></td>

                </tr>

                <tr>

                    <td>dBASE ���ݿ⣺</td>

                    <td><?php echo isfun("dbase_close"); ?></td>

                    <td>mSQL ���ݿ⣺</td>

                    <td><?php echo isfun("msql_close"); ?></td>

                </tr>

                <tr>

                    <td>SQLite ���ݿ⣺</td>

                    <td><?php if (extension_loaded('sqlite3')) {
                            $sqliteVer = SQLite3::version();
                            echo '<font color=green>��</font>��';
                            echo "SQLite3��Ver ";
                            echo $sqliteVer[versionString];
                        } else {
                            echo isfun("sqlite_close");
                            if (isfun("sqlite_close") == '<font color="green">��</font>') {
                                echo "&nbsp; �汾�� " . @sqlite_libversion();
                            }
                        } ?></td>

                    <td>Hyperwave ���ݿ⣺</td>

                    <td><?php echo isfun("hw_close"); ?></td>

                </tr>

                <tr>

                    <td>Postgre SQL ���ݿ⣺</td>

                    <td><?php echo isfun("pg_close"); ?></td>

                    <td>Informix ���ݿ⣺</td>

                    <td><?php echo isfun("ifx_close"); ?></td>

                </tr>
                <tr>
                    <td>DBA ���ݿ⣺</td>
                    <td><?php echo isfun("dba_close"); ?></td>
                    <td>DBM ���ݿ⣺</td>
                    <td><?php echo isfun("dbmclose"); ?></td>
                </tr>    
                <tr>
                    <td>FilePro ���ݿ⣺</td>
                    <td><?php echo isfun("filepro_fieldcount"); ?></td>
                    <td>SyBase ���ݿ⣺</td>
                    <td><?php echo isfun("sybase_close"); ?></td>
                </tr> 

            </table>

            <a name="w_performance"></a><a name="bottom"></a>

            <form action="<?php echo $_SERVER[PHP_SELF] . "#bottom"; ?>" method="post">

                <!--���������ܼ��-->

                <table>

                    <tr><th colspan="5">���������ܼ��</th></tr>

                    <tr align="center">

                        <td width="19%">���ն���</td>

                        <td width="17%">���������������<br />(1+1����300���)</td>

                        <td width="17%">���������������<br />(Բ���ʿ�ƽ��300���)</td>

                        <td width="17%">����I/O�������<br />(��ȡ10K�ļ�1���)</td>

                        <td width="30%">CPU��Ϣ</td>

                    </tr>
                    <tr align="center">
                        <td align="left">���� LinodeVPS</td>
                        <td>0.357��</td>
                        <td>0.802��</td>
                        <td>0.023��</td>
                        <td align="left">4 x Xeon L5520 @ 2.27GHz</td>
                    </tr> 

                    <tr align="center">

                        <td align="left">���� PhotonVPS.com</td>

                        <td>0.431��</td>

                        <td>1.024��</td>

                        <td>0.034��</td>

                        <td align="left">8 x Xeon E5520 @ 2.27GHz</td>

                    </tr>

                    <tr align="center">

                        <td align="left">�¹� SpaceRich.com</td>

                        <td>0.421��</td>

                        <td>1.003��</td>

                        <td>0.038��</td>

                        <td align="left">4 x Core i7 920 @ 2.67GHz</td>

                    </tr>

                    <tr align="center">

                        <td align="left">���� RiZie.com</td>

                        <td>0.521��</td>

                        <td>1.559��</td>

                        <td>0.054��</td>

                        <td align="left">2 x Pentium4 3.00GHz</td>

                    </tr>

                    <tr align="center">

                        <td align="left">���� CitynetHost.com</a></td>

                        <td>0.343��</td>

                        <td>0.761��</td>

                        <td>0.023��</td>

                        <td align="left">2 x Core2Duo E4600 @ 2.40GHz</td>

                    </tr>

                    <tr align="center">

                        <td align="left">���� IXwebhosting.com</td>

                        <td>0.535��</td>

                        <td>1.607��</td>

                        <td>0.058��</td>

                        <td align="left">4 x Xeon E5530 @ 2.40GHz</td>

                    </tr>

                    <tr align="center">

                        <td>��̨������</td>

                        <td><?php echo $valInt; ?><br /><input class="btn" name="act" type="submit" value="���Ͳ���" /></td>

                        <td><?php echo $valFloat; ?><br /><input class="btn" name="act" type="submit" value="�������" /></td>

                        <td><?php echo $valIo; ?><br /><input class="btn" name="act" type="submit" value="IO����" /></td>

                        <td></td>

                    </tr>

                </table>

                <input type="hidden" name="pInt" value="<?php echo $valInt; ?>" />

                <input type="hidden" name="pFloat" value="<?php echo $valFloat; ?>" />

                <input type="hidden" name="pIo" value="<?php echo $valIo; ?>" />

                <a name="w_networkspeed"></a>
                <!--�����ٶȲ���-->
                <table>
                    <tr><th colspan="3">�����ٶȲ���</th></tr>
                    <tr>
                        <td width="19%" align="center"><input name="act" type="submit" class="btn" value="��ʼ����" />
                            <br />
                            ��ͻ��˴���1000k�ֽ�����<br />
                            ��������������ֵ����
                        </td>
                        <td width="81%" align="center" >

                            <table align="center" width="550" border="0" cellspacing="0" cellpadding="0" >
                                <tr >
                                    <td height="15" width="50">����</td>
                                    <td height="15" width="50">1M</td>
                                    <td height="15" width="50">2M</td>
                                    <td height="15" width="50">3M</td>
                                    <td height="15" width="50">4M</td>
                                    <td height="15" width="50">5M</td>
                                    <td height="15" width="50">6M</td>
                                    <td height="15" width="50">7M</td>
                                    <td height="15" width="50">8M</td>
                                    <td height="15" width="50">9M</td>
                                    <td height="15" width="50">10M</td>
                                </tr>
                                <tr>
                                    <td colspan="11" class="suduk" ><table align="center" width="550" border="0" cellspacing="0" cellpadding="0" height="8" class="suduk">
                                            <tr>
                                                <td class="sudu"  width="<?php
                        if (preg_match("/[^\d-., ]/", $speed)) {
                            echo "0";
                        } else {
                            echo 550 * ($speed / 11000);
                        }
                        ?>"></td>
                                                <td class="suduk" width="<?php
                        if (preg_match("/[^\d-., ]/", $speed)) {
                            echo "550";
                        } else {
                            echo 550 - 550 * ($speed / 11000);
                        }
                        ?>"></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
<?php echo (isset($_GET['speed'])) ? "����1000KB������ʱ <font color='#cc0000'>" . $_GET['speed'] . "</font> ���룬�����ٶȣ�" . "<font color='#cc0000'>" . $speed . "</font>" . " kb/s������Զ��ȡƽ��ֵ������10Mֱ�ӿ������ٶ�" : "<font color='#cc0000'>&nbsp;δ̽��&nbsp;</font>" ?>

                        </td>
                    </tr>
                </table>

                <a name="w_MySQL"></a>

                <!--MySQL���ݿ����Ӽ��-->

                <table>

                    <tr><th colspan="3">MySQL���ݿ����Ӽ��</th></tr>

                    <tr>

                        <td width="15%"></td>

                        <td width="60%">

                            ��ַ��<input type="text" name="host" value="localhost" size="10" />

                            �˿ڣ�<input type="text" name="port" value="3306" size="10" />

                            �û�����<input type="text" name="login" size="10" />

                            ���룺<input type="password" name="password" size="10" />

                        </td>

                        <td width="25%">

                            <input class="btn" type="submit" name="act" value="MySQL���" />

                        </td>

                    </tr>

                </table>

<?php
if ($_POST['act'] == 'MySQL���') {

    if (function_exists("mysql_close") == 1) {

        $link = @mysql_connect($host . ":" . $port, $login, $password);

        if ($link) {

            echo "<script>alert('���ӵ�MySql���ݿ�����')</script>";
        } else {

            echo "<script>alert('�޷����ӵ�MySql���ݿ⣡')</script>";
        }
    } else {

        echo "<script>alert('��������֧��MySQL���ݿ⣡')</script>";
    }
}
?>

                <a name="w_function"></a>

                <!--�������-->

                <table>

                    <tr><th colspan="3">�������</th></tr>

                    <tr>

                        <td width="15%"></td>

                        <td width="60%">

                            ��������Ҫ���ĺ�����

                            <input type="text" name="funName" size="50" />

                        </td>

                        <td width="25%">

                            <input class="btn" type="submit" name="act" align="right" value="�������" />

                        </td>

                    </tr>

                <?php
                if ($_POST['act'] == '�������') {

                    echo "<script>alert('$funRe')</script>";
                }
                ?>

                </table>

                <a name="w_mail"></a>

                <!--�ʼ����ͼ��-->

                <table>

                    <tr><th colspan="3">�ʼ����ͼ��</th></tr>

                    <tr>

                        <td width="15%"></td>

                        <td width="60%">

                            ��������Ҫ�����ʼ���ַ��

                            <input type="text" name="mailAdd" size="50" />

                        </td>

                        <td width="25%">

                            <input class="btn" type="submit" name="act" value="�ʼ����" />

                        </td>

                    </tr>

<?php
if ($_POST['act'] == '�ʼ����') {

    echo "<script>alert('$mailRe')</script>";
}
?>

                </table>

            </form>



            <table>
                <tr>
                    <td class="w_foot"><A HREF="http://www.Yahei.Net" target="_blank"><?php echo $title . $version; ?></A></td>
                    <td class="w_foot"><?php $run_time = sprintf('%0.4f', microtime_float() - $time_start); ?>Processed in <?php echo $run_time ?> seconds. <?php echo memory_usage(); ?> memory usage.</td>
                    <td class="w_foot"><a href="#w_top">���ض���</a></td>
                </tr>
            </table>

        </div>

    </body>

</html>