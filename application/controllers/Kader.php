<?php

class Kader extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('html');
        $this->load->model('m_kader');
        $this->load->model('m_posyandu');
        $this->load->library('pagination');
        $this->load->library('upload');
    }

    public function index()
    {
        $this->load->view('partials/v_sidebar');
        $config['total_rows'] = $this->m_kader->total_rows();
        $kader = $this->m_kader->get_limit_data();
        $posyandu = $this->m_posyandu->get_limit_data_asc();
        $this->pagination->initialize($config);
        $data = array(
            'kader_data' => $kader,
            'total_rows' => $config['total_rows'],
            'posyandu_data' => $posyandu
        );

        $this->load->view('v_kader', $data);
        $this->load->view('partials/v_footer');
    }

    public function posyandu($id)
    {
        $this->load->view('partials/v_sidebar');
        $config['total_rows'] = $this->m_kader->total_rows();
        $kader = $this->m_kader->get_limit_data_posyandu($id);
        $posyandu = $this->m_posyandu->get_limit_data_asc();
        $data = array(
            'kader_data' => $kader,
            'total_rows' => $config['total_rows'],
            'posyandu_data' => $posyandu
        );

        $this->load->view('v_kader', $data);
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
            'posyandu_id' => $this->input->post('posyandu_id'),
        );
        $this->m_kader->insert($data);
        redirect(site_url('kader'));
    }

    public function update()
    {
        $data = array(
            'nama' => $this->input->post('nama'),
            'email' => $this->input->post('email'),
            'alamat' => $this->input->post('alamat'),
            'telepon' => $this->input->post('telepon'),
            'posyandu_id' => $this->input->post('posyandu_id'),
        );
        if ($this->input->post('password')) {
            $data['password'] = md5($this->input->post('password'));
        }

        $this->m_kader->update($this->input->post('id'), $data);
        redirect(site_url('kader'));
    }

    public function delete()
    {
        $this->m_kader->delete($this->input->post('id'));
        redirect(site_url('kader'));
    }
}
