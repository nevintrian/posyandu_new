<?php

class Jadwal_balita extends CI_Controller
{

    public function index()
    {
        $this->load->view('partials/v_sidebar');
        $this->load->view('jadwal_balita/v_jadwal_balita');
        $this->load->view('partials/v_footer');
    }
}
