<?php

class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('html');
        $this->load->model('m_ibu');
        $this->load->model('m_balita');
        $this->load->library('pagination');
        $this->load->library('upload');
    }
    public function index()
    {

        if ($this->session->userdata('level') == 'kader') {
            $balita = $this->m_balita->total_rows_kader();
            $ibu = $this->m_ibu->total_rows_kader();
        } else {
            $balita = $this->m_balita->total_rows();
            $ibu = $this->m_ibu->total_rows();
        }

        $data = array(
            'balita' => $balita,
            'ibu' => $ibu
        );

        $this->load->view('partials/v_sidebar');
        $this->load->view('v_dashboard', $data);
        $this->load->view('partials/v_footer');
    }
}
