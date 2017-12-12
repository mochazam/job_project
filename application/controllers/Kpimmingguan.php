<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kpimmingguan extends CI_Controller {


	public function __construct() {
        date_default_timezone_set('Asia/Jakarta');
		parent::__construct();
        $this->load->model(array('M_kpimmingguan', 'M_kpimmingguannext', 'M_karyawanku', 'M_reportsub','app_model'));
        $this->load->library(array('session', 'form_validation', 'upload', 'user_agent', 'email'));
        $this->load->helper(array('url', 'form', 'text', 'html', 'security', 'file', 'directory', 'number', 'date', 'download', 'tgl_indo'));
	}

	public function index()
	{
        $this->app_model->getLogin();
        
        $key = $this->session->userdata('id_karyawan');

        //UNTUK UPDATE OTOMATIS
        $updateauto = array(
             'id_status' => 2,
             'sdh_send' => 1,
            );
        $this->M_kpimmingguan->updateauto($updateauto);
        //UNTUK UPDATE OTOMATIS end



        $data['jabatan'] = $this->M_kpimmingguan->getJabatan($key);

        $data['dept'] = $this->M_kpimmingguan->getDept($key);

        $data['deptbaru'] = $this->M_kpimmingguan->ambilDept($key);
        //print_r($username);
        //die();
        $data['profilku'] = $this->M_kpimmingguan->getdataku()->result();

		$data['table'] = $this->M_kpimmingguan->getAll()->result();
        $data['nilaiku'] = $this->M_kpimmingguan->getnilaiku()->result();
        $data['tdkinput'] = $this->M_kpimmingguan->tdkinput()->result();
        $data['inboxblmbaca'] = $this->M_kpimmingguan->inboxblmbaca()->result();
        $data['noteblmbaca'] = $this->M_kpimmingguan->noteblmbaca()->result();
        $data['planblmbaca'] = $this->M_kpimmingguan->planblmbaca()->result();
        $data['noteplan'] = $this->M_kpimmingguan->noteplan()->result();

        //mulai dept

        $this->db->where('id_karyawan', $key);
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

        


        $this->load->view('tampil_kpim',$data);

	}

    function jadwal(){
        $this->app_model->getLogin();
         $keyjabatan = $this->session->userdata('id_karyawan');
        $data['jabatan'] = $this->M_kpimmingguan->getJabatan($keyjabatan);
        $data['profilku'] = $this->M_kpimmingguan->getdataku()->result();

        $keydept = $this->session->userdata('id_karyawan');
        $data['dept'] = $this->M_kpimmingguan->getDept($keydept);
        $this->load->view('tampil_jadwal',$data);
    }

    function jadwalnilai(){
        $this->app_model->getLogin();
         $keyjabatan = $this->session->userdata('id_karyawan');
        $data['jabatan'] = $this->M_kpimmingguan->getJabatan($keyjabatan);
        $data['profilku'] = $this->M_kpimmingguan->getdataku()->result();

        $keydept = $this->session->userdata('id_karyawan');
        $data['dept'] = $this->M_kpimmingguan->getDept($keydept);
        $this->load->view('tampil_jadwalnilai',$data);
    }

    function kpimterkirim(){
        $this->app_model->getLogin();
        
        $keyjabatan = $this->session->userdata('id_karyawan');
        $data['jabatan'] = $this->M_kpimmingguan->getJabatan($keyjabatan);
        $data['profilku'] = $this->M_kpimmingguan->getdataku()->result();
        $keydept = $this->session->userdata('id_karyawan');
        $data['dept'] = $this->M_kpimmingguan->getDept($keydept);
        //print_r($username);
        //die();

        $data['table'] = $this->M_kpimmingguan->getAllterkirim()->result();
        $data['inboxblmbaca'] = $this->M_kpimmingguan->inboxblmbaca()->result();
        $data['noteblmbaca'] = $this->M_kpimmingguan->noteblmbaca()->result();
        $data['planblmbaca'] = $this->M_kpimmingguan->planblmbaca()->result();
        $data['noteplan'] = $this->M_kpimmingguan->noteplan()->result();

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

        $this->load->view('tampil_kpimterkirim',$data);
    }

    function replykpim(){
        $this->app_model->getLogin();
        
        $keyjabatan = $this->session->userdata('id_karyawan');
        $data['jabatan'] = $this->M_kpimmingguan->getJabatan($keyjabatan);
        $data['profilku'] = $this->M_kpimmingguan->getdataku()->result();
        $key = $this->session->userdata('id_karyawan');
        $data['dept'] = $this->M_kpimmingguan->getDept($key);
        //print_r($username);
        //die();

        $data['table'] = $this->M_kpimmingguan->getAllreply()->result();
         $data['inboxblmbaca'] = $this->M_kpimmingguan->inboxblmbaca()->result();
        $data['noteblmbaca'] = $this->M_kpimmingguan->noteblmbaca()->result();
        $data['planblmbaca'] = $this->M_kpimmingguan->planblmbaca()->result();
        $data['noteplan'] = $this->M_kpimmingguan->noteplan()->result();

        $gantinotif = array(
            
            'notif_note' => 0,
            
            );

        $this->M_kpimmingguan->notif_note($gantinotif, $key);

        //mulai dept

        $this->db->where('id_karyawan', $key);
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

        $this->load->view('tampil_reply',$data);
    }

    function replykpimnext(){
        $this->app_model->getLogin();
        
        $keyjabatan = $this->session->userdata('id_karyawan');
        $data['jabatan'] = $this->M_kpimmingguannext->getJabatan($keyjabatan);
        $data['profilku'] = $this->M_kpimmingguan->getdataku()->result();

        $keydept = $this->session->userdata('id_karyawan');
        $data['dept'] = $this->M_kpimmingguannext->getDept($keydept);
        //print_r($username);
        //die();

        $data['table'] = $this->M_kpimmingguannext->getAllreplykpimnext()->result();
         $data['inboxblmbaca'] = $this->M_kpimmingguan->inboxblmbaca()->result();
        $data['noteblmbaca'] = $this->M_kpimmingguan->noteblmbaca()->result();
        $data['planblmbaca'] = $this->M_kpimmingguan->planblmbaca()->result();
        $data['noteplan'] = $this->M_kpimmingguan->noteplan()->result();

        $gantinotif = array(
            
            'notif_plan' => 0,
            'notif_note' => 0,
            
            );

        $this->M_kpimmingguan->notif_plan($gantinotif, $keydept);

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

        $this->load->view('tampil_replykpimnext',$data);
    }

    public function pesan()
    {
        $this->app_model->getLogin();

        // if ($this->session->userdata('level') == 2 ) {
        //     $this->session->set_flashdata('message_name', 'Mohon maaf, Anda tidak dapat mengakses halaman Report Sub');
        //     redirect(base_url() . 'Home', 'refresh');

        // }

        $data['pesanku'] = $this->M_kpimmingguan->getpesanku()->result();
        $data['pesanmasuk'] = $this->M_kpimmingguan->getpesanmasuk()->result();
        $data['pesandept'] = $this->M_kpimmingguan->getpesandept()->result();

         $data['inboxblmbaca'] = $this->M_kpimmingguan->inboxblmbaca()->result();
        $data['noteblmbaca'] = $this->M_kpimmingguan->noteblmbaca()->result();
        $data['planblmbaca'] = $this->M_kpimmingguan->planblmbaca()->result();
        $data['noteplan'] = $this->M_kpimmingguan->noteplan()->result();

        $data['profilku'] = $this->M_kpimmingguan->getdataku()->result();

        $keyjabatan = $this->session->userdata('id_karyawan');
        $data['jabatan'] = $this->M_reportsub->getJabatan($keyjabatan);

        $keydept = $this->session->userdata('id_karyawan');
        $data['dept'] = $this->M_kpimmingguan->getDept($keydept);

        $this->load->model(array('M_pilihkaryawan', 'app_model'));

        $data['ambilkaryawanall'] = $this->M_reportsub->ambilkaryawanall();
       $data['isidept'] = $this->M_pilihkaryawan->ambilDept();

       $gantinotif = array(
            
            'notif' => '0',
            
            );

        $this->M_kpimmingguan->notif_pesan($gantinotif, $keydept);

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

        //tampilkan nama karyawan
        $key = $this->input->post('id');

        $this->db->where('id_karyawan', $keydept);
        $kueri = $this->db->get('karyawan');
        if($kueri->num_rows()>0)
        {
            foreach ($query->result() as $row) {
            $hak = $row->hak_akses;
            }
        }

        $hak_akses = explode(',', $hak);
        $this->db->where_in('dept', $key);
        $this->db->where_in('id_jabatan', $hak_akses);
        $kueri2 = $this->db->get('karyawan');

        if($kueri2->num_rows()>0)
        {
            /*echo "<select>";;
            foreach ($query2->result() as $rows) 
            {
            echo "<option value'".$rows->$id_dept."'>".$rows->nama_dept."</option>";

            }
            echo "</select>";*/

            $data['isinamakaryawan'] = $kueri2;
            

        }


        $this->load->view('tampil_pesan',$data);



    }


    public function kirimpesan(){
        $this->app_model->getLogin();
        date_default_timezone_set('Asia/Jakarta');

         $data = array(
            'pengirim' => $this->session->userdata('id_karyawan'),
            'tgl' => date('y-m-d'),
            'penerima_user' => $this->input->post('pilihkar'),
            'penerima_dept' => $this->input->post('pilihdept'),
            'goal' => $this->input->post('goal'),
            'pesan' => $this->input->post('pesan'),
            'status_pesan' => $this->input->post('status_pesan'),
            'notif' => '1',
        );

        
        $this->M_kpimmingguan->kirimpesan($data);

        redirect(base_url() . 'Kpimmingguan/pesan', 'refresh');



    }

    public function hapuspesanku($idpesan){
        $this->app_model->getLogin();
        // $where = array('id_pesan' => $idpesan);
        $this->M_kpimmingguan->deletepesan($idpesan);
        redirect(base_url() . 'Kpimmingguan/pesan', 'refresh');
    

    }

    public function ijin()
    {
        $this->app_model->getLogin();

        if ($this->session->userdata('id_dept') != 2 ) {
            $this->session->set_flashdata('message_name', 'Mohon maaf, Anda tidak dapat mengakses halaman Ijin Karyawan');
            redirect(base_url() . 'Home', 'refresh');

        }
        $data['table'] = $this->M_kpimmingguan->getIjin()->result();
        $data['pesanku'] = $this->M_kpimmingguan->getpesanku()->result();
        $data['pesanmasuk'] = $this->M_kpimmingguan->getpesanmasuk()->result();
        $data['pesandept'] = $this->M_kpimmingguan->getpesandept()->result();

         $data['inboxblmbaca'] = $this->M_kpimmingguan->inboxblmbaca()->result();
        $data['noteblmbaca'] = $this->M_kpimmingguan->noteblmbaca()->result();
        $data['planblmbaca'] = $this->M_kpimmingguan->planblmbaca()->result();
        $data['noteplan'] = $this->M_kpimmingguan->noteplan()->result();

        $data['profilku'] = $this->M_kpimmingguan->getdataku()->result();

        $keyjabatan = $this->session->userdata('id_karyawan');
        $data['jabatan'] = $this->M_reportsub->getJabatan($keyjabatan);

        $keydept = $this->session->userdata('id_karyawan');
        $data['dept'] = $this->M_kpimmingguan->getDept($keydept);

        $this->load->model(array('M_pilihkaryawan', 'app_model'));

        $data['ambilkaryawanall'] = $this->M_reportsub->ambilkaryawanall();
       $data['isidept'] = $this->M_pilihkaryawan->ambilDept();

       $gantinotif = array(
            
            'notif' => '0',
            
            );

        $this->M_kpimmingguan->notif_pesan($gantinotif, $keydept);

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

        //tampilkan nama karyawan
        $key = $this->input->post('id');

        $this->db->where('id_karyawan', $keydept);
        $kueri = $this->db->get('karyawan');
        if($kueri->num_rows()>0)
        {
            foreach ($query->result() as $row) {
            $hak = $row->hak_akses;
            }
        }

        $hak_akses = explode(',', $hak);
        $this->db->where_in('dept', $key);
        $this->db->where_in('id_jabatan', $hak_akses);
        $kueri2 = $this->db->get('karyawan');

        if($kueri2->num_rows()>0)
        {
            /*echo "<select>";;
            foreach ($query2->result() as $rows) 
            {
            echo "<option value'".$rows->$id_dept."'>".$rows->nama_dept."</option>";

            }
            echo "</select>";*/

            $data['isinamakaryawan'] = $kueri2;
            

        }


        $this->load->view('tampil_ijin',$data);



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

    public function test2($key){
        $this->db->where('id_karyawan',$key);
        $query = $this->db->get('karyawan');
        if($query->num_rows()>0)
        {
            foreach ($query->result() as $row) {
                $dept = $row->dept;  //1,2
            }
        }

        $id_dept = explode(',', $dept);  //[1, 2]
        $this->db->where_in('id_dept', $id_dept);
        $query2 = $this->db->get('dept');

        if($query2->num_rows()>0)
        {
            echo "<select>";;
            foreach ($query2->result() as $rows) 
            {
            echo "<option value'".$rows->id_dept."'>".$rows->nama_dept."</option>";

            }
            echo "</select>";
        }
    }

	public function create() {
        $this->app_model->getLogin();
        /*$this->form_validation->set_rules('tgl1', 'tgl1', 'required');
        $this->form_validation->set_rules('tgl2', 'tgl2', 'required');
        $this->form_validation->set_rules('tgl', 'tgl', 'required');
        $this->form_validation->set_rules('goals', 'goals', 'required');
        $this->form_validation->set_rules('action', 'action', 'required');
        $this->form_validation->set_rules('result', 'result', 'required');
        $this->form_validation->set_rules('deadline', 'deadline', 'required');*/

// $tgl = $this->input->post('tgl');\
    date_default_timezone_set('Asia/Jakarta');
    $tgl = date("y-m-d");
    $dead = date("y-m-d", strtotime($this->input->post('deadline')));

    if ($dead < $tgl ) {
        $status_dead = 3;
    }
    elseif ($dead > $tgl ) {
        $status_dead = 1;   
    }
    elseif ($dead == $tgl ) {
        $status_dead = 2;   
    }



            $data = array(
            'id_karyawan' => $this->session->userdata('id_karyawan'),
            // 'tgl' => $this->input->post('tgl'),
            'tgl' => $tgl,
            'tgl_start' => $this->input->post('tgl1'),
            'tgl_end' => $this->input->post('tgl2'),
            'nama_goals' => $this->input->post('goals'),
            'action' => $this->input->post('action'),
            'kendala' => $this->input->post('kendala'),
            'result' => $this->input->post('result'),
            'deadline' => $this->input->post('deadline'),
            'id_status' => '1',
            // untuk OTOMATIS nilai 10 
            'target' => '10', 
            'note' => '0',
            'status_deadline' => $status_dead,
            'tgs_dept' => $this->input->post('tgs_dept'),
            'usulnilai' => $this->input->post('usulnilai'),
        );

        //$input = $this->input->post('departemen');

        //print_r($input);

        //die();

        //$this->db->insert('dept', $data);
        $this->M_kpimmingguan->get_insert($data);

        redirect(base_url() . 'Kpimmingguan', 'refresh');
	}

    public function simpanijin() {
        $this->app_model->getLogin();
        /*$this->form_validation->set_rules('tgl1', 'tgl1', 'required');
        $this->form_validation->set_rules('tgl2', 'tgl2', 'required');
        $this->form_validation->set_rules('tgl', 'tgl', 'required');
        $this->form_validation->set_rules('goals', 'goals', 'required');
        $this->form_validation->set_rules('action', 'action', 'required');
        $this->form_validation->set_rules('result', 'result', 'required');
        $this->form_validation->set_rules('deadline', 'deadline', 'required');*/

        // $tgl = $this->input->post('tgl');\
            date_default_timezone_set('Asia/Jakarta');
            $tgl = date("y-m-d");

            $start = $this->input->post('tglstart');
            $end = $this->input->post('tglend');

            // loop date
            $startDate = DateTime::createFromFormat("Y/m/d", date("Y/m/d", strtotime($start)));
            $endDate = DateTime::createFromFormat("Y/m/d", date("Y/m/d", strtotime($end)));

            $periodInterval = new DateInterval( "P1D" ); // 1-day, though can be more sophisticated rule
            $endDate->add( $periodInterval );
            $period = new DatePeriod( $startDate, $periodInterval, $endDate );


            foreach($period as $date){
               // echo $date->format("Y-m-d") , PHP_EOL;

                $data = array(
            'id_karyawan' => $this->input->post('pilihkar'),
            // 'tgl' => $this->input->post('tgl'),
            'tgl' => $date->format("Y-m-d"),
            'nama_goals' => 'Ijin',
            'action' => $this->input->post('status_ijin'),
            'result' => $this->input->post('keterangan'),
            'deadline' => $date->format("Y-m-d"),
            // untuk OTOMATIS nilai 10 
            'target' => '10', 
            'note' => '0',
            'status_deadline' => '2',
            'tgs_dept' => $this->input->post('pilihdept'),
            'usulnilai' => '0',
            'id_status' => '2',
            'sdh_send' => '1',
            );

        
            $this->M_kpimmingguan->get_insert($data);
           }
            // loop date


           

        redirect(base_url() . 'kpimmingguan/ijin', 'refresh');
    }

    

	public function update($key){
        $this->app_model->getLogin();
        date_default_timezone_set('Asia/Jakarta');
        $tgl = date("y-m-d", strtotime($this->input->post('tgledit')));
        $dead = date("y-m-d", strtotime($this->input->post('deadlineedit')));

        if ($dead < $tgl ) {
            $status_dead = 3;
        }
        elseif ($dead > $tgl ) {
            $status_dead = 1;   
        }
        elseif ($dead == $tgl ) {
            $status_dead = 2;   
        }

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
            'status_deadline' => $status_dead,
            'tgs_dept' => $this->input->post('tgs_dept'),
            'usulnilai' => $this->input->post('usulnilaiedit'),
			);
		$this->M_kpimmingguan->get_update($data, $key);

        redirect(base_url() . 'Kpimmingguan', 'refresh');
	}

    public function updatestatus(){
        $this->app_model->getLogin();
         $key = $this->session->userdata('id_karyawan');
        $data = array(

             'id_status' => $this->input->post('isistatus'),
             'sdh_send' => 1,
            );
        $this->M_kpimmingguan->get_updatestatus($key, $data);

       redirect(base_url() . 'Kpimmingguan', 'refresh');
    }

	public function hapus($key){
        $this->app_model->getLogin();
		$where = array('id' => $key);
		$this->M_kpimmingguan->delete($key);
		redirect(base_url() . 'Kpimmingguan', 'refresh');
	}

    public function hapusijin($key){
        $this->app_model->getLogin();
        $where = array('id' => $key);
        $this->M_kpimmingguan->delete($key);
        redirect(base_url() . 'Kpimmingguan/ijin', 'refresh');
    }
}
