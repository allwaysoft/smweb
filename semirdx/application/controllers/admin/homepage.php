<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Homepage extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->authorization->check_auth();
        $this->load->model('homepage_model');
        $this->sysconfig_model->sysInfo(); // set sysInfo
        $this->sysconfig_model->menu_all();
        $navAction = "homepage";
        $this->cismarty->assign("navAction", $navAction);
    }

    function index() { 
        $this->authorization->check_permission($this->uri->segment(2), '1');
        $data['hType'] = $this->uri->segment(4);

        if ($data['hType']) {
            $where = $data['hType'];
        } else {
            $where = '';
        }

        $data['adPics'] = $this->homepage_model->get_homePics($where);

        //  print_r($data['adPics']);
        //$data['links'] = $this->pagination($where);
        $data['action'] = "view";
        $this->cismarty->assign("data", $data);
        $this->cismarty->display('admin/homepage_layout.tpl');
        // $this->load->view('admin/homepage_layout', $data);
    }

    function homepage_add() {
        $action = $this->uri->segment(4);
        // echo $action;
        if ($action == 'edit') {
            $data['info'] = $this->homepage_model->get_homepage_byid($this->uri->segment(5));
        } else {
            $data['info'] = array();
        }
        $reUrl = $this->input->server('HTTP_REFERER');
        $this->cismarty->assign("reurl", $reUrl);
        $data['action'] = $action;
        $this->cismarty->assign("data", $data);
        $this->cismarty->display('admin/homepage_add.tpl');
    }

    function homepage_modify() {
        $hId = $this->uri->segment(4);
        if ($hId) {
            $data['info'] = $this->homepage_model->get_homepage_byid($hId);

            $reUrl = $this->input->server('HTTP_REFERER');
            $this->cismarty->assign("reurl", $reUrl);
            $this->cismarty->assign("data", $data['info']);
            $this->cismarty->display('admin/homepage_modify.tpl');
        } else {
            echo "Error!!";
        }
    }

    function get_post() {

        $data['hType'] = $this->input->post('hType');
        $data['hPic'] = $this->input->post('hPic');
        $data['hTitle'] = $this->input->post('hTitle');
        $data['hContents'] = $this->input->post('hContents');
        $data['hUrl'] = $this->input->post('hUrl');
        $data['hSort'] = $this->input->post('hSort');

        return $data;
    }

    function getByid() {
        $list = $this->homepage_model->get_homepage_byid($this->uri->segment(4));
        // print(json_encode($list));
        $this->cismarty->assign("data", $list);
        $this->cismarty->display('admin/homepage_form.tpl');
    }

    function add() {

        if ($msg = $this->homepage_model->add($this->get_post())) {
            echo $msg;
        }
    }

    function edit() {
        $data = $this->get_post();
        $data['hId'] = $this->input->post('hId');
        if ($msg = $this->homepage_model->edit($data)) {
            echo $msg;
        }
        //die('修改成功');
        // $this->view();
    }

    function sort_save() {
        $this->authorization->check_permission($this->uri->segment(2), '3');

        $data['hSort'] = $this->uri->segment(4);
        $data['hId'] = $this->uri->segment(5);
        if ($msg = $this->homepage_model->editSort($data)) {
            echo $msg;
        }
    }

    function dodel() {
        $this->authorization->check_permission($this->uri->segment(2), '4');
        if ($hId = $this->input->post('hId')) {
            // $hId;
            if ($msg = $this->homepage_model->doDel($hId)) {
                echo 1;
            } else {
                echo 0;
            }
        }
    }

    function get_homepage_id() {
        $data = array();
        foreach ($_POST as $key => $v)
            $data[$key] = $v;
        if ($this->input->post('submit'))
            array_pop($data);
        if (count($data)) {
            return $data;
        } else {
            return false;
        }
    }

    function physical_del() {
        $this->authorization->check_permission($this->uri->segment(2), '4');
        $hId = $this->input->post('hId');
        $data = explode(',', $hId);
        if ($data) {
            if ($this->homepage_model->doDel($data)) {
                echo 1;
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
    }

    function recover() {
        $this->authorization->check_permission($this->uri->segment(2), '3');
        if ($data = $this->get_gallery_id()) {
            if ($this->gallery_model->recover($data)) {
                $this->view();
            } else {
                show_error("编辑失败,原因可能是当前记录不存在！");
            }
        }
    }

    function delPic() {
        $upload_dir = './attachments/adpic/';
        $filename = $_POST['imagename'];
        if (file_exists($upload_dir . $filename)) {
            if (!unlink($upload_dir . $filename)) {
                echo ("Error deleting ");
            } else {
                echo '1';
            }
        } else {
            echo '1.';
        }
    }

    function upPic() {
        $picname = $_FILES['upPic']['name'];
        $picsize = $_FILES['upPic']['size'];
        $size = round($picsize / 1024, 2);
        $name_array = explode("\.", $_FILES['upPic']['name']);
        date_default_timezone_set("PRC");
        $post_time = date("YmdHis");
        $file_type = $name_array[count($name_array) - 1];
        $realname = $post_time . "." . $file_type;
        $upload_dir = './attachments/adpic/';

        $file_path = $upload_dir . $realname;
        $MAX_SIZE = 20000000;
        //echo $_POST['buttoninfo'];
        if (!is_dir($upload_dir)) {
            if (!mkdir($upload_dir))
                echo "文件上传目录不存在并且无法创建文件上传目录";
            if (!chmod($upload_dir, 0755))
                echo "文件上传目录的权限无法设定为可读可写";
        }

        if ($_FILES['upPic']['size'] > $MAX_SIZE)
            echo "上传的文件大小超过了规定大小";

        if ($_FILES['upPic']['size'] == 0)
            echo "请选择上传的文件";

        if (!move_uploaded_file($_FILES['upPic']['tmp_name'], $file_path))
            echo "复制文件失败，请重新上传";

        switch ($_FILES['upPic']['error']) {
            case 0:
                //echo ""; // echo "success";
                $arr = array(
                    'name' => $picname,
                    'pic' => $realname,
                    'size' => $size
                );
                echo json_encode($arr);
                break;
            case 1:
                echo "上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值";
                break;
            case 2:
                echo "上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值";
                break;
            case 3:
                echo "文件只有部分被上传";
                break;
            case 4:
                echo "没有文件被上传";
                break;
        }
    }

}
