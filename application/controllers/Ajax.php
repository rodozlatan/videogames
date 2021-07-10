<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Ajax extends CI_Controller {
		public function __construct(){
            parent::__construct();
            $this->load->helper('url');
			$this->load->model('Videogames_model');
			$this->load->library('pagination');
        }
		public function getVideogames($rowno=0, $search=''){
			$search = trim(urldecode($search));
			if($rowno != 0){
			  $rowno = ($rowno-1) * $this->config->item('rowperpage');
			}
			$allcount = $this->Videogames_model->getTotal($search);
			$games_record = $this->Videogames_model->getVideogames($search, $rowno);
			$config['base_url'] = '#';
			$config['use_page_numbers'] = TRUE;
			$config['total_rows'] = $allcount;
			$config['per_page'] = $this->config->item('rowperpage');

			$config['use_page_numbers'] = TRUE;
			$config['reuse_query_string'] = TRUE;
			
			$config['attributes'] = array('class' => 'page-link');
             
            $config['full_tag_open'] = '<ul class="pagination justify-content-center">';
            $config['full_tag_close'] = '</ul>';
             
			$config['first_link'] = 'First';
			$config['first_tag_open'] = '<li class="page-item">';
            $config['first_tag_close'] = '</li>';
             
			$config['last_link'] = 'Last';
			$config['last_tag_open'] = '<li class="page-item">';
            $config['last_tag_close'] = '</li>';
             
			$config['next_link'] = '&#8594;';
			$config['next_tag_open'] = '<li class="page-item">';
            $config['next_tag_close'] = '</li>';
 
			$config['prev_link'] = '&#8592';
			$config['prev_tag_open'] = '<li class="page-item">';
            $config['prev_tag_close'] = '</li>';
 
            $config['cur_tag_open'] = '<li class="page-item active" aria-current="page"><a class="page-link" href="">';
            $config['cur_tag_close'] = '</a></li>';
 
            $config['num_tag_open'] = '<li class="page-item">';
            $config['num_tag_close'] = '</li>';
		
			$this->pagination->initialize($config);

			$data['pagination'] = $this->pagination->create_links();
			$data['result'] = $games_record;
			$data['row'] = $rowno;
		
			echo json_encode($data);
		}

		public function setVideogame($publisher=null, $name=null, $rating=null, $nickname=null){
			$data = array(
				'publisher'	=> urldecode($publisher),
				'name'		=> urldecode($name),
				'nickname'	=> ($nickname === 'null') ? null : urldecode($nickname),
				'rating'	=> $rating
			);
			$result = $this->Videogames_model->setVideogame($data);
			echo json_encode($result);
		}

}