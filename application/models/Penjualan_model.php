<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan_model extends CI_Model {

	// Fungsi untuk mengambil transaksi penjualan berdasarkan tanggal
    public function getPenjualanByTanggal($tanggal) {
        $this->db->select("*");
        $this->db->from('transaksi a');
        $this->db->order_by('a.tanggal', 'DESC');
        $this->db->where("DATE(a.tanggal)", $tanggal);
        $this->db->join('pelanggan b', 'a.id_pelanggan = b.id_pelanggan', 'left');
        return $this->db->get()->result_array();

        
    }
    
    public function getAllPelanggan() {
        $this->db->from('pelanggan');
        $this->db->order_by('nama', 'ASC');
        return $this->db->get()->result_array();
    }

    // Fungsi untuk menghitung transaksi per bulan dan generate nomor nota
    public function generateNota($tanggal){
        // Menghitung jumlah transaksi untuk bulan ini
        $this->db->from('transaksi');
        $this->db->where("DATE_FORMAT(tanggal, '%y-%m') =", $tanggal);
        $jumlah = $this->db->count_all_results();

        // Membuat nomor nota berdasarkan bulan dan urutan transaksi
        return date('Ym') . sprintf('%03d', $jumlah + 1);
    }

    // Mengambil nama pelanggan berdasarkan id_pelanggan
    public function getNamaPelanggan($id_pelanggan){
        $this->db->from('pelanggan');
        $this->db->where('id_pelanggan', $id_pelanggan);
        return $this->db->get()->row()->nama;
    }

    // Mengambil detail transaksi berdasarkan nota
    public function getDetailTransaksi($nota){
        $this->db->select("a.*, b.nama, b.harga, b.barcode, a.diskon");
        $this->db->from('detail_tranksaksi a');
        $this->db->join('produk b', 'a.id_produk = b.id_produk', 'left');
        $this->db->where('a.nota', $nota);
        return $this->db->get()->result_array();
    }

    // Mengambil produk yang ada di keranjang (temp)
    public function getTempKeranjang($id_pelanggan, $id_user){
        $this->db->from('temp a');
        $this->db->join('produk b', 'a.id_produk = b.id_produk', 'left');
        $this->db->where('a.id_user', $id_user);
        $this->db->where('a.id_pelanggan', $id_pelanggan);
        return $this->db->get()->result_array();
    }

    // Fungsi untuk menambahkan produk ke keranjang sementara (temp)
    public function addTemp($id_produk, $id_pelanggan, $id_user, $jumlah, $diskon){
        // Ambil stok lama dari produk
        $this->db->from('produk')->where('id_produk', $id_produk);
        $stok_lama = $this->db->get()->row()->stok;

        // Cek apakah produk sudah ada di keranjang temp
        $this->db->from('temp');
        $this->db->where('id_produk', $id_produk);
        $this->db->where('id_user', $id_user);
        $this->db->where('id_pelanggan', $id_pelanggan);
        $this->db->where('diskon', $diskon);
        $cek = $this->db->get()->result_array();

        // Validasi stok produk
        if ($stok_lama < $jumlah) {
            return '<div class="alert alert-danger" role="alert">Produk yang dipilih tidak mencukupi</div>';
        } 
        // Validasi apakah produk sudah ada di temp
        else if (!empty($cek)) {
            return '<div class="alert alert-danger" role="alert">Produk sudah dipilih</div>';
        } 
        // Jika lolos validasi, tambahkan ke temp
        else {
            $data = array(
                'id_pelanggan' => $id_pelanggan,
                'id_user' => $id_user,
                'id_produk' => $id_produk,
                'jumlah' => $jumlah,
                'diskon' => $diskon
            );
            $this->db->insert('temp', $data);
            return '<div class="alert alert-success" role="alert">Data berhasil ditambahkan ke keranjang</div>';
        }
    }

     // Fungsi untuk menghapus data dari tabel temp
     public function hapusTemp($id_temp){
        $this->db->where('id_temp', $id_temp);
        $this->db->delete('temp');
        
        // Set pesan flashdata
        $this->session->set_flashdata('alert', '<div class="alert alert-success" role="alert">
            Data berhasil dihapus</div>');
    }

    public function processPayment($input){
        date_default_timezone_set("Asia/Jakarta");

        // Buat nomor nota
        $tanggal = date('y-m');
        $this->db->from('transaksi')->where("DATE_FORMAT(tanggal, '%y-%m') =", $tanggal);
        $jumlah = $this->db->count_all_results();
        $nota = date('Ym') . sprintf('%03d', $jumlah + 1);

        // Ambil data dari tabel temp
        $this->db->from('temp a');
        $this->db->join('produk b', 'a.id_produk=b.id_produk', 'left');
        $this->db->where('a.id_user', $input['id_user']);
        $this->db->where('a.id_pelanggan', $input['id_pelanggan']);
        $temp = $this->db->get()->result_array();

        // Periksa stok dan simpan transaksi
        foreach ($temp as $data) {
            if ($data['stok'] < $data['jumlah']) {
                $this->session->set_flashdata('alert', '<div class="alert alert-danger">Produk tidak mencukupi</div>');
                redirect($_SERVER["HTTP_REFERER"]);
            }

            // Simpan detail transaksi
            $detail_transaksi = array(
                'nota'      => $nota,
                'id_produk' => $data['id_produk'],
                'jumlah'    => $data['jumlah'],
                'diskon'    => $data['diskon'],
                'sub_total' => ($data['jumlah'] * $data['harga']) - ($data['diskon']*$data['jumlah']),
            );
            $this->db->insert('detail_tranksaksi', $detail_transaksi);

            // Update stok produk
            $this->db->where('id_produk', $data['id_produk']);
            $this->db->update('produk', ['stok' => $data['stok'] - $data['jumlah']]);
        }

        // Hapus data dari tabel temp
        $this->db->delete('temp', ['id_pelanggan' => $input['id_pelanggan'], 'id_user' => $input['id_user']]);

        // Simpan transaksi utama
        $transaksi = array(
            'nota'        => $nota,
            'id_pelanggan'=> $input['id_pelanggan'],
            'tagihan'     => $input['total_harga'],
            'tanggal'     => date('Y-m-d H:i:s'),
        );
        $this->db->insert('transaksi', $transaksi);

        return $nota;
    }

    public function getTransaksi($nota){
        $this->db->select("*");
        $this->db->from('transaksi a');
        $this->db->where('a.nota', $nota);
        $this->db->join('pelanggan b', 'a.id_pelanggan = b.id_pelanggan', 'left');
        return $this->db->get()->row();
    }


    
   
    
}