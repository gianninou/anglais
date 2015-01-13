<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {


	public function index(){
		$data=array();

		$this->load->model('user_model');

		$newUser = $this->user_model->add_user('Grosminet','toto','Damien','Cupif');

		$data['content']=$this->load->view('welcome',NULL,true);
		$data['user']=$newUser;
		$this->load->view('template',$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */