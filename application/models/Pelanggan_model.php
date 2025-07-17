                                                      <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan_model extends CI_Model {

	public function simpan()
	{
		$data = array(
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'no_hp' => $this->input->post('no_hp'),
        );
        $this->db->insert('pelanggan', $data);
	}

    public function update(){
        $data = array(
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'no_hp' => $this->input->post('no_hp'),
        );

        $where = array(
           'id_pelanggan' => $this->input->post('id_pelanggan'),
        );
        $this->db->update('pelanggan', $data, $where);
    }

    
}