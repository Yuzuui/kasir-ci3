<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C extends CI_Model {

	public function index()
	{
		$this->load->view('welcome_message');
	}
}