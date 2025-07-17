<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {
    public function __construct(){
        parent:: __construct();
       
        $this->load->model('Pelanggan_model');
    }

	public function index()
	{
        $this->db->from('pelanggan');
        $this->db->order_by('nama', 'ASC');
        $pelanggan = $this->db->get()->result_array();
        $data = array(
			'judul_halaman' => 'Kasir T-Mart| pelanggan',
            'pelanggan'     =>  $pelanggan,
		);
		$this->template->load('template', 'pelanggan_index', $data);
	}

    public function simpan(){
        $no_hp = $this->input->post('no_hp');
        $this->db->from('pelanggan');
        $this->db->where('no_hp', $no_hp);
        $cek = $this->db->get()->result_array();
        if($cek<>NULL){
            $this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">
            data sudah di tambahkan, <b>BUAT DATA BARU</b></div>');
            redirect('pelanggan');
        }
        $this->session->set_flashdata('alert', '<div class="alert alert-success" role="alert">
        data berhasil di simpan</div>');
        
        $this->Pelanggan_model->simpan();
        redirect('pelanggan');
    }

    public function hapus($id){
        $where = array(
            'id_pelanggan' => $id
        );

        $this->db->delete('pelanggan', $where);
       

        $this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">
        data berhasil di hapus</div>');
        redirect('pelanggan');
    }

    public function update(){
        $this->Pelanggan_model->update();
        $this->session->set_flashdata('alert', '<div class="alert alert-success" role="alert">
        data berhasil di perbarui</div>');

        redirect('pelanggan');
    }

    
}