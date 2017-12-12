<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Laporan extends CI_Controller {

	public function __construct() {
		parent::__construct();
        $this->load->model(array('M_laporan', 'M_kpimmingguan', 'app_model'));
        $this->load->library(array('session', 'form_validation', 'upload', 'user_agent', 'email'));
        $this->load->helper(array('url', 'form', 'text', 'html', 'security', 'file', 'directory', 'number', 'date', 'download', 'tgl_indo'));
	}

	public function index()
	{
   $this->app_model->getLogin();
        if ($this->session->userdata('level') == 2 || $this->session->userdata('level') == 6 || $this->session->userdata('level') == 3 || $this->session->userdata('level') == 4) {
            $this->session->set_flashdata('message_name', 'Mohon maaf, Anda tidak dapat mengakses halaman Admin');
            redirect(base_url() . 'Home', 'refresh');

        }


        $data['table'] = $this->M_laporan->ambilsemua()->result();
        $data['profilku'] = $this->M_kpimmingguan->getdataku()->result();
        $data['semua'] = $this->M_laporan->ambiluntuklaporan()->result();

        $keyjabatan = $this->session->userdata('id_karyawan');
        $data['jabatan'] = $this->M_kpimmingguan->getJabatan($keyjabatan);

        $keydept = $this->session->userdata('id_karyawan');
        $data['dept'] = $this->M_kpimmingguan->getDept($keydept);
        

        $this->load->view('tampil_laporanentry',$data);
	}

    
    public function berinilai(){
        $this->app_model->getLogin();
        if ($this->session->userdata('level') == 2 || $this->session->userdata('level') == 6 || $this->session->userdata('level') == 3 || $this->session->userdata('level') == 4) {
            $this->session->set_flashdata('message_name', 'Mohon maaf, Anda tidak dapat mengakses halaman Admin');
            redirect(base_url() . 'Home', 'refresh');

        }

         if( $this->input->post('tglstart')==null  & $this->input->post('tglend')==null){
            redirect(base_url() . 'Laporan', 'refresh');
         }

        $tglstart = $this->input->post('tglstart');
        $tglend = $this->input->post('tglend');
        $libur = $this->input->post('libur');
        

        $data['semua'] = $this->M_laporan->ygdipilih($tglstart, $tglend)->result();

        $data['profilku'] = $this->M_kpimmingguan->getdataku()->result();

        $keyjabatan = $this->session->userdata('id_karyawan');
        $data['jabatan'] = $this->M_kpimmingguan->getJabatan($keyjabatan);

        $keydept = $this->session->userdata('id_karyawan');
        $data['dept'] = $this->M_kpimmingguan->getDept($keydept);

        $data['tglstart'] = $tglstart;
        $data['tglend'] = $tglend;
        $data['libur'] = $libur;
        

        $this->load->view('tampil_laporanentry',$data);

    }

    public function entry(){
        $this->app_model->getLogin();
        // if ($this->session->userdata('level') == 2 || $this->session->userdata('level') == 6 || $this->session->userdata('level') == 3 || $this->session->userdata('level') == 4) {
        //     $this->session->set_flashdata('message_name', 'Mohon maaf, Anda tidak dapat mengakses halaman Admin');
        //     redirect(base_url() . 'Home', 'refresh');

        // }

         // if( $this->input->post('tglstart')==null  & $this->input->post('tglend')==null){
         //    redirect(base_url() . 'Laporan', 'refresh');
         // }

        // $tglawalinput = date("Y-m-26", strtotime("-2 month", now()));
        // $tglsekarang = date("d-m-Y");

        // $tglstart = $this->input->post('tglstart');
        // $tglend = $this->input->post('tglend');
        // $libur = $this->input->post('libur');

        date_default_timezone_set('Asia/Jakarta');

       
        $batas = 10;
        $sekarang = date('d');

        if($sekarang < $batas) { 
            $tglstart = date("Y-m-26", strtotime("-2 month", now()));
            $tglend = date("Y-m-25", strtotime("-1 month", now()));
            $periode = "Laporan Periode Bulan Lalu :";
        }

        else {
            $tglstart = date("Y-m-26", strtotime("-1 month", now()));
            $tglend = date("Y-m-d", strtotime("-2 day", now()));
            $periode = "Laporan Periode Bulan ini :";
        }

        $libur = $this->input->post('libur');


        $data['semua'] = $this->M_laporan->ygdipilih($tglstart, $tglend)->result();
        $data['semua6'] = $this->M_laporan->ygdipilih6hari($tglstart, $tglend)->result();

        $data['profilku'] = $this->M_kpimmingguan->getdataku()->result();

        $keyjabatan = $this->session->userdata('id_karyawan');
        $data['jabatan'] = $this->M_kpimmingguan->getJabatan($keyjabatan);

        $keydept = $this->session->userdata('id_karyawan');
        $data['dept'] = $this->M_kpimmingguan->getDept($keydept);

        $data['tglstart'] = $tglstart;
        $data['tglend'] = $tglend;
        $data['libur'] = $libur;
        $data['periode'] = $periode;
        

        $this->load->view('tampil_laporanentrypublik',$data);
    }

    public function enamhari()
    {
   $this->app_model->getLogin();
        if ($this->session->userdata('level') == 2 || $this->session->userdata('level') == 6 || $this->session->userdata('level') == 3 || $this->session->userdata('level') == 4) {
            $this->session->set_flashdata('message_name', 'Mohon maaf, Anda tidak dapat mengakses halaman Admin');
            redirect(base_url() . 'Home', 'refresh');

        }


        $data['table'] = $this->M_laporan->ambilsemua()->result();
        $data['profilku'] = $this->M_kpimmingguan->getdataku()->result();
        $data['semua'] = $this->M_laporan->ambiluntuklaporan()->result();

        $keyjabatan = $this->session->userdata('id_karyawan');
        $data['jabatan'] = $this->M_kpimmingguan->getJabatan($keyjabatan);

        $keydept = $this->session->userdata('id_karyawan');
        $data['dept'] = $this->M_kpimmingguan->getDept($keydept);
        

        $this->load->view('tampil_laporanentry6hari',$data);
    }

    public function hitung6hari(){
        $this->app_model->getLogin();
        if ($this->session->userdata('level') == 2 || $this->session->userdata('level') == 6 || $this->session->userdata('level') == 3 || $this->session->userdata('level') == 4) {
            $this->session->set_flashdata('message_name', 'Mohon maaf, Anda tidak dapat mengakses halaman Admin');
            redirect(base_url() . 'Home', 'refresh');

        }

         if( $this->input->post('tglstart')==null  & $this->input->post('tglend')==null){
            redirect(base_url() . 'Laporan/enamhari', 'refresh');
         }

        $tglstart = $this->input->post('tglstart');
        $tglend = $this->input->post('tglend');
        $libur = $this->input->post('libur');
        

        $data['semua'] = $this->M_laporan->ygdipilih6hari($tglstart, $tglend)->result();

        $data['profilku'] = $this->M_kpimmingguan->getdataku()->result();

        $keyjabatan = $this->session->userdata('id_karyawan');
        $data['jabatan'] = $this->M_kpimmingguan->getJabatan($keyjabatan);

        $keydept = $this->session->userdata('id_karyawan');
        $data['dept'] = $this->M_kpimmingguan->getDept($keydept);

        $data['tglstart'] = $tglstart;
        $data['tglend'] = $tglend;
        $data['libur'] = $libur;
        

        $this->load->view('tampil_laporanentry6hari',$data);

    }

    public function update($key) {
        $this->app_model->getLogin();

        if( $this->input->post('dept[]')==null ){
            redirect(base_url() . 'Karyawan', 'refresh');
         }

        $isi=$this->input->post('dept[]');
        $hak=$this->input->post('hak[]');

        if( $this->input->post('hak[]')==null ){
            $hak = array('0');
         }

        $data = array(
            'username' => $this->input->post('username'),
            'nama_karyawan' => $this->input->post('nama'),
            'password' => md5($this->input->post('password')),
            'id_jabatan' => $this->input->post('jabatan'),
            'dept' => implode(",", $isi),
            'hak_akses' => implode(",", $hak),
            );
        
        $this->M_laporan->get_update($data, $key);

        redirect(base_url() . 'Karyawan', 'refresh');

    }

}
