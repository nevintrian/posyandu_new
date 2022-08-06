<?php

class Dashboard extends CI_Controller
{

    public function index()
    {
        $this->load->view('partials/v_sidebar');
        $this->load->view('v_dashboard');
        $this->load->view('partials/v_footer');
    }
}
