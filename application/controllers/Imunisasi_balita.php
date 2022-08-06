<?php

class Imunisasi_balita extends CI_Controller
{

    public function index()
    {
        $this->load->view('partials/v_sidebar');
        $this->load->view('imunisasi_balita/v_imunisasi_balita');
        $this->load->view('partials/v_footer');
    }
}
