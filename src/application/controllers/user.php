<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {



	public function add($group_id=''){
		//$group_id = $this->session->flashdata('group_id_add');
		if($this->session->userdata('user')){

			if($this->input->post('cancel') || $this->input->post('add_finish') || $this->input->post('add')){

				$group = Group_model::find_by_id($group_id);
				//check if group exist
				if(!$group){
					redirect(base_url().'index.php/welcome');
				}

				//check if user is the admin of the group
				if($group->get_id_admin() != $this->session->userdata('user')['id']){
					redirect(base_url().'index.php/welcome');
				}

				//check if user cancel the form
				if($this->input->post('cancel')){
					//TODO redirect to group
					redirect(base_url().'index.php/group/view/'.$group_id);
				}

				$this->form_validation->set_rules('login', '"Login"', 'trim|required|min_length[1]|max_length[255|encode_php_tags|xss_clean');

				if($this->form_validation->run()){

					//check if user entered exists TODO
					//récupérer user dans $user
					$user = User_Model::find_by_login($this->input->post('login'));

					//add the user to the group
					$data2 = array();
					if ($user) {
						$group->add_user($user);
						$data2['success'] = true;
						//$data2['error']="";
					} else {
						//$data2['success'] = false;
						$data2['error'] = "L'utilisateur n'existe pas.";
					}
					
					if($this->input->post('add')){
						//add an other user
						$data2['group_id']=$group_id;
						$data['content']=$this->load->view('add_user',$data2,true);
						$this->load->view('template',$data);
					}elseif($this->input->post('add_finish')){
						//go to the group
						redirect(base_url().'index.php/group/view/'.$group->get_id());
					}
				}
			}else{
				//some field are empty
				$data['content']=$this->load->view('add_user',array('error' => "" , 'group_id'=>$group_id),true);
				$this->load->view('template',$data);
			}
		}else{
			//Need to be connected
			redirect(base_url().'index.php/welcome');
		}
	}
	
}

/* End of file word.php */
/* Location: ./application/controllers/word.php */