<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {


	public function index(){
		$data=array();


		$user = new User_model();
		$user->set_last_name("Cupif");
		$user->set_first_name("Damien");
		$user->set_login("Mizu");
		$user->set_password("qwerty");

		$user->save();
		
		var_dump($user);
		$data2['user']=$user;

		$data['content']=$this->load->view('welcome',$data2,true);
		$this->load->view('template',$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */