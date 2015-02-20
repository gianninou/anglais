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
				redirect(base_url().'index.php/welcome');
			}
			
			$this->form_validation->set_rules('name', '"List name"', 'trim|required|min_length[1]|max_length[255|encode_php_tags|xss_clean');
			
			if($this->form_validation->run()){


				//create list and save on DB
				$list = new List_model();
				$list->set_name($this->input->post('name'));
				$list->set_id_admin($this->session->userdata('user')['id']);
				$list->save();

				$data2 = array();
				$data2['success'] = true;
				$data2['error']="";

				if($this->input->post('add')){
					//go to the list
					redirect(base_url().'index.php/wlist/view/'.$list->get_id());
				}elseif($this->input->post('add_continue')){
					//go to add word for the list
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

	public function answer($list_id){
		$this->session->keep_flashdata('word_id');
		if($this->session->userdata('user')){

			if($this->input->post('cancel')){
				//TODO redirect to list
				redirect(base_url().'index.php/wlist/view/'.$list_id);
			}	

			if($this->input->post('validate')){
				
				
				
				$en_to_fr = $this->input->post('en_to_fr');
				$word_id = $this->session->flashdata('word_id');
				$word = Word_model::find_by_id($word_id);
				if($word){
					$answer = $this->input->post('translation');
					$check_answer=false;
					if( ($en_to_fr && $word->get_french() == $answer) || (!$en_to_fr && $word->get_english() == $answer)){
						$check_answer=true;	
					}
					$previous;
					if($check_answer){
						$word->add_good_answer_user($this->session->userdata('user')['id']);
						$previous=true;
					}else{
						$word->add_bad_answer_user($this->session->userdata('user')['id']);
						$previous=false;
					}
					$word = List_model::find_word_random($list_id, $this->session->userdata('user')['id']);
					$this->session->set_flashdata('word_id',$word->get_id());
					$en_to_fr = (rand(0,1)>0.5 ? true : false );
					$data2=array();
					$data2['en_to_fr']=$en_to_fr;
					$data2['word']=$word;
					$data2['previous']=$previous;

					$data2['list_id']=$list_id;
					$data['content']=$this->load->view('answer_word',$data2,true);
					$this->load->view('template',$data);
				}else{
					//TODO word not exist
					redirect(base_url().'index.php/welcome');
				}
				
			}else{
				$word = List_model::find_word_random($list_id, $this->session->userdata('user')['id']);
				
				$this->session->set_flashdata('word_id',$word->get_id());
				$en_to_fr = (rand(0,1)>0.5 ? true : false );
				$data2=array();
				$data2['en_to_fr']=$en_to_fr;
				$data2['word']=$word;
				$data2['list_id']=$list_id;

				$data['content']=$this->load->view('answer_word',$data2,true);
				$this->load->view('template',$data);
			}
		}else{
			//Need to be connected
			redirect(base_url().'index.php/welcome');
		}
	}


	public function myLists(){
		if($this->session->userdata('user')){
			$lists = List_model::find_by_user($this->session->userdata('user')['id']);
			$data2=array();
			$data2['lists']=$lists;
			$data['content']=$this->load->view('my_lists',$data2,true);
			$this->load->view('template',$data);

		}else{
			//Need to be connected
			redirect(base_url().'index.php/welcome');
		}
	}

}


/* End of file list.php */
/* Location: ./application/controllers/list.php */