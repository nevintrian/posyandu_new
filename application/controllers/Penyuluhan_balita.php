<?php

class Penyuluhan_balita extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('html');
        $this->load->model('m_penyuluhan_balita');
        $this->load->library('pagination');
        $this->load->library('upload');
    }

    public function index()
    {
        $this->load->view('partials/v_sidebar');
        $config['total_rows'] = $this->m_penyuluhan_balita->total_rows();
        $penyuluhan_balita = $this->m_penyuluhan_balita->get_limit_data();
        $this->pagination->initialize($config);
        $data = array(
            'penyuluhan_balita_data' => $penyuluhan_balita,
            'total_rows' => $config['total_rows'],
        );

        $this->load->view('v_penyuluhan_balita', $data);
        $this->load->view('partials/v_footer');
    }

    public function save()
    {
        $data = array(
            'nama' => $this->input->post('nama'),
        );
        $this->m_penyuluhan_balita->insert($data);
        redirect(site_url('penyuluhan_balita'));
    }

    public function update()
    {
        $data = array(
            'nama' => $this->input->post('nama'),
        );
        $this->m_penyuluhan_balita->update($this->input->post('id'), $data);
        redirect(site_url('penyuluhan_balita'));
    }

    public function delete()
    {
        $this->m_penyuluhan_balita->delete($this->input->post('id'));
        redirect(site_url('penyuluhan_balita'));
    }

}
