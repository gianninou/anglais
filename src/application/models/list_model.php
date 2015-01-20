<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class List_model extends CI_model
{
	protected $table = 'list';

	private $id;
	private $id_admin;
	private $name;

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

	public function set_id_admin($id_admin)
	{
		$this->id_admin = $id_admin;
	}

	public function get_id_admin()
	{
		return $this->id_admin;
	}

	public function set_name($name)
	{
		$this->name = $name;
	}

	public function get_name()
	{
		return $this->name;
	}

	public function save()
	{
		if (!isset($this->id)) {
			return $this->add_list();
		} else {
			return $this->update_list();
		}
	}

	private function add_list()
	{
		$this->db->set('id_admin', $this->id_admin);
		$this->db->set('name', $this->name);

		$res = $this->db->insert($this->table);
		if ($res) {
			$this->id = $this->db->insert_id();
		}
		return $res;
	}

	private function update_list()
	{
		$this->db->set('id_admin', $this->id_admin);
		$this->db->set('name', $this->name);

		$this->db->where('id', $this->id);
		return $this->db->update($this->table);
	}

	private function delete_list()
	{
		if (isset($this->id)) {
			return $this->db->where('id', (int) $this->id)
							->delete($this->table);
		}
	}


	public function get_words(){
		$query = $this->db->query("select * from list_word ,word where list_word.id_word = word.id and id_list='".$this->id."'");
      
        $words=array();
        foreach ($query->result() as $row) {
            $w = new Word_model();
            $w->set_id($row->id);
            $w->set_french($row->french);
            $w->set_english($row->english);
            $w->set_phonetic($row->phonetic);
            $w->set_sound($row->sound);
            $words[]=$w;
        }
        return $words;
	}

	public function add_word($word){
		$this->db->set('id_list', $this->id);
		$this->db->set('id_word', $word->get_id());

		$res = $this->db->insert("list_word");
		return $res;
	}

	public static function find_by_id($id){
		$CI =& get_instance();
		$CI->db->where('id', $id);
		$q = $CI->db->get('list');
		$row = array_shift($q->result_array());
		$list=new List_model();
		$list->set_id($row['id']);
		$list->set_id_admin($row['id_admin']);
		$list->set_name($row['name']);
		return $list;
		
	}

	public static function find_word_random($list_id,$user_id){
		$list = List_model::find_by_id($list_id);

		$words = $list->get_words();

		return $words[rand(0,count($words)-1)];
	}

}