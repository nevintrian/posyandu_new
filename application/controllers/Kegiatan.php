<?php

class Kegiatan extends CI_Controller
{

    public function index()
    {
        $this->load->view('partials/v_sidebar');
        $this->load->view('kegiatan/v_kegiatan');
        $this->load->view('partials/v_footer');
    }
}
