<?php

class Laporan_model extends CI_Model
{
    public function crateLaporan($laporan)
    {
        $this->db->insert('laporan2', $laporan);
        return $this->db->affected_rows();
    }

    public function getLaporan()
    {
        return $this->db->get('laporan2')->result_array();
    }
}
