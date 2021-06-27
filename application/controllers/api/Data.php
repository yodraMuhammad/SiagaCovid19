<?php

setlocale(LC_TIME, 'id_ID.utf8');
defined('BASEPATH') or exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */

require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . '/libraries/Format.php';

// use namespace
use Restserver\Libraries\REST_Controller;

class Data extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Data_model', 'data');
        $this->load->model('Laporan_model', 'laporan');
    }

    public function index_get()
    {
        $nik = $this->get('nik');
        if ($nik === null) {
            $data = $this->data->getData();
        } else {
            $data = $this->data->getData($nik);
        }

        if ($data) {
            $this->response([
                'status' => true,
                'data' => $data,
            ], REST_Controller::HTTP_OK);
        } else {
            // Set the response and exit
            $this->response([
                'status' => FALSE,
                'message' => 'NIK TIDAK VALID'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function index_post()
    {
        $laporan = [
            'nik' => $this->post('nik'),
            'nama_pelapor' => strtoupper($this->post('nama_pelapor')),
            'nama_terduga' => strtoupper($this->post('nama_terduga')),
            'alamat' => strtoupper($this->post('alamat')),
            'gejala' => strtoupper($this->post('gejala')),
            'status' => 'DIPROSES',
            'date_created' => time()
        ];

        $nik = $laporan['nik'];
        $data = $this->data->getData($nik);

        $jadwal = time() + 60 * 60 * 10;
        $hari  = date('l, d F Y H:i', $jadwal);

        if (date('H', $jadwal) >= 20) {
            $petugas = ['John', 'Dimas', 'Kurnia', 'Sadam'];
        } elseif (date('H', $jadwal) >= 16) {
            $petugas = ['Hauzan', 'Alip', 'Daffa', 'Shidiq'];
        } elseif (date('H', $jadwal) >= 12) {
            $petugas = ['Dimas', 'Kurnia', 'Sadam'];
        } elseif (date('H', $jadwal) >= 8) {
            $petugas = ['Sena', 'Evam', 'Husain', 'Alea'];
        } elseif (date('H', $jadwal) >= 4) {
            $petugas = ['Hauzan', 'Alip', 'Daffa', 'Shidiq'];
        } elseif (date('H', $jadwal) >= 0) {
            $petugas = ['Sena', 'Evam', 'Husain'];
        }


        $users =
            [

                'nama' => $petugas,
                'jumlah' => count($petugas),
                'waktu2' => $hari
            ];


        if ($data) {
            if ($this->laporan->crateLaporan($laporan) > 0) {
                $this->response([
                    'status' => true,
                    'message' => 'New data has been created',
                    'Penjemputan' => $users
                ], REST_Controller::HTTP_CREATED);
            } else {
                $this->response([
                    'status' => FALSE,
                    'message' => 'failed to created new data'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'NIK TIDAK VALID'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
