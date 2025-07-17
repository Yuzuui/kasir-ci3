<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Zend\Barcode\Barcode;

class Produk_model extends CI_Model {
    
public function generateBarcode($kode_produk)
{
    require_once APPPATH . '../vendor/autoload.php'; // Jika menggunakan Composer

    // Path penyimpanan barcode
    $barcodePath = FCPATH . 'assets/barcodes/' . $kode_produk . '.png';

    // Konfigurasi barcode
    $barcodeOptions = ['text' => $kode_produk];
    $rendererOptions = ['imageType' => 'png'];

    // Generate barcode dan simpan sebagai gambar
    $imageResource = Barcode::factory('code128', 'image', $barcodeOptions, $rendererOptions)->draw();
    
    // Simpan ke file
    imagepng($imageResource, $barcodePath);
    imagedestroy($imageResource);

    return 'assets/barcodes/' . $kode_produk . '.png'; // Path relatif untuk ditampilkan
}


	public function simpan()
	{
        
		$data = array(
            'nama' => $this->input->post('name'),
            'harga' => $this->input->post('harga'),
            'stok' => $this->input->post('stok'),
            'barcode' => $this->input->post('barcode'),
        );
        $this->db->insert('produk', $data);
	}

    public function update(){
        $data = array(
            'stok'  => $this->input->post('stok'),
            'harga'  => $this->input->post('harga'),
        );

        $where = array(
           'id_produk' => $this->input->post('id_produk'),
        );
        $this->db->update('produk', $data, $where);
    }

    //memeriksa stok
    public function getProdukTersedia(){
        $this->db->from('produk');
        $this->db->where('stok > 0');
        $this->db->order_by('nama', 'ASC');
        return $this->db->get()->result_array();
    }

   

}