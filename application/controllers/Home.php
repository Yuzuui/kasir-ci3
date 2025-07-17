<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct(){
		parent:: __construct();
		if($this->session->userdata('level')==NULL){
			redirect('auth');
		}
	} 

	public function index(){
		
		date_default_timezone_set("Asia/Jakarta");
		$tanggal = date('Y-m-d');
		$this->db->select('sum(tagihan) as total');
		$this->db->from('transaksi')->where('tanggal', $tanggal);
		$hari_ini = $this->db->get()->row()->total;

		$this->db->from('transaksi')->where('tanggal', $tanggal);
		$transaksi = $this->db->count_all_results();

		$produk = $this->db->from('produk')->count_all_results();
		
		$tanggal = date('Y-m'); 
		$this->db->select('SUM(tagihan) as total');
		$this->db->from('transaksi');
		$this->db->where("DATE_FORMAT(tanggal, '%Y-%m') =", $tanggal);
		$bulan_ini = $this->db->get()->row()->total;

		$tanggal = date('Y-m-d');
		$this->db->select('sum(tagihan) as total');
		$this->db->from('transaksi')->where('tanggal', $tanggal);
		$hari_ini = $this->db->get()->row()->total;

		if($hari_ini==NULL) {$hari_ini = 0; }
		if($bulan_ini==NULL) {$bulan_ini = 0; }
		if($transaksi==NULL) {$transaksi = 0; }
		
		$data = array(
			'judul_halaman' => 'Kasir T-Mart|Dashbord',
			'hari_ini'		=> $hari_ini,
			'bulan_ini'		=> $bulan_ini,
			'transaksi'		=> $transaksi,
			'produk'		=> $produk,
		);
		$this->template->load('template', 'beranda', $data);
	}
}