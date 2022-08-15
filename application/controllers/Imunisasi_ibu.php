<?php

class Imunisasi_ibu extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('html');
        $this->load->model('m_imunisasi_ibu');
        $this->load->library('pagination');
        $this->load->library('upload');
        $this->load->library('cetak_pdf');
    }

    public function index()
    {
        $this->load->view('partials/v_sidebar');
        $config['total_rows'] = $this->m_imunisasi_ibu->total_rows();
        $imunisasi_ibu = $this->m_imunisasi_ibu->get_limit_data();
        $this->pagination->initialize($config);
        $data = array(
            'imunisasi_ibu_data' => $imunisasi_ibu,
            'total_rows' => $config['total_rows'],
        );

        $this->load->view('v_imunisasi_ibu', $data);
        $this->load->view('partials/v_footer');
    }

    public function save()
    {
        $data = array(
            'nama' => $this->input->post('nama'),
        );
        $this->m_imunisasi_ibu->insert($data);
        redirect(site_url('imunisasi_ibu'));
    }

    public function update()
    {
        $data = array(
            'nama' => $this->input->post('nama'),
        );
        $this->m_imunisasi_ibu->update($this->input->post('id'), $data);
        redirect(site_url('imunisasi_ibu'));
    }

    public function delete()
    {
        $this->m_imunisasi_ibu->delete($this->input->post('id'));
        redirect(site_url('imunisasi_ibu'));
    }

    public function cetak_pdf()
    {
        $pdf = new FPDF('P', 'mm', 'Letter');
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 7, 'DATA IMUNISASI IBU', 0, 1, 'C');
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(8, 6, 'No', 1, 0, 'C');
        $pdf->Cell(190, 6, 'Nama Imunisasi Ibu', 1, 1, 'C');
        $pdf->SetFont('Arial', '', 10);
        $barang = $this->db->query("SELECT * FROM imunisasi_ibu")->result();
        $no = 1;
        foreach ($barang as $data) {
            $pdf->Cell(8, 6, $no, 1, 0);
            $pdf->Cell(190, 6, $data->nama, 1, 1);
            $no++;
        }

        $pdf->Output();
    }
}
