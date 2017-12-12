<?php

class M_laporan extends CI_Model {

	var $table = 'karyawan';
	function __construct() {
        parent::__construct();
    }


function delete($key){
    $this->db->where('id_karyawan',$key);
    $this->db->delete($this->table);
}    

function get_update($data, $key){
        $this->db->where("id_karyawan", $key);
        $this->db->update($this->table, $data);
        return TRUE;
    }


function ambilsemua(){
	$this->db->select("*");
      

    $this->db->from('karyawan');
    $this->db->join('dept', 'dept.id_dept = karyawan.dept');
    $this->db->join('akses', 'akses.id_akses = karyawan.id_jabatan');
    $query = $this->db->get();
	return $query;
        
}

function ygdipilih($tglstart, $tglend){
    // $this->db->select('karyawan.*, kpim_karyawan.*, dept.*, akses.*, SUM(kpim_karyawan.sdh_send) AS jumlah');
    // $this->db->from('kpim_karyawan');
    // $this->db->join('karyawan', 'karyawan.id_karyawan = kpim_karyawan.id_karyawan', 'left');
    // $this->db->join('dept', 'dept.id_dept = karyawan.dept');
    // $this->db->join('akses', 'akses.id_akses = karyawan.id_jabatan');
    // $this->db->where('kpim_karyawan.tgl >=', $tglstart);
    // $this->db->where('kpim_karyawan.tgl <=', $tglend);
    // $this->db->group_by('kpim_karyawan.id_karyawan');
    // $query = $this->db->get(); 

    $query = $this->db->query('SELECT karyawan.*, kpim_karyawan.*, dept.*, akses.*, group_concat(distinct dept.nama_dept SEPARATOR ", ") as deptini, COUNT(DISTINCT tgl) as jumlah FROM kpim_karyawan
join karyawan on karyawan.id_karyawan = kpim_karyawan.id_karyawan join dept on find_in_set(dept.id_dept, karyawan.dept) join akses on akses.id_akses = karyawan.id_jabatan
where NOT karyawan.harikerja = 6 and NOT karyawan.id_jabatan = 1 and NOT karyawan.id_jabatan = 5 and NOT karyawan.status = "Blokir" and kpim_karyawan.tgl between "'.$tglstart.'" and "'.$tglend.'" and kpim_karyawan.sdh_send = 1
GROUP BY kpim_karyawan.id_karyawan HAVING COUNT(*) >= 1');

    return $query;
    }

    function ygdipilih6hari($tglstart, $tglend){
    

    $query = $this->db->query('SELECT karyawan.*, kpim_karyawan.*, dept.*, akses.*, group_concat(distinct dept.nama_dept SEPARATOR ", ") as deptini, COUNT(DISTINCT tgl) as jumlah FROM kpim_karyawan
        join karyawan on karyawan.id_karyawan = kpim_karyawan.id_karyawan join dept on find_in_set(dept.id_dept, karyawan.dept) join akses on akses.id_akses = karyawan.id_jabatan
        where NOT karyawan.harikerja = 5 and NOT karyawan.id_jabatan = 1 and NOT karyawan.id_jabatan = 5 and NOT karyawan.status = "Blokir" and kpim_karyawan.tgl between "'.$tglstart.'" and "'.$tglend.'" and kpim_karyawan.sdh_send = 1
        GROUP BY kpim_karyawan.id_karyawan HAVING COUNT(*) >= 1');

        return $query;
    }

function ambiluntuklaporan(){

    $query = $this->db->query('SELECT karyawan.*, kpim_karyawan.*, dept.*, akses.*,  COUNT(DISTINCT tgl) as jumlah FROM
     kpim_karyawan join karyawan on karyawan.id_karyawan = kpim_karyawan.id_karyawan join dept on dept.id_dept = karyawan.dept join akses on akses.id_akses = karyawan.id_jabatan
    where kpim_karyawan.tgl = "0000-00-00"
 GROUP BY kpim_karyawan.id_karyawan
HAVING COUNT(*) > 1');
    return $query;

    // SELECT *, sum(kpim_karyawan.sdh_send) as jumlah FROM `kpim_karyawan` join karyawan ON karyawan.id_karyawan = kpim_karyawan.id_karyawan JOIN dept ON dept.id_dept = karyawan.dept JOIN akses ON akses.id_akses = karyawan.id_jabatan GROUP BY kpim_karyawan.id_karyawan



// pertama
//     $query = $this->db->query('SELECT *, count(id_status) as jumlah
// from karyawan left join kpim_karyawan on karyawan.id_karyawan = kpim_karyawan.id_karyawan join dept on dept.id_dept = karyawan.dept join akses on akses.id_akses = karyawan.id_jabatan
// GROUP by karyawan.nama_karyawan');
//     return $query;

//     kedua punyaku
//     $query = $this->db->query('SELECT karyawan.*, kpim_karyawan.*, dept.*, akses.*, sum(kpim_karyawan.sdh_send) as jumlah
// from karyawan left join kpim_karyawan on karyawan.id_karyawan = kpim_karyawan.id_karyawan join dept on dept.id_dept = karyawan.dept join akses on akses.id_akses = karyawan.id_jabatan
// where kpim_karyawan.tgl between "'.$tglstart.'" and "'.$tglend.'"
// GROUP by karyawan.nama_karyawan');
//     return $query;

// ketiga mas zam
//     $query = $this->db->query('SELECT karyawan.*, kpim_karyawan.*, dept.*, akses.*, COUNT(sdh_send) as jumlah FROM kpim_karyawan  
// join karyawan on karyawan.id_karyawan = kpim_karyawan.id_karyawan join dept on dept.id_dept = karyawan.dept join akses on akses.id_akses = karyawan.id_jabatan
// WHERE tgl >= "2017-07-20" AND tgl <= "2017-07-28"
// GROUP BY kpim_karyawan.id_karyawan');
//     return $query;


//BISA
//     Select DISTINCT kpim_karyawan.id_karyawan, karyawan.username, akses.nama_akses, dept.nama_dept, count(distinct id) as jumlah from kpim_karyawan join karyawan on karyawan.id_karyawan = kpim_karyawan.id_karyawan join dept on dept.id_dept = karyawan.dept join akses on akses.id_akses = karyawan.id_jabatan
// where kpim_karyawan.tgl between "'.$tglstart.'" and "'.$tglend.'" group by tgl order by jumlah asc
        
}

}
