<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends CI_Controller {
	public function __construct() {
        parent::__construct();
        // Pastikan user sudah login dengan level admin
        if ($this->session->userdata('level') != 'admin') {
            redirect('home');
        }
		// Memuat model
        $this->load->model('Penjualan_model'); 
		$this->load->model('Produk_model');
		
    }

	public function index() {
        // Menentukan zona waktu Jakarta
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date('Y-m-d'); // Mengambil tanggal hari ini

        // Mengambil data penjualan berdasarkan tanggal hari ini
        $penjualan = $this->Penjualan_model->getPenjualanByTanggal($tanggal);

        // Mengambil data pelanggan
        $pelanggan = $this->Penjualan_model->getAllPelanggan();

        // Menyiapkan data untuk ditampilkan di View
        $data = array(
            'judul_halaman' => 'Kasir T-Mart | Penjualan',
            'penjualan' => $penjualan,
            'pelanggan' => $pelanggan
        );

        // Menampilkan View dengan data yang telah disiapkan
        $this->template->load('template', 'penjualan_index', $data);
    }

	 // Fungsi untuk mengelola transaksi penjualan
	 public function transaksi($id_pelanggan){
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date('y-m'); // Mendapatkan bulan dan tahun saat ini

        // Mengambil nomor nota yang akan digunakan
        $nota = $this->Penjualan_model->generateNota($tanggal);

        // Mengambil produk yang tersedia
        $produk = $this->Produk_model->getProdukTersedia();

        // Mengambil nama pelanggan
        $jenengsengtuku = $this->Penjualan_model->getNamaPelanggan($id_pelanggan);

        // Mengambil detail transaksi yang ada
        $detail_tranksaksi = $this->Penjualan_model->getDetailTransaksi($nota);

        // Mengambil produk yang ada di keranjang (temp)
        $temp = $this->Penjualan_model->getTempKeranjang($id_pelanggan, $this->session->userdata('id_user'));

        // Menyiapkan data untuk view
        $data = array(
            'judul_halaman' => 'Kasir T-Mart | Transaksi',
            'nota' => $nota,
            'produk' => $produk,
            'id_pelanggan' => $id_pelanggan,
            'jenengsengtuku' => $jenengsengtuku,
            'detail_tranksaksi' => $detail_tranksaksi,
            'temp' => $temp,
        );

        // Menampilkan view dengan data
        $this->template->load('template', 'tranksaksi_index', $data);
    }


	public function addtemp(){
        $id_produk = $this->input->post('id_produk');
        $id_pelanggan = $this->input->post('id_pelanggan');
        $id_user = $this->session->userdata('id_user');
        $jumlah = $this->input->post('jumlah');
		$diskon = $this->input->post('diskon');

        // Memanggil model untuk menambahkan produk ke temp
        $result = $this->Penjualan_model->addTemp($id_produk, $id_pelanggan, $id_user, $jumlah,$diskon);

        // Menyimpan alert ke session berdasarkan hasil proses
        $this->session->set_flashdata('alert', $result);
        
        // Redirect kembali ke halaman sebelumnya
        redirect($_SERVER["HTTP_REFERER"]);
    }

	
	// public function pembelian(){
	// 	$this->db->from('detail_tranksaksi');
	// 	$this->db->where('id_produk',$this->input->post('id_produk'));
	// 	$this->db->where('nota',$this->input->post('nota'));
	// 	$cek = $this->db->get()->result_array();
	// 	if($cek <> NULL){
	// 		$this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">
    // 		Produk sudah dipilih </div>');
			
	// 		redirect($_SERVER["HTTP_REFERER"]);
	// 	}

		
		
	// 	$this->db->from('produk')->where('id_produk',$this->input->post('id_produk'));
	// 	$harga = $this->db->get()->row()->harga;
	// 	$this->db->from('produk')->where('id_produk',$this->input->post('id_produk'));
	// 	$stok_lama = $this->db->get()->row()->stok;
	// 	$stok_sekarang = (float)$stok_lama - (float)$this->input->post('jumlah');
	// 	$sub_total =  (float)$this->input->post('jumlah')* (float)$harga;
	// 	$data = array(
    //         'nota' => $this->input->post('nota'),
    //         'id_produk' => $this->input->post('id_produk'),
    //         'jumlah' => $this->input->post('jumlah'),
    //         'sub_total' => $sub_total,
    //     );
	// 	if($stok_lama >= $this->input->post('jumlah')){
	// 		$this->db->insert('detail_tranksaksi',$data);
	// 		$data2 = array(
	// 			'stok'	=> $stok_sekarang,
	// 		);
	// 		$where = array(
	// 			'id_produk'	=> $this->input->post('id_produk'),
	// 		);
	// 		$this->db->update('produk', $data2, $where);
	// 		$this->session->set_flashdata('alert', '<div class="alert alert-success" role="alert">
	// 			data berhasil di tambahkan ke keranjang, <b>BUAT DATA BARU</b></div>');
	// 	}else{
	// 		$this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">
    // 		Produk yang dipilih tidak mencukupi </div>');

	// 	}
		
	// 	redirect($_SERVER["HTTP_REFERER"]);
        
	// }

	// public function hapus($id_dt, $id_produk){
	// 	$this->db->from('detail_tranksaksi')->where('id_dt', $id_dt);
	// 	$jumlah = $this->db->get()->row()->jumlah;

	// 	$this->db->from('produk')->where('id_produk',$id_produk);
	// 	$stok_lama = $this->db->get()->row()->stok;

	// 	$stok_sekarang = $jumlah+$stok_lama;

	// 	$data2 = array(
	// 		'stok'	=> $stok_sekarang,
	// 	);
	// 	$where = array(
	// 		'id_produk'	=> $id_produk,
	// 	);
	// 	$this->db->update('produk', $data2, $where);
		
	// 	$where = array('id_dt' =>$id_dt);
	// 	$this->db->delete('detail_tranksaksi', $where);
	// 	$this->session->set_flashdata('alert', '<div class="alert alert-success" role="alert">
    //     data berhasil di perbarui</div>');
		
	// 	redirect($_SERVER["HTTP_REFERER"]);
	// }

	
	// Fungsi untuk menghapus data dari tabel temp berdasarkan id_temp
    public function hapus_temp($id_temp){
        // Memanggil model untuk menghapus data
        $this->Penjualan_model->hapusTemp($id_temp);
        
        // Redirect kembali ke halaman sebelumnya
        redirect($_SERVER["HTTP_REFERER"]);
    }
	
	// public function bayar(){
	// 	$data = array(
	// 		'nota'			=>$this->input->post('nota'),
	// 		'id_pelanggan'	=>$this->input->post('id_pelanggan'),
	// 		'tagihan'		=>$this->input->post('total_harga'),
	// 		'tanggal' => date('Y-m-d H:i:s'),
	// 	);
	// 	$this->db->insert('transaksi',$data);
	// 	$this->session->set_flashdata('alert', '<div class="alert alert-success" role="alert">
    //    Transaksi berhasil</div>');
	//    redirect('penjualan/invoice/'.$this->input->post('nota'));
	// }
	
	public function payment(){
        // Ambil data dari form
        $input = array(
            'id_pelanggan' => $this->input->post('id_pelanggan'),
            'total_harga'  => $this->input->post('total_harga'),
            'id_user'      => $this->session->userdata('id_user')
        );

        // Kirim data ke Model
        $nota = $this->Penjualan_model->processPayment($input);

        // Redirect ke halaman invoice
        $this->session->set_flashdata('alert', '<div class="alert alert-success">Transaksi berhasil</div>');
        redirect('penjualan/invoice/' . $nota);
    }

	
	public function invoice($nota){
		$data = array(
			'judul_halaman'  => 'Kasir T-Mart | Invoice',
			'nota'           => $nota,
			'transaksi'      => $this->Penjualan_model->getTransaksi($nota),
			'detail_transaksi' => $this->Penjualan_model->getDetailTransaksi($nota),
		);
	
		$this->template->load('template', 'invoice', $data);
	}
	

	public function print($nota){
		$data = array(
			'judul_halaman'    => 'Kasir T-Mart | Struk',
			'nota'             => $nota,
			'transaksi'        => $this->Penjualan_model->getTransaksi($nota),
			'detail_transaksi' => $this->Penjualan_model->getDetailTransaksi($nota),
		);
	
		$this->load->view('struk', $data);
	}
	

	public function laporan(){
		$tanggal1 = $this->input->get('tanggal1');
		$tanggal2 = $this->input->get('tanggal2');
		date_default_timezone_set("Asia/Jakarta");
		$this->db->select("*");
		$this->db->from('transaksi a');
        $this->db->order_by('a.tanggal', 'DESC');
		$this->db->join('pelanggan b', 'a.id_pelanggan = b.id_pelanggan', 'left');
       $this->db->where('tanggal >=', $tanggal1);
       $this->db->where('tanggal <=' ,$tanggal2);
	   $transaksi = $this->db->get()->result_array();
	   
	   $data = array(
			'tanggal1' => $tanggal1,
			'tanggal2' => $tanggal2,
			'transaksi' => $transaksi,
	   );
	   $this->load->view('laporan', $data);
	}
}