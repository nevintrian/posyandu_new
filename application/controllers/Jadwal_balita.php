<?php

class Jadwal_balita extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('html');
        $this->load->model('m_jadwal_balita');
        $this->load->model('m_kegiatan');
        $this->load->model('m_penyuluhan_balita');
        $this->load->model('m_imunisasi_balita');
        $this->load->model('m_posyandu');
        $this->load->model('m_pesan');
        $this->load->model('m_balita');
        $this->load->library('pagination');
        $this->load->library('upload');
        $this->load->helper('tgl_indo');
    }


    public function index()
    {
        $this->load->view('partials/v_sidebar');
        $config['total_rows'] = $this->m_jadwal_balita->total_rows();
        $jadwal_balita = $this->m_jadwal_balita->get_limit_data();
        $kegiatan = $this->m_kegiatan->get_limit_data();
        $imunisasi_balita = $this->m_imunisasi_balita->get_limit_data();
        $penyuluhan_balita = $this->m_penyuluhan_balita->get_limit_data();
        $posyandu = $this->m_posyandu->get_limit_data();

        $this->pagination->initialize($config);
        $data = array(
            'jadwal_balita_data' => $jadwal_balita,
            'kegiatan_data' => $kegiatan,
            'imunisasi_balita_data' => $imunisasi_balita,
            'penyuluhan_balita_data' => $penyuluhan_balita,
            'posyandu_data' => $posyandu,
            'total_rows' => $config['total_rows'],
        );

        $this->load->view('v_jadwal_balita', $data);
        $this->load->view('partials/v_footer');
    }

    public function save()
    {
        $data = array(
            'jadwal' => $this->input->post('jadwal'),
            'kegiatan_id' => $this->input->post('kegiatan_id'),
            'imunisasi_balita_id' => $this->input->post('imunisasi_balita_id'),
            'penyuluhan_balita_id' => $this->input->post('penyuluhan_balita_id'),
            'posyandu_id' => $this->input->post('posyandu_id'),
        );
        $this->m_jadwal_balita->insert($data);
        redirect(site_url('jadwal_balita'));
    }

    public function update()
    {
        $data = array(
            'jadwal' => $this->input->post('jadwal'),
            'kegiatan_id' => $this->input->post('kegiatan_id'),
            'imunisasi_balita_id' => $this->input->post('imunisasi_balita_id'),
            'penyuluhan_balita_id' => $this->input->post('penyuluhan_balita_id'),
            'posyandu_id' => $this->input->post('posyandu_id'),
        );

        $this->m_jadwal_balita->update($this->input->post('id'), $data);
        redirect(site_url('jadwal_balita'));
    }

    public function delete()
    {
        $this->m_jadwal_balita->delete($this->input->post('id'));
        redirect(site_url('jadwal_balita'));
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
        $imunisasi_balita_nama = $this->input->post('imunisasi_balita_nama');
        $penyuluhan_balita_nama = $this->input->post('penyuluhan_balita_nama');
        $posyandu_nama = $this->input->post('posyandu_nama');
        $posyandu_alamat = $this->input->post('posyandu_alamat');
        $posyandu_id = $this->input->post('posyandu_id');
        $balita_data = $this->m_balita->get_limit_data_posyandu($posyandu_id);

        $date = new DateTime($jadwal);

        $day = longdate_indo($date->format('d-m-Y'));
        $str_arr = explode(",", $day);
        $new_day = $str_arr[0];
        $new_date = $date->format('d-m-Y');
        $new_time = $date->format('H:i');

        foreach ($balita_data as $balita) {
            $telepon = $this->convert_telepon($balita->telepon);

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
                            "text": "$imunisasi_balita_nama"
                        },
                        {
                            "type": "text",
                            "text": "$penyuluhan_balita_nama"
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
            var_dump($resp);
        }

        $this->updateDB();
        redirect(site_url('jadwal_balita'));
    }

    public function updateDB()
    {
        $data = array(
            'status' => 1,
        );

        $this->m_jadwal_balita->update($this->input->post('id'), $data);


        $data1 = array(
            'waktu' => date("Y-m-d H:i:s"),
            'posyandu_id' => $this->input->post('posyandu_id'),
            'status' => 'Berhasil',
        );
        $this->m_pesan->insert($data1);
    }
}
