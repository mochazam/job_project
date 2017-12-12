<?php

class M_visit extends CI_Model {

	var $table = 'visits';
	var $table2 = 'dept';
	var $table3 = 'karyawan';
	function __construct() {
        parent::__construct();
    }

    function getVisitDataBy($key) {
    	$this->db->select("*");
    	$this->db->where('karyawan_id', $key);
        $this->db->order_by('id', 'DESC');
        $this->db->from($this->table);
		$query = $this->db->get();
    	return $query;
    }

    function getAllHistory($id, $start, $end) {
    	$this->db->select("*");
    	$this->db->where('karyawan_id', $id);
    	$this->db->where("visited_at >=", $start);
        $this->db->where("visited_at <=", $end);
        $this->db->order_by('id', 'DESC');
        $this->db->from($this->table);
		$query = $this->db->get();
    	return $query;
    }

    function getAllMarker($id, $start, $end) {
    	$this->db->select("*");
    	$this->db->where('karyawan_id', $id);
    	$this->db->where("visited_at >=", $start);
        $this->db->where("visited_at <=", $end);
        $this->db->from($this->table);
		$query = $this->db->get();
    	return $query;
    }

    function getNowHistory($id, $date) {
        $this->db->select("*");
        $this->db->where('karyawan_id', $id);
        $this->db->where("visited_at", $date);
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query;
    }

    function getAllMarkerNow($id, $date) {
        $this->db->select("*");
        $this->db->where('karyawan_id', $id);
        $this->db->where("visited_at", $date);
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query;
    }

    function getDeptById($key) {
    	$id_dept = explode(',', $key);

    	$this->db->select("*");
        $this->db->where_in('id_dept', $id_dept);
        $this->db->from($this->table2);
		$query = $this->db->get();

		$result = [];
		foreach ($query->result_array() as $row) {
			$result[] = $row['nama_dept'];
		}
    	return $result;
    }

    function getJabatanById($key) {
        $this->db->select("*");
        $this->db->where('id_karyawan', $key);
        $this->db->from($this->table3);
        $query = $this->db->get();

        $result = '';
        foreach ($query->result_array() as $row) {
            $result = $row['jabatannya'];
        }
        return $result;
    }

    function getFotoKaryawan($key) {
        $this->db->select("*");
        $this->db->where('id_karyawan', $key);
        $this->db->from($this->table3);
        $query = $this->db->get();

        $result = '';
        foreach ($query->result_array() as $row) {
            $result = $row['img'];
        }
        return $result;
    }

    function getDeptName($key) {
        $this->db->select("*");
        $this->db->where_in('id_dept', $key);
        $this->db->from($this->table2);
        $query = $this->db->get();

        $result = '';
        foreach ($query->result_array() as $row) {
            $result = $row['nama_dept'];
        }
        return $result;
    }

    function getNamaKaryawan($key) {
        $this->db->select("*");
        $this->db->where('id_karyawan', $key);
        $this->db->from($this->table3);
        $query = $this->db->get();

        $result = '';
        foreach ($query->result_array() as $row) {
            $result = $row['nama_karyawan'];
        }
        return $result;
    }

    function getDept() {
    	$this->db->select("*");
        $this->db->from($this->table2);
		$query = $this->db->get();
    	return $query;
    }

    function getNameById($id) {
        // $query = $this->db->query("SELECT * FROM karyawan WHERE '$id' IN (dept)");
        $this->db->select("*");
        $this->db->LIKE("dept", $id);
        $query = $this->db->get($this->table3);
        if ($query->num_rows() > 0) return $query->result_array();              
    }

    function update($id,$value,$modul){
		$this->db->where(array("id"=>$id));
		$this->db->update($this->table,array($modul=>$value));
	}



    function delete($key){
        $this->db->where('id',$key);
        $this->db->delete($this->table);
    }    

    //fungsi insert ke database
    function get_insert($data){
       	$this->db->insert($this->table, $data);
      	return TRUE;
    }

    function get_update($data, $key){
        $this->db->where("id", $key);
        $this->db->update($this->table, $data);
        return TRUE;
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('id',$id);
        $query = $this->db->get();
 
        return $query->row();
    }

    public function visits_update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

}
