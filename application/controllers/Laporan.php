<?php

use PhpParser\Node\Stmt\Echo_;

defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Data_model', 'data');
        $this->load->model('Laporan_model', 'laporan');
    }

    public function index()
    {
        $data['laporan'] = $this->laporan->getLaporan();

        $this->load->view('laporan', $data);
    }

    public function edit($id)
    {

        $data = [
            'nik' => $this->input->post('nik'),
            'nama_pelapor' => $this->input->post('nama_pelapor'),
            'nama_terduga' => $this->input->post('nama_terduga'),
            'alamat' => $this->input->post('alamat'),
            'gejala' => $this->input->post('gejala'),
            'status' => $this->input->post('status'),
            'date_created' => $this->input->post('date_created'),
        ];

        $this->db->where('id', $id);
        $this->db->update('laporan2', $data);

        redirect('laporan');
    }
}
