<?php
class m_pUmum extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert_umum($data) {    
        return $this->db->insert('antrian', $data);
    }

    public function get_umum_data() {
        $sql = "SELECT * FROM antrian
        JOIN pasien ON idPasien = antrianPasienId
        JOIN poli ON idPoli = antrianPoliId
        ORDER BY idAntrian DESC";
        $query = $this->db->query($sql);
        return $query->result();

    }

    public function status_data($id)
{
    // Update query dengan kondisi untuk tiga status (0, 1, 2)
    $sql = "UPDATE antrian
            SET antrianStatus = CASE 
                WHEN antrianStatus = 0 THEN 1   -- Jika 0, set jadi 1
                WHEN antrianStatus = 1 THEN 2   -- Jika 1, set jadi 2
                ELSE antrianStatus   -- Jika 2, set jadi 0
            END 
            WHERE idAntrian = '$id'";

    return $this->db->query($sql);
}
}
?>