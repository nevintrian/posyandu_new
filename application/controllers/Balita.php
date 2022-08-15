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
        $this->load->library('cetak_pdf');
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

    public function cetak_pdf($id)
    {
        $pdf = new FPDF('L', 'mm', array(560, 350));
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        if (is_numeric($id)) {
            $pdf->Cell(0, 7, "DATA BALITA POSYANDU $id", 0, 1, 'C');
        } else {
            $pdf->Cell(0, 7, "DATA BALITA SEMUA POSYANDU", 0, 1, 'C');
        }
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(8, 6, 'No', 1, 0, 'C');
        $pdf->Cell(45, 6, 'Nama', 1, 0, 'C');
        $pdf->Cell(45, 6, 'Tanggal Lahir', 1, 0, 'C');
        $pdf->Cell(45, 6, 'Tanggal Ukur', 1, 0, 'C');
        $pdf->Cell(20, 6, 'Umur', 1, 0, 'C');
        $pdf->Cell(45, 6, 'Tinggi Badan', 1, 0, 'C');
        $pdf->Cell(45, 6, 'Berat Badan', 1, 0, 'C');
        $pdf->Cell(45, 6, 'Lingkar Kepala', 1, 0, 'C');
        $pdf->Cell(30, 6, 'Vitamin A', 1, 0, 'C');
        $pdf->Cell(30, 6, 'Obat Cacing', 1, 0, 'C');
        $pdf->Cell(45, 6, 'Orangtua', 1, 0, 'C');
        $pdf->Cell(45, 6, 'Telepon', 1, 0, 'C');
        $pdf->Cell(45, 6, 'Alamat', 1, 0, 'C');
        $pdf->Cell(45, 6, 'Posyandu', 1, 1, 'C');
        $pdf->SetFont('Arial', '', 10);
        if (is_numeric($id)) {
            $barang = $this->db->query("SELECT balita.*, posyandu.nama as posyandu_nama FROM balita join posyandu on posyandu.id = balita.posyandu_id where posyandu.id = $id")->result();
        } else {
            $barang = $this->db->query("SELECT balita.*, posyandu.nama as posyandu_nama FROM balita join posyandu on posyandu.id = balita.posyandu_id")->result();
        }
        $no = 1;
        foreach ($barang as $data) {
            $pdf->Cell(8, 6, $no, 1, 0);
            $pdf->Cell(45, 6, $data->nama, 1, 0);
            $pdf->Cell(45, 6, $data->tanggal_lahir, 1, 0);
            $pdf->Cell(45, 6, $data->tanggal_ukur, 1, 0);
            $pdf->Cell(20, 6, $data->umur, 1, 0);
            $pdf->Cell(45, 6, $data->tinggi_badan, 1, 0);
            $pdf->Cell(45, 6, $data->berat_badan, 1, 0);
            $pdf->Cell(45, 6, $data->lingkar_kepala, 1, 0);
            $pdf->Cell(30, 6, $data->vitamin_a == 1 ? 'Sudah' : 'Belum', 1, 0);
            $pdf->Cell(30, 6, $data->obat_cacing == 1 ? 'Sudah' : 'Belum', 1, 0);
            $pdf->Cell(45, 6, $data->orangtua, 1, 0);
            $pdf->Cell(45, 6, $data->telepon, 1, 0);
            $pdf->Cell(45, 6, $data->alamat, 1, 0);
            $pdf->Cell(45, 6, $data->posyandu_nama, 1, 1);
            $no++;
        }

        $pdf->Output();
    }
}
