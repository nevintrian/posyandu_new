<?php

class Posyandu extends CI_Controller
{

    public function index()
    {
        $this->load->view('partials/v_sidebar');
        $this->load->view('posyandu/v_posyandu');
        $this->load->view('partials/v_footer');
    }
}
