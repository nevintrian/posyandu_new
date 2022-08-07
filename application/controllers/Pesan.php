<?php

class Pesan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('html');
        $this->load->model('m_pesan');
        $this->load->library('pagination');
        $this->load->library('upload');
    }
    public function index()
    {
        $this->load->view('partials/v_sidebar');
        $config['total_rows'] = $this->m_pesan->total_rows();
        $pesan = $this->m_pesan->get_limit_data();
        $this->pagination->initialize($config);
        $data = array(
            'pesan_data' => $pesan,
            'total_rows' => $config['total_rows'],
        );

        $this->load->view('v_pesan', $data);
        $this->load->view('partials/v_footer');
    }
}
