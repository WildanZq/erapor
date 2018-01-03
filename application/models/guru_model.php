                            <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guru_model extends CI_Model {

	public function getAllGuru()
	{
		return $this->db
		->get('guru')->result();
	}

	public function getGuruById($id)
	{
		return $this->db
		->where('id_guru', $this->db->escape_str($id))
		->get('guru')->result();
	}

	public function addGuru($data)
	{
		$this->db->insert('guru', $data);
		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

	public function editGuru($id, $data)
	{
		$this->db
		->where('id_guru', $this->db->escape_str($id))
		->update('guru', $data);
		if ($this->db->affected_rows() == 0) {
			return false;
		}
		 return true;
	}

	public function deleteGuru($id)
	{
		$this->db
		->where('id_guru', $this->db->escape_str($id))
		->delete('guru');
		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}
}

/* End of file guru_model.php */
/* Location: ./application/models/guru_model.php */