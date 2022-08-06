<?php

class Imunisasi_ibu extends CI_Controller
{

    public function index()
    {
        $this->load->view('partials/v_sidebar');
        $this->load->view('imunisasi_ibu/v_imunisasi_ibu');
        $this->load->view('partials/v_footer');
    }
}
