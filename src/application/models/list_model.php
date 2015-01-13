<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class List_model extends CI_model
{
	protected $table = 'group';

	/**
	 * Add a list to database
	 * 
	 * @param 	integer 	$id_admin   	Id of the admin user of the group
	 * @param 	string 		$name   		Name of the group
	 * @return 	bool    	          		Return value of the request
	 */
	public function add_group($id_admin, $name)
	{
		$this->db->set('id_admin', $id_admin);
		$this->db->set('name', $name);
		
		return $this->db->insert($this->table);
	}

	/**
	 * Delete a list from database
	 * 
	 * @param 	integer 	$id 			Id of the group
	 * @return 	bool   						Return value of the request
	 */
	public function delete_group($id)
	{
		return $this->db->where('id', (int) $id)
						->delete($this->table);
	}

	/**
	 *  Update list data
	 *  
	 *  @param 	integer 	$id
	 *  @param 	string  	$id_admin  		Id of the admin user of the group
	 *  @param 	string  	$name 			Group name
	 *  @return bool
	 */
	public function update_group($id, $id_admin = null, $name = null)
	{
	    //  There's nothing to modify
	    if($id_admin == null AND $name == null)
	    {
	        return false;
	    }
	    
	    if($id_admin != null)
	    {
	        $this->db->set('id_admin', $id_admin);
	    }
	    if($name != null)
	    {
	        $this->db->set('name', $name);
	    }


	    $this->db->where('id', (int) $id);
	    
	    return $this->db->update($this->table);
	}
}