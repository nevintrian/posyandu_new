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
        $this->load->library('cetak_pdf');
    }

    public function index()
    {
        $this->load->view('partials/v_sidebar');
        $config['total_rows'] = $this->m_ibu->total_rows();
        if ($this->session->userdata('level') == 'kader') {
            $ibu = $this->m_ibu->get_limit_data_kader();
        } else {
            $ibu = $this->m_ibu->get_limit_data();
        }
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

    public function posyandu($id)
    {
        $this->load->view('partials/v_sidebar');

        $config['total_rows'] = $this->m_ibu->total_rows();
        $this->pagination->initialize($config);
        $ibu = $this->m_ibu->get_limit_data_posyandu($id);
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
            'rt' => $this->input->post('rt'),
            'rw' => $this->input->post('rw'),
            'tanggal_daftar' => $this->input->post('tanggal_daftar'),
            'usia_ibu' => $this->input->post('usia_ibu'),
            'umur_kehamilan' => $this->input->post('umur_kehamilan'),
            'usia_anak_terakhir' => $this->input->post('usia_anak_terakhir'),
            'sistol' => $this->input->post('sistol'),
            'diastol' => $this->input->post('diastol'),
            'diastol_miring' => $this->input->post('diastol_miring'),
            'diastol_terlentang' => $this->input->post('diastol_terlentang'),
            'berat_badan' => $this->input->post('berat_badan'),
            'tinggi_badan' => $this->input->post('tinggi_badan'),
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
            'rt' => $this->input->post('rt'),
            'rw' => $this->input->post('rw'),
            'tanggal_daftar' => $this->input->post('tanggal_daftar'),
            'usia_ibu' => $this->input->post('usia_ibu'),
            'umur_kehamilan' => $this->input->post('umur_kehamilan'),
            'usia_anak_terakhir' => $this->input->post('usia_anak_terakhir'),
            'sistol' => $this->input->post('sistol'),
            'diastol' => $this->input->post('diastol'),
            'diastol_miring' => $this->input->post('diastol_miring'),
            'diastol_terlentang' => $this->input->post('diastol_terlentang'),
            'berat_badan' => $this->input->post('berat_badan'),
            'tinggi_badan' => $this->input->post('tinggi_badan'),
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

    public function cetak_pdf($id)
    {
        $pdf = new FPDF('L', 'mm',  array(790, 350));
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        if (is_numeric($id)) {
            $pdf->Cell(0, 7, "DATA IBU HAMIL POSYANDU $id", 0, 1, 'C');
        } else {
            $pdf->Cell(0, 7, "DATA IBU HAMIL SEMUA POSYANDU", 0, 1, 'C');
        }
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(8, 6, 'No', 1, 0, 'C');
        $pdf->Cell(45, 6, 'Nama Ibu', 1, 0, 'C');
        $pdf->Cell(45, 6, 'Nama Suami', 1, 0, 'C');
        $pdf->Cell(45, 6, 'Alamat', 1, 0, 'C');
        $pdf->Cell(20, 6, 'RT', 1, 0, 'C');
        $pdf->Cell(20, 6, 'RW', 1, 0, 'C');
        $pdf->Cell(45, 6, 'Tanggal Daftar', 1, 0, 'C');
        $pdf->Cell(45, 6, 'Usia Ibu', 1, 0, 'C');
        $pdf->Cell(45, 6, 'Umur Kehamilan', 1, 0, 'C');
        $pdf->Cell(45, 6, 'Usia Anak Terakhir', 1, 0, 'C');
        $pdf->Cell(45, 6, 'Sistol', 1, 0, 'C');
        $pdf->Cell(45, 6, 'Diastol', 1, 0, 'C');
        $pdf->Cell(45, 6, 'Diastol Miring', 1, 0, 'C');
        $pdf->Cell(45, 6, 'Diastol Terlentang', 1, 0, 'C');
        $pdf->Cell(45, 6, 'Berat Badan (kg)', 1, 0, 'C');
        $pdf->Cell(45, 6, 'Tinggi Badan (cm)', 1, 0, 'C');
        $pdf->Cell(45, 6, 'Keluhan', 1, 0, 'C');
        $pdf->Cell(40, 6, 'Telepon', 1, 0, 'C');
        $pdf->Cell(45, 6, 'Posyandu', 1, 1, 'C');
        $pdf->SetFont('Arial', '', 10);
        if (is_numeric($id)) {
            $barang = $this->db->query("SELECT ibu.*, posyandu.nama as posyandu_nama FROM ibu join posyandu on posyandu.id = ibu.posyandu_id where posyandu.id = $id")->result();
        } else {
            $barang = $this->db->query("SELECT ibu.*, posyandu.nama as posyandu_nama FROM ibu join posyandu on posyandu.id = ibu.posyandu_id")->result();
        }
        $no = 1;
        foreach ($barang as $data) {
            $pdf->Cell(8, 6, $no, 1, 0);
            $pdf->Cell(45, 6, $data->nama_ibu, 1, 0);
            $pdf->Cell(45, 6, $data->nama_suami, 1, 0);
            $pdf->Cell(45, 6, $data->alamat, 1, 0);
            $pdf->Cell(20, 6, $data->rt, 1, 0);
            $pdf->Cell(20, 6, $data->rw, 1, 0);
            $pdf->Cell(45, 6, $data->tanggal_daftar, 1, 0);
            $pdf->Cell(45, 6, $data->usia_ibu, 1, 0);
            $pdf->Cell(45, 6, $data->umur_kehamilan, 1, 0);
            $pdf->Cell(45, 6, $data->usia_anak_terakhir, 1, 0);
            $pdf->Cell(45, 6, $data->sistol, 1, 0);
            $pdf->Cell(45, 6, $data->diastol, 1, 0);
            $pdf->Cell(45, 6, $data->diastol_miring, 1, 0);
            $pdf->Cell(45, 6, $data->diastol_terlentang, 1, 0);
            $pdf->Cell(45, 6, $data->berat_badan, 1, 0);
            $pdf->Cell(45, 6, $data->tinggi_badan, 1, 0);
            $pdf->Cell(45, 6, $data->keluhan, 1, 0);
            $pdf->Cell(40, 6, $data->telepon, 1, 0);
            $pdf->Cell(45, 6, $data->posyandu_nama, 1, 1);
            $no++;
        }

        $pdf->Output();
    }
}
