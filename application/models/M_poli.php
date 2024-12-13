<?php
class m_poli extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert_poli($data) {    
        return $this->db->insert('poli', $data);
    }

    public function get_poli_data() {
        $sql = "SELECT * FROM poli ORDER BY idPoli DESC";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function delete_data($id) {
        $sql = "DELETE FROM poli WHERE idPoli = ?";
        return $this->db->query($sql, array($id));
    }
}
?>