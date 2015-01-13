<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_model
{
	protected $table = 'user';

	/**
	 * Add a user to database
	 * 
	 * @param 	string 		$french   		French traduction of the word
	 * @param 	string 		$english   		English traduction of the word
	 * @param 	string 		$sound 			Sound of english phonetic
	 * @param 	string 		$phonetic  		English phonetic
	 * @return 	bool    	          		Return value of the request
	 */
	public function add_user($french, $english, $sound, $phonetic)
	{
		$this->db->set('french', $french);
		$this->db->set('english', $english);
		$this->db->set('sound', $sound);
		$this->db->set('phonetic', $phonetic);
		
		return $this->db->insert($this->table);
	}

	/**
	 * Delete a user from database
	 * 
	 * @param 	integer 	$id 			Id of the user
	 * @return 	bool   						Return value of the request
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
	 *  @param 	string  	$french  		French traduction of the word
	 *  @param 	string  	$english 		English traduction of the word
 	 *  @param 	string  	$sound 			Sound of english phonetic
 	 *  @param 	string  	$phonetic 		English phonetic
	 *  @return bool
	 */
	public function update_user($id, $french = null, $english = null, $sound = null, $phonetic = null)
	{
	    //  There's nothing to modify
	    if($french == null AND $english == null AND $sound == null AND $phonetic == null)
	    {
	        return false;
	    }
	    
	    if($french != null)
	    {
	        $this->db->set('french', $french);
	    }
	    if($english != null)
	    {
	        $this->db->set('english', $english);
	    }
	    if($sound != null)
	    {
	        $this->db->set('sound', $sound);
	    }
	    if($phonetic != null)
	    {
	        $this->db->set('phonetic', $phonetic);
	    }

	    $this->db->where('id', (int) $id);
	    
	    return $this->db->update($this->table);
	}
}