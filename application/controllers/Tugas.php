<?php
class Tugas extends CI_Controller{
	public function index(){
		$this->load->view('tugas/artikel');
		$this->load->view('tugas/footer');
	}
}