<?php

class Bidan extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('html');
        $this->load->model('m_bidan');
        $this->load->library('pagination');
        $this->load->library('upload');
    }

    public function index()
    {
        $this->load->view('partials/v_sidebar');
        $config['total_rows'] = $this->m_bidan->total_rows();
        $bidan = $this->m_bidan->get_limit_data();
        $this->pagination->initialize($config);
        $data = array(
            'bidan_data' => $bidan,
            'total_rows' => $config['total_rows'],
        );

        $this->load->view('v_bidan', $data);
        $this->load->view('partials/v_footer');
    }

    public function save()
    {
        $data = array(
            'nama' => $this->input->post('nama'),
            'email' => $this->input->post('email'),
            'alamat' => $this->input->post('alamat'),
            'telepon' => $this->input->post('telepon'),
            'password' => md5($this->input->post('password')),
        );
        $this->m_bidan->insert($data);
        redirect(site_url('bidan'));
    }

    public function update()
    {
        $data = array(
            'nama' => $this->input->post('nama'),
            'email' => $this->input->post('email'),
            'alamat' => $this->input->post('alamat'),
            'telepon' => $this->input->post('telepon'),
        );
        if ($this->input->post('password')) {
            $data['password'] = md5($this->input->post('password'));
        }

        $this->m_bidan->update($this->input->post('id'), $data);
        redirect(site_url('bidan'));
    }

    public function delete()
    {
        $this->m_bidan->delete($this->input->post('id'));
        redirect(site_url('bidan'));
    }
}
