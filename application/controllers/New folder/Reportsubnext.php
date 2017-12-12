<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportsubnext extends CI_Controller {


	 public function __construct() {
	        parent::__construct();
	        $this->load->model(array('M_reportsubnext', 'app_model'));
	        $this->load->library(array('session', 'form_validation', 'upload', 'user_agent', 'email'));
	        $this->load->helper(array('url', 'form', 'text', 'html', 'security', 'file', 'directory', 'number', 'date', 'download'));
	    }

	
	public function index()
	{
	
		$this->app_model->getLogin();
        
        $keyjabatan = $this->session->userdata('id_karyawan');
        $data['jabatan'] = $this->M_reportsubnext->getJabatan($keyjabatan);

        $keydept = $this->session->userdata('id_karyawan');
        $data['dept'] = $this->M_reportsubnext->getDept($keydept);
        //print_r($username);
        //die();

        $data['table'] = $this->M_reportsubnext->getAll()->result();
        $this->load->view('tampil_reportsubnext',$data);

	}
}
