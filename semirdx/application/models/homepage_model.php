<?php

class Homepage_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->table = 'ag_homepage';
        $this->dbs = $this->load->database('shangwu', TRUE);
    }

    function get_shangwu_news($limit = 0, $offset = 0, $condition = "") {
        $this->dbs->select('*');
         if ($limit) {
            $this->dbs->limit($limit, $offset);
        }
        if ($condition) {
            $this->dbs->where($condition);
        }
        $this->dbs->from('tp_news');
        $this->dbs->order_by("id", 'desc');
        $query = $this->dbs->get();
        return $query->result();
    }
function get_shangwu_newinfo($condition = "") {
        $this->dbs->select('*'); 
        if ($condition) {
            $this->dbs->where($condition);
        }
        $this->dbs->from('tp_news');
        $this->dbs->order_by("id", 'desc');
        $query = $this->dbs->get();
        return $query->row();
    }
    function get_homePics($t) {
        $this->db->select('*');
        if ($t) {
            $this->db->where("hType", $t);
        }
        $this->db->from($this->table);
        $this->db->order_by("hSort", 'desc');
        $query = $this->db->get();
        return $query->result();
    }
    
    function get_ehomePics($t) {
    	$this->db->select('*');
    	if ($t) {
    		$this->db->where("hType", $t);
    	}
    	$this->db->from('ag_homepage_e');
    	$this->db->order_by("hSort", 'desc');
    	$query = $this->db->get();
    	return $query->result();
    }
    
    function get_newproducts() {
        $this->db->select('*');
        $this->db->where("hType = 2");
        $this->db->from($this->table);
        $this->db->order_by("hSort", 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    function get_homepage_byid($id) {

        $this->db->select('*');

        $this->db->from($this->table);
        $this->db->where('hId', $id);
        $query = $this->db->get();
        // return $this->db->get($this->_product_table);
        return $query->row();
    }

    function get_num_rows($condition = "") {
        if ($condition)
            $this->db->where($condition);
        return $this->db->count_all_results($this->table);
    }

    function get_attachments($data) {
        $this->db->where($data);
        $query = $this->db->get('attachment');
        return $query->result();
    }

    function add($data) {
        date_default_timezone_set("PRC");
        $data['post_time'] = date("Y-m-d H:i:s");

        if ($this->db->insert($this->table, $data)) {
            return "ok";
        } else {
            return false;
        }
        //$query = $this->db->query("select max(gallery_id) as gallery_id from gallery");
//			foreach ($query->result() as $row) {
//				$this->get_links($row->gallery_id);
//			}
    }

    function edit($data) {
        $id = array_pop($data);
        date_default_timezone_set("PRC");

        $this->db->where('hId', $id);
        //$this->db->update('gallery',$data);
        //$this->get_links($gallery_id);
        if ($this->db->update($this->table, $data)) {
            return "ok";
        } else {
            return false;
        }
    }

    function editSort($data) {
        $hId = array_pop($data);
        date_default_timezone_set("PRC");

        $this->db->where('hId', $hId);

        if ($this->db->update($this->table, $data)) {
            return "ok";
        } else {
            return false;
        }
    }

    function doDel($data) {
        $this->db->where_in('hId', $data);
        $query = $this->db->delete($this->table);
        $this->db->where_in('hId', $data);

        return true;
    }

    function recover($data) {
        $this->db->where_in('gallery_id', $data);
        if ($this->db->update($this->table, array('is_del' => 0))) {
            return true;
        } else {
            return false;
        }
    }

}
