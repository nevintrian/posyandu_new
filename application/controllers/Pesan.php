<?php

class Pesan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('html');
        $this->load->model('m_pesan');
        $this->load->library('pagination');
        $this->load->library('upload');
        $this->load->library('cetak_pdf');
    }

    public function index()
    {
        $this->load->view('partials/v_sidebar');
        $config['total_rows'] = $this->m_pesan->total_rows();
        $pesan = $this->m_pesan->get_limit_data();
        $this->pagination->initialize($config);
        $data = array(
            'pesan_data' => $pesan,
            'total_rows' => $config['total_rows'],
        );

        $this->load->view('v_pesan', $data);
        $this->load->view('partials/v_footer');
    }

    public function cetak_pdf()
    {
        $pdf = new FPDF('P', 'mm', 'Letter');
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 7, 'DATA PESAN', 0, 1, 'C');
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(8, 6, 'No', 1, 0, 'C');
        $pdf->Cell(60, 6, 'Waktu', 1, 0, 'C');
        $pdf->Cell(65, 6, 'Posyandu Nama', 1, 0, 'C');
        $pdf->Cell(65, 6, 'Status', 1, 1, 'C');
        $pdf->SetFont('Arial', '', 10);
        $barang = $this->db->query("SELECT pesan.*, posyandu.nama as posyandu_nama FROM pesan join posyandu on posyandu.id = pesan.posyandu_id")->result();
        $no = 1;
        foreach ($barang as $data) {
            $pdf->Cell(8, 6, $no, 1, 0);
            $pdf->Cell(60, 6, $data->waktu, 1, 0);
            $pdf->Cell(65, 6, $data->posyandu_nama, 1, 0);
            $pdf->Cell(65, 6, $data->status == 1 ? 'Berhasil' : 'Gagal', 1, 1);
            $no++;
        }

        $pdf->Output();
    }
}
