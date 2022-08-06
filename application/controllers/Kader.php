<?php

class Kader extends CI_Controller
{

    public function index()
    {
        $this->load->view('partials/v_sidebar');
        $this->load->view('kader/v_kader');
        $this->load->view('partials/v_footer');
    }
}
