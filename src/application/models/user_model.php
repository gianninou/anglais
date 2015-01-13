<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_model
{
	protected $table = 'user';

	/**
	 * Add a user to database
	 * 
	 * @param 	string 	$login   		Login of the user
	 * @param 	string 	$password   	Password of the user
	 * @param 	string 	$first_name 	First name of the user
	 * @param 	string 	$last_name  	Last name of the user
	 * @return 	bool    	          	Return value of the request
	 */
	public function add_user($login, $password, $first_name, $last_name)
	{
		$this->db->set('login', $login);
		$this->db->set('password', $password);
		$this->db->set('first_name', $first_name);
		$this->db->set('last_name', $last_name);
		
		return $this->db->insert($this->table);
	}

	/**
	 * Delete a user from database
	 * 
	 * @param 	integer 	$id 	Id of the user
	 * @return 	bool   				Return value of the request
	 */
	public function delete_user($id)
	{
		return $this->db->where('id', (int) $id)
						->delete($this->table);
	}

	/**
	 *  Update user data
	 *  
	 *  @param 	integer 	$id
	 *  @param 	string  	$login  		User login
	 *  @param 	string  	$password 		User password
 	 *  @param 	string  	$first_name 	User first name
 	 *  @param 	string  	$last_name 		User last name
	 *  @return bool
	 */
	public function update_user($id, $login = null, $password = null, $first_name = null, $last_name = null, $right = null)
	{
	    //  There's nothing to modify
	    if($login == null AND $password == null AND $first_name == null AND $last_name == null AND $right == null)
	    {
	        return false;
	    }
	    
	    if($login != null)
	    {
	        $this->db->set('login', $login);
	    }
	    if($password != null)
	    {
	        $this->db->set('password', $password);
	    }
	    if($first_name != null)
	    {
	        $this->db->set('first_name', $first_name);
	    }
	    if($last_name != null)
	    {
	        $this->db->set('last_name', $last_name);
	    }
	    if($right != null)
	    {
	        $this->db->set('right', $right);
	    }

	    $this->db->where('id', (int) $id);
	    
	    return $this->db->update($this->table);
	}
}