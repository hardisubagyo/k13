<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('logged_in') === NULL){
			redirect(site_url());
		}
    }

	public function index()
	{	
		$data['title'] = 'Dashboard';

		$this->load->view('header', $data);
		$this->load->view('home/index', $data);
		$this->load->view('footer');
	}
}
