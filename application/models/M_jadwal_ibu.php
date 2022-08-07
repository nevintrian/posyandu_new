<?php

class M_jadwal_ibu extends CI_Model
{
    public $table = 'jadwal_ibu';
    public $id = 'id';
    public $order = 'DESC';

    public function total_rows()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function get_limit_data()
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->select('jadwal_ibu.* , kegiatan.nama as kegiatan_nama, imunisasi_ibu.nama as imunisasi_ibu_nama, penyuluhan_ibu.nama as penyuluhan_ibu_nama, posyandu.nama as posyandu_nama');
        $this->db->join('kegiatan', 'jadwal_ibu.kegiatan_id = kegiatan.id');
        $this->db->join('imunisasi_ibu', 'jadwal_ibu.imunisasi_ibu_id = imunisasi_ibu.id');
        $this->db->join('penyuluhan_ibu', 'jadwal_ibu.penyuluhan_ibu_id = penyuluhan_ibu.id');
        $this->db->join('posyandu', 'jadwal_ibu.posyandu_id = posyandu.id');
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
