<?php

class Penyuluhan_balita extends CI_Controller
{

    public function index()
    {
        $this->load->view('partials/v_sidebar');
        $this->load->view('penyuluhan_balita/v_penyuluhan_balita');
        $this->load->view('partials/v_footer');
    }
}
