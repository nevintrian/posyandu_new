<?php

class Jadwal_ibu extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('html');
        $this->load->model('m_jadwal_ibu');
        $this->load->model('m_kegiatan');
        $this->load->model('m_penyuluhan_ibu');
        $this->load->model('m_imunisasi_ibu');
        $this->load->model('m_posyandu');
        $this->load->library('pagination');
        $this->load->library('upload');
    }


    public function index()
    {
        $this->load->view('partials/v_sidebar');
        $config['total_rows'] = $this->m_jadwal_ibu->total_rows();
        $jadwal_ibu = $this->m_jadwal_ibu->get_limit_data();
        $kegiatan = $this->m_kegiatan->get_limit_data();
        $imunisasi_ibu = $this->m_imunisasi_ibu->get_limit_data();
        $penyuluhan_ibu = $this->m_penyuluhan_ibu->get_limit_data();
        $posyandu = $this->m_posyandu->get_limit_data();
        $this->pagination->initialize($config);
        $data = array(
            'jadwal_ibu_data' => $jadwal_ibu,
            'kegiatan_data' => $kegiatan,
            'imunisasi_ibu_data' => $imunisasi_ibu,
            'penyuluhan_ibu_data' => $penyuluhan_ibu,
            'posyandu_data' => $posyandu,
            'total_rows' => $config['total_rows'],
        );

        $this->load->view('v_jadwal_ibu', $data);
        $this->load->view('partials/v_footer');
    }

    public function save()
    {
        $data = array(
            'jadwal' => $this->input->post('jadwal'),
            'kegiatan_id' => $this->input->post('kegiatan_id'),
            'imunisasi_ibu_id' => $this->input->post('imunisasi_ibu_id'),
            'penyuluhan_ibu_id' => $this->input->post('penyuluhan_ibu_id'),
            'posyandu_id' => $this->input->post('posyandu_id'),
        );
        $this->m_jadwal_ibu->insert($data);
        redirect(site_url('jadwal_ibu'));
    }

    public function update()
    {
        $data = array(
            'jadwal' => $this->input->post('jadwal'),
            'kegiatan_id' => $this->input->post('kegiatan_id'),
            'imunisasi_ibu_id' => $this->input->post('imunisasi_ibu_id'),
            'penyuluhan_ibu_id' => $this->input->post('penyuluhan_ibu_id'),
            'posyandu_id' => $this->input->post('posyandu_id'),
        );

        $this->m_jadwal_ibu->update($this->input->post('id'), $data);
        redirect(site_url('jadwal_ibu'));
    }

    public function delete()
    {
        $this->m_jadwal_ibu->delete($this->input->post('id'));
        redirect(site_url('jadwal_ibu'));
    }

    public function send()
    {
        //send message


        $data = array(
            'status' => 1,
        );

        $this->m_jadwal_balita->update($this->input->post('id'), $data);


        $data1 = array(
            'waktu' => date("Y-m-d H:i:s"),
            'posyandu_id' => $this->input->post('posyandu_id'),
            'status' => $this->input->post('status'),
        );
        $this->m_pesan->insert($data1);
    }
}
