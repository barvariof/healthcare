<?php
class m_pasien extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert_pasien($data) {    
        return $this->db->insert('healthcare', $data);
    }

    public function get_pasien_data() {
        $sql = "SELECT * FROM pasien ORDER BY idPasien DESC";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function delete_data($id) {
        $sql = "DELETE FROM pasien WHERE idPasien = ?";
        return $this->db->query($sql, array($id));
    }
}
?>