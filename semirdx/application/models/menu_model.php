<?php

class Menu_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->table = 'ag_menu';
        $this->tableT = 'ag_menu_type';
    }

    function get_menu_byid($id) {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $query = $this->db->get();

        return $query->row();
    }

    function get_menu_type_by($where) {

        $this->db->select('*');
        if ($where) {
            $this->db->where($where);
        }
        $this->db->from($this->tableT);
        $query = $this->db->get();

        return $query->row();
    }

    function get_menu_byUrl($url) {

        $this->db->select('*');

        $this->db->from($this->table);

        $this->db->where('menuUrl', $url);

        $this->db->order_by('menuSort', 'asc');

        $query = $this->db->get();

        // return $this->db->get($this->_product_table);

        return $query->row();
    }

    function menu_all_byUrl($where) {
        $this->db->select('ag_menu.*');
        $this->db->select('ag_menu_type.mt_url,ag_menu_type.admin_mt_url');
        if ($where) {
            $this->db->where($where);
        }
        $this->db->from($this->table);
        $this->db->join($this->tableT, 'ag_menu_type.id = ag_menu.typeId');
        $this->db->order_by('ag_menu.menuSort', 'asc');
        $query = $this->db->get();
        return $query->row();
    }

    function get_all() {

        $records = array();

        $query = $this->db->query('SELECT * FROM ag_menu_type INNER JOIN ag_menu ON (ag_menu_type.id = ag_menu.typeId) ORDER BY menuSort asc');

        foreach ($query->result() as $row) {
            $row->children = $this->get_child_num($row->id);
            $records[] = $row;
        }

        return $records;
    }

    function get_child_num($classid) {

        $query = $this->db->query("select count(*) as children from ag_menu where parent_id='$classid'  ORDER BY menuSort asc");

        foreach ($query->result() as $row) {

            return $row->children;
        }
    }

    function get_in_tree($array, $pid = 0, $y, &$tdata = array()) {

        foreach ($array as $row) {

            if ($row->parent_id == $pid) {
                $n = $y + 1;
                $row->deep = $y;
                $tdata[] = $row;
                $this->get_in_tree($array, $row->id, $n, $tdata);
            }
        }

        return $tdata;
    }

    function get_menus() {

        return $this->get_in_tree($this->get_all(), 0, 0);
    }

    function get_menuTypes() {
        $records = array();
        $query = $this->db->query("SELECT * FROM ag_menu_type WHERE is_del = 1 ORDER BY id ");
        foreach ($query->result() as $row) {
            $records[] = $row;
        }
        return $records;
    }

    function get_menu_by($where = '') {

        $this->db->select('ag_menu.*');
        $this->db->select('ag_menu_type.mt_url,ag_menu_type.admin_mt_url');
        if ($where) {
            $this->db->where($where);
        }
        $this->db->from($this->table);
        $this->db->join($this->tableT, 'ag_menu_type.id = ag_menu.typeId');
        $this->db->order_by('menuSort', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    function get_menus_tree($where = '', $menuUrl = '') {

        global $str;
        $this->db->select('*');
        if ($where) {
            $this->db->where($where);
        } else {
            $this->db->where("parent_id = 0");
        }
        $this->db->from($this->table);
        $this->db->order_by('menuSort', 'asc');
        $query = $this->db->get();
        $result = $query->result_array();
        $tempRows = $this->db->affected_rows();

        if ($result && $tempRows) {//如果有子类 
            $str .= '<nav class="  hidden-print " > <ul class="nav  navList " id="navList" >';
            // print_r($result);
            foreach ($result as $row) { //循环记录集 
                $str .= "<li ";
                if($menuUrl === $row['menuUrl'] ){
                    $str .="class=active";
                }
                $str .= "><a href=" . site_url("page/" . $row['menuUrl']) . " >" . $row['menuName'] . "</a></li>"; //构建字符串 
                $this->get_menus_tree("parent_id = " . $row['id'], $menuUrl); //调用get_str()，将记录集中的id参数传入函数中，继续查询下级 
            }
            $str .= '</ul></nav>';
        }
        return $str;
    }

    function get_menus_path($where = '') {
        $arr = $this->get_menus_path_list($where);

        $arrDn[] = $arr->menuName;
        // print_r($arr);
        //  echo '<br>';
        if ($arr->parent_id > 0) {
            $parent_id = $arr->parent_id;
            do {
                $query = $this->get_menus_path_list('id = ' . $parent_id);
                //  print_r($query);
                $arrDn[] = $query->menuName;
                //  echo $query->menuName;
                $parent_id = $query->parent_id;

                // echo $rootId.'=rootId';
            } while ($parent_id > 0);
            //  print_r($arrDn);
            return array_reverse($arrDn);
        }
    }

    function get_menus_path_list($where) {
        $this->db->select('*');
        $this->db->where($where);
        $this->db->from($this->table);
        $query = $this->db->get()->row();

        if ($query) {
            $arrDn[] = $query->menuName;
            return $query;
        }
        // return $arrDn;
    }

    function move_menu($from, $to) {

        $data = array(
            'parent_id' => $to
        );

        $this->db->where('class_id', $from);

        $this->db->update($this->table, $data);

        return true;
    }

    function insert($data) {

        if ($this->db->insert($this->table, $data)) {

            return "ok";
        } else {

            return false;
        }
    }

    function update($id, $data) {

        $this->db->where('id', $id);

        if ($this->db->update($this->table, $data)) {

            return "ok";
        } else {

            return false;
        }
    }

    function del($classid) {

        $this->db->where('id', $classid);

        $this->db->delete($this->table);
    }

    function upload() {

        if (!empty($_FILES)) {

            $name_array = explode("\.", $_FILES['userfile']['name']);

            date_default_timezone_set("PRC");

            $post_time = date("Y-m-d H:i:s");

            $file_type = $name_array[count($name_array) - 1];

            $realname = md5($post_time + rand(0, 100)) . "." . $file_type;

            $folder = date("Y-m-d");

            $mypath = str_replace("-", "/", $folder);

            $tempFile = $_FILES['userfile']['tmp_name'];

            $targetPath = realpath('./attachments/menu') . '/' . $mypath . '/';

            $targetFile = str_replace('//', '/', $targetPath) . $realname;

            if (!is_dir($targetPath))
                if (!mkdir(str_replace('//', '/', $targetPath), 0755, true))
                    die("目录创建不成功");

            if (!move_uploaded_file($tempFile, $targetFile))
                die("文件移动失败");





            $data['real_name'] = $realname;

            $data['original_name'] = $_FILES['userfile']['name'];

            $data['upload_time'] = $post_time;

            $data['path'] = '/' . $mypath;

            $data['file_type'] = $file_type;

            if ($this->db->insert('attachment', $data)) {

                $this->db->select_max('id');

                $query = $this->db->get('attachment');

                foreach ($query->result() as $row)
                    echo $row->id . "|" . $mypath . "/" . "|" . $realname;
            } else {

                echo "写入数据库不成功！";
            }
        }
    }

}
