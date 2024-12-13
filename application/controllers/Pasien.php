<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pasien extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('m_pasien'));
    }

    public function index()
    {
        $data['title'] = 'Pasien';
        $data['pasien'] = $this->m_pasien->get_pasien_data();
        $data['js'] = 'pasien';

        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        $this->load->view('v_pasien', $data);
        $this->load->view('footer', $data);
    }
    public function load_data(){
        $data['pasien'] = $this->m_pasien->get_pasien_data();
        echo json_encode($data);
    }   

    public function create()
    {
        if ($this->input->post('nik') != '') {

            $nik = $this->input->post('nik');
            $nama = $this->input->post('nama');
            $ttl = $this->input->post('ttl');
            $gender = $this->input->post('gender');
            $goldarah = $this->input->post('goldarah');
            $alamat = $this->input->post('alamat');
            $notelp = $this->input->post('notelp');

            $query = $this->db->query("SELECT COUNT(*) as count FROM pasien WHERE nikPasien = '{$nik}'");
            $result = $query->row();

            if ($result->count > 0) {
                $res['status'] = 'error';
                $res['msg'] = "NIK sudah terpakai";
            } else {
                $sql = "INSERT INTO pasien (nikPasien, namaPasien, ttlPasien, genderPasien, golDarahPasien, alamatPasien, noTelpPasien) 
                VALUES ('{$nik}', '{$nama}', '{$ttl}', '{$gender}', '{$goldarah}', '{$alamat}', '{$notelp}')";
                $exc = $this->db->query($sql);

                if ($exc) {
                    $res['status'] = 'success';
                    $res['msg'] = "Simpan data {$nama} berhasil";

                } else {
                    $res['status'] = 'error';
                    $res['msg'] = "Simpan data {$nama} gagal";
                }
            }
            echo json_encode($res);
        }
    }

    public function edit_table()
    {
        $id = $this->input->post('id');
        $sql = $this->db->query("SELECT * FROM pasien WHERE idPasien = ?", array($id));
        $result = $sql->row_array();
        if ($result > 0) {
            $res['status'] = 'ok';
            $res['data'] = $result;
            $res['msg'] = "Data {$id} sudah ada";
        } else {
            $res['status'] = 'error';
            $res['msg'] = "Code tidak ditemukan";
        }
        echo json_encode($res);
    }
    
    public function delete_table()
    {
        if ($this->m_pasien->delete_data($this->input->post('id'))) {
            $res['status'] = 'success';

            $res['msg'] = "Data berhasil dihapus";
        } else {
            $res['status'] = 'error';
            $res['msg'] = "Gagal menghapus data";
        }
        echo json_encode($res);
    }
}