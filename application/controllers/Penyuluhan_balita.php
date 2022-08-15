<?php

class Penyuluhan_balita extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('html');
        $this->load->model('m_penyuluhan_balita');
        $this->load->library('pagination');
        $this->load->library('upload');
        $this->load->library('cetak_pdf');
    }

    public function index()
    {
        $this->load->view('partials/v_sidebar');
        $config['total_rows'] = $this->m_penyuluhan_balita->total_rows();
        $penyuluhan_balita = $this->m_penyuluhan_balita->get_limit_data();
        $this->pagination->initialize($config);
        $data = array(
            'penyuluhan_balita_data' => $penyuluhan_balita,
            'total_rows' => $config['total_rows'],
        );

        $this->load->view('v_penyuluhan_balita', $data);
        $this->load->view('partials/v_footer');
    }

    public function save()
    {
        $data = array(
            'nama' => $this->input->post('nama'),
        );
        $this->m_penyuluhan_balita->insert($data);
        redirect(site_url('penyuluhan_balita'));
    }

    public function update()
    {
        $data = array(
            'nama' => $this->input->post('nama'),
        );
        $this->m_penyuluhan_balita->update($this->input->post('id'), $data);
        redirect(site_url('penyuluhan_balita'));
    }

    public function delete()
    {
        $this->m_penyuluhan_balita->delete($this->input->post('id'));
        redirect(site_url('penyuluhan_balita'));
    }

    public function cetak_pdf()
    {
        $pdf = new FPDF('P', 'mm', 'Letter');
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 7, 'DATA PENYULUHAN BALITA', 0, 1, 'C');
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(8, 6, 'No', 1, 0, 'C');
        $pdf->Cell(190, 6, 'Nama Penyuluhan Balita', 1, 1, 'C');
        $pdf->SetFont('Arial', '', 10);
        $barang = $this->db->query("SELECT * FROM penyuluhan_balita")->result();
        $no = 1;
        foreach ($barang as $data) {
            $pdf->Cell(8, 6, $no, 1, 0);
            $pdf->Cell(190, 6, $data->nama, 1, 1);
            $no++;
        }

        $pdf->Output();
    }
}
