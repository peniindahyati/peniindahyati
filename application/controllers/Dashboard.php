<?php
class Dashboard extends CI_Controller{
	public function index(){
		
		$this->load->view('adminlte/header');
		$this->load->view('adminlte/navbar');
		$this->load->view('adminlte/sidebar');
		$this->load->view('adminlte/content');
		$this->load->view('adminlte/footer');
		
	}
}