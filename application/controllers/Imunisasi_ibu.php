<?php

class Imunisasi_ibu extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('html');
        $this->load->model('m_imunisasi_ibu');
        $this->load->library('pagination');
        $this->load->library('upload');
    }

    public function index()
    {
        $this->load->view('partials/v_sidebar');
        $config['total_rows'] = $this->m_imunisasi_ibu->total_rows();
        $imunisasi_ibu = $this->m_imunisasi_ibu->get_limit_data();
        $this->pagination->initialize($config);
        $data = array(
            'imunisasi_ibu_data' => $imunisasi_ibu,
            'total_rows' => $config['total_rows'],
        );

        $this->load->view('v_imunisasi_ibu', $data);
        $this->load->view('partials/v_footer');
    }

    public function save()
    {
        $data = array(
            'nama' => $this->input->post('nama'),
        );
        $this->m_imunisasi_ibu->insert($data);
        redirect(site_url('imunisasi_ibu'));
    }

    public function update()
    {
        $data = array(
            'nama' => $this->input->post('nama'),
        );
        $this->m_imunisasi_ibu->update($this->input->post('id'), $data);
        redirect(site_url('imunisasi_ibu'));
    }

    public function delete()
    {
        $this->m_imunisasi_ibu->delete($this->input->post('id'));
        redirect(site_url('imunisasi_ibu'));
    }
}
