<?php

class Kegiatan extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('html');
        $this->load->model('m_kegiatan');
        $this->load->library('pagination');
        $this->load->library('upload');
    }

    public function index()
    {
        $this->load->view('partials/v_sidebar');
        $config['total_rows'] = $this->m_kegiatan->total_rows();
        $kegiatan = $this->m_kegiatan->get_limit_data();
        $this->pagination->initialize($config);
        $data = array(
            'kegiatan_data' => $kegiatan,
            'total_rows' => $config['total_rows'],
        );

        $this->load->view('v_kegiatan', $data);
        $this->load->view('partials/v_footer');
    }

    public function save()
    {
        $data = array(
            'nama' => $this->input->post('nama'),
        );
        $this->m_kegiatan->insert($data);
        redirect(site_url('kegiatan'));
    }

    public function update()
    {
        $data = array(
            'nama' => $this->input->post('nama'),
        );
        $this->m_kegiatan->update($this->input->post('id'), $data);
        redirect(site_url('kegiatan'));
    }

    public function delete()
    {
        $this->m_kegiatan->delete($this->input->post('id'));
        redirect(site_url('kegiatan'));
    }
}
