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
        $this->right=0;
    }

    public function set_id($id){
    	$this->id = $id;
    }

    public function get_id(){
    	return $this->id;
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
    		return $this->add_user();
    	}else{
    		return $this->update_user();
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

	public static function login($login, $pass){
		$CI =& get_instance();
		$query = $CI->db->query("select * from user
                                    where login='".$login."'");
        if($query->num_rows()==1){
            $row = $query->result();
            $row = $row[0];
            if($row->password == sha1($pass)){
                $user = User_model::find_by_id($row->id);
                return $user;
            }else{
                return null;
            }
        }else{
            return null;
        }    
	}

    public static function find_by_id($id) {
        $CI =& get_instance();
        $query = $CI->db->query("select * from user where user.id = '".$id."'");

        if($query->num_rows()==1){
            $row = $query->result();
            $row = $row[0];
            $user = new User_model();
            $user->set_id($row->id);
            $user->set_first_name($row->first_name);
            $user->set_last_name($row->last_name);
            $user->set_login($row->login);
            $user->set_right($row->right);
            $user->set_password($row->password);
            return $user;
        }else{
            return null;
        }    

    }

    public static function find_by_login($login) {
        $CI =& get_instance();
        $query = $CI->db->query("select * from user where user.login = '".$login."'");

        if($query->num_rows()==1){
            $row = $query->result();
            $row = $row[0];
            $user = new User_model();
            $user->set_id($row->id);
            $user->set_first_name($row->first_name);
            $user->set_last_name($row->last_name);
            $user->set_login($row->login);
            $user->set_right($row->right);
            $user->set_password($row->password);
            return $user;
        }else{
            return null;
        }    

    }


}