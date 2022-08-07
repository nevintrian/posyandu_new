<?php

class Posyandu extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('html');
        $this->load->model('m_posyandu');
        $this->load->library('pagination');
        $this->load->library('upload');
    }

    public function index()
    {
        $this->load->view('partials/v_sidebar');
        $config['total_rows'] = $this->m_posyandu->total_rows();
        $posyandu = $this->m_posyandu->get_limit_data();
        $this->pagination->initialize($config);
        $data = array(
            'posyandu_data' => $posyandu,
            'total_rows' => $config['total_rows'],
        );

        $this->load->view('v_posyandu', $data);
        $this->load->view('partials/v_footer');
    }

    public function save()
    {
        $data = array(
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
        );
        $this->m_posyandu->insert($data);
        redirect(site_url('posyandu'));
    }

    public function update()
    {
        $data = array(
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
        );
        $this->m_posyandu->update($this->input->post('id'), $data);
        redirect(site_url('posyandu'));
    }

    public function delete()
    {
        $this->m_posyandu->delete($this->input->post('id'));
        redirect(site_url('posyandu'));
    }
}
