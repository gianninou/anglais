<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Group extends CI_Controller {

	public function view($id){
		$group = Group_model::find_by_id($id);
		if($group){
			$users = $group->get_users();

			$data2['group']=$group;
			$data2['users']=$users;

			$data['content']=$this->load->view('group_view',$data2,true);
			$this->load->view('template',$data);
		}else{
			//TODO
			echo "Group not found";
		}
	}

	public function myGroups(){
		if($this->session->userdata('user')){
			$groups = Group_model::find_by_user($this->session->userdata('user')['id']);
			$data2=array();
			$data2['groups']=$groups;
			$data['content']=$this->load->view('my_groups',$data2,true);
			$this->load->view('template',$data);

		}else{
			//Need to be connected
			redirect(base_url().'index.php/welcome');
		}
	}

	public function add(){
		if($this->session->userdata('user')){

			if($this->input->post('cancel')){
				//TODO redirect to my groups
				redirect(base_url().'index.php/welcome');
			}
			
			$this->form_validation->set_rules('name', '"Group name"', 'trim|required|min_length[1]|max_length[255|encode_php_tags|xss_clean');
			
			if($this->form_validation->run()){


				//create group and save on DB
				$group = new Group_model();
				$group->set_name($this->input->post('name'));
				$group->set_id_admin($this->session->userdata('user')['id']);
				$group->save();


				if($this->input->post('add')){
					//go to the group
					redirect(base_url().'index.php/group/view/'.$group->get_id());
				}elseif($this->input->post('add_continue')){
					//go to add users to the group TODO
					redirect(base_url().'index.php/welcome');
				}
				
			}else{
				//some field are empty
				$data['content']=$this->load->view('add_group',array('error' => ""),true);
				$this->load->view('template',$data);
			}
		}else{
			//Need to be connected
			redirect(base_url().'index.php/welcome');
		}
	}
}