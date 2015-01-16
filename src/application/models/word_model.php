<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Word_model extends CI_model
{
	protected $table = 'word';

	private $french;
	private $english;
	private $sound;
	private $phonetic;

	function __construct()
	{
		parent::__construct();
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

}