<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {


	public function index(){
		$data=array();


		$data['content']=$this->load->view('welcome',NULL,true);
		$this->load->view('template',$data);
	}

	public function login(){
		$data['content']=$this->load->view('login',NULL,true);
		$this->load->view('template',$data);
	}

	public function login_form(){
		if(!$this->session->userdata('user')){
			if($this->input->post('email') && $this->input->post('pass')){
				$user = User_model::login($this->input->post('email'),$this->input->post('pass'));
				if($user){
					$sess = array('user'=> array(
						'id' => $user->get_id() ,
						'first_name' => $user->get_first_name(),
						'last_name' => $user->get_last_name(),
						'login' => $user->get_login(),
						'right' => $user->get_right()
						));
					$this->session->set_userdata($sess);
				}
			}
		}
		redirect(base_url().'index.php/welcome');	
	}

	public function register(){
		$data['content']=$this->load->view('register',NULL,true);
		$this->load->view('template',$data);
	}

	public function register_form(){
		if(!$this->session->userdata('user')){


			$this->form_validation->set_rules('first_name', '"First Name"', 'trim|required|min_length[1]|max_length[255]|encode_php_tags|xss_clean');
			$this->form_validation->set_rules('last_name', '"Last name"', 'trim|required|min_length[1]|max_length[255]|encode_php_tags|xss_clean');
			$this->form_validation->set_rules('email', '"Email"', 'trim|required|min_length[5]|max_length[255]|encode_php_tags|xss_clean');
			$this->form_validation->set_rules('pass', '"Password"', 'trim|required|matches[pass2]|min_length[4]|max_length[255]|encode_php_tags|xss_clean');
			$this->form_validation->set_rules('pass2', '"Confirme Password"', 'trim|required|min_length[4]|max_length[255]|encode_php_tags|xss_clean');


			if($this->form_validation->run()){
				if($this->input->post('pass') == $this->input->post('pass2')){
					$user = new User_model();
					$user->set_last_name($this->input->post('last_name'));
					$user->set_first_name($this->input->post('first_name'));
					$user->set_login($this->input->post('email'));
					$user->set_password($this->input->post('pass'));
					var_dump($user);

					if($user->save()){
						echo "ok";
					}else{
						echo "save error";
					}
				}else{
					echo "pass1 != pass2";
				}
			}else{
				echo "field not fill";
			}
		}
		redirect(base_url().'index.php/welcome');	
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url().'index.php/welcome');
	}





}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */