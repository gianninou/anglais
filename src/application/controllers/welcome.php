<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {


	public function index(){
		$data=array();
		$data['content']=$this->load->view('welcome',NULL,true);
		$this->load->view('template',$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */