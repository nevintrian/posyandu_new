<?php

class Ibu extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('html');
        $this->load->model('m_ibu');
        $this->load->model('m_posyandu');
        $this->load->library('pagination');
        $this->load->library('upload');
    }

    public function index()
    {
        $this->load->view('partials/v_sidebar');
        $config['total_rows'] = $this->m_ibu->total_rows();
        $ibu = $this->m_ibu->get_limit_data();
        $this->pagination->initialize($config);
        $posyandu = $this->m_posyandu->get_limit_data_asc();
        $data = array(
            'ibu_data' => $ibu,
            'total_rows' => $config['total_rows'],
            'posyandu_data' => $posyandu
        );

        $this->load->view('v_ibu', $data);
        $this->load->view('partials/v_footer');
    }

    public function save()
    {
        $data = array(
            'nama_ibu' => $this->input->post('nama_ibu'),
            'nama_suami' => $this->input->post('nama_suami'),
            'alamat' => $this->input->post('alamat'),
            'tanggal_daftar' => $this->input->post('tanggal_daftar'),
            'umur_kehamilan' => $this->input->post('umur_kehamilan'),
            'keluhan' => $this->input->post('keluhan'),
            'telepon' => $this->input->post('telepon'),
            'posyandu_id' => $this->input->post('posyandu_id'),
        );
        $this->m_ibu->insert($data);
        redirect(site_url('ibu'));
    }

    public function update()
    {
        $data = array(
            'nama_ibu' => $this->input->post('nama_ibu'),
            'nama_suami' => $this->input->post('nama_suami'),
            'alamat' => $this->input->post('alamat'),
            'tanggal_daftar' => $this->input->post('tanggal_daftar'),
            'umur_kehamilan' => $this->input->post('umur_kehamilan'),
            'keluhan' => $this->input->post('keluhan'),
            'telepon' => $this->input->post('telepon'),
            'posyandu_id' => $this->input->post('posyandu_id'),
        );

        $this->m_ibu->update($this->input->post('id'), $data);
        redirect(site_url('ibu'));
    }

    public function delete()
    {
        $this->m_ibu->delete($this->input->post('id'));
        redirect(site_url('ibu'));
    }
}
