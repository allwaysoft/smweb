<?php

namespace Index\Controller;

use Index\Common\CheckUserController;

class IndexController extends CheckUserController {

    public function _initialize() {
        parent::_initialize();
        $this->arealist = M('400_area')->field('areaname')->select();
        $this->nowtime = time();
        define('RES', '/Tpl/Semir400');
    }

    public function index() {
        $this->display('Index_quality');
    }

    public function service() {
        $this->display('Index_index');
    }

    public function index_list() {
        $user = $this->thisUser;
        $where = array(
            'agent_code' => $user['user_name']
        );
        $list = M('400_service')->where($where)->order('add_time desc')->select();

        foreach ($list as $key => $val) {
            $list[$key]['add_time'] = date('Y-m-d H:i:s', $val['add_time']);
            if ($val['com_status'] == 1) {
                $list[$key]['com_status'] = '待处理';
            } elseif ($val['com_status'] == 2) {
                $list[$key]['com_status'] = '处理中';
            }if ($val['com_status'] == 3) {
                $list[$key]['com_status'] = '处理结束';
                $traFq = M('400_service_track')->where(array('com_code' => $val['com_code'], 'tra_type' => 99))->find();
                if ($traFq) {
                    $list[$key]['com_status'] = '废弃';
                }
            }
            // 客户是否阅读
            $feedback = M('400_service_track')->where(array('com_code' => $val['com_code'], 'view_status' => 1))->find();
            $list[$key]['view_status'] = $feedback['view_status'];

            $list[$key]['agent_area'] = $list[$key]['agent_province'] . ' / ' . $list[$key]['agent_area'];
            $list[$key]['agent_person'] = $list[$key]['agent_person'] . ' / ' . $list[$key]['agent_tel'];
        }
        if ($list) {
            $data['data'] = $list;
        } else {
            $data['data'] = '';
        }

        $this->ajaxReturn($data, 'JSON');
    }

    public function quality() {
        $this->display();
    }

    public function quality_list() {
        $user = $this->thisUser;
        $where = array(
            'agent_code' => $user['user_name']
        );
        $list = M('400_quality')->where($where)->order('add_time desc')->select();
        foreach ($list as $key => $val) {
            $list[$key]['add_time'] = date('Y-m-d H:i:s', $val['add_time']);
            if ($val['com_status'] == 1) {
                $list[$key]['com_status'] = '待处理';
            } elseif ($val['com_status'] == 2) {
                $list[$key]['com_status'] = '处理中';
            }if ($val['com_status'] == 3) {
                $list[$key]['com_status'] = '处理结束';
                $traFq = M('400_quality_track')->where(array('com_code' => $val['com_code'], 'tra_type' => 99))->find();
                if ($traFq) {
                    $list[$key]['com_status'] = '废弃';
                }
            }
            // 客户是否阅读
            $feedback = M('400_quality_track')->where(array('com_code' => $val['com_code'], 'view_status' => 1))->find();
            $list[$key]['view_status'] = $feedback['view_status'];

            $list[$key]['agent_name'] = $list[$key]['agent_name'] . ' / ' . $list[$key]['agent_area'];
            $list[$key]['agent_person'] = $list[$key]['agent_person'] . ' / ' . $list[$key]['agent_tel'];
            $list[$key]['style_id'] = $val['style_id'] . ' / ' . $val['color_id']; // . ' / ' . $val['number'];
        }
        if ($list) {
            $data['data'] = $list;
        } else {
            $data['data'] = '';
        }
        $this->ajaxReturn($data, 'JSON');
    }

    public function sampling() {

        $this->display();
    }

    public function sampling_list() {
        $user = $this->thisUser;
        $where = array(
            'agent_code' => $user['user_name']
        );
        $list = M('400_terminal')->where($where)->order('add_time desc')->select();
        foreach ($list as $key => $val) {
            $list[$key]['add_time'] = date('Y-m-d H:i:s', $val['add_time']);
            if ($val['com_status'] == 1) {
                $list[$key]['com_status'] = '待处理';
            } elseif ($val['com_status'] == 2) {
                $list[$key]['com_status'] = '处理中';
            }if ($val['com_status'] == 3) {
                $list[$key]['com_status'] = '处理结束';
                $traFq = M('400_terminal_track')->where(array('com_code' => $val['com_code'], 'tra_type' => 99))->find();
                if ($traFq) {
                    $list[$key]['com_status'] = '废弃';
                }
            }
            // 客户是否阅读
            $feedback = M('400_terminal_track')->where(array('com_code' => $val['com_code'], 'view_status' => 1))->find();
            $list[$key]['view_status'] = $feedback['view_status'];

            $list[$key]['agent_name'] = $list[$key]['agent_name'] . ' / ' . $list[$key]['agent_area'];
            $list[$key]['agent_person'] = $list[$key]['agent_person'] . ' / ' . $list[$key]['agent_tel'];
            $list[$key]['style_id'] = $val['style_id'] . ' / ' . $val['color_id']; // . ' / ' . $val['number'];
        }
        if ($list) {
            $data['data'] = $list;
        } else {
            $data['data'] = '';
        }
        $this->ajaxReturn($data, 'JSON');
    }

    public function index_apply() {
        //   dump(session('index_complaintno'));
//      $this->ComplaintNo = session('index_complaintno') ? session('index_complaintno') : $this->getComplaintNo('index');
        $this->ComplaintNo =  $this->getComplaintNo('index');

        $this->display();
    }

    public function indexrefer() {
        $user = $this->thisUser;
        $_POST['agent_code'] = $user['user_name'];
        $_POST['add_time'] = time();
        $service = D('400_service');
        if (!$service->create()) {
            exit($service->getError());
        }

        $id = $service->add();
        if ($id) {
            session('index_complaintno', null);
            $this->success('申诉成功', U('index/service'));
        } else {
            $this->error('申诉失败');
        }
    }

    public function indexinfo() {
        $user = $this->thisUser;
        $id = I('get.id', 0, 'intval');
        $info = M('400_service')->where(array('id' => $id, 'agent_code' => $user['user_name']))->find();
        $this->info = $info;
        // if ($info['com_status'] == 3) {
        $this->feedback = M('400_service_track')->where(array('com_code' => $info['com_code']))->order('add_time desc')->select();
        // 保存阅读
        M('400_service_track')->where(array('com_code' => $info['com_code'], 'view_status' => 1))->setField('view_status', 2);

        //    print_r($this->feedback );
        //  }
        $this->display();
    }

    public function quality_apply() {
//      $this->ComplaintNo = session('quality_complaintno') ? session('quality_complaintno') : $this->getComplaintNo('quality');
        $this->ComplaintNo = $this->getComplaintNo('quality');
		        $this->ComplaintNo = $this->getComplaintNo('quality');
        $user = $this->thisUser;
        $usercode  = $user['user_name'];
        if($usercode){
           $codelen =  strlen($usercode);
           if($codelen >= 10){
	           $code = substr($usercode,0,10);
           		$code_index  = '2100';
           }
           else{
	           $code = substr($usercode,0,5);
           		$code_index = '1100';
           }
        }
        //获取店铺代码  名称
        $storelist = $this->storelist($code,$code_index);
        $this->storelist =$storelist;
        $this->display();
    }
    
    public function storelist($code='',$code_index=''){
    	$content = $this->curl_get_hana("ShopInfoQueryForShangWuWang.xsodata/ShopInfoSeviceParameters(INPUT_ITEM_CUSTOMCODE='$code',INPUT_ITEM_CTICKETINDUSTRY='$code_index')/Results?".'$format'."=json");
    	$storelist = $content->d->results;
    	foreach ($storelist as $store){
    		$val =  $store->ITEM_STORECODE.'|'.$store->ITEM_STORENAME;
    		$stores[$val] = $store->ITEM_STORENAME;
    	}
    	return $stores;
    }
	
    public function fetch_colorcode(){
    	$style_id = $id = I('post.style_id');
    	$returnmsg = '';
    	if($style_id){
	    	$colors = $this->colorcodes($style_id);
			if(!$colors){
	    		$colors = $this->colorcodes(strtoupper($style_id));
	    		if(!$colors){
	    			$returnmsg = '找不到色号,请确认款号是否录入正确';
	    		}
	    	}
	    	foreach ($colors as $color){
	    		if(sizeof($colors) == 1){
			    	$returnmsg .= '<input  class="checkbox-inline" type="checkbox" value="'.$color.'" name="color_id[]" checked>&nbsp;'.$color;
	    		}else
	    			$returnmsg .= '<input  class="checkbox-inline" type="checkbox" value="'.$color.'" name="color_id[]">&nbsp;'.$color;
	    	}
    	}
    	echo $returnmsg.'&nbsp;';
    }
    
    function colorcodes($styleid=''){
    	$content = $this->curl_get_hana("ProductInfoForShangWuWang.xsodata/ProductInfoServiceParameters(INPUT_ZPROD_CODE='$styleid')/Results?".'$format'."=json");
    	$color_codes = $content->d->results;
    	foreach ($color_codes as $c_code){
    		$colors[] = $c_code->CAC_ZCOLOR;
    	}
    	return $colors;
    }
	
    function curl_get_hana($request_uri){
    	$ch = curl_init ();
    	$header = ['Authorization: Basic RGV2MDE6U21AMTIzNDU2']; //设置一个你的浏览器agent的header
    	curl_setopt ( $ch, CURLOPT_URL, "http://10.90.20.160:8000/Semir_Report_CalModel/3rdPartyIntergration/Odata/3rdService/".$request_uri);
    	curl_setopt ( $ch, CURLOPT_TIMEOUT, 10 );
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    	// post数据
    	$output = curl_exec ( $ch );
    	curl_close ( $ch );
    	if ($output) {
    		$content = json_decode ( $output );
    	}
		return $content;
    }
	
    public function quality_again() {
        $id = I('get.id', 0, 'intval');
        $user = $this->thisUser;
        $id = I('get.id', 0, 'intval');
        $info = M('400_quality')->where(array('id' => $id, 'agent_code' => $user['user_name']))->find();
        $this->info = $info;
        $this->feedback = M('400_quality_track')->where(array('com_code' => $info['com_code']))->order('id desc')->find();
        $this->display();
    }

    public function qualityrefer_again() {
        $_POST['add_time'] = time();
        if ($_POST['com_type'] == 1) {
            $_POST['fol_pic'] = implode(',', $_POST['fol_pic']);
            unset($_POST['fol_express']);
            unset($_POST['fol_express_number']);
            unset($_POST['fol_express_address']);
        } elseif ($_POST['com_type'] == 1) {
            unset($_POST['fol_pic']);
        }
        $quality_follow = D('400_quality_follow');
        if (!$quality_follow->create()) {
            exit($quality_follow->getError());
        }

        $id = $quality_follow->add();
        if ($id) {
            M('400_quality')->where(array('com_code' => $_POST['com_code']))->save(array('com_status' => 2));
            $this->success('申诉成功', U('index/quality'));
        } else {
            $this->error('申诉失败');
        }
    }

    public function qualityrefer() {
        $user = $this->thisUser;
        $_POST['agent_code'] = $user['user_name'];
        $_POST['add_time'] = time();
        if ($_POST['com_type'] == 1) {
            if ($_FILES || count($_FILES) == 4) {
                // $uPpic = $this->batchupload($_FILES);
                //   print_r($_FILES); //['com_pic']['name']
                // upload pic
                $_FILES = $_FILES;
                $dir = date('Ymd', time());
                $dates = date('YmdHis');
                $dirname = 'Uploads/images/400/' . $dir;
                if (file_exists($dirname)) {
                    mkdir($dirname, 0777);
                }
                $targetPath = "Uploads/images/400/" . $dir . '/';
                if (!empty($_FILES)) {
                    $pname = substr($_FILES['Filedata']['name'], 0, -4);
                    $pname = explode('-', $pname);

                    $upload = new \Think\Upload(); // 实例化上传类
                    $upload->maxSize = 3145728; // 设置附件上传大小			 
                    $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
                    $upload->savePath = $targetPath; // 设置附件上传目录
                    $upload->autoSub = false;
                    /* $upload->subName = $styleID; */
                    $upload->replace = true;
                    //  $upload->saveName = '';

                    //$now = $_SERVER['REQUEST_TIME'];
                    //$upload->saveName = array('uniqid', $now); //上传文件的保存规则
                    $upload->saveName = 'get_uniquepicname';
                    $images = $upload->upload();
                    if (!$images) {// 上传错误提示错误信息
                        // echo $upload->getError();
                        $this->error('1002:请选择正确的图片！！');
                        return 101;
                    } else {

                        // 上传成功 获取上传文件信息  
                        $thumb = new \Think\Image();

                        //    $filename = "Uploads/images/400/" . $dir . '/'.$images['Filedata']['savename'];
                        //    
                        //   $thumb->open($filename);
                        //   $thumb->thumb(1440, 900)->save($filename);

                        /* $thumb->open($savename3);
                          $thumb->crop(180, 340, 80, 0)->save($savename3); */
                        // echo $targetPath . $images['savename']['savename'];
                        $uPpic = $images;
                    }
                }
                // upload pic end
                //   count($_FILES);
                //   exit;
            } else {
                // echo "1002:请选择图片！！";
                $this->error('1002:请选择正确的图片！！');
                exit;
            }
            foreach ($uPpic as $pic) {
                $pic_temp[] = '/' . $pic['savepath'] . $pic['savename'];
            }
            $_POST['com_pic'] = implode(',', $pic_temp);

            unset($_POST['com_express']);
            unset($_POST['com_express_number']);
            unset($_POST['com_express_address']);
        } elseif ($_POST['com_type'] != 1) {
            unset($_POST['com_pic']);
        }
        //$quality = D('400_quality');
       // if (!$quality->create()) {
       //     exit($quality->getError());
       // }
		
       // $id = $quality->add();
	   $quality = M('400_quality');
        $data  = array('agent_code'=>$user['user_name'],
		'add_time'=>time(),
		'com_code'=>$_POST['com_code'],
		'agent_province'=>$_POST['agent_province'],
		'agent_name'=>$_POST['agent_name'],
		'agent_area'=>$_POST['agent_area'],
		'agent_storename'=>$_POST['agent_storename'],
		'agent_tel'=>$_POST['agent_tel'],
		'agent_person'=>$_POST['agent_person'],
		'style_id'=>$_POST['style_id'],
		'color_id'=>implode(',',$_POST['color_id']),
		'number'=>$_POST['number'],
		'sale_time'=>$_POST['sale_time'],
		'sale_type'=>$_POST['sale_type'],
		'com_express'=>$_POST['com_express'],
		'com_express_number'=>$_POST['com_express_number'],
		'com_express_address'=>$_POST['com_express_address'],
		'com_contents'=>$_POST['com_contents'],
		'com_type'=>$_POST['com_type'],
		'com_pic'=>$_POST['com_pic']);
		
        $id = $quality->add($data);
        if ($id) {
            session('quality_complaintno', null);
            // echo 0;
            $this->success('申诉成功', U('index/quality'));
        } else {
            //  echo "103：信息提交失败，请联系客服！";
            $this->error('申诉失败');
        }
    }

    public function qualityinfo() {
        $user = $this->thisUser;
        $id = I('get.id', 0, 'intval');
        $info = M('400_quality')->where(array('id' => $id, 'agent_code' => $user['user_name']))->find();
        $info['com_pic'] = explode(',', $info['com_pic']);
        $follow = M('400_quality_follow')->where(array('com_code' => $info['com_code']))->order('id desc')->select();
        foreach ($follow as $key => $val) {
            if ($val['fol_pic']) {
                $follow[$key]['fol_pic'] = explode(',', $val['fol_pic']);
            }
        }
        $this->follow = $follow;
        $this->info = $info;
        $this->feedback = M('400_quality_track')->where(array('com_code' => $info['com_code']))->order('id desc')->select();
        M('400_quality_track')->where(array('com_code' => $info['com_code'], 'view_status' => 1))->setField('view_status', 2);
        $this->display();
    }

    public function sampling_apply() {
//      $this->ComplaintNo = session('sampling_complaintno') ? session('sampling_complaintno') : $this->getComplaintNo('sampling');
        $this->ComplaintNo =  $this->getComplaintNo('sampling');
        $this->display();
    }

    public function samplingrefer() {
        $user = $this->thisUser;
        $_POST['agent_code'] = $user['user_name'];
        $_POST['add_time'] = time();
        $terminal = D('400_terminal');
        if (!$terminal->create()) {
            exit($terminal->getError());
        }

        $id = $terminal->add();
        if ($id) {
            session('sampling_complaintno', null);
            $this->success('申诉成功', U('index/sampling'));
        } else {
            $this->error('申诉失败');
        }
    }

    public function samplinginfo() {
        $user = $this->thisUser;
        $id = I('get.id', 0, 'intval');
        $info = M('400_terminal')->where(array('id' => $id, 'agent_code' => $user['user_name']))->find();
        $this->info = $info;
        if ($info['com_status'] == 3) {
            $this->feedback = M('400_terminal_track')->where(array('com_code' => $info['com_code']))->order('add_time desc')->select();
            M('400_quality_track')->where(array('com_code' => $info['com_code'], 'view_status' => 1))->setField('view_status', 2);
        }

        $this->display();
    }

    public function getComplaintNo($type) {
        $str = '';
        if ($type == 'index') {
            $str.='F';
        } elseif ($type == 'quality') {
            $str.='Z';
        } elseif ($type == 'sampling') {
            $str.='C';
        }
        $str.=date('Ymd');
        //查找数据库投诉编号
        $ComplaintNo = M('400_complain_number')->where(array('type' => $type))->order('id desc')->find();
        if (!$ComplaintNo) {
            $liushuihao = '001';
        } else {
            $createtime = date('Ymd', $ComplaintNo['createtime']);
            if ($createtime == date('Ymd')) {
                $liushuihao = $this->num2str($ComplaintNo['complaintno'] + 1, 3);
            } else {
                $liushuihao = '001';
            }
        }
        M('400_complain_number')->add(array('type' => $type, 'complaintno' => $liushuihao, 'createtime' => time()));
        $str.=$liushuihao;
        session($type . '_complaintno', $str);
        return $str;
    }

    public function batchupload($upload) {
        $_FILES = $upload;
        $dir = date('Ymd', time());
        $dates = date('YmdHis');
        $dirname = 'Uploads/images/400/' . $dir;
        if (file_exists($dirname)) {
            mkdir($dirname, 0777);
        }
        $targetPath = "Uploads/images/400/" . $dir . '/';
        if (!empty($_FILES)) {
            $pname = substr($_FILES['Filedata']['name'], 0, -4);
            $pname = explode('-', $pname);

            $upload = new \Think\Upload(); // 实例化上传类
            $upload->maxSize = 3145728; // 设置附件上传大小				
            $upload->allowExts = array('jpg,png,jepg'); // 设置附件上传类型				
            $upload->savePath = $targetPath; // 设置附件上传目录
            $upload->autoSub = false;
            /* $upload->subName = $styleID; */
            $upload->replace = true;
            //  $upload->saveName = '';

            $now = $_SERVER['REQUEST_TIME'];
            $upload->saveName = array('uniqid', $now); //上传文件的保存规则

            $images = $upload->upload();
            if (!$images) {// 上传错误提示错误信息
                // echo $upload->getError();
                return 101;
            } else {

                // 上传成功 获取上传文件信息  
                $thumb = new \Think\Image();

                //    $filename = "Uploads/images/400/" . $dir . '/'.$images['Filedata']['savename'];
                //    
                //   $thumb->open($filename);
                //   $thumb->thumb(1440, 900)->save($filename);

                /* $thumb->open($savename3);
                  $thumb->crop(180, 340, 80, 0)->save($savename3); */
                // echo $targetPath . $images['savename']['savename'];
                return $images;
            }
        }
    }

    public function upload() {
        $base64 = I('post.base64');
        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64, $result)) {
            $uploadPath = '/Uploads'; // 存到文件位置
            $dates = date('YmdHis');
            $type = $result[2];
            $filepath = '.' . $uploadPath;
            $savepath = '/images/400/' . date('Ym') . '/' . date('d') . '/';
            // 文件保存路径+文件名称

            $filename = $filepath . $savepath . $dates . ".{$type}";
            $this->saveFile($filename, base64_decode(str_replace($result[1], '', $base64)));
            //$this->ajaxReturn($filename, 'json');
            echo substr($filename, 1);
        }
        if (!empty($_FILES)) {
            //  echo $_FILES['Filedata']['tmp_name'];
            // exit();

            $upload = new \Think\Upload(); // 实例化上传类
            $upload->maxSize = 3145728; // 设置附件上传大小
            $upload->allowExts = array('jpg', 'gif', 'png', 'jpeg'); // 设置附件上传类型
            $upload->savePath = '/Uploads/';
            $upload->autoSub = true;
            $upload->subName = array('date', 'Ymd');
            $images = $upload->upload();
            //判断是否有图
            if ($images) {
                $info = $images['Filedata']['savepath'] . $images['Filedata']['savename'];
                //返回文件地址和名给JS作回调用
                echo $info;
            } else {
                $this->error($upload->getError()); //获取失败信息
            }
        }
    }

    /**
     * 数字转为字符串
     */
    private function num2str($num, $length) {
        $num_str = (string) $num;
        $num_strlength = count($num_str);
        if ($length > $num_strlength) {
            $num_str = str_pad($num_str, $length, "0", STR_PAD_LEFT);
        }
        return $num_str;
    }

    private function saveFile($filename, $filecontent) {
        if (!file_exists($filename)) {
            mkdir(dirname($filename), 0775, true);
        }
        $local_file = fopen($filename, 'wb');
        if (false !== $local_file) {
            if (false !== fwrite($local_file, $filecontent)) {
                fclose($local_file);
            }
        }
    }

}

?>