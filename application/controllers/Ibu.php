<?php

class Ibu extends CI_Controller
{

    public function index()
    {
        $this->load->view('partials/v_sidebar');
        $this->load->view('ibu/v_ibu');
        $this->load->view('partials/v_footer');
    }
}
