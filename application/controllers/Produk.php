<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {
    public function __construct(){
        parent:: __construct();
        if($this->session->userdata('level')!='admin'){
			redirect('home');
		}   
        $this->load->model('Produk_model');
    }

    public function index()
    {
        $produk = $this->db->order_by('nama', 'ASC')->get('produk')->result_array();

        // Loop untuk menambahkan URL barcode ke setiap produk
        foreach ($produk as &$p) {
            $p['barcode_image'] = base_url('produk/generate_barcode/' . $p['barcode']);
        }

        $data = [
            'judul_halaman' => 'Kasir T-Mart | Produk',
            'produk' => $produk,
        ];
        $this->template->load('template', 'produk_index', $data);
    }

    public function generate_barcode($barcode)
    {
        require_once APPPATH . '../vendor/autoload.php'; // Pastikan Zend Barcode tersedia
    
        // Set header untuk gambar PNG
        header('Content-Type: image/png');
    
        // Konfigurasi barcode
        $barcodeOptions = ['text' => $barcode];
        $rendererOptions = ['imageType' => 'png'];
    
        // Generate barcode
        $imageResource = Zend\Barcode\Barcode::factory('code128', 'image', $barcodeOptions, $rendererOptions)->draw();
        
        // Output gambar ke browser
        imagepng($imageResource);
        imagedestroy($imageResource);
    }
    

    public function simpan(){
        $barcode = $this->input->post('barcode');

    // Cek apakah barcode sudah ada
    $this->db->from('produk');
    $this->db->where('barcode', $barcode);
    $cek = $this->db->get()->result_array();

    if ($cek != NULL) {
        $this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">
        Kode produk sudah ada, <b>BUAT DATA BARU</b></div>');
        redirect('produk');
    }

    // Generate barcode dan simpan
    $barcodePath = $this->Produk_model->generateBarcode($barcode);

    $data = array(
        'nama' => $this->input->post('name'),
        'harga' => $this->input->post('harga'),
        'stok' => $this->input->post('stok'),
        'barcode' => $barcode,
        'barcode_image' => $barcodePath
    );

    $this->db->insert('produk', $data);
    
    $this->session->set_flashdata('alert', '<div class="alert alert-success" role="alert">
    Data berhasil disimpan</div>');

    redirect('produk');

    }

    public function hapus($id){
        $where = array(
            'id_produk' => $id
        );

        $this->db->delete('produk', $where);
       

        $this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">
        data berhasil di hapus</div>');
        redirect('produk');
    }

    public function update(){
        $this->Produk_model->update();
        $this->session->set_flashdata('alert', '<div class="alert alert-success" role="alert">
        data berhasil di perbarui</div>');

        redirect('produk');
    }

    public function print(){
        $this->db->select('*')->from('produk');
        $this->db->order_by('nama','ASC');
        $status =  $this->input->get('status');
        if($status == 'Ada'){
            $this->db->where('stok >' ,0);
        } else if($status == 'Habis'){
            $this->db->where('stok',0);
        }
        $produk = $this->db->get()->result_array();
        $data = array(
            'status'       => $status,
            'produk'       => $produk,
        );
        
        $this->load->view('print_produk', $data);
    }
    

}