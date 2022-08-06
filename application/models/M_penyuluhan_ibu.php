<?php

class M_penyuluhan_ibu extends CI_Model
{
    public $table = 'penyuluhan_ibu';
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
