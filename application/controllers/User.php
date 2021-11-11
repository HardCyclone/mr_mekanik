<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();        
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->isLoggedAdminIn();
        $data['daftar_user'] = $this->User_model->daftar_user()->result();
        $this->load->template('daftar_user', $data);
    }

    public function login()
    {
        $this->load->view('login');
    }

    // CONTROLLER TAMBAH USER BARU
    public function tambah_user()
    {
        $nama = $this->input->post('nama_lengkap');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $role = $this->input->post('role');
        $jenis = $this->input->post('jenis');

        $data = array(
            'nama_lengkap' => $nama,
            'username' => $username,
            'password' => md5($password),
            'role' => $role,
            'jenis' => $jenis,
            'create_by' => 1
        );

        $where = array(
            'username' => $username
        );

        $result = $this->User_model->checkUser($where);

        if ($result) {
            echo $this->session->set_flashdata('error', 'Username telah terpakai');
            redirect(base_url('User'));
        } else {
            $result2 = $this->User_model->input_user($data);
            if ($result2) {
                $this->session->set_flashdata('error', 'Data gagal disimpan');
                redirect(base_url('user'));
            } else {
                $this->session->set_flashdata('success', 'User Berhasil Ditambahkan');
                redirect(base_url('user'));
            }
        }
    }

    public function edit_user()
    {
        $id = $this->input->post('id_user');
        $nama_lengkap = $this->input->post('nama_lengkap');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $role = $this->input->post('role');
        $jenis = $this->input->post('jenis');

        if ($password == null) {
            $data = array(
                'nama_lengkap' => $nama_lengkap,
                'username' => $username,
                'role' => $role,
                'jenis' => $jenis,
                'update_by' => 1
            );
        } else {
            $data = array(
                'nama_lengkap' => $nama_lengkap,
                'username' => $username,
                'role' => $role,
                'jenis' => $jenis,                
                'password' => md5($password),
                'update_by' => 1
            );
        }
        $result2 = $this->User_model->edit_user($id, $data);

        if ($result2) {
            $this->session->set_flashdata('error', 'Data gagal diupdate');
            redirect(base_url('user'));
        } else {
            $this->session->set_flashdata('success', 'User Berhasil Diupdate');
            redirect(base_url('user'));
        }
    }

    // CONTROLLER MENGHAPUS USER
    public function hapus_user($id)
    {

        if($this->session->userdata('id') === $id){
            $this->session->set_flashdata('error', 'User ini tidak boleh dihapus karena sedang aktif');
            redirect(base_url('user'));
        }else{
            $data = array(
                'id' => $id,
            );
    
            $result2 = $this->User_model->hapusUser($data);
    
    
            if ($result2) {
                $this->session->set_flashdata('error', 'Data gagal dihapus');
                redirect(base_url('user'));
            } else {
                $this->session->set_flashdata('success', 'User Berhasil Dihapus');
                redirect(base_url('user'));
            }
        }        
    }

    public function autentikasi()
    {
        $this->form_validation->set_rules('email', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        $email = $this->input->post('email');
        $password = $this->input->post('password');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'Username / Password belum diisi');
            redirect('login');
        } else {            
            // $where = array(
            //     'username' => $username,
            //     'password' => md5($password)
            // );
            // $cek = $this->User_model->cek_login($where)->num_rows();
            // if ($cek > 0) {
            //     $result = $this->User_model->cek_login($where)->result();

            //     $data_session = array(
            //         'role' => $result[0]->role,
            //         'id' => $result[0]->id,
            //         'nama_admin' => $result[0]->nama_lengkap,                                        
            //         'jenis' => $result[0]->jenis
            //     );                

            //     $this->session->set_userdata($data_session);

            //     redirect(base_url());
            // } else {
            //     $this->session->set_flashdata('error', 'Username atau password salah !');
            //     redirect(base_url('login'));
            // }

            redirect(base_url());
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }

    public function access_denied()
    {        
        $this->load->template('access_denied');
    }
}
