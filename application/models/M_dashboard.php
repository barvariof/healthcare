<?php
class m_dashboard extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_total_pasien_data() {
        $this->db->select('COUNT(DISTINCT namaPasien) as totalPasien');
        $query = $this->db->get('pasien');
        return $query->row()->totalPasien;
    }
    public function get_total_poli_data() {
        $this->db->select('COUNT(DISTINCT namaPoli) as totalPoli');
        $query = $this->db->get('poli');
        return $query->row()->totalPoli;
    }
}
?>