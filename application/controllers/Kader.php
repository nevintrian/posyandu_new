<?php

class Kader extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('html');
        $this->load->model('m_kader');
        $this->load->model('m_posyandu');
        $this->load->library('pagination');
        $this->load->library('upload');
        $this->load->library('cetak_pdf');
    }

    public function index()
    {
        $this->load->view('partials/v_sidebar');
        $config['total_rows'] = $this->m_kader->total_rows();
        $kader = $this->m_kader->get_limit_data();
        $posyandu = $this->m_posyandu->get_limit_data_asc();
        $this->pagination->initialize($config);
        $data = array(
            'kader_data' => $kader,
            'total_rows' => $config['total_rows'],
            'posyandu_data' => $posyandu
        );

        $this->load->view('v_kader', $data);
        $this->load->view('partials/v_footer');
    }

    public function posyandu($id)
    {
        $this->load->view('partials/v_sidebar');
        $config['total_rows'] = $this->m_kader->total_rows();
        $kader = $this->m_kader->get_limit_data_posyandu($id);
        $posyandu = $this->m_posyandu->get_limit_data_asc();
        $data = array(
            'kader_data' => $kader,
            'total_rows' => $config['total_rows'],
            'posyandu_data' => $posyandu
        );

        $this->load->view('v_kader', $data);
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
            'posyandu_id' => $this->input->post('posyandu_id'),
        );
        $this->m_kader->insert($data);
        redirect(site_url('kader'));
    }

    public function update()
    {
        $data = array(
            'nama' => $this->input->post('nama'),
            'email' => $this->input->post('email'),
            'alamat' => $this->input->post('alamat'),
            'telepon' => $this->input->post('telepon'),
            'posyandu_id' => $this->input->post('posyandu_id'),
        );
        if ($this->input->post('password')) {
            $data['password'] = md5($this->input->post('password'));
        }

        $this->m_kader->update($this->input->post('id'), $data);
        redirect(site_url('kader'));
    }

    public function delete()
    {
        $this->m_kader->delete($this->input->post('id'));
        redirect(site_url('kader'));
    }

    public function cetak_pdf($id)
    {
        $pdf = new FPDF('P', 'mm', array(265, 345));
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        if (is_numeric($id)) {
            $pdf->Cell(0, 7, "DATA KADER POSYANDU $id", 0, 1, 'C');
        } else {
            $pdf->Cell(0, 7, "DATA KADER SEMUA POSYANDU", 0, 1, 'C');
        }
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(8, 6, 'No', 1, 0, 'C');
        $pdf->Cell(50, 6, 'Email', 1, 0, 'C');
        $pdf->Cell(50, 6, 'Nama', 1, 0, 'C');
        $pdf->Cell(45, 6, 'Alamat', 1, 0, 'C');
        $pdf->Cell(45, 6, 'Telepon', 1, 0, 'C');
        $pdf->Cell(45, 6, 'Posyandu', 1, 1, 'C');
        $pdf->SetFont('Arial', '', 10);
        if (is_numeric($id)) {
            $barang = $this->db->query("SELECT kader.*, posyandu.nama as posyandu_nama FROM kader join posyandu on posyandu.id = kader.posyandu_id where posyandu.id = $id")->result();
        } else {
            $barang = $this->db->query("SELECT kader.*, posyandu.nama as posyandu_nama FROM kader join posyandu on posyandu.id = kader.posyandu_id")->result();
        }
        $no = 1;
        foreach ($barang as $data) {
            $pdf->Cell(8, 6, $no, 1, 0);
            $pdf->Cell(50, 6, $data->email, 1, 0);
            $pdf->Cell(50, 6, $data->nama, 1, 0);
            $pdf->Cell(45, 6, $data->alamat, 1, 0);
            $pdf->Cell(45, 6, $data->telepon, 1, 0);
            $pdf->Cell(45, 6, $data->posyandu_nama, 1, 1);
            $no++;
        }

        $pdf->Output();
    }
}
