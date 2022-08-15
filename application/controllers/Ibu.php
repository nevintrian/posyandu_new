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

    public function cetak_pdf($id)
    {
        $pdf = new FPDF('L', 'mm', 'A3');
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
        $pdf->Cell(50, 6, 'Nama Ibu', 1, 0, 'C');
        $pdf->Cell(50, 6, 'Nama Suami', 1, 0, 'C');
        $pdf->Cell(50, 6, 'Alamat', 1, 0, 'C');
        $pdf->Cell(50, 6, 'Tanggal Daftar', 1, 0, 'C');
        $pdf->Cell(50, 6, 'Umur Kehamilan', 1, 0, 'C');
        $pdf->Cell(50, 6, 'Keluhan', 1, 0, 'C');
        $pdf->Cell(45, 6, 'Telepon', 1, 0, 'C');
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
            $pdf->Cell(50, 6, $data->nama_ibu, 1, 0);
            $pdf->Cell(50, 6, $data->nama_suami, 1, 0);
            $pdf->Cell(50, 6, $data->alamat, 1, 0);
            $pdf->Cell(50, 6, $data->tanggal_daftar, 1, 0);
            $pdf->Cell(50, 6, $data->umur_kehamilan, 1, 0);
            $pdf->Cell(50, 6, $data->keluhan, 1, 0);
            $pdf->Cell(45, 6, $data->telepon, 1, 0);
            $pdf->Cell(45, 6, $data->posyandu_nama, 1, 1);
            $no++;
        }

        $pdf->Output();
    }
}
