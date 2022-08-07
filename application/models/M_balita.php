<?php

class M_balita extends CI_Model
{
    public $table = 'balita';
    public $id = 'balita.id';
    public $order = 'DESC';

    public function total_rows()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function total_rows_kader()
    {
        $this->db->from($this->table);
        $this->db->where('posyandu_id',  $this->session->userdata('posyandu_id'));
        return $this->db->count_all_results();
    }

    function get_limit_data()
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->select('balita.* , posyandu.nama as posyandu_nama');
        $this->db->join('posyandu', 'balita.posyandu_id = posyandu.id');
        return $this->db->get($this->table)->result();
    }

    function get_limit_data_kader()
    {
        $this->db->select('balita.* , posyandu.nama as posyandu_nama');
        $this->db->join('posyandu', 'balita.posyandu_id = posyandu.id');
        $this->db->where('posyandu.id',  $this->session->userdata('posyandu_id'));
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    function get_limit_data_posyandu($id)
    {
        $this->db->select('balita.* , posyandu.nama as posyandu_nama');
        $this->db->join('posyandu', 'balita.posyandu_id = posyandu.id');
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
