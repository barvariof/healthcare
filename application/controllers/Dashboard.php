<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('m_dashboard'));
    }

    public function index()
    {
        $data['totalPasien'] = $this->m_dashboard->get_total_pasien_data();
        $data['totalPoli'] = $this->m_dashboard->get_total_poli_data();
        $data['title'] = 'Dashboard';
        $data['js'] = 'dashboard';

        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        $this->load->view('dashboard', $data);
        $this->load->view('footer', $data);
    }
}