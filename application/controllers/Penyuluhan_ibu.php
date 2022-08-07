<?php

class Penyuluhan_ibu extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('html');
        $this->load->model('m_penyuluhan_ibu');
        $this->load->library('pagination');
        $this->load->library('upload');
    }

    public function index()
    {
        $this->load->view('partials/v_sidebar');
        $config['total_rows'] = $this->m_penyuluhan_ibu->total_rows();
        $penyuluhan_ibu = $this->m_penyuluhan_ibu->get_limit_data();
        $this->pagination->initialize($config);
        $data = array(
            'penyuluhan_ibu_data' => $penyuluhan_ibu,
            'total_rows' => $config['total_rows'],
        );

        $this->load->view('v_penyuluhan_ibu', $data);
        $this->load->view('partials/v_footer');
    }

    public function save()
    {
        $data = array(
            'nama' => $this->input->post('nama'),
        );
        $this->m_penyuluhan_ibu->insert($data);
        redirect(site_url('penyuluhan_ibu'));
    }

    public function update()
    {
        $data = array(
            'nama' => $this->input->post('nama'),
        );
        $this->m_penyuluhan_ibu->update($this->input->post('id'), $data);
        redirect(site_url('penyuluhan_ibu'));
    }

    public function delete()
    {
        $this->m_penyuluhan_ibu->delete($this->input->post('id'));
        redirect(site_url('penyuluhan_ibu'));
    }
}
