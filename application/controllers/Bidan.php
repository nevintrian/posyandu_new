<?php

class Bidan extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('html');
        $this->load->model('m_bidan');
        $this->load->library('pagination');
        $this->load->library('upload');
        $this->load->library('cetak_pdf');
    }

    public function index()
    {
        $this->load->view('partials/v_sidebar');
        $config['total_rows'] = $this->m_bidan->total_rows();
        $bidan = $this->m_bidan->get_limit_data();
        $this->pagination->initialize($config);
        $data = array(
            'bidan_data' => $bidan,
            'total_rows' => $config['total_rows'],
        );

        $this->load->view('v_bidan', $data);
        $this->load->view('partials/v_footer');
    }

    public function save()
    {
        $data = array(
            'nama' => $this->input->post('nama'),
            'email' => $this->input->post('email'),
            'alamat' => $this->input->post('alamat'),
            'telepon' => $this->input->post('telepon'),
            'password' => md5($this->input->post('password')),
        );
        $this->m_bidan->insert($data);
        redirect(site_url('bidan'));
    }

    public function update()
    {
        $data = array(
            'nama' => $this->input->post('nama'),
            'email' => $this->input->post('email'),
            'alamat' => $this->input->post('alamat'),
            'telepon' => $this->input->post('telepon'),
        );
        if ($this->input->post('password')) {
            $data['password'] = md5($this->input->post('password'));
        }

        $this->m_bidan->update($this->input->post('id'), $data);
        redirect(site_url('bidan'));
    }

    public function delete()
    {
        $this->m_bidan->delete($this->input->post('id'));
        redirect(site_url('bidan'));
    }

    public function cetak_pdf()
    {
        $pdf = new FPDF('P', 'mm', 'Letter');
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 7, 'DATA BIDAN', 0, 1, 'C');
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(8, 6, 'No', 1, 0, 'C');
        $pdf->Cell(50, 6, 'Email', 1, 0, 'C');
        $pdf->Cell(50, 6, 'Nama', 1, 0, 'C');
        $pdf->Cell(45, 6, 'Alamat', 1, 0, 'C');
        $pdf->Cell(45, 6, 'Telepon', 1, 1, 'C');
        $pdf->SetFont('Arial', '', 10);
        $barang = $this->db->query("SELECT * FROM bidan")->result();
        $no = 1;
        foreach ($barang as $data) {
            $pdf->Cell(8, 6, $no, 1, 0);
            $pdf->Cell(50, 6, $data->email, 1, 0);
            $pdf->Cell(50, 6, $data->nama, 1, 0);
            $pdf->Cell(45, 6, $data->alamat, 1, 0);
            $pdf->Cell(45, 6, $data->telepon, 1, 1);
            $no++;
        }

        $pdf->Output();
    }
}
