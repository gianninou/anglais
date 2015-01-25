<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Word_model extends CI_model
{
	protected $table = 'word';

	private $id;
	private $french;
	private $english;
	private $sound;
	private $phonetic;

	function __construct()
	{
		parent::__construct();
	}

	public function set_id($id)
	{
		$this->id = $id;
	}

	public function get_id()
	{
		return $this->id;
	}

	public function set_french($french)
	{
		$this->french = $french;
	}

	public function get_french()
	{
		return $this->french;
	}

	public function set_english($english)
	{
		$this->english = $english;
	}

	public function get_english()
	{
		return $this->english;
	}

	public function set_sound($sound)
	{
		$this->sound = $sound;
	}

	public function get_sound()
	{
		return $this->sound;
	}

	public function set_phonetic($phonetic)
	{
		$this->phonetic = $phonetic;
	}

	public function get_phonetic()
	{
		return $this->phonetic;
	}

	public function save()
	{
		if (!isset($this->id)) {
			return $this->add_word();
		} else {
			return $this->update_word();
		}
	}

	private function add_word()
	{
		$this->db->set('french', $this->french);
		$this->db->set('english', $this->english);
		$this->db->set('sound', $this->sound);
		$this->db->set('phonetic', $this->phonetic);

		$res = $this->db->insert($this->table);
		if ($res) {
			$this->id = $this->db->insert_id();
		}
		return $res;
	}

	private function update_word()
	{
		$this->db->set('french', $this->french);
		$this->db->set('english', $this->english);
		$this->db->set('sound', $this->sound);
		$this->db->set('phonetic', $this->phonetic);

		$this->db->where('id', $this->id);
		return $this->db->update($this->table);
	}

	private function delete_word()
	{
		if (isset($this->id)) {
			return $this->db->where('id', (int) $this->id)
							->delete($this->table);
		}
	}

	public static function find_by_id($id){
		$CI =& get_instance();
		$CI->db->where('id', $id);
		$q = $CI->db->get('word');
		$row = array_shift($q->result_array());
		$word=new Word_model();
		$word->set_id($row['id']);
		$word->set_french($row['french']);
		$word->set_english($row['english']);
		$word->set_sound($row['sound']);
		$word->set_phonetic($row['phonetic']);
		return $word;	
	}

	public function add_good_answer_user($user_id){
		return $this->add_answer_user($user_id,true);
	}

	public function add_bad_answer_user($user_id){
		return $this->add_answer_user($user_id,false);
	}

	public function add_answer_user($user_id, $answer){
		$this->db->where('id_word',$this->id);
		$this->db->where('id_user',$user_id);
		$this->db->from('user_word');
		$nb = $this->db->count_all_results();
		if($nb==1){
			$this->db->where('id_word', $this->id);
			$this->db->where('id_user', $user_id);
			$this->db->set('nb_all', 'nb_all+1', FALSE);
			if($answer){
				$this->db->set('nb_right', 'nb_right+1', FALSE);
			}else{
				$this->db->set('nb_false', 'nb_false+1', FALSE);
			}
			$res = $this->db->update('user_word');
		}else{
			$this->db->set('id_word', $this->id);
			$this->db->set('id_user', $user_id);
			$this->db->set('nb_right', ($answer?1:0));
			$this->db->set('nb_false', ($answer?0:1));
			$this->db->set('nb_all', 1);
			$res = $this->db->insert("user_word");
		}

		return $res;
	}

	

}