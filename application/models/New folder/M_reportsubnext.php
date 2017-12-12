<?php

class M_reportsubnext extends CI_Model {

    var $table = 'kpim_next';
    function __construct() {
        parent::__construct();
    }

    public function getJabatan($keyjabatan) {
        $this->db->select("*");
        $this->db->from("karyawan");
        $this->db->join("akses","karyawan.id_jabatan = akses.id_akses");
        $this->db->where("id_karyawan", $keyjabatan);

        $query = $this->db->get();

        return $query;
    }

    public function getDept($keydept) {
        $this->db->select("*");
        $this->db->from("karyawan");
        $this->db->join("dept","karyawan.dept = dept.id_dept");
        $this->db->where("id_karyawan", $keydept);

        $query = $this->db->get();

        return $query;
    }

public function getStatus($keystatus) {
        $this->db->select("*");
        $this->db->from("kpim_karyawan");
        $this->db->where("id_status", $keystatus);

        $query = $this->db->get();

        return $query;
    }

    function getAll() {
        $this->db->select("*");
        //$this->db->where("id_karyawan", $this->session->userdata('id_karyawan'));
        $tampilkan = array('id_status ' => '2' , 'id_karyawan ' => $this->session->userdata('id_karyawan'));
        $this->db->where($tampilkan);

       //$this->db->where("id_karyawan", $this->session->userdata('id_karyawan'));

        $getb = $this->db->get($this->table);
        return $getb;
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

    function get_updatestatus($data){
        $this->db->update($this->table, $data);
        return TRUE;
    }

}
