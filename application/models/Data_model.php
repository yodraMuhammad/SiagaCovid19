<?php

class Data_model extends CI_Model
{
    public function getData($nik = null)
    {
        if ($nik === null) {
            return $this->db->get('data')->result_array();
        } else {
            return $this->db->get_where('data', ['nik' => $nik])->result_array();
        }
    }
}
