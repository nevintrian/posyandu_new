<?php

class Jadwal_ibu extends CI_Controller
{

    public function index()
    {
        $this->load->view('partials/v_sidebar');
        $this->load->view('jadwal_ibu/v_jadwal_ibu');
        $this->load->view('partials/v_footer');
    }
}
