<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wlist extends CI_Controller {


	public function view($id){
		$list = List_model::find_by_id($id);
		if($list){
			$words = $list->get_words();

			$data2['list']=$list;
			$data2['words']=$words;

			$data['content']=$this->load->view('list_view',$data2,true);
			$this->load->view('template',$data);
		}else{
			//TODO
			echo "List not found";
		}
	}


	public function add(){
		if($this->session->userdata('user')){

			if($this->input->post('cancel')){
				//TODO redirect to my lists
				echo "TODO my lists...";
				break;
			}
			
			$this->form_validation->set_rules('name', '"List name"', 'trim|required|min_length[1]|max_length[255|encode_php_tags|xss_clean');
			
			if($this->form_validation->run()){

	
				//create list and save on DB
				$list = new List_model();
				$list->set_name($this->input->post('name'));
				$list->set_id_admin($this->session->userdata('user')['id']);
				$list->save();


				if($this->input->post('add')){
					//go to my lists
					echo "TODO : display my lists";
					//$data['content']=$this->load->view('add_word',$data2,true);
					//$this->load->view('template',$data);
				}elseif($this->input->post('add_continue')){
					//go to the list
					//TODO go to add word
					echo "TODO add word...";
					$this->session->set_flashdata('liste_id_add', $list->get_id());
					redirect(base_url().'index.php/word/add/'.$list->get_id());
				}
				
			}else{
				//some field are empty
				$data['content']=$this->load->view('add_list',array('error' => ""),true);
				$this->load->view('template',$data);
			}
		}else{
			//Need to be connected
			redirect(base_url().'index.php/welcome');
		}
	}


}


/* End of file list.php */
/* Location: ./application/controllers/list.php */