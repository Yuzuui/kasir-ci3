<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    public function __construct(){
        parent:: __construct();
        if($this->session->userdata('level')!='admin'){
			redirect('home');
		}
        $this->load->model('User_model');
    }

	public function index()
	{
        $this->db->from('user');
        $this->db->order_by('nama', 'ASC');
        $user = $this->db->get()->result_array();
        $data = array(
			'judul_halaman' => 'Kasir T-Mart| User',
            'user'          =>  $user,
		);
		$this->template->load('template', 'user_index', $data);
	}

    public function simpan(){
        $username = $this->input->post('username');
        $this->db->from('user');
        $this->db->where('username', $username);
        $cek = $this->db->get()->result_array();
        if($cek<>NULL){
            $this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">
            data sudah di tambahkan, <b>BUAT DATA BARU</b></div>');
            redirect('user');
        }
        $this->session->set_flashdata('alert', '<div class="alert alert-success" role="alert">
        data berhasil di simpan</div>');
        
        $this->User_model->simpan();
        redirect('user');
    }

    public function hapus($id){
        $where = array(
            'id_user' => $id
        );

        $this->db->delete('user', $where);
       

        $this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">
        data berhasil di hapus</div>');
        redirect('user');
    }

    public function update(){
        $this->User_model->update();
        $this->session->set_flashdata('alert', '<div class="alert alert-success" role="alert">
        data berhasil di perbarui</div>');

        redirect('user');
    }

    public function reset($id){
        $this->User_model->reset($id);
        $this->session->set_flashdata('alert', '<div class="alert alert-success" role="alert">
        password di ubah ke 123</div>');

        redirect('user');
    }
}