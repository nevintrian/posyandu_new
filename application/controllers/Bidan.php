<?php

class Bidan extends CI_Controller
{

    public function index()
    {
        $this->load->view('partials/v_sidebar');
        $this->load->view('bidan/v_bidan');
        $this->load->view('partials/v_footer');
    }
}
