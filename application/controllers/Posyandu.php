<?php

class Posyandu extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('html');
        $this->load->model('m_posyandu');
        $this->load->library('pagination');
        $this->load->library('upload');
        $this->load->library('cetak_pdf');
    }

    public function index()
    {
        $this->load->view('partials/v_sidebar');
        $config['total_rows'] = $this->m_posyandu->total_rows();
        $posyandu = $this->m_posyandu->get_limit_data();
        $this->pagination->initialize($config);
        $data = array(
            'posyandu_data' => $posyandu,
            'total_rows' => $config['total_rows'],
        );

        $this->load->view('v_posyandu', $data);
        $this->load->view('partials/v_footer');
    }

    public function save()
    {
        $data = array(
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
        );
        $this->m_posyandu->insert($data);
        redirect(site_url('posyandu'));
    }

    public function update()
    {
        $data = array(
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
        );
        $this->m_posyandu->update($this->input->post('id'), $data);
        redirect(site_url('posyandu'));
    }

    public function delete()
    {
        $this->m_posyandu->delete($this->input->post('id'));
        redirect(site_url('posyandu'));
    }

    public function cetak_pdf()
    {
        $pdf = new FPDF('P', 'mm', 'Letter');
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 7, 'DATA POSYANDU', 0, 1, 'C');
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(8, 6, 'No', 1, 0, 'C');
        $pdf->Cell(95, 6, 'Nama Posyandu', 1, 0, 'C');
        $pdf->Cell(95, 6, 'Alamat', 1, 1, 'C');
        $pdf->SetFont('Arial', '', 10);
        $barang = $this->db->query("SELECT * FROM posyandu")->result();
        $no = 1;
        foreach ($barang as $data) {
            $pdf->Cell(8, 6, $no, 1, 0);
            $pdf->Cell(95, 6, $data->nama, 1, 0);
            $pdf->Cell(95, 6, $data->alamat, 1, 1);
            $no++;
        }

        $pdf->Output();
    }
}
