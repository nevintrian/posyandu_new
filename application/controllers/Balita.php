<?php

class Balita extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('html');
        $this->load->model('m_balita');
        $this->load->model('m_posyandu');
        $this->load->library('pagination');
        $this->load->library('upload');
    }

    public function index()
    {
        $this->load->view('partials/v_sidebar');

        $config['total_rows'] = $this->m_balita->total_rows();
        $this->pagination->initialize($config);
        if ($this->session->userdata('level') == 'kader') {
            $balita = $this->m_balita->get_limit_data_kader();
        } else {
            $balita = $this->m_balita->get_limit_data();
        }
        $posyandu = $this->m_posyandu->get_limit_data_asc();
        $data = array(
            'balita_data' => $balita,
            'total_rows' => $config['total_rows'],
            'posyandu_data' => $posyandu
        );

        $this->load->view('v_balita', $data);
        $this->load->view('partials/v_footer');
    }

    public function posyandu($id)
    {
        $this->load->view('partials/v_sidebar');

        $config['total_rows'] = $this->m_balita->total_rows();
        $this->pagination->initialize($config);
        $balita = $this->m_balita->get_limit_data_posyandu($id);
        $posyandu = $this->m_posyandu->get_limit_data_asc();
        $data = array(
            'balita_data' => $balita,
            'total_rows' => $config['total_rows'],
            'posyandu_data' => $posyandu
        );

        $this->load->view('v_balita', $data);
        $this->load->view('partials/v_footer');
    }

    public function save()
    {
        $data = array(
            'nama' => $this->input->post('nama'),
            'tanggal_lahir' => $this->input->post('tanggal_lahir'),
            'tanggal_ukur' => $this->input->post('tanggal_ukur'),
            'umur' => $this->input->post('umur'),
            'tinggi_badan' => $this->input->post('tinggi_badan'),
            'berat_badan' => $this->input->post('berat_badan'),
            'lingkar_kepala' => $this->input->post('lingkar_kepala'),
            'vitamin_a' => $this->input->post('vitamin_a'),
            'obat_cacing' => $this->input->post('obat_cacing'),
            'orangtua' => $this->input->post('orangtua'),
            'telepon' => $this->input->post('telepon'),
            'alamat' => $this->input->post('alamat'),
            'posyandu_id' => $this->input->post('posyandu_id'),
        );
        $this->m_balita->insert($data);
        redirect(site_url('balita'));
    }

    public function update()
    {
        $data = array(
            'nama' => $this->input->post('nama'),
            'tanggal_lahir' => $this->input->post('tanggal_lahir'),
            'tanggal_ukur' => $this->input->post('tanggal_ukur'),
            'umur' => $this->input->post('umur'),
            'tinggi_badan' => $this->input->post('tinggi_badan'),
            'berat_badan' => $this->input->post('berat_badan'),
            'lingkar_kepala' => $this->input->post('lingkar_kepala'),
            'vitamin_a' => $this->input->post('vitamin_a'),
            'obat_cacing' => $this->input->post('obat_cacing'),
            'orangtua' => $this->input->post('orangtua'),
            'telepon' => $this->input->post('telepon'),
            'alamat' => $this->input->post('alamat'),
            'posyandu_id' => $this->input->post('posyandu_id'),
        );

        $this->m_balita->update($this->input->post('id'), $data);
        redirect(site_url('balita'));
    }

    public function delete()
    {
        $this->m_balita->delete($this->input->post('id'));
        redirect(site_url('balita'));
    }
}
