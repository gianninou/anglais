<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Word extends CI_Controller {



	public function add($liste_id=''){
		//$liste_id = $this->session->flashdata('liste_id_add');
		if($this->session->userdata('user')){

			$list = List_model::find_by_id($liste_id);
			//check if list exist
			if(!$list){
				redirect(base_url().'index.php/welcome');
			}

			if($this->input->post('cancel') || $this->input->post('add_continue') || $this->input->post('add')){

				

				//check if user is the admin of the list
				if($list->get_id_admin() != $this->session->userdata('user')['id']){
					redirect(base_url().'index.php/welcome');
				}

				//check if user cancel the form
				if($this->input->post('cancel')){
					//TODO redirect to list
					redirect(base_url().'index.php/wlist/view/'.$liste_id);
				}

				$this->form_validation->set_rules('en_word', '"English word"', 'trim|required|min_length[1]|max_length[255|encode_php_tags|xss_clean');
				$this->form_validation->set_rules('fr_word', '"French word"', 'trim|required|min_length[1]|max_length[255|encode_php_tags|xss_clean');

				if($this->form_validation->run()){

					//configure upload library
					$config['upload_path'] = './uploads/';
					$config['allowed_types'] = 'mp3|wav';
					$config['max_size']	= '10000';
					$config['encrypt_name'] = true;
					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					$sound=null;
					if ($this->upload->do_upload("audio_file")){
						$sound = $this->upload->data();
					}

					//create word and save on DB
					$word = new Word_model();
					$word->set_english($this->input->post('en_word'));
					$word->set_french($this->input->post('fr_word'));
					$word->set_phonetic($this->input->post('phonetic'));
					if($sound){
						$word->set_sound($sound['file_name']);
					}
					$word->save();

					//add the word to the list
					$list->add_word($word);


					$data2 = array();
					$data2['success'] = true;
					$data2['error']="";
					
					if($this->input->post('add')){
						//add an other word	
						$data2['list']=$list;
						$data['content']=$this->load->view('add_word',$data2,true);
						$this->load->view('template',$data);
					}elseif($this->input->post('add_continue')){
						//go to the list
						redirect(base_url().'index.php/wlist/view/'.$list->get_id());
					}
				}
			}else{
				//some field are empty
				$data['content']=$this->load->view('add_word',array('error' => "" , 'list'=>$list),true);
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