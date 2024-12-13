<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PoliUmum extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('m_pUmum', 'm_pasien', 'm_poli'));
    }

    public function index()
    {
        $data['title'] = 'Poli Umum';
        $data['poliumum'] = $this->m_pUmum->get_umum_data();
        $data['js'] = 'poliUmum';

        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        $this->load->view('v_poliUmum', $data);
        $this->load->view('footer', $data);
    }
    public function load_data(){
        $data['poliumum'] = $this->m_pUmum->get_umum_data();
        echo json_encode($data);
    }   
    public function load_pasien(){
        $data['pasien'] = $this->m_pasien->get_pasien_data();
        echo json_encode($data);
    }   
    public function load_poli(){
        $data['poli'] = $this->m_poli->get_poli_data();
        echo json_encode($data);
    }   

    public function create()
{
    $antrianPasienId = $this->input->post('pasien');
    $antrianPoliId = $this->input->post('poli');

    // Tentukan prefix berdasarkan poli
    $prefixMap = [
        '5' => 'GZ',
        '4' => 'GG',
        '3' => 'UM',
        // Tambahkan mapping poli lain di sini
    ];

    $prefix = isset($prefixMap[$antrianPoliId]) ? $prefixMap[$antrianPoliId] : 'XX'; // Default prefix jika poli tidak ditemukan

    $query = $this->db->query("SELECT COUNT(*) as count FROM antrian WHERE antrianPasienId = '{$antrianPasienId}' AND antrianStatus IN (0, 1)");
    $result = $query->row();

    if ($result->count > 0) {
        $pasienNamaQuery = "SELECT namaPasien FROM pasien WHERE idPasien = '{$antrianPasienId}'";
        $pasienNama = $this->db->query($pasienNamaQuery)->row()->namaPasien;

        $res['status'] = 'error';
        $res['msg'] = "{$pasienNama} sudah terdaftar";
    } else {
        $sql = "SELECT IFNULL(
            (
                SELECT CONCAT(
                    '{$prefix}/', 
                    DATE_FORMAT(CURRENT_DATE(), '%m%d'), '/', 
                    LPAD(RIGHT(MAX(antrianNo), 3) + 1, 3, '0')
                ) AS no_trans
                FROM antrian
                WHERE antrianNo LIKE CONCAT(
                    '{$prefix}/', DATE_FORMAT(CURRENT_DATE(), '%m%d'), '/%')
                AND DATE_FORMAT(CURRENT_DATE(), '%d%m')
                ORDER BY antrianNo DESC
                LIMIT 1
            ), 
            CONCAT('{$prefix}/', DATE_FORMAT(CURRENT_DATE(), '%m%d'), '/001')
        ) AS no_trans;";

        $no_trans = $this->db->query($sql)->row()->no_trans;
        $sql2 = "INSERT INTO antrian (antrianPoliId, antrianPasienId, antrianNo, antrianWaktuReg) VALUES ('{$antrianPoliId}','{$antrianPasienId}','{$no_trans}', NOW())";
        $exc = $this->db->query($sql2);

        if ($exc) {
            $pasienNamaQuery = "SELECT namaPasien FROM pasien WHERE idPasien = '{$antrianPasienId}'";
            $pasienNama = $this->db->query($pasienNamaQuery)->row()->namaPasien;

            $res['status'] = 'success';
            $res['msg'] = "{$pasienNama} berhasil ditambahkan ke antrian";
        } else {
            $res['status'] = 'error';
            $res['msg'] = "Pasien gagal ditambahkan ke antrian";
        }
    }
    echo json_encode($res);
}


    public function status_data()
    {
        $id = $this->input->post("id");
        $status = $this->input->post("status");

        // Menentukan deskripsi berdasarkan status
        if ($status == 1) {
            $action = "telah dilayani"; // Selesai
        } elseif ($status == 0) {
            $action = "sedang dilayani"; // Menunggu
        } elseif ($status == 2) {
            $action = "harus menunggu kembali"; // Dilayani
        } else {
            $action = "unknown";
        }

        $isSuccess = $this->m_pUmum->status_data($id, $status); // Update status data

        if ($isSuccess) {
            $res["status"] = "success";
            $res["msg"] = "Pasien " . $action;
        } else {
            $res["status"] = "error";
            $res["msg"] = "Pasien " . $action;
        }

        echo json_encode($res);
    }
}