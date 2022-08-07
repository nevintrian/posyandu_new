<?php

class Jadwal_balita extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('html');
        $this->load->model('m_jadwal_balita');
        $this->load->model('m_kegiatan');
        $this->load->model('m_penyuluhan_balita');
        $this->load->model('m_imunisasi_balita');
        $this->load->model('m_posyandu');
        $this->load->model('m_pesan');
        $this->load->library('pagination');
        $this->load->library('upload');
    }


    public function index()
    {
        $this->load->view('partials/v_sidebar');
        $config['total_rows'] = $this->m_jadwal_balita->total_rows();
        $jadwal_balita = $this->m_jadwal_balita->get_limit_data();
        $kegiatan = $this->m_kegiatan->get_limit_data();
        $imunisasi_balita = $this->m_imunisasi_balita->get_limit_data();
        $penyuluhan_balita = $this->m_penyuluhan_balita->get_limit_data();
        $posyandu = $this->m_posyandu->get_limit_data();

        $this->pagination->initialize($config);
        $data = array(
            'jadwal_balita_data' => $jadwal_balita,
            'kegiatan_data' => $kegiatan,
            'imunisasi_balita_data' => $imunisasi_balita,
            'penyuluhan_balita_data' => $penyuluhan_balita,
            'posyandu_data' => $posyandu,
            'total_rows' => $config['total_rows'],
        );

        $this->load->view('v_jadwal_balita', $data);
        $this->load->view('partials/v_footer');
    }

    public function save()
    {
        $data = array(
            'jadwal' => $this->input->post('jadwal'),
            'kegiatan_id' => $this->input->post('kegiatan_id'),
            'imunisasi_balita_id' => $this->input->post('imunisasi_balita_id'),
            'penyuluhan_balita_id' => $this->input->post('penyuluhan_balita_id'),
            'posyandu_id' => $this->input->post('posyandu_id'),
        );
        $this->m_jadwal_balita->insert($data);
        redirect(site_url('jadwal_balita'));
    }

    public function update()
    {
        $data = array(
            'jadwal' => $this->input->post('jadwal'),
            'kegiatan_id' => $this->input->post('kegiatan_id'),
            'imunisasi_balita_id' => $this->input->post('imunisasi_balita_id'),
            'penyuluhan_balita_id' => $this->input->post('penyuluhan_balita_id'),
            'posyandu_id' => $this->input->post('posyandu_id'),
        );

        $this->m_jadwal_balita->update($this->input->post('id'), $data);
        redirect(site_url('jadwal_balita'));
    }

    public function delete()
    {
        $this->m_jadwal_balita->delete($this->input->post('id'));
        redirect(site_url('jadwal_balita'));
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
