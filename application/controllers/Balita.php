<?php

class Balita extends CI_Controller
{

    public function index()
    {
        $this->load->view('partials/v_sidebar');
        $this->load->view('balita/v_balita');
        $this->load->view('partials/v_footer');
    }
}
