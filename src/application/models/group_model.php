<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Group_model extends CI_model
{
	protected $table = 'group';

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
			return $this->add_group();
		} else {
			return $this->update_group();
		}
	}

	private function add_group()
	{
		$this->db->set('id_admin', $this->id_admin);
		$this->db->set('name', $this->name);

		$res = $this->db->insert($this->table);
		if ($res) {
			$this->id = $this->db->insert_id();
		}
		return $res;

	}

	private function update_group()
	{
		$this->db->set('id_admin', $this->id_admin);
		$this->db->set('name', $this->name);

		$this->db->where('id', $this->id);
		return $this->db->update($this->table);
	}

	private function delete_group()
	{
		if (isset($this->id)) {
			return $this->db->where('id', (int) $this->id)
							->delete($this->table);
		}
	}

	public function add_user($user)
	{

		$query = $this->db->get_where("group_user" , 
									array(
										'id_group' => $this->id , 
										'id_user'=> $user->get_id() ));

		$res=false;
		if($query->num_rows()==0){
			$this->db->set('id_group', $this->id);
			$this->db->set('id_user', $user->get_id());
			$res = $this->db->insert("group_user");
		}
		return $res;
	}

	public function get_users(){
		$query = $this->db->query("select * from group_user ,user where group_user.id_user = user.id and id_group='".$this->id."'");
      
        $users=array();
        foreach ($query->result() as $row) {
            $user = new User_model();
            $user->set_id($row->id);
            $user->set_login($row->login);
            $user->set_password($row->password);
            $user->set_first_name($row->first_name);
            $user->set_last_name($row->last_name);
            $user->set_right($row->right);
            $users[]=$user;
        }
        return $users;
	}

	public static function find_by_id($id){
		$CI =& get_instance();
		$CI->db->where('id', $id);
		$q = $CI->db->get('group');
		$row = array_shift($q->result_array());
		$group=new Group_model();
		$group->set_id($row['id']);
		$group->set_id_admin($row['id_admin']);
		$group->set_name($row['name']);
		return $group;
	}

	public static function find_by_user($user_id){
		$CI =& get_instance();
		$query = $CI->db->query("select * from `group` where group.id_admin = ".$user_id);
      	$groups=array();
		foreach ($query->result() as $row) {
			$group=new Group_model();
			$group->set_id($row->id);
			$group->set_id_admin($row->id_admin);
			$group->set_name($row->name);
			$groups[]=$group;
		}
		return $groups;
	}
}