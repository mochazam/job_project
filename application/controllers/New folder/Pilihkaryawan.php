<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pilihkaryawan extends CI_Controller {

	public function __construct() {
		parent::__construct();
        $this->load->model(array('M_pilihkaryawan', 'app_model'));
        $this->load->library(array('session', 'form_validation', 'upload', 'user_agent', 'email'));
        $this->load->helper(array('url', 'form', 'text', 'html', 'security', 'file', 'directory', 'number', 'date', 'download'));
	}

	public function index()
	{
        $this->app_model->getLogin();
        
        $keyjabatan = $this->session->userdata('id_karyawan');
        $data['jabatan'] = $this->M_pilihkaryawan->getJabatan($keyjabatan);

        $keydept = $this->session->userdata('id_karyawan');
        $data['dept'] = $this->M_pilihkaryawan->getDept($keydept);
        $data['ambilkaryawanall'] = $this->M_pilihkaryawan->ambilkaryawanall();
        //print_r($username);
        //die();
        $val_pilih = $this->input->post('pilihkar');
        if ($val_pilih) {
            $data['table'] = $this->M_pilihkaryawan->getAll($val_pilih)->result();    
        }

		$data['isidept'] = $this->M_pilihkaryawan->ambilDept();


        $data['tot'] = $this->M_pilihkaryawan->getTot();


        //mulai dept

        $this->db->where('id_karyawan', $keydept);
        $query = $this->db->get('karyawan');
        if($query->num_rows()>0)
        {
            foreach ($query->result() as $row) {
            $dept = $row->dept;
            }
        }

        $id_dept = explode(',', $dept);
        $this->db->where_in('id_dept', $id_dept);
        $query2 = $this->db->get('dept');

        if($query2->num_rows()>0)
        {
            /*echo "<select>";;
            foreach ($query2->result() as $rows) 
            {
            echo "<option value'".$rows->$id_dept."'>".$rows->nama_dept."</option>";

            }
            echo "</select>";*/

            $data['isinamadept'] = $query2;
            

        }
        //selesai tampilkan dept
		$this->load->view('tampil_pilihkaryawan',$data);



	}

    function test() {
        $str = 'one,two,three,four,ss';

        $arr = explode(',', $str);
        // zero limit
       // print_r(explode(',',$str));

        print "<br>";

        echo "<select>";
        foreach ($arr as $key => $value) {
            //echo "key = " .$key. "<br>";
            //echo "value = " .$value. "<br>";
            
            echo "<option value='".$key."''>".$value."</option>";
            
        }
        echo "</select>";
    }

    public function tampilkan() {
        $pilihkar = $this->input->post('pilihkar');
        
        
        //var_dump($pilihkar);
        //die();

        $data['tampilkan'] = $this->M_pilihkaryawan->tampilkan($pilihkar);
        //var_dump( $data['tampilkan']);
        //die();
        $this->load->view('tampil_reportsub', $data);


    }

    public function test2($key){
    $this->db->where('id_karyawan',$key);
    $query = $this->db->get('karyawan');
    if($query->num_rows()>0)
    {
        foreach ($query->result() as $row) {
        $dept = $row->dept;
        }
    }

    $id_dept = explode(',', $dept);
    $this->db->where_in('id_dept', $id_dept);
    $query2 = $this->db->get('dept');

    if($query2->num_rows()>0)
    {
        echo "<select>";;
        foreach ($query2->result() as $rows) 
        {
        echo "<option value'".$rows->$id_dept."'>".$rows->nama_dept."</option>";

        }
        echo "</select>";
    }
    }

	public function create() {
        $this->app_model->getLogin();
                $data = array(
            //'id_kary' => $this->session->userdata('id_karyawan'),
            //'tgl_start' => $this->input->post('tgl_start'),
            //'tgl_end' => $this->input->post('tgl_end'),
            'tot_bobot' => $this->input->post('tbobot'),
            'tot_target' => $this->input->post('ttarget'),
            'tot_actual' => $this->input->post('tactual'),
            'tot_score' => $this->input->post('tscore'),
            'nilai_akhir' => $this->input->post('tnilai_akhir'),
        );

        //$input = $this->input->post('departemen');

        //print_r($input);

        //die();

        //$this->db->insert('dept', $data);
        $this->M_pilihkaryawan->get_insertnilai($data);

        redirect(base_url() . 'Reportsub', 'refresh');
	}

    

	public function update($key){
        $this->app_model->getLogin();

		$data = array(
			//'nama_karyawan' => $this->input->post('nama'),
            //'jabatan' => $this->input->post('jabatan'),
            //'dept' => $this->input->post('dept'),
            'tgl' => $this->input->post('tgledit'),
            //'tgl_start' => $this->input->post('tgl1'),
            //'tgl_end' => $this->input->post('tgl2'),
            'nama_goals' => $this->input->post('goaledit'),
            'action' => $this->input->post('actionedit'),
            'kendala' => $this->input->post('kendalaedit'),
            'result' => $this->input->post('resultedit'),
            'deadline' => $this->input->post('deadlineedit'),
            'tgs_dept' => $this->input->post('tgs_dept'),
            'bobot' => $this->input->post('bobotedit'),
            'target' => $this->input->post('targetedit'),
            'actual' => $this->input->post('actualedit'),
            //'score' => $this->input->post('scoreedit'),

            
			);
        $data['score'] = $data['actual'] / $data['target'] * $data['bobot'];

		$this->M_pilihkaryawan->get_update($data, $key);

        //$this->index();

        redirect(base_url() . 'Reportsub', 'refresh');
	}

    public function updatestatus(){
        $this->app_model->getLogin();

        $data = array(
          
             'id_status' => $this->input->post('isistatus'),
            );
        $this->M_pilihkaryawan->get_updatestatus($data);

       redirect(base_url() . 'Reportsub', 'refresh');
    }

	public function hapus($key){
        $this->app_model->getLogin();
		$where = array('id' => $key);
		$this->M_pilihkaryawan->delete($key);
		redirect(base_url() . 'Reportsub', 'refresh');
	}
}
