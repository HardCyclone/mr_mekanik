<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // $this->isLoggedIn();
        // $this->load->model('Transaksi_model');        
    }

    public function index()
    {        
        // $data['semua_pekerjaan'] = $this->Transaksi_model->daftar_terbit_masalah()->num_rows();
        // $data['buffered_pekerjaan'] = $this->Transaksi_model->daftar_buffer_masalah()->num_rows();
        // $data['pekerjaan_completed'] = $this->Transaksi_model->jumlah_permintaan_by_status("completed")->num_rows();
        // $data['pekerjaan_on_going'] = $this->Transaksi_model->jumlah_permintaan_by_status("assigned")->num_rows();
        $this->load->template('dashboard');
    }

    public function dashboard_on_going()
    {                
        $data['detail_pengerjaan'] = $this->Transaksi_model->jumlah_permintaan_by_status("assigned")->result();
        $this->load->template('detail_pengerjaan_semua', $data);
    }

    public function dashboard_completed()
    {                
        $data['detail_pengerjaan'] = $this->Transaksi_model->jumlah_permintaan_by_status("completed")->result();
        $this->load->template('detail_pengerjaan_semua', $data);
    }
}
