<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Poli extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('m_poli'));
    }

    public function index()
    {
        $data['title'] = 'Poli';
        $data['poli'] = $this->m_poli->get_poli_data();
        $data['js'] = 'poli';

        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        $this->load->view('v_poli', $data);
        $this->load->view('footer', $data);
    }
    public function load_data(){
        $data['poli'] = $this->m_poli->get_poli_data();
        echo json_encode($data);
    }   

    public function create()
    {
        if ($this->input->post('poli') != '') {

            $poli = $this->input->post('poli');

            $query = $this->db->query("SELECT COUNT(*) as count FROM poli WHERE namaPoli = '{$poli}'");
            $result = $query->row();

            if ($result->count > 0) {
                $res['status'] = 'error';
                $res['msg'] = "Poli sudah ada";
            } else {
                $sql = "INSERT INTO poli (namaPoli) 
                VALUES ('{$poli}')";
                $exc = $this->db->query($sql);

                if ($exc) {
                    $res['status'] = 'success';
                    $res['msg'] = "Simpan data {$poli} berhasil";

                } else {
                    $res['status'] = 'error';
                    $res['msg'] = "Simpan data {$poli} gagal";
                }
            }
            echo json_encode($res);
        }
    }
    
    public function delete_table()
    {
        if ($this->m_poli->delete_data($this->input->post('id'))) {
            $res['status'] = 'success';

            $res['msg'] = "Data berhasil dihapus";
        } else {
            $res['status'] = 'error';
            $res['msg'] = "Gagal menghapus data";
        }
        echo json_encode($res);
    }
}