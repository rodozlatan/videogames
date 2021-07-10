<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Home extends CI_Controller {
		public function __construct(){
			parent::__construct();
			$this->load->model('Videogames_model');
			$this->load->helper('url');
			$this->load->library('pagination');
		}
		public function index(){
			$this->load->view('home');
		}
}