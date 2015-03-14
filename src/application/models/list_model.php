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

	public static function share_list()
	{
		
	}


	public function get_words(){
		$query = $this->db->query("select * from list_word ,word where list_word.id_word = word.id and id_list='".$this->id."'");
      
        $words=array();
        foreach ($query->result() as $row) {
            $w = Word_model::find_by_id($row->id);
            $words[]=$w;
        }
        return $words;
	}

	public function get_nb_words(){
		$query = $this->db->query("select COUNT(*) as count from list_word ,word where list_word.id_word = word.id and id_list='".$this->id."'");
      
      	$row = $query->result()[0];
        return $row->count;
	}

	public function  get_groups(){
		$query = $this->db->query("select * from group_list, group_model where group_list.id_list=".$this->get_id()." and group_list.id_group = group_model.id");
		$groups=array();
        foreach ($query->result() as $row) {
            $g = Group_model::find_by_id($row->id);
            $groups[]=$g;
        }
        return $groups;

	}

	public function add_word($word){
		$this->db->set('id_list', $this->id);
		$this->db->set('id_word', $word->get_id());

		$res = $this->db->insert("list_word");
		return $res;
	}

	public function delete_word($id_word) {
		$this->db->delete("list_word", array('id_word' => $id_word));
		
		$word = Word_model::find_by_id($id_word);
		var_dump($word);
		if ($word) {$word->delete_word();}
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


	public static function find_by_user($user_id){
		$CI =& get_instance();
		$query = $CI->db->query("select * from list where list.id_admin = ".$user_id);
      	$lists=array();
		foreach ($query->result() as $row) {
			$list=new List_model();
			$list->set_id($row->id);
			$list->set_id_admin($row->id_admin);
			$list->set_name($row->name);
			$lists[]=$list;
		}
		return $lists;
	}



	public static function find_word_random($list_id,$user_id){

		$CI =& get_instance();


		$notrep="	select distinct id_word
				from list_word
				where list_word.id_list=$list_id";


		$avg = "select AVG(nb_all)
             	from user_word, list_word
				where user_word.id_word = list_word.id_word
				and list_word.id_list=$list_id
				and user_word.id_user=$user_id";
		
		$rep ="	select distinct user_word.id_word 
				from user_word, list_word
				where user_word.id_word = list_word.id_word
				and list_word.id_list=$list_id
				and user_word.id_user=$user_id
				and (nb_all <= ($avg)
				or nb_right < nb_false)";

		$ens = "select distinct id
				from word
				where id in ($rep)
				or id in ($notrep)";


		$query = $CI->db->query($ens);
		if($query->num_rows()>0){
			$random = rand(0,$query->num_rows()-1);
			$id = $query->row($random);
			$id = $id->id;
			$word = Word_model::find_by_id($id);
			return $word;
		}else{
			return null;
		}
		
	}

	public function try_list($user_id){
		$this->db->where('id_list',$this->id);
		$this->db->where('id_user',$user_id);
		$this->db->from('list_user');
		$nb = $this->db->count_all_results();
		if($nb==0){
			$this->db->set('id_list',$this->id);
			$this->db->set('id_user',$user_id);
			$this->db->insert('list_user');
		}
	}

	public static function get_tried_lists($user_id){
		$CI =& get_instance();
		$query = $CI->db->query("select id_list from  list_user where list_user.id_user = ".$user_id);
		$lists=array();
		foreach ($query->result() as $row) {
			$l = List_model::find_by_id($row->id_list);
			if($l){
				$lists[]=$l;
			}
		}
		return $lists;
	}

	public function get_stat($user_id){
		$query = $this->db->query("
			select nb_right, nb_false, nb_all 
			from list_word, user_word 
			where $this->id = list_word.id_list
			and list_word.id_word = user_word.id_word
			and user_word.id_user = $user_id 
			");
      	$lists=array();
		$nbWord=0;
		$ok=0;
		if($query->num_rows()==0){
			return 0;
		}
		foreach ($query->result() as $row) {
			$nbWord=$nbWord+1;
			if($row->nb_right >= $row->nb_false*2  &&  $row->nb_all>5 ){
				$ok++;
			}
		}
		return floor(($ok/$nbWord)*100);
	}




}