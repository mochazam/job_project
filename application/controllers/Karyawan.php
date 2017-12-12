<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Karyawan extends CI_Controller {

    var $destination;


	public function __construct() {
		parent::__construct();
        $this->destination = realpath(APPPATH. '../assets/ft_profil/');
        $this->load->model(array('M_karyawanku','M_addkaryawan' ,'app_model'));
        $this->load->library(array('session', 'form_validation', 'upload', 'user_agent', 'email'));
        $this->load->helper(array('url', 'form', 'text', 'html', 'security', 'file', 'directory', 'number', 'date', 'download'));
	}

	public function index()
	{


        $this->app_model->getLogin();
        if ($this->session->userdata('level') == 2 || $this->session->userdata('level') == 6 || $this->session->userdata('level') == 3 || $this->session->userdata('level') == 4) {
            $this->session->set_flashdata('message_name', 'Mohon maaf, Anda tidak dapat mengakses halaman Admin');
            redirect(base_url() . 'index', 'refresh');

        }

        $data['isijabatan'] = $this->M_addkaryawan->getAll();


        $data['table'] = $this->M_karyawanku->ambilsemua()->result();
        

        $this->load->view('tampil_karyawan',$data);
	}

    public function vendor()
    {


        $this->app_model->getLogin();
        $find   = 'e';
        $pos = strpos($this->session->userdata('id_dept'), $find);
        $find2   = 'd';
        $pos2 = strpos($this->session->userdata('id_dept'), $find2);
        $find3   = '7';
        $pos3 = strpos($this->session->userdata('id_dept'), $find3);

        if (($this->session->userdata('level') != 12 || $this->session->userdata('level') != 11) AND ($pos !== false || $pos2 !== false || $pos3 !== false)  ) {

        $data['isijabatan'] = $this->M_addkaryawan->getAll();
        $data['table'] = $this->M_karyawanku->ambilsemuavendor()->result();
        $this->load->view('tampil_uservendor',$data); 
        }

        else{
            $this->session->set_flashdata('message_name', 'Mohon maaf, Anda tidak dapat mengakses halaman tambah user vendor');
            redirect(base_url() . 'index', 'refresh');
        }

        // if ($this->session->userdata('level') == 2 || $this->session->userdata('level') == 12 || $this->session->userdata('level') == 11) {
        //     $this->session->set_flashdata('message_name', 'Mohon maaf, Anda tidak dapat mengakses halaman tambah user vendor');
        //     redirect(base_url() . 'index', 'refresh');
        // }

        // $data['isijabatan'] = $this->M_addkaryawan->getAll();


        // $data['table'] = $this->M_karyawanku->ambilsemuavendor()->result();
        

        // $this->load->view('tampil_uservendor',$data);
    }

    public function hapus($key){
        $this->app_model->getLogin();
        $where = array('id_karyawan' => $key);
        $this->M_karyawanku->delete($key);
        redirect(base_url() . 'Karyawan', 'refresh');
    }

    public function hapusvendor($key){
        $this->app_model->getLogin();
        $where = array('id_karyawan' => $key);
        $this->M_karyawanku->delete($key);
        redirect(base_url() . 'Karyawan/vendor', 'refresh');
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

         if( $this->input->post('password')==null ){
            $data = array(
            'username' => $this->input->post('username'),
            'nama_karyawan' => $this->input->post('nama'),
            'id_jabatan' => $this->input->post('pangkat'),
            'jabatannya' => $this->input->post('jabatannya'),
            'dept' => implode(",", $isi),
            'hak_akses' => implode(",", $hak),
            'img' =>$gbr['file_name']

            );
         }

         else
         {
            $data = array(
            'username' => $this->input->post('username'),
            'nama_karyawan' => $this->input->post('nama'),
            'password' => md5($this->input->post('password')),
            'id_jabatan' => $this->input->post('pangkat'),
            'jabatannya' => $this->input->post('jabatannya'),
            'dept' => implode(",", $isi),
            'hak_akses' => implode(",", $hak),
            'img' =>$gbr['file_name']

            );

         }

        
        
        $this->M_karyawanku->get_update($data, $key);

        redirect(base_url() . 'Karyawan', 'refresh');

    }

    public function ganti($key){
        $this->form_validation->set_rules('ft_profil', 'ft_profil', 'required');

        $this->load->library('upload');

        $nmfile =  $this->input->post('username') . ','. date("d-m-Y");//nama file saya beri nama langsung dan diikuti fungsi time
       
        $config['upload_path'] = './assets/ft_profil'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['max_size'] = '2048'; //maksimum besar file 2M
        // $config['max_width']  = '1288'; //lebar maksimum 1288 px
        // $config['max_height']  = '768'; //tinggi maksimu 768 px    
        $config['file_name'] = $nmfile; //nama yang terupload nantinya

        // if($this->upload->do_upload('ft_profil') == null){
        //     $this->session->set_flashdata('msg','<div class="alert alert-block alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button><i class="icon-ok green"></i> Data gagal di Simpan. Masukan foto profil!</div>');

        //             redirect(base_url() . 'Karyawan', 'refresh');
        // }
    
        $this->upload->initialize($config);    
        
        if ($_FILES['ft_profil']['name']) {
            if($_FILES['ft_profil']['name'])
            {
                if ($this->upload->do_upload('ft_profil'))
                {
                    $gbr = $this->upload->data();

                    $isi=$this->input->post('dept[]');
                    $hak=$this->input->post('hak[]');

                    if( $this->input->post('hak[]')==null ){
                        $hak = array('0');
                    }

                     if( $this->input->post('password')==null ){
                        $data = array(
                        'username' => $this->input->post('username'),
                        'nama_karyawan' => $this->input->post('nama'),
                        'id_jabatan' => $this->input->post('pangkat'),
                        'jabatannya' => $this->input->post('jabatannya'),
                        'harikerja' => $this->input->post('harikerja'),
                        'status' => $this->input->post('status'),
                        'email' => $this->input->post('email'),
                        'dept' => implode(",", $isi),
                        'hak_akses' => implode(",", $hak),
                        'img' =>$gbr['file_name']

                        );
                     }

                     else
                     {
                        $data = array(
                        'username' => $this->input->post('username'),
                        'nama_karyawan' => $this->input->post('nama'),
                        'password' => md5($this->input->post('password')),
                        'id_jabatan' => $this->input->post('pangkat'),
                        'jabatannya' => $this->input->post('jabatannya'),
                        'harikerja' => $this->input->post('harikerja'),
                        'status' => $this->input->post('status'),
                        'email' => $this->input->post('email'),
                        'dept' => implode(",", $isi),
                        'hak_akses' => implode(",", $hak),
                        'img' =>$gbr['file_name']

                        );

                     }

                        $this->db->select('*');
                        $this->db->where(array('id_karyawan'=> $key));
                        $query = $this->db->get('karyawan');
                        $result =  $query->first_row('array');
                        $nama = $result['img'];
                        
                        if($nama){


                      
                        //hapus image dari server
                           
                        // lokasi folder image
                        $map = $_SERVER['DOCUMENT_ROOT'];
                        $path = $this->destination . '/';//$map . '/ci_3_admin/assets/banner/';
                        $path2 = $this->destination . '/resized/';//$map . '/ci_3_admin/assets/banner/resized/';
                        //lokasi gambar secara spesifik
                        $image1 = $path.$nama;
                        $image2 = $path2.$nama;
                        //hapus image
                        unlink($image1);
                        unlink($image2);
                        }
                        
                    
                    $this->M_karyawanku->get_update($data, $key);
                    
                    $nama = $data['nama_karyawan'];

                    if($isi == null) {
                        $this->session->set_flashdata('msg', 
                                '<div class="alert alert-danger">
                                    <h4>Oppss</h4>
                                    <p>Tidak ada kata dinput.</p>
                                </div>');    
                        $this->load->view('tampil_addkaryawan');      
                    } else {    
                        $this->session->set_flashdata('msg', 
                                '<div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <h4>Berhasil </h4>
                                    <p>Anda berhasil edit data karyawan <b>'.$nama.'.</b></p>
                                </div>');    
                        $this->load->view('tampil_karyawan');    
                    };

                    $this->M_karyawanku->do_upload('name_field');

                    redirect(base_url() . 'Karyawan', 'refresh');
                }else{
                    //pesan yang muncul jika terdapat error dimasukkan pada session flashdata
                    $this->session->set_flashdata('msg','<div class="alert alert-block alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button><i class="icon-ok green"></i> Data gagal di Simpan.</div>');

                    redirect(base_url() . 'Karyawan', 'refresh');
                }
            }
        } else {
            
                if ($this->form_validation->run() == FALSE)
                {
                    
                    $isi=$this->input->post('dept[]');
                    $hak=$this->input->post('hak[]');

                    if( $this->input->post('hak[]')==null ){
                        $hak = array('0');
                    }

                     if( $this->input->post('password')==null ){
                        $data = array(
                        'username' => $this->input->post('username'),
                        'nama_karyawan' => $this->input->post('nama'),
                        'id_jabatan' => $this->input->post('pangkat'),
                        'jabatannya' => $this->input->post('jabatannya'),
                        'harikerja' => $this->input->post('harikerja'),
                        'status' => $this->input->post('status'),
                        'email' => $this->input->post('email'),
                        'dept' => implode(",", $isi),
                        'hak_akses' => implode(",", $hak)

                        );
                     }

                     else
                     {
                        $data = array(
                        'username' => $this->input->post('username'),
                        'nama_karyawan' => $this->input->post('nama'),
                        'password' => md5($this->input->post('password')),
                        'id_jabatan' => $this->input->post('pangkat'),
                        'jabatannya' => $this->input->post('jabatannya'),
                        'harikerja' => $this->input->post('harikerja'),
                        'status' => $this->input->post('status'),
                        'email' => $this->input->post('email'),
                        'dept' => implode(",", $isi),
                        'hak_akses' => implode(",", $hak)

                        );

                     }
                        
                    
                    $this->M_karyawanku->get_update($data, $key);
                    
                    $nama = $data['nama_karyawan'];

                    if($isi == null) {
                        $this->session->set_flashdata('msg', 
                                '<div class="alert alert-danger">
                                    <h4>Oppss</h4>
                                    <p>Tidak ada kata dinput.</p>
                                </div>');    
                        $this->load->view('tampil_karyawan');      
                    } else {    
                        $this->session->set_flashdata('msg', 
                                '<div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <h4>Berhasil </h4>
                                    <p>Anda berhasil edit data karyawan <b>'.$nama.'.</b></p>
                                </div>');    
                        $this->load->view('tampil_karyawan');    
                    };

                    redirect(base_url() . 'Karyawan', 'refresh');
                }else{
                    //pesan yang muncul jika terdapat error dimasukkan pada session flashdata
                    $this->session->set_flashdata('msg','<div class="alert alert-block alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button><i class="icon-ok green"></i> Data gagal di Simpan.</div>');
                    redirect(base_url() . 'Karyawan', 'refresh');
                }
            //}
        }
    
    }

    public function gantivendor($key){
        $this->form_validation->set_rules('ft_profil', 'ft_profil', 'required');

        $this->load->library('upload');

        $nmfile =  $this->input->post('username') . ','. date("d-m-Y");//nama file saya beri nama langsung dan diikuti fungsi time
       
        $config['upload_path'] = './assets/ft_profil'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['max_size'] = '2048'; //maksimum besar file 2M
        // $config['max_width']  = '1288'; //lebar maksimum 1288 px
        // $config['max_height']  = '768'; //tinggi maksimu 768 px    
        $config['file_name'] = $nmfile; //nama yang terupload nantinya

        // if($this->upload->do_upload('ft_profil') == null){
        //     $this->session->set_flashdata('msg','<div class="alert alert-block alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button><i class="icon-ok green"></i> Data gagal di Simpan. Masukan foto profil!</div>');

        //             redirect(base_url() . 'Karyawan', 'refresh');
        // }
    
        $this->upload->initialize($config);    
        
        if ($_FILES['ft_profil']['name']) {
            if($_FILES['ft_profil']['name'])
            {
                if ($this->upload->do_upload('ft_profil'))
                {
                    $gbr = $this->upload->data();

                    $isi=$this->input->post('dept');
                    // $hak=$this->input->post('hak[]');

                    if( $this->input->post('hak[]')==null ){
                        $hak = array('0');
                    }

                     if( $this->input->post('password')==null ){
                        $data = array(
                        'username' => $this->input->post('username'),
                        'nama_karyawan' => $this->input->post('nama'),
                        'id_jabatan' => $this->input->post('pangkat'),
                        'jabatannya' => $this->input->post('jabatannya'),
                        'harikerja' => $this->input->post('harikerja'),
                        'status' => $this->input->post('status'),
                        'email' => $this->input->post('email'),
                        'dept' => $isi,
                        // 'hak_akses' => implode(",", $hak),
                        'img' =>$gbr['file_name']

                        );
                     }

                     else
                     {
                        $data = array(
                        'username' => $this->input->post('username'),
                        'nama_karyawan' => $this->input->post('nama'),
                        'password' => md5($this->input->post('password')),
                        'id_jabatan' => $this->input->post('pangkat'),
                        'jabatannya' => $this->input->post('jabatannya'),
                        'harikerja' => $this->input->post('harikerja'),
                        'status' => $this->input->post('status'),
                        'email' => $this->input->post('email'),
                        'dept' => $isi,
                        // 'hak_akses' => implode(",", $hak),
                        'img' =>$gbr['file_name']

                        );

                     }

                        $this->db->select('*');
                        $this->db->where(array('id_karyawan'=> $key));
                        $query = $this->db->get('karyawan');
                        $result =  $query->first_row('array');
                        $nama = $result['img'];
                        
                        if($nama){


                      
                        //hapus image dari server
                           
                        // lokasi folder image
                        $map = $_SERVER['DOCUMENT_ROOT'];
                        $path = $this->destination . '/';//$map . '/ci_3_admin/assets/banner/';
                        $path2 = $this->destination . '/resized/';//$map . '/ci_3_admin/assets/banner/resized/';
                        //lokasi gambar secara spesifik
                        $image1 = $path.$nama;
                        $image2 = $path2.$nama;
                        //hapus image
                        unlink($image1);
                        unlink($image2);
                        }
                        
                    
                    $this->M_karyawanku->get_update($data, $key);
                    
                    $nama = $data['nama_karyawan'];

                    if($isi == null) {
                        $this->session->set_flashdata('msg', 
                                '<div class="alert alert-danger">
                                    <h4>Oppss</h4>
                                    <p>Tidak ada kata dinput.</p>
                                </div>');    
                        $this->load->view('tampil_addkaryawan');      
                    } else {    
                        $this->session->set_flashdata('msg', 
                                '<div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <h4>Berhasil </h4>
                                    <p>Anda berhasil edit data karyawan <b>'.$nama.'.</b></p>
                                </div>');    
                        $this->load->view('tampil_karyawan');    
                    };

                    $this->M_karyawanku->do_upload('name_field');

                    redirect(base_url() . 'Karyawan/vendor', 'refresh');
                }else{
                    //pesan yang muncul jika terdapat error dimasukkan pada session flashdata
                    $this->session->set_flashdata('msg','<div class="alert alert-block alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button><i class="icon-ok green"></i> Data gagal di Simpan.</div>');

                    redirect(base_url() . 'Karyawan/vendor', 'refresh');
                }
            }
        } else {
            
                if ($this->form_validation->run() == FALSE)
                {
                    
                    $isi=$this->input->post('dept');
                    // $hak=$this->input->post('hak[]');

                    // if( $this->input->post('hak[]')==null ){
                    //     $hak = array('0');
                    // }

                     if( $this->input->post('password')==null ){
                        $data = array(
                        'username' => $this->input->post('username'),
                        'nama_karyawan' => $this->input->post('nama'),
                        'id_jabatan' => $this->input->post('pangkat'),
                        'jabatannya' => $this->input->post('jabatannya'),
                        'harikerja' => $this->input->post('harikerja'),
                        'status' => $this->input->post('status'),
                        'email' => $this->input->post('email'),
                        'dept' => $isi,
                        // 'hak_akses' => implode(",", $hak)

                        );
                     }

                     else
                     {
                        $data = array(
                        'username' => $this->input->post('username'),
                        'nama_karyawan' => $this->input->post('nama'),
                        'password' => md5($this->input->post('password')),
                        'id_jabatan' => $this->input->post('pangkat'),
                        'jabatannya' => $this->input->post('jabatannya'),
                        'harikerja' => $this->input->post('harikerja'),
                        'status' => $this->input->post('status'),
                        'email' => $this->input->post('email'),
                        'dept' => $isi,
                        // 'hak_akses' => implode(",", $hak)

                        );

                     }
                        
                    
                    $this->M_karyawanku->get_update($data, $key);
                    
                    $nama = $data['nama_karyawan'];

                    if($isi == null) {
                        $this->session->set_flashdata('msg', 
                                '<div class="alert alert-danger">
                                    <h4>Oppss</h4>
                                    <p>Tidak ada kata dinput.</p>
                                </div>');    
                        $this->load->view('tampil_karyawan');      
                    } else {    
                        $this->session->set_flashdata('msg', 
                                '<div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <h4>Berhasil </h4>
                                    <p>Anda berhasil edit data karyawan <b>'.$nama.'.</b></p>
                                </div>');    
                        $this->load->view('tampil_karyawan');    
                    };

                    redirect(base_url() . 'Karyawan/vendor', 'refresh');
                }else{
                    //pesan yang muncul jika terdapat error dimasukkan pada session flashdata
                    $this->session->set_flashdata('msg','<div class="alert alert-block alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button><i class="icon-ok green"></i> Data gagal di Simpan.</div>');
                    redirect(base_url() . 'Karyawan/vendor', 'refresh');
                }
            //}
        }
    
    }

}
