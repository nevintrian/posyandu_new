<?php

class Pesan extends CI_Controller
{

    public function index()
    {
        $this->load->view('partials/v_sidebar');
        $this->load->view('pesan/v_pesan');
        $this->load->view('partials/v_footer');
    }
}
