<?php

namespace Admin\Controller;

use Common\Common\Controller\AdminController;

class HotSalesController extends AdminController {

    public $area;

    public function _initialize() {
        parent::_initialize();
        $areaset = M('Areaset');
        $areasetinfo = $areaset->find();
        $thisuser = M('Localuser')->where(array('id' => $_SESSION['userid']))->find();
        $area = $thisuser[$areasetinfo['checkname']];
        $this->area = $area;
        $newnews = M('News')->order('time desc')->limit(5)->select();
        foreach ($newnews as $key => $val) {
            $newnews[$key]['image'] = str_replace('/', '_', $val['image']);
        }
        $this->newnews = $newnews;
        $this->nowtime = time();
    }

    public function index() {
        // banner图
        $banner = M('Banner')->where('type_id = 4')->order('id desc')->find();
        $this->banner = $banner;
        $this->display();
    }

    public function import() {
        if ($_POST) {
            $result = M('hotsales')->where('1=1')->delete();
            if ($result == false) {
                $this->error('导入失败，清理原始数据失败！');
            }
            vendor('PHPExcel.PHPExcel');
            $cacheMethod = \PHPExcel_CachedObjectStorageFactory::cache_in_memory_gzip;
            $cacheSettings = array();
            \PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);
            $objPHPExcel = new \PHPExcel();
            $objPHPExcel = \PHPExcel_IOFactory::load($_FILES["inputExcel"]["tmp_name"]);
            $indata = $objPHPExcel->getSheet(0)->toArray();
            $db = M('hotsales');
            $period = '';
            $createTime = time();
            foreach ($indata as $k => $arr) {
                if ($k == 0) {
                    continue;
                }
                $data = array();
                //0:区域，  1.款号 ，2：性别 ，3：种类， 4：排名，5：库存量，6：最好卖色，7:颜色码
                $data['areaname'] = trim($arr[0]);
                $data['styleID'] = trim($arr[1]);
                $data['gender'] = trim($arr[2]);
                $data['kind'] = trim($arr[3]);
                $data['rank'] = trim($arr[4]);
                $data['stock'] = trim($arr[5]);
                $data['bestcolor'] = trim($arr[6]);
                $data['colorcode'] = trim($arr[7]);
                $data['period'] = '';
                $data['createtime'] = $createTime;
                $hasDone = M('hotsales')->where(array('areaname' => $data['areaname'], 'colorcode' => $data['colorcode'], 'styleID' => $data['styleID'], 'rank' => $data['rank'], 'bestcolor' => $data['bestcolor']))->find();
                if (!$hasDone) {
                    $id = $db->add($data);
                }
            }
            $this->success('导入成功');
//     		$this->success('导入成功',U('HotSales/import'));
            /* if ($id) {
              $this->success('导入成功',U('Product/index'));
              }else
              {
              $this->error('导入失败');
              } */
        } else {
            $this->display();
        }
    }

    public function setBanner() {
        $sub_banner = M('subbanner')->where("id=2")->find();
        $this->assign("sub", $sub_banner);
        $this->display();
    }

    public function bannerEdit() {
        if ($_POST) {
            $db = M('subbanner');
            $data = array(
                'type' => $_POST['type'],
                'text' => $_POST['text'],
                'image' => $_POST['image'],
                'backgroundimg' => $_POST['backgroundimg'],
                'url' => $_POST['url']
            );
            $sub = $db->where("id=2")->find();
            $data['id'] = $sub['id'];
            $id = $db->save($data);
            if ($id) {
                $this->success('修改成功', U('HotSales/setBanner'));
            } else {
                $this->error('修改失败');
            }
        } else {
            $db = M('subbanner');
            $sub = $db->where("id=2")->find();
            $this->assign("sub", $sub);
            $this->display();
        }
    }

    function hnlist() {
        $kind_text = $_GET['kind_text'];
        $condition = "1=1 ";
        if ($kind_text && $kind_text != '无') {
            $condition .= " and kind='$kind_text'";
            $this->assign("kind_text", $kind_text);
        }
        $order = "areaname asc,  rank asc";

//        $count = $table->where($where)->order('id desc')->count();
//        $page = new \Think\Page($count, 20);
//        $page->setConfig('prev', '上一页');
//        $page->setConfig('next', '下一页');
//        $page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
//        $show = $page->show();
        $db = M('hotsales_hana');
        $datas = $db->where($condition)->order($order)->select();
        //  print_r($datas);
         $this->assign("total", count($datas));
        $this->assign("datas", $datas);
        $table = M('hotsales_season');
        $pq = $table->order("id desc")->select(); 
        $this->assign("pq", $pq);
        $kind = M('hotsales_hana')->distinct(true)->field('kind')->order('kind desc')->select();
        $this->assign("kind", $kind);
        $this->time = time() - 8 * 24 * 60 * 60;
        $this->endtime = time() - 1 * 24 * 60 * 60;
        $this->display();
    }

    function hnImport() {
        $ch = curl_init();
        $timeout = 5;
        $sdate = date('Ymd', strtotime($_POST['time']));
        $edate = date('Ymd', strtotime($_POST['endtime']));
        $pq = implode(';', $_POST['pq']);
        $kn = rand(1,9);
        $str =  mb_substr( '666B12F0921A435BF55FF575ED413B03', 0, $kn);
        $mKey = md5($str);
    //    echo "https://10.90.20.29:8443/xplatform/router/rest/getODATASourceJson?appKey=".$mKey."&kn=".$kn."&serviceEh=APP3&param={'input_sdate':'" . $sdate . "';'input_edate':'" . $edate . "';'input_CPJ':'" . $pq . "'}";
      //  exit;
        //  echo $sdate;
        /// print_r($_POST);
        /// exit;
        //'http://10.90.18.20'); //
        //
        //  curl_setopt($ch, CURLOPT_URL, "http://10.90.20.29/xplatform/router/rest/getODATASourceJson?appKey=666B12F0921A435BF55FF575ED413B03&serviceEh=Semir_HotSell_Service2&param={'input_sdate':'" . $date . "';'input_edate':'" . $date . "';'INPUT_ARRIVAL_DAT4':'" . $date . "';'ZINPUT_CPJ_M':'2016Q4'}");
        curl_setopt($ch, CURLOPT_URL, "https://10.90.20.29:8443/xplatform/router/rest/getODATASourceJson?appKey=".$mKey."&kn=".$kn."&appCode=002&serviceEh=APP3&param={'input_sdate':'" . $sdate . "';'input_edate':'" . $edate . "';'input_CPJ':'" . $pq . "'}");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // 获取数据返回  
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // https请求 不验证证书和hostscmdcmd
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        $file_contents = curl_exec($ch);
       // var_dump($ch);
        curl_close($ch);
       // print_r($file_contents);
        //echo  "https://10.90.20.29:8443/xplatform/router/rest/getODATASourceJson?appKey=".$mKey."&kn=".$kn."&appCode=002&serviceEh=APP3&param={'input_sdate':'" . $sdate . "';'input_edate':'" . $edate . "';'input_CPJ':'" . $pq . "'}";
        $result = json_decode($file_contents);
       // echo count($result->results);
        //  print_r($result->results);
      //  exit;
        if ($result->results) {
            $dbh = M('hotsales_hana');
            $row = $dbh->where('1')->delete(); // 删除表内容
            foreach ($result->results as $arr) {
                $createTime = time();
                $data = array();
                //0:区域，  1.款号 ，2：性别 ，3：种类， 4：排名，5：库存量，6：最好卖色，7:颜色码
                $data['areaname'] = trim($arr->ITEM_SALEREGION_T);
                $data['styleID'] = trim($arr->ZPROD_CODE);
                $data['gender'] = trim($arr->ZXINGBIE);
                $data['kind'] = trim($arr->ZCobineZL_De);
                $data['rank'] = trim($arr->Rank_Column);
                $data['stock'] = trim($arr->Zcal_zb);
                $data['bestcolor'] = trim($arr->ZCOLOR) . ":" . trim($arr->ZCOLOR_CODE);
                $data['colorcode'] = trim($arr->ZCOLOR_CODE);
                $data['period'] = '';
                $data['createtime'] = $createTime;

                // print_r($data);

                $dbh->add($data);
            }
            
             $this->success('导入数据完成！');
        }
        //   
    }

    function hntest() {
        echo "Test:";
        $ch = curl_init();
        $timeout = 5;
        //'http://10.90.18.20'); //
        curl_setopt($ch, CURLOPT_URL, "http://10.90.20.29/xplatform/router/rest/getODATASourceJson?appKey=666B12F0921A435BF55FF575ED413B03&serviceEh=Semir_HotSell_Service2&param={'input_sdate':'20170313';'input_edate':'20170313';'INPUT_ARRIVAL_DAT4':'20170313'}");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // 获取数据返回  
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // https请求 不验证证书和hosts
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        $file_contents = curl_exec($ch);
        // var_dump($ch);
        curl_close($ch);
        //    print_r($file_contents);
        $result = json_decode($file_contents);
        echo count($result->results);
        //  print_r($result);
        //  return $file_contents;
    }

//
    function HotSales_season() {
        $table = M('hotsales_season');
        $where = "";
        $count = $table->where($where)->order('id desc')->count();
        $page = new \Think\Page($count, 20);
        $page->setConfig('prev', '上一页');
        $page->setConfig('next', '下一页');
        $page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $show = $page->show();
        $list = $table->where($where)->order('id desc')->limit($page->firstRow . ',' . $page->listRows)->select();

        $this->list = $list;
        $this->page = $show;
        $this->display();
    }

    public function season_add() {
        if ($_POST) {
            $db = M('hotsales_season');
            $data = array(
                'name' => $_POST['name'],
            );
            $id = $db->add($data);
            if ($id) {
                $this->success('添加成功', U('HotSales/HotSales_season'));
            } else {
                  $this->error('添加失败');
            }
        } else {
            $this->display();
        }
    }
 

    public function season_del() {
        $id = $_POST['id'];
        $db = M('hotsales_season'); 
        foreach ($id as $val) { 
            $isbool = $db->where('id='.$val)->delete(); 
        }
        if ($isbool) {
           $this->success('删除成功', U('HotSales/HotSales_season'));
        } else {
            $this->error('删除失败');
        }
    }

}

?>