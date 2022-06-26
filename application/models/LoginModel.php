<?php

defined('BASEPATH') or exit('No direct script access allowed');

class LoginModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function check_user()
    {
        $query = $this->db->join('jabatan', 'jabatan.id_jabatan = pegawai.id_jabatan')
            ->join('role', 'role.id_role=jabatan.role')
            ->where('username', $this->input->post('username'))
            ->where('password', md5($this->input->post('password')))
            ->get('pegawai');

        if ($query->num_rows() > 0) {
            $data_pegawai = $query->row();
            $session = array(
                'logged_in' => true,
                'username' => $data_pegawai->username,
                'id_pegawai' => $data_pegawai->id_pegawai,
                'id_jabatan' => $data_pegawai->id_jabatan,
                'nama_pegawai' => $data_pegawai->nama_pegawai,
                'nama_jabatan' => $data_pegawai->nama_jabatan,
                'role' => $data_pegawai->nama_role
            );



            $this->session->set_userdata($session);
            return true;
        } else {
            return false;
        }
    }
}
