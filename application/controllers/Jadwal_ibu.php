<?php

class Jadwal_ibu extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('html');
        $this->load->model('m_jadwal_ibu');
        $this->load->model('m_kegiatan');
        $this->load->model('m_penyuluhan_ibu');
        $this->load->model('m_imunisasi_ibu');
        $this->load->model('m_posyandu');
        $this->load->model('m_pesan');
        $this->load->model('m_ibu');
        $this->load->library('pagination');
        $this->load->library('upload');
        $this->load->helper('tgl_indo');
        $this->load->library('cetak_pdf');
    }


    public function index()
    {
        $this->load->view('partials/v_sidebar');
        $config['total_rows'] = $this->m_jadwal_ibu->total_rows();
        if ($this->session->userdata('level') == 'kader') {
            $jadwal_ibu = $this->m_jadwal_ibu->get_limit_data_kader();
        } else {
            $jadwal_ibu = $this->m_jadwal_ibu->get_limit_data();
        }
        $kegiatan = $this->m_kegiatan->get_limit_data();
        $imunisasi_ibu = $this->m_imunisasi_ibu->get_limit_data();
        $penyuluhan_ibu = $this->m_penyuluhan_ibu->get_limit_data();
        $posyandu = $this->m_posyandu->get_limit_data_asc();
        $this->pagination->initialize($config);
        $data = array(
            'jadwal_ibu_data' => $jadwal_ibu,
            'kegiatan_data' => $kegiatan,
            'imunisasi_ibu_data' => $imunisasi_ibu,
            'penyuluhan_ibu_data' => $penyuluhan_ibu,
            'posyandu_data' => $posyandu,
            'total_rows' => $config['total_rows'],
        );

        $this->load->view('v_jadwal_ibu', $data);
        $this->load->view('partials/v_footer');
    }

    public function posyandu($id)
    {
        $this->load->view('partials/v_sidebar');
        $config['total_rows'] = $this->m_jadwal_ibu->total_rows();
        $jadwal_ibu = $this->m_jadwal_ibu->get_limit_data_posyandu($id);
        $kegiatan = $this->m_kegiatan->get_limit_data();
        $imunisasi_ibu = $this->m_imunisasi_ibu->get_limit_data();
        $penyuluhan_ibu = $this->m_penyuluhan_ibu->get_limit_data();
        $posyandu = $this->m_posyandu->get_limit_data_asc();
        $data = array(
            'jadwal_ibu_data' => $jadwal_ibu,
            'kegiatan_data' => $kegiatan,
            'imunisasi_ibu_data' => $imunisasi_ibu,
            'penyuluhan_ibu_data' => $penyuluhan_ibu,
            'posyandu_data' => $posyandu,
            'total_rows' => $config['total_rows'],
        );

        $this->load->view('v_jadwal_ibu', $data);
        $this->load->view('partials/v_footer');
    }

    public function save()
    {
        $data = array(
            'jadwal' => $this->input->post('jadwal'),
            'kegiatan_id' => $this->input->post('kegiatan_id'),
            'imunisasi_ibu_id' => $this->input->post('imunisasi_ibu_id'),
            'penyuluhan_ibu_id' => $this->input->post('penyuluhan_ibu_id'),
            'posyandu_id' => $this->input->post('posyandu_id'),
        );
        $this->m_jadwal_ibu->insert($data);
        redirect(site_url('jadwal_ibu'));
    }

    public function update()
    {
        $data = array(
            'jadwal' => $this->input->post('jadwal'),
            'kegiatan_id' => $this->input->post('kegiatan_id'),
            'imunisasi_ibu_id' => $this->input->post('imunisasi_ibu_id'),
            'penyuluhan_ibu_id' => $this->input->post('penyuluhan_ibu_id'),
            'posyandu_id' => $this->input->post('posyandu_id'),
        );

        $this->m_jadwal_ibu->update($this->input->post('id'), $data);
        redirect(site_url('jadwal_ibu'));
    }

    public function delete()
    {
        $this->m_jadwal_ibu->delete($this->input->post('id'));
        redirect(site_url('jadwal_ibu'));
    }



    public function convert_telepon($nohp)
    {
        $nohp = str_replace(" ", "", $nohp);
        $nohp = str_replace("(", "", $nohp);
        $nohp = str_replace(")", "", $nohp);
        $nohp = str_replace(".", "", $nohp);

        if (!preg_match('/[^+0-9]/', trim($nohp))) {
            if (substr(trim($nohp), 0, 3) == '62') {
                $hp = trim($nohp);
            } elseif (substr(trim($nohp), 0, 1) == '0') {
                $hp = '62' . substr(trim($nohp), 1);
            }
        }
        return $hp;
    }

    function send_whatsapp()
    {
        $jadwal = $this->input->post('jadwal');
        $kegiatan_nama = $this->input->post('kegiatan_nama');
        $imunisasi_ibu_nama = $this->input->post('imunisasi_ibu_nama');
        $penyuluhan_ibu_nama = $this->input->post('penyuluhan_ibu_nama');
        $posyandu_nama = $this->input->post('posyandu_nama');
        $posyandu_alamat = $this->input->post('posyandu_alamat');
        $posyandu_id = $this->input->post('posyandu_id');
        $ibu_data = $this->m_ibu->get_limit_data_posyandu($posyandu_id);

        $date = new DateTime($jadwal);

        $day = longdate_indo($date->format('d-m-Y'));
        $str_arr = explode(",", $day);
        $new_day = $str_arr[0];
        $new_date = $date->format('d-m-Y');
        $new_time = $date->format('H:i');

        $telepon_array = [];
        foreach ($ibu_data as $ibu) {
            array_push($telepon_array, $ibu->telepon);
        }
        $telepon_unique = array_unique($telepon_array);

        foreach ($telepon_unique as $telepon) {
            $telepon = $this->convert_telepon($telepon);

            $url = "https://graph.facebook.com/v13.0/110056228476958/messages";

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $headers = array(
                "Accept: application/json",
                "Authorization: Bearer EAAYIhixngCoBALihDjgo2dun7fv1O0mXUlb0SdCdNmWcL8o8irsMK7dE4a3cobZAfmG1wCto3FzjAyE8ZAqHR2pA2x8492wR2t8uhN5AX86ZBd3EvBcxouzDWRJ04l5sf4WyWVFZCnd9u9k8T1hEIlobifY8Q5ZC6wF6DfQp3BfZCV3jb2GQ3P",
                "Content-Type: application/json",
            );
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

            $data = <<<DATA
            { 
                "messaging_product": "whatsapp", 
                "to": "$telepon", 
                "type": "template", 
                "template": { "name": "sipadu", 
                "language": { "code": "id" },
                "components": [{
                    "type" : "body",
                    "parameters": [
                        {
                            "type": "text",
                            "text": "$new_day"
                        },
                        {
                            "type": "text",
                            "text": "$new_date"
                        },
                        {
                            "type": "text",
                            "text": "$new_time"
                        },
                        {
                            "type": "text",
                            "text": "$kegiatan_nama"
                        },
                        {
                            "type": "text",
                            "text": "$imunisasi_ibu_nama"
                        },
                        {
                            "type": "text",
                            "text": "$penyuluhan_ibu_nama"
                        },
                        {
                            "type": "text",
                            "text": "$posyandu_nama"
                        },
                        {
                            "type": "text",
                            "text": "$posyandu_alamat"
                        }
                    ]}
                ]}
            }
            DATA;

            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

            //for debug only!
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

            $resp = curl_exec($curl);
            curl_close($curl);
            $hasil = json_decode($resp, true)['error']['message'] ?? 'Berhasil';
        }

        $this->updateDB($hasil);
        redirect(site_url('jadwal_ibu'));
    }

    public function updateDB($hasil)
    {
        $hasil == 'Berhasil' ? $hasil = 1 : $hasil = 0;
        $data = array(
            'status' => 1,
        );

        $this->m_jadwal_ibu->update($this->input->post('id'), $data);


        $data1 = array(
            'waktu' => date("Y-m-d G:i:s"),
            'posyandu_id' => $this->input->post('posyandu_id'),
            'status' => $hasil,
        );
        $this->m_pesan->insert($data1);
    }

    public function cetak_pdf($id)
    {
        $pdf = new FPDF('P', 'mm', array(265, 345));
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        if (is_numeric($id)) {
            $pdf->Cell(0, 7, "DATA JADWAL IBU HAMIL POSYANDU $id", 0, 1, 'C');
        } else {
            $pdf->Cell(0, 7, "DATA JADWAL IBU HAMIL SEMUA POSYANDU", 0, 1, 'C');
        }
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(8, 6, 'No', 1, 0, 'C');
        $pdf->Cell(45, 6, 'Jadwal Kegiatan', 1, 0, 'C');
        $pdf->Cell(45, 6, 'Nama Kegiatan', 1, 0, 'C');
        $pdf->Cell(50, 6, 'Nama Imunisasi', 1, 0, 'C');
        $pdf->Cell(50, 6, 'Nama Penyuluhan', 1, 0, 'C');
        $pdf->Cell(45, 6, 'Nama Posyandu', 1, 1, 'C');
        $pdf->SetFont('Arial', '', 10);
        if (is_numeric($id)) {
            $barang = $this->db->query("SELECT jadwal_ibu.*, kegiatan.nama as kegiatan_nama, penyuluhan_ibu.nama as penyuluhan_ibu_nama, imunisasi_ibu.nama as imunisasi_ibu_nama, posyandu.nama as posyandu_nama FROM jadwal_ibu join kegiatan on kegiatan.id = jadwal_ibu.kegiatan_id join penyuluhan_ibu on penyuluhan_ibu.id = jadwal_ibu.penyuluhan_ibu_id join imunisasi_ibu on imunisasi_ibu.id = jadwal_ibu.imunisasi_ibu_id join posyandu on jadwal_ibu.posyandu_id = posyandu.id where posyandu.id = $id")->result();
        } else {
            $barang = $this->db->query("SELECT jadwal_ibu.*, kegiatan.nama as kegiatan_nama, penyuluhan_ibu.nama as penyuluhan_ibu_nama, imunisasi_ibu.nama as imunisasi_ibu_nama, posyandu.nama as posyandu_nama FROM jadwal_ibu join kegiatan on kegiatan.id = jadwal_ibu.kegiatan_id join penyuluhan_ibu on penyuluhan_ibu.id = jadwal_ibu.penyuluhan_ibu_id join imunisasi_ibu on imunisasi_ibu.id = jadwal_ibu.imunisasi_ibu_id join posyandu on jadwal_ibu.posyandu_id = posyandu.id")->result();
        }
        $no = 1;
        foreach ($barang as $data) {
            $pdf->Cell(8, 6, $no, 1, 0);
            $pdf->Cell(45, 6, $data->jadwal, 1, 0);
            $pdf->Cell(45, 6, $data->kegiatan_nama, 1, 0);
            $pdf->Cell(50, 6, $data->imunisasi_ibu_nama, 1, 0);
            $pdf->Cell(50, 6, $data->penyuluhan_ibu_nama, 1, 0);
            $pdf->Cell(45, 6, $data->posyandu_nama, 1, 1);
            $no++;
        }

        $pdf->Output();
    }
}
