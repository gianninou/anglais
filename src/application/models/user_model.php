<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_model
{
	protected $table = 'user';

	private $id;
	private $login;
	private $password;
	private $first_name;
	private $last_name;
	private $right;

	function __construct()
	{
        parent::__construct();
    }

    public function set_login($login){
    	$this->login = $login;
    }

    public function get_login(){
    	return $this->login;
    }

    public function set_password($password , $hash=true){
    	if($hash){
   	 		$this->password = sha1($password);
   	 	}else{
   	 		$this->password = $password;
   	 	}
    }

    public function get_password(){
    	return $this->password;
    }

    public function set_first_name($first_name){
    	$this->first_name = $first_name;
    }

    public function get_first_name(){
    	return $this->first_name;
    }

    public function set_last_name($last_name){
    	$this->last_name = $last_name;
    }

    public function get_last_name(){
    	return $this->last_name;
    }

    public function set_right($right){
    	$this->right = $right;
    }

    public function get_right(){
    	return $this->right;
    }


    public function save(){
    	if(!isset($this->id)){
    		$this->add_user();
    	}else{
    		$this->update_user();
    	}
    }


	/**
	 * Add a user to database
	 * 
	 */
	private function add_user()
	{
		$this->db->set('login', $this->login);
		$this->db->set('password', $this->password);
		$this->db->set('first_name', $this->first_name);
		$this->db->set('last_name', $this->last_name);
		
		$res = $this->db->insert($this->table);
		if($res){
			$this->id = $this->db->insert_id();
		}
		return $res;
	}


	/**
	 *  Update user data
	 *  @return bool
	 */
	private function update_user()
	{
	    
        $this->db->set('login', $this->login);
        $this->db->set('password', $this->password);
        $this->db->set('first_name', $this->first_name);
        $this->db->set('last_name', $this->last_name);
        $this->db->set('right', $this->right);
	    
	    $this->db->where('id', (int) $this->id);
	    return $this->db->update($this->table);

	}


	/**
	 * Delete a user from database
	 * @return 	bool   				Return value of the request
	 */
	public function delete_user()
	{
		if(isset($this->id)){
			return $this->db->where('id', (int) $this->id)
						->delete($this->table);
		}
	}

}