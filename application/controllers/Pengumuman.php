<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengumuman extends CI_Controller {

	public function __construct() {
		parent::__construct();
        $this->load->model(array('M_pengumuman', 'app_model'));
        $this->load->library(array('session', 'form_validation', 'upload', 'user_agent', 'email'));
        $this->load->helper(array('url', 'form', 'text', 'html', 'security', 'file', 'directory', 'number', 'date', 'download', 'tgl_indo'));
	}
	public function index()
	{
		$this->app_model->getLogin();
		$data['table'] = $this->M_pengumuman->getAll()->result();
		$data['ambilsatu'] = $this->M_pengumuman->getSatu()->result();
		$this->load->view('tampil_pengumuman', $data);
	}

	public function datapengumuman()
	{

		$this->app_model->getLogin();
        if ($this->session->userdata('level') == 2 || $this->session->userdata('level') == 6 || $this->session->userdata('level') == 3 || $this->session->userdata('level') == 4) {
            // $this->session->set_flashdata('message_name', 'Mohon maaf, Anda tidak dapat mengakses halaman Admin');
            redirect(base_url() . 'Pengumuman', 'refresh');

        }

		$this->app_model->getLogin();
		$data['table'] = $this->M_pengumuman->getData()->result();
		$this->load->view('tampil_datapengumuman', $data);
	}

	public function pengumumanku()
	{

		$this->app_model->getLogin();
        if ($this->session->userdata('level') == 2 || $this->session->userdata('level') == 10 || $this->session->userdata('level') == 11) {
            $this->session->set_flashdata('message_name', 'Mohon maaf, Anda tidak dapat mengakses halaman Admin');
            redirect(base_url() . 'index', 'refresh');

        }
        $idku = $this->session->userdata('id_karyawan');
		$this->app_model->getLogin();
		$data['table'] = $this->M_pengumuman->getpengumumanku($idku)->result();
		$this->load->view('tampil_datapengumumanku', $data);
	}

	public function Addpengumuman(){
	$this->app_model->getLogin();

	$utkdept=$this->input->post('dept[]');
	if( $this->input->post('dept[]')==null ){
       $utkdept=array('15');
    }
    
    $tgl_post=date('Y-m-d H:i:s');
	$data = array(
	        'id_karyawan' => $this->session->userdata('id_karyawan'),
	        'judul_post' => $this->input->post('judul_pengumuman'),
	        'tgl_post' => $tgl_post,
	        'tujuan_post' => implode(",", $utkdept),
	        'isi_post' => $this->input->post('isi_pengumuman')
	    );

	    $this->M_pengumuman->get_insert($data);

	    redirect(base_url() . 'Pengumuman', 'refresh');


	}

	public function Editpengumuman($idpost){
	$this->app_model->getLogin();
	if( $this->input->post('dept[]')==null ){
		 $this->session->set_flashdata('message_name', 'Mohon Masukkan Tujuan Departement');
        redirect(base_url() . 'Pengumuman/datapengumuman', 'refresh');
    }

    $utkdept=$this->input->post('dept[]');
    $tgl_post=date('Y-m-d H:i:s');
	$data = array(
	        'id_karyawan' => $this->session->userdata('id_karyawan'),
	        'judul_post' => $this->input->post('judul_pengumuman'),
	        // 'tgl_post' => $tgl_post,
	        'tujuan_post' => implode(",", $utkdept),
	        'isi_post' => $this->input->post('isi_pengumuman')
	    );

	    $this->M_pengumuman->get_update($data, $idpost);

	    redirect(base_url() . 'Pengumuman/datapengumuman', 'refresh');


	}

	public function hapus($idpost){
        $this->app_model->getLogin();
        $where = array('id_post' => $idpost);
        $this->M_pengumuman->delete($idpost);
        redirect(base_url() . 'Pengumuman/datapengumuman', 'refresh');
    }
}
