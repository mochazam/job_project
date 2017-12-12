<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kpimmingguannext extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('M_kpimmingguannext', 'M_kpimmingguan' , 'app_model'));
        $this->load->library(array('session', 'form_validation', 'upload', 'user_agent', 'email'));
        $this->load->helper(array('url', 'form', 'text', 'html', 'security', 'file', 'directory', 'number', 'date', 'download', 'tgl_indo'));
    }

    public function index()
    {
        $this->app_model->getLogin();
        
        $keyjabatan = $this->session->userdata('id_karyawan');
        $data['jabatan'] = $this->M_kpimmingguannext->getJabatan($keyjabatan);

        $keydept = $this->session->userdata('id_karyawan');
        $data['profilku'] = $this->M_kpimmingguan->getdataku()->result();
        $data['dept'] = $this->M_kpimmingguannext->getDept($keydept);
        //print_r($username);
        //die();

        $data['table'] = $this->M_kpimmingguannext->getAll()->result();
         $data['inboxblmbaca'] = $this->M_kpimmingguan->inboxblmbaca()->result();
        $data['noteblmbaca'] = $this->M_kpimmingguan->noteblmbaca()->result();
        $data['planblmbaca'] = $this->M_kpimmingguan->planblmbaca()->result();
        $data['noteplan'] = $this->M_kpimmingguan->noteplan()->result();


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
        $this->load->view('tampil_kpimnext',$data);
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


            $data = array(
            'id_karyawan' => $this->session->userdata('id_karyawan'),
            'tgl' => $this->input->post('tgl'),
            'tgl_start' => $this->input->post('tgl1'),
            'tgl_end' => $this->input->post('tgl2'),
            'nama_goals' => $this->input->post('goals'),
            'action' => $this->input->post('action'),
           
            'deadline' => $this->input->post('deadline'),
            'id_status' => '1',
            'tgs_dept' => $this->input->post('tgs_dept'),
            'id_approve' => '1',
        );

        //$input = $this->input->post('departemen');

        //print_r($input);

        //die();

        //$this->db->insert('dept', $data);
        $this->M_kpimmingguannext->get_insert($data);

        redirect(base_url() . 'Kpimmingguannext', 'refresh');
    }

    

    public function update($key){
        $this->app_model->getLogin();

        $data = array(
            //'nama_karyawan' => $this->input->post('nama'),
            //'jabatan' => $this->input->post('jabatan'),
            //'dept' => $this->input->post('dept'),
            'tgl' => $this->input->post('tgledit'),
            // 'tgl_start' => $this->input->post('tgl1'),
            // 'tgl_end' => $this->input->post('tgl2'),
            'nama_goals' => $this->input->post('goaledit'),
            'action' => $this->input->post('actionedit'),
            'deadline' => $this->input->post('deadlineedit'),
            'tgs_dept' => $this->input->post('tgs_dept'),
            );
        $this->M_kpimmingguannext->get_update($data, $key);

        redirect(base_url() . 'Kpimmingguannext', 'refresh');
    }

    public function updatestatus(){
        $this->app_model->getLogin();
        $key = $this->session->userdata('id_karyawan');

        // mulai fungsi entri ke kpim
        $data_entri = $this->db->get_where('kpim_next', array('id_karyawan' => $key, 'id_status' => '1'))->result();

        foreach ($data_entri as $entri) {
            date_default_timezone_set('Asia/Jakarta');
            $tgl = $entri->tgl;
            $dead = $entri->deadline;

            if ($dead < $tgl ) {
                $status_dead = 3;
            }
            elseif ($dead > $tgl ) {
                $status_dead = 1;   
            }
            elseif ($dead == $tgl ) {
                $status_dead = 2;   
            }


            $isi = array(
                'id_karyawan' => $key,
                'tgl' => $entri->tgl,
                'nama_goals' => $entri->nama_goals,
                'action' => $entri->action,
                'deadline' => $entri->deadline,
                'tgs_dept' => $entri->tgs_dept,
                'status_deadline' => $status_dead,
                'id_status' => '1',
                'target' => '10',
                'usulnilai' => '0',
            );
            $this->M_kpimmingguan->get_insert($isi);
        }
        // selesai fungsi entri ke kpim

        $data = array(
          
             'id_status' => $this->input->post('isistatus'),
            ); //id status 2 berarti sudah send
        $this->M_kpimmingguannext->get_updatestatus($data, $key);

       redirect(base_url() . 'Kpimmingguannext', 'refresh');
    }

    public function hapus($key){
        $this->app_model->getLogin();
        $where = array('id' => $key);
        $this->M_kpimmingguannext->delete($key);
        redirect(base_url() . 'Kpimmingguannext', 'refresh');
    }
}
