<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visit extends CI_Controller {

	var $template = 'visit/template';
	public function __construct() {
		parent::__construct();
        $this->load->model(array('app_model'));
        $this->load->model('Mvisit/M_visit', 'visit');
        $this->load->library(array('session', 'form_validation', 'upload', 'user_agent', 'email', 'googlemaps'));
        $this->load->helper(array('url', 'form', 'text', 'html', 'security', 'file', 'directory', 'number', 'date', 'download', 'tgl_indo_helper'));
	}

	public function index()
	{
		$this->app_model->getLogin();
		$data['dept'] = implode(',', $this->visit->getDeptById($this->session->userdata('id_dept')));
		// $deptArray = explode(',', $this->session->userdata('id_dept'));
		// $deptString = $this->session->userdata('id_dept');
		// $getAllDept = implode(',', $data['dept']);
		// var_dump($data['dept']);
		// var_dump($getAllDept);
		// die();
		$this->load->view('visit/form_visit',$data);
	}

	function insert() {
		$this->form_validation->set_rules('log_lokasi', 'log_lokasi', 'required');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
                        'karyawan_id' => $this->session->userdata('id_karyawan'),
                        'visited_at' => date('Y-m-d H:i:s'),
                        'lokasi' => $this->input->post('log_lokasi'),
                        'lat' => $this->input->post('log_lat'),
                        'long' => $this->input->post('log_long'),
                        'company' => $this->input->post('company'),
                        'keterangan' => $this->input->post('keterangan'),
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    );
               
            $this->visit->get_insert($data);
            redirect(base_url() . 'Evisit/visit/show', 'refresh');

        } else {
        	return 'error page';
        }
	} 

	function show() {
		$this->app_model->getLogin();
		$data['visit'] = $this->visit->getVisitDataBy($this->session->userdata('id_karyawan'));
		// $data['visit'] = $this->M_visit->getVisitDataBy(80);
		$data['dept'] = implode(',', $this->visit->getDeptById($this->session->userdata('id_dept')));

		$data['content'] = 'visit/list_visit';
		$this->load->view($this->template, $data);
	}

	function show_map($param1 = '', $param2 = '') {
		$data['lat'] = $param1;
		$data['long'] = $param2;
		$latlng = $param1.", ".$param2;
		// 
		// var_dump($latlng);
		// die();
		$config['center'] = $latlng;
		$config['zoom'] = 17; //'auto';
		$this->googlemaps->initialize($config);

		$marker = array();
		$marker['position'] = $latlng;
		$this->googlemaps->add_marker($marker);
		$data['map'] = $this->googlemaps->create_map();

		$data['content'] = 'visit/map_visit2';
		$this->load->view($this->template, $data);
	}

	function history() {
		$submit = $this->input->post('submit');

		// var_dump($submit);

		if ($submit == 'Tampil') {
			$this->form_validation->set_rules('nama_karyawan', 'nama_karyawan', 'required');

			if ($this->form_validation->run() == TRUE) {
				$name_id = $this->input->post('nama_karyawan');
				$id_dept = $this->input->post('kd_dept');
				$start = $this->input->post('mulai');
				$end = $this->input->post('selesai');

				$data_visitor = $this->visit->getAllHistory($name_id, $start, $end);
				$data['history_visit'] = $this->visit->getAllHistory($name_id, $start, $end);

				if ($data_visitor->num_rows() > 0) {
					$result = array();
					foreach ($data_visitor->result_array() as $row) {
						$result[] = 'lat: '.$row['lat'].', lng: '.$row['long'];
					};

					$multi_marker = $this->visit->getAllMarker($name_id, $start, $end);

					$result = array();
					foreach ($multi_marker->result_array() as $row) {
						$result[] = $row['lat'].', '.$row['long'];
					};

					if (count($result) > 0 ) {
						$config['center'] = $result[0];	
					} else {
						$config['center'] = '';
					}

					$config['zoom'] = 'auto';
					$this->googlemaps->initialize($config);

					foreach ($result as $key => $value) {
						$marker = array();
						$marker['position'] = $value;
						$this->googlemaps->add_marker($marker);
					}

					if (count($result) > 0 ) {
						$data['map'] = $this->googlemaps->create_map();
					} else {
						$data['map'] = array(
							'js' => '',
							'html' => ''
						);
					}
				}
				
				$data['visitor'] = $this->getNama($name_id);
				$data['departemen'] = $this->getDept($id_dept);
				$data['jabatan'] = $this->getJabatan($name_id);
				$data['foto'] = $this->getFoto($name_id);
				$data['id_name'] = $name_id;
				$data['tgl_awal'] = $start;
				$data['tgl_akhir'] = $end;
				$data['dept'] = implode(',', $this->visit->getDeptById($this->session->userdata('id_dept')));
				$data['history_visit'] = $this->visit->getAllHistory($name_id, $start, $end);
			}
		}	
		$data['list_dept'] =  $this->visit->getDept();
		$data['content'] = 'visit/history_visit';
		$this->load->view($this->template, $data);
	}

	function getNama($param = '') {
		$nama = $this->visit->getNamaKaryawan($param);
		return $nama;
	}

	function getDept($param = '') {
		$dept = $this->visit->getDeptName($param);
		return $dept;
	}

	function getJabatan($param = '') {
		$jabatan = $this->visit->getJabatanById($param);
		return $jabatan;
	}

	function getFoto($param = '') {
		$foto = $this->visit->getFotoKaryawan($param);
		return $foto;
	}

	public function get_name() {
		$dept_id = $this->input->post('dept_id');
		$tmp 	= '';
		$data 	= $this->visit->getNameById($dept_id);
		if(!empty($data)) {
			$tmp .=	"<option value=''>Pilih Karyawan</option>";	
			foreach($data as $row){	
			     $tmp .= "<option value='".$row['id_karyawan']."'>".$row['nama_karyawan']."</option>";
			}
		} else {
			$tmp .=	"<option value=''>Pilih Karyawan</option>";	
		}
		die($tmp);
	}

	function getHistoryVisit() {
		$this->form_validation->set_rules('nama_karyawan', 'nama_karyawan', 'required');

		if ($this->form_validation->run() == TRUE) {
			$name_id = $this->input->post('nama_karyawan');
			$start = $this->input->post('mulai');
			$end = $this->input->post('selesai');

			$data_visitor = $this->visit->getAllHistory($name_id, $start, $end);
			$data['history_visit'] = $this->visit->getAllHistory($name_id, $start, $end);
			$result = array();
			foreach ($data_visitor->result_array() as $row) {
				$result[] = 'lat: '.$row['lat'].', lng: '.$row['long'];
			};

			$data['dept'] = implode(',', $this->visit->getDeptById($this->session->userdata('id_dept')));
			$data['history_visit'] = $this->visit->getAllHistory($name_id, $start, $end);

			$data['content'] = 'visit/history_visit_list';
			$this->load->view($this->template, $data);
		}		
	}

	function update(){
		$id= $this->input->post("id");
		$value= $this->input->post("value");
		$modul= $this->input->post("modul");
		$this->visit->update($id,$value,$modul);
		echo "{}";
	}

	function getRouteMap() {
		$name_id = $this->input->post('id');
		$start = $this->input->post('tgl_awal');
		$end = $this->input->post('tgl_akhir');

		$data_visitor = $this->visit->getAllHistory($name_id, $start, $end);

		if ($data_visitor->num_rows() > 0) {
			$result = array();
			foreach ($data_visitor->result_array() as $row) {
				$result[] = 'lat: '.$row['lat'].', lng: '.$row['long'];
			};

			$multi_marker = $this->visit->getAllMarker($name_id, $start, $end);

			$result = array();
			foreach ($multi_marker->result_array() as $row) {
				$result[] = $row['lat'].', '.$row['long'];
			};

			if (count($result) > 0 ) {
				$config['center'] = $result[0];	
			} else {
				$config['center'] = '';
			}

			$config['zoom'] = 'auto';
			$this->googlemaps->initialize($config);

			foreach ($result as $key => $value) {
				$marker = array();
				$marker['position'] = $value;
				$this->googlemaps->add_marker($marker);
			}

			if (count($result) > 0 ) {
				$data['map'] = $this->googlemaps->create_map();
			} else {
				$data['map'] = array(
					'js' => '',
					'html' => ''
				);
			}
		}
		// }
		$data['content'] = 'visit/map_visit2';
		$this->load->view($this->template, $data);
	}

	function showUMap() {
		$date_now = date('Y-m-d');//NOW();
		$name_id = $this->session->userdata('id_karyawan');
		$data_visitor = $this->visit->getNowHistory($name_id, $date_now);

		if ($data_visitor->num_rows() > 0) {
			$result = array();
			foreach ($data_visitor->result_array() as $row) {
				$result[] = 'lat: '.$row['lat'].', lng: '.$row['long'];
			};

			$multi_marker = $this->visit->getAllMarkerNow($name_id, $date_now);

			$result = array();
			foreach ($multi_marker->result_array() as $row) {
				$result[] = $row['lat'].', '.$row['long'];
			};

			if (count($result) > 0 ) {
				$config['center'] = $result[0];	
			} else {
				$config['center'] = '';
			}

			$config['zoom'] = 'auto';
			$this->googlemaps->initialize($config);

			foreach ($result as $key => $value) {
				$marker = array();
				$marker['position'] = $value;
				$this->googlemaps->add_marker($marker);
			}

			if (count($result) > 0 ) {
				$data['map'] = $this->googlemaps->create_map();
			} else {
				$data['map'] = array(
					'js' => '',
					'html' => ''
				);
			}
		}
		$data['content'] = 'visit/map_visit2';
		$this->load->view($this->template, $data);
	}

	// function getRouteMap() {
	// 	if ('IS_AJAX') {
	// 		// $id = $this->input->post('id');
	// 		// $start = $this->input->post('tgl_awal');
	// 		// $end = $this->input->post('tgl_akhir');

	// 		$id = 96;
	// 		$start = '2017-11-1';
	// 		$end = '2017-12-6';

	// 		$multi_marker = $this->M_visit->getAllMarker($id, $start, $end);

	// 		$result = array();
	// 		foreach ($multi_marker->result_array() as $row) {
	// 			// $result[] = '[lat: '.$row['lat'].', lng: '.$row['long'].']';
	// 			$result[] = $row['lat'].', '.$row['long'];
	// 			$lok = $row['company'];
	// 			$lat = $row['lat'];
	// 			$long = $row['long'];
	// 		};

	// 		$getCenter = $result[0]; //explode(',', $result[5]);
	// 		// $getCenterLat = $result[0][0];
	// 		// $getCenterLong = $result[0][1];
	// 		// var_dump($result);
	// 		// die();

	// 		echo json_encode($result);
	// 		die();

	// 		$config['center'] = $getCenter;
	// 		$config['zoom'] = 16;
	// 		$this->googlemaps->initialize($config);

	// 		$polyline = array();
	// 		$polyline['points'] = $result;
	// 		$this->googlemaps->add_polyline($polyline);
	// 		$data['map'] = $this->googlemaps->create_map();

	// 		$this->load->view('visit/map_visit2', $data); 

	// 	}
	// }


	function marker() {
		$id = 96;
		$start = '2017-11-1';
		$end = '2017-12-6';

		$multi_marker = $this->visit->getAllMarker($id, $start, $end);

		$result = array();
		foreach ($multi_marker->result_array() as $row) {
			$result[] = $row['lat'].', '.$row['long'];
		};

		$config['center'] = '37.429, -122.1519';
		$config['zoom'] = 'auto';
		$this->googlemaps->initialize($config);

		$marker = array();
		$marker['position'] = '37.429, -122.1519';
		$marker['infowindow_content'] = '1 - Hello World!';
		$marker['icon'] = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=A|9999FF|000000';
		$this->googlemaps->add_marker($marker);
		$data['map'] = $this->googlemaps->create_map();

		$data['content'] = 'visit/map_visit2';
		$this->load->view($this->template, $data);
	}

	function dashboard() {
		$data['content'] = 'visit/dashboard';
		$this->load->view($this->template, $data);
	}

	public function ajax_edit($id) {
		$data = $this->visit->get_by_id($id);
		echo json_encode($data);
	}
 
	public function visits_update() {
		$data = array(
				'note' => $this->input->post('note')
			);
		$this->visit->visits_update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}
}
