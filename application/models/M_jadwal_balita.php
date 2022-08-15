<?php

class M_jadwal_balita extends CI_Model
{
    public $table = 'jadwal_balita';
    public $id = 'jadwal_balita.id';
    public $order = 'DESC';

    public function total_rows()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function get_limit_data()
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->select('jadwal_balita.* , kegiatan.nama as kegiatan_nama, imunisasi_balita.nama as imunisasi_balita_nama, penyuluhan_balita.nama as penyuluhan_balita_nama, posyandu.nama as posyandu_nama, posyandu.alamat as posyandu_alamat');
        $this->db->join('kegiatan', 'jadwal_balita.kegiatan_id = kegiatan.id');
        $this->db->join('imunisasi_balita', 'jadwal_balita.imunisasi_balita_id = imunisasi_balita.id');
        $this->db->join('penyuluhan_balita', 'jadwal_balita.penyuluhan_balita_id = penyuluhan_balita.id');
        $this->db->join('posyandu', 'jadwal_balita.posyandu_id = posyandu.id');
        return $this->db->get($this->table)->result();
    }

    function get_limit_data_posyandu($id)
    {
        $this->db->select('jadwal_balita.* , kegiatan.nama as kegiatan_nama, imunisasi_balita.nama as imunisasi_balita_nama, penyuluhan_balita.nama as penyuluhan_balita_nama, posyandu.nama as posyandu_nama, posyandu.alamat as posyandu_alamat');
        $this->db->join('kegiatan', 'jadwal_balita.kegiatan_id = kegiatan.id');
        $this->db->join('imunisasi_balita', 'jadwal_balita.imunisasi_balita_id = imunisasi_balita.id');
        $this->db->join('penyuluhan_balita', 'jadwal_balita.penyuluhan_balita_id = penyuluhan_balita.id');
        $this->db->join('posyandu', 'jadwal_balita.posyandu_id = posyandu.id');
        $this->db->where('posyandu.id',  $id);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
}
