<?php

class Penyuluhan_ibu extends CI_Controller
{

    public function index()
    {
        $this->load->view('partials/v_sidebar');
        $this->load->view('penyuluhan_ibu/v_penyuluhan_ibu');
        $this->load->view('partials/v_footer');
    }
}
