<?php


defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property  HomeModel $HomeModel
 */
class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('HomeModel');
    }

    public function checkLogin()
    {
        if ($this->session->userdata('logged_in') != true) redirect('login');

        return true;
    }

    public function checkRole($role)
    {
        if ($this->session->userdata('role') !== $role) return false;

        return true;
    }

    public function checkUser($role)
    {
        $this->checkLogin();

        if (!$this->checkRole($role)) redirect('/');

        return true;
    }

    public function index()
    {
        $this->checkLogin();
        $data['judul'] = 'Welcome, ' . $this->session->userdata('nama_pegawai') . '!';
        if ($this->checkRole('ADMIN')) {
            $data['jumlah_surat'] = $this->HomeModel->get_jumlah_surat();
            $data['main_view'] = 'admin/dashboard';
        }
        if ($this->checkRole('KEAMANAN')) {
            $data['jumlah_surat'] = $this->HomeModel->get_jumlah_surat();
            $data['main_view'] = 'keamanan/dashboard';
        }
        if ($this->checkRole('PENGAWAS')) {
            $data['jumlah_surat'] = $this->HomeModel->get_jumlah_surat();
            $data['main_view'] = 'pengawas/dashboard';
        }
        if ($this->checkRole('KOORDINATOR')) {
            $data['jumlah_disposisi'] = $this->HomeModel->get_jumlah_disposisi();
            $data['jumlah_surat'] = $this->HomeModel->get_jumlah_surat();
            $data['main_view'] = 'pegawai/dashboard';
        }
        return $this->load->view('template', $data);
    }

    public function surat_masuk()
    {
        $this->checkLogin();
        $data['judul'] = 'Surat Masuk';
        $data['data_surat_masuk'] = $this->HomeModel->get_surat_masuk();
        if ($this->checkRole('ADMIN')) {
            $data['main_view'] = 'admin/surat_masuk';
        }
        if ($this->checkRole('PENGAWAS')) {
            $data['main_view'] = 'pengawas/surat_masuk';
        }
        $this->load->view('template', $data);
    }

    public function surat_keluar()
    {
        $this->checkLogin();
        $data['judul'] = 'Surat Keluar';
        $data['data_surat_keluar'] = $this->HomeModel->get_surat_keluar();

        if ($this->checkRole('ADMIN')) {
            $data['main_view'] = 'admin/surat_keluar';
        }
        if ($this->checkRole('PENGAWAS')) {
            $data['main_view'] = 'pengawas/surat_keluar';
        }
        $this->load->view('template', $data);
    }

    public function surat_keputusan()
    {
        $this->checkLogin();
        $data['judul'] = 'Surat Keputusan';
        $data['data_surat_keputusan'] = $this->HomeModel->get_surat_keputusan();
        $data['drop_down_jabatan'] = $this->HomeModel->get_jabatan();

        if ($this->checkRole('ADMIN')) {
            $data['main_view'] = 'admin/surat_keputusan';
        }
        if ($this->checkRole('PENGAWAS')) {
            $data['main_view'] = 'pengawas/surat_keputusan';
        }
        if ($this->checkRole('KOORDINATOR')) {
            $data['main_view'] = 'pegawai/surat_keputusan';
        }
        $this->load->view('template', $data);
    }



    public function pegawai()
    {
        $this->checkLogin();
        $data['judul'] = 'Pegawai';
        $data['data_pegawai'] = $this->HomeModel->get_pegawai();
        $data['drop_down_jabatan'] = $this->HomeModel->get_jabatan();
        if ($this->checkRole('ADMIN')) {
            $data['main_view'] = 'admin/pegawai';
        }
        if ($this->checkRole('PENGAWAS')) {
            $data['main_view'] = 'pengawas/pegawai';
        }

        $this->load->view('template', $data);
    }

    public function jabatan()
    {
        $this->checkLogin();
        $data['judul'] = 'Daftar Jabatan';
        $data['data_jabatan'] = $this->HomeModel->get_jabatan();
        $data['drop_down_role'] = $this->HomeModel->get_role();
        if ($this->checkRole('ADMIN')) {
            $data['main_view'] = 'admin/jabatan';
        }
        if ($this->checkRole('PENGAWAS')) {
            $data['main_view'] = 'pengawas/jabatan';
        }

        $this->load->view('template', $data);
    }

    public function tamu()
    {
        $this->checkLogin();
        $data['judul'] = 'Daftar Tamu';
        $data['data_tamu'] = $this->HomeModel->get_tamu();
        if ($this->checkRole('ADMIN')) {
            $data['main_view'] = 'keamanan/tamu';
        }
        if ($this->checkRole('PENGAWAS')) {
            $data['main_view'] = 'pengawas/tamu';
        }
        if ($this->checkRole('KEAMANAN')) {
            $data['main_view'] = 'keamanan/tamu';
        }
        $this->load->view('template', $data);
    }

    public function disposisi_selesai($id_surat)
    {
        if ($this->session->userdata('logged_in') == true) {
            if ($this->session->userdata('role') == 'ADMIN') {
                if ($this->HomeModel->disposisi_selesai($id_surat) == true) {
                    $this->session->set_flashdata('notif', 'Disposisi surat ini telah selesai!');
                    redirect('home/disposisi/' . $id_surat);
                } else {
                    $this->session->set_flashdata('notif', 'Gagal update status disposisi!');
                    redirect('home/disposisi/' . $id_surat);
                }
            } else {
                redirect('logout');
            }
        } else {
            redirect('login');
        }
    }

    public function disposisi($id_surat)
    {
        if ($this->session->userdata('logged_in') == true) {
            if ($this->session->userdata('role') == 'ADMIN') {
                $data['judul'] = 'Disposisi Surat';
                $data['main_view'] = 'admin/disposisi';
                $data['data_surat'] = $this->HomeModel->get_surat_masuk_by_id($id_surat);
                $data['drop_down_jabatan_koordinator'] = $this->HomeModel->get_jabatan_koordinator();
                $data['drop_down_pegawai_koordinator'] = $this->HomeModel->get_pegawai_koordinator();
                $data['data_disposisi'] = $this->HomeModel->get_disposisi($id_surat);
                $this->load->view('template', $data);
            } else {
                redirect('logout');
            }
        } else {
            redirect('login');
        }
    }

    // public function disposisi_keluar()
    // {
    //     if ($this->session->userdata('logged_in') == true) {
    //         $data['judul'] = 'Disposisi Keluar';
    //         $data['main_view'] = 'pegawai/disposisi_keluar';
    //         $data['data_disposisi_keluar'] = $this->HomeModel->get_all_disposisi_keluar();
    //         $this->load->view('template', $data);
    //     } else {
    //         redirect('login');
    //     }
    // }

    public function disposisi_masuk()
    {
        if ($this->session->userdata('logged_in') == true) {
            $data['judul'] = 'Disposisi Masuk';
            $data['main_view'] = 'pegawai/disposisi_masuk';
            $data['data_disposisi_masuk'] = $this->HomeModel->get_disposisi_masuk($this->session->userdata('id_pegawai'));
            $this->load->view('template', $data);
        } else {
            redirect('login');
        }
    }

    public function disposisi_keluar_pegawai($id_surat)
    {
        if ($this->session->userdata('logged_in') == true) {
            $data['judul'] = 'Disposisi Keluar';
            $data['main_view'] = 'pegawai/disposisi_keluar';
            $data['data_surat'] = $this->HomeModel->get_surat_masuk_by_id($id_surat);
            $data['data_disposisi_keluar'] = $this->HomeModel->get_disposisi_keluar($id_surat);
            $data['drop_down_jabatan'] = $this->HomeModel->get_jabatan();
            $this->load->view('template', $data);
        } else {
            redirect('login');
        }
    }

    public function tambah_disposisi($id_surat)
    {
        if ($this->session->userdata('logged_in') == true) {
            if ($this->session->userdata('role') == 'ADMIN') {
                $this->form_validation->set_rules('tujuan_unit', 'Tujuan Unit', 'trim|required');
                $this->form_validation->set_rules('tujuan_pegawai', 'Tujuan Pegawai', 'trim|required');
                $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');

                if ($this->form_validation->run() == true) {
                    if ($this->HomeModel->tambah_disposisi($id_surat) == true) {
                        $this->session->set_flashdata('notif', 'Tambah disposisi surat berhasil!');
                        redirect('home/disposisi/' . $id_surat);
                    } else {
                        $this->session->set_flashdata('notif', 'Tambah disposisi surat gagal!');
                        redirect('home/disposisi/' . $id_surat);
                    }
                } else {
                    $this->session->set_flashdata('notif', validation_errors());
                    redirect('home/disposisi/' . $id_surat);
                }
            } else {
                redirect('logout');
            }
        } else {
            redirect('login');
        }
    }

    public function tambah_disposisi_pegawai($id_surat)
    {
        if ($this->session->userdata('logged_in') == true) {
            $this->form_validation->set_rules('tujuan_unit', 'Tujuan Unit', 'trim|required');
            $this->form_validation->set_rules('tujuan_pegawai', 'Tujuan Pegawai', 'trim|required');
            $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');

            if ($this->form_validation->run() == true) {
                if ($this->HomeModel->tambah_disposisi($id_surat) == true) {
                    $this->session->set_flashdata('notif', 'Tambah disposisi surat berhasil!');
                    redirect('home/disposisi_keluar_pegawai/' . $id_surat);
                } else {
                    $this->session->set_flashdata('notif', 'Tambah disposisi surat gagal!');
                    redirect('home/disposisi_keluar_pegawai/' . $id_surat);
                }
            } else {
                $this->session->set_flashdata('notif', validation_errors());
                redirect('home/disposisi_keluar_pegawai/' . $id_surat);
            }
        } else {
            redirect('login');
        }
    }

    public function tambah_surat_keluar()
    {
        if ($this->session->userdata('logged_in') == true) {
            if ($this->session->userdata('role') == 'ADMIN') {
                $this->form_validation->set_rules('nomor_surat', 'Nomor Surat', 'trim|required');
                $this->form_validation->set_rules('tgl_kirim', 'Tanggal Kirim', 'trim|required|date');
                $this->form_validation->set_rules('tujuan', 'Tujuan', 'trim|required');
                $this->form_validation->set_rules('perihal', 'Perihal', 'trim|required');

                if ($this->form_validation->run() == true) {
                    $config['upload_path'] = './uploads/';
                    $config['allowed_types'] = 'pdf';
                    $config['max_size'] = 2000000;
                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('file_surat')) {
                        if ($this->HomeModel->tambah_surat_keluar($this->upload->data()) == true) {
                            $this->session->set_flashdata('notif', 'Tambah Surat Keluar Berhasil!');
                            redirect('home/surat_keluar');
                        } else {
                            $this->session->set_flashdata('notif', 'Tambah Surat Gagal!');
                            redirect('home/surat_keluar');
                        }
                    } else {
                        $this->session->set_flashdata('notif', $this->upload->display_errors());
                        redirect('home/surat_keluar');
                    }
                } else {
                    $this->session->set_flashdata('notif', validation_errors());
                    redirect('home/surat_keluar');
                }
            } else {
                redirect('logout');
            }
        } else {
            redirect('login');
        }
    }

    public function tambah_surat_masuk()
    {
        if ($this->session->userdata('logged_in') == true) {
            if ($this->session->userdata('role') == 'ADMIN') {
                $this->form_validation->set_rules('nomor_surat', 'Nomor Surat', 'trim|required');
                $this->form_validation->set_rules('tgl_kirim', 'Tanggal Kirim', 'trim|date|required');
                $this->form_validation->set_rules('tgl_terima', 'Tanggal Terima', 'trim|date|required');
                $this->form_validation->set_rules('pengirim', 'Pengirim', 'trim|required');
                $this->form_validation->set_rules('perihal', 'Perihal', 'trim|required');

                if ($this->form_validation->run() == true) {
                    $config['upload_path'] = './uploads/';
                    $config['allowed_types'] = 'pdf';
                    $config['max_size'] = 2000000;
                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('file_surat')) {
                        if ($this->HomeModel->tambah_surat_masuk($this->upload->data()) == true) {
                            $this->session->set_flashdata('notif', 'Tambah Surat Berhasil!');
                            redirect('home/surat_masuk');
                        } else {
                            $this->session->set_flashdata('notif', 'Tambah Surat Berhasil!');
                            redirect('home/surat_masuk');
                        }
                    } else {
                        $this->session->set_flashdata('notif', $this->upload->display_errors());
                        redirect('home/surat_masuk');
                    }
                } else {
                    $this->session->set_flashdata('notif', validation_errors());
                    redirect('home/surat_masuk');
                }
            } else {
                redirect('logout');
            }
        } else {
            redirect('login');
        }
    }

    public function tambah_surat_keputusan()
    {
        $this->checkLogin();
        if ($this->checkRole('ADMIN')) {
            $this->form_validation->set_rules('nomor_surat', 'Nomor Surat', 'trim|required');
            $this->form_validation->set_rules('tgl_surat', 'Tanggal Surat', 'trim|required|date');
            $this->form_validation->set_rules('perihal', 'Perihal', 'trim|required');
            $this->form_validation->set_rules('bagian', 'Bagian', 'trim|required');


            if ($this->form_validation->run() == true) {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'pdf';
                $config['max_size'] = 2000000;
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('file_surat')) {
                    if ($this->HomeModel->tambah_surat_keputusan($this->upload->data()) == true) {
                        $this->session->set_flashdata('notif', 'Tambah Surat Keputusan Berhasil!');
                        redirect('home/surat_keputusan');
                    } else {
                        $this->session->set_flashdata('notif', 'Tambah Surat Keputusan Gagal!');
                        redirect('home/surat_keputusan');
                    }
                } else {
                    $this->session->set_flashdata('notif', $this->upload->display_errors());
                    redirect('home/surat_keputusan');
                }
            } else {
                $this->session->set_flashdata('notif', validation_errors());
                redirect('home/surat_keputusan');
            }
        }
        if ($this->checkRole('KOORDINATOR')) {
            $this->form_validation->set_rules('nomor_surat', 'Nomor Surat', 'trim|required');
            $this->form_validation->set_rules('tgl_surat', 'Tanggal Surat', 'trim|required|date');
            $this->form_validation->set_rules('perihal', 'Perihal', 'trim|required');
            $this->form_validation->set_rules('bagian', 'Bagian', 'trim|required');


            if ($this->form_validation->run() == true) {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'pdf';
                $config['max_size'] = 2000000;
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('file_surat')) {
                    if ($this->HomeModel->tambah_surat_keputusan($this->upload->data()) == true) {
                        $this->session->set_flashdata('notif', 'Tambah Surat Keputusan Berhasil!');
                        redirect('home/surat_keputusan');
                    } else {
                        $this->session->set_flashdata('notif', 'Tambah Surat Keputusan Gagal!');
                        redirect('home/surat_keputusan');
                    }
                } else {
                    $this->session->set_flashdata('notif', $this->upload->display_errors());
                    redirect('home/surat_keputusan');
                }
            } else {
                $this->session->set_flashdata('notif', validation_errors());
                redirect('home/surat_keputusan');
            }
        }
    }

    public function tambah_pegawai()
    {
        if ($this->session->userdata('logged_in') == true) {
            if ($this->session->userdata('role') == 'ADMIN') {
                $this->form_validation->set_rules('username', 'username', 'trim|required');
                $this->form_validation->set_rules('nama_pegawai', 'Nama Pegawai', 'trim|required');
                $this->form_validation->set_rules('id_jabatan', 'Id Jabatan', 'trim|required');
                $this->form_validation->set_rules('password', 'Password', 'trim|required');
                if ($this->form_validation->run() == true) {
                    $config['upload_path'] = './uploads/';
                    $this->load->library('upload', $config);

                    if ($this->HomeModel->tambah_pegawai($this->upload->data()) == true) {
                        $this->session->set_flashdata('notif', 'Tambah Pegawai Berhasil!');
                        redirect('home/pegawai');
                    } else {
                        $this->session->set_flashdata('notif', 'Tambah Pegawai Berhasil!');
                        redirect('home/pegawai');
                    }
                } else {
                    $this->session->set_flashdata('notif', validation_errors());
                    redirect('home/pegawai');
                }
            } else {
                redirect('logout');
            }
        } else {
            redirect('login');
        }
    }

    public function tambah_jabatan()
    {
        if ($this->session->userdata('logged_in') == true) {
            if ($this->session->userdata('role') == 'ADMIN') {
                $this->form_validation->set_rules('nama_jabatan', 'Nama Jabatan', 'trim|required');
                $this->form_validation->set_rules('role', 'Role', 'trim|required');

                if ($this->form_validation->run() == true) {
                    $config['upload_path'] = './uploads/';
                    $this->load->library('upload', $config);

                    if ($this->HomeModel->tambah_jabatan($this->upload->data()) == true) {
                        $this->session->set_flashdata('notif', 'Tambah Jabatan Berhasil!');
                        redirect('home/jabatan');
                    } else {
                        $this->session->set_flashdata('notif', 'Tambah Jabatan Berhasil!');
                        redirect('home/jabatan');
                    }
                } else {
                    $this->session->set_flashdata('notif', validation_errors());
                    redirect('home/jabatan');
                }
            } else {
                redirect('logout');
            }
        } else {
            redirect('login');
        }
    }

    public function tambah_tamu()
    {
        $this->checkLogin();
        if ($this->checkRole('ADMIN')) {
            $this->form_validation->set_rules('nama_tamu', 'Nama Tamu', 'trim|required');
            $this->form_validation->set_rules('tgl_masuk', 'Tanggal Masuk', 'trim|required');
            $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
            $this->form_validation->set_rules('keperluan', 'Keperluan', 'trim|required');
            $this->form_validation->set_rules('suhu', 'Suhu', 'trim|required');
            if ($this->form_validation->run() == true) {
                $config['upload_path'] = './uploads/';
                $this->load->library('upload', $config);

                if ($this->HomeModel->tambah_tamu($this->upload->data()) == true) {
                    $this->session->set_flashdata('notif', 'Tambah Tamu Berhasil!');
                    redirect('home/tamu');
                } else {
                    $this->session->set_flashdata('notif', 'Tambah Tamu Berhasil!');
                    redirect('home/tamu');
                }
            } else {
                $this->session->set_flashdata('notif', validation_errors());
                redirect('home/tamu');
            }
        }
        if ($this->checkRole('KEAMANAN')) {
            $this->form_validation->set_rules('nama_tamu', 'Nama Tamu', 'trim|required');
            $this->form_validation->set_rules('tgl_masuk', 'Tanggal Masuk', 'trim|required');
            $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
            $this->form_validation->set_rules('keperluan', 'Keperluan', 'trim|required');
            $this->form_validation->set_rules('suhu', 'Suhu', 'trim|required');
            if ($this->form_validation->run() == true) {
                $config['upload_path'] = './uploads/';
                $this->load->library('upload', $config);

                if ($this->HomeModel->tambah_tamu($this->upload->data()) == true) {
                    $this->session->set_flashdata('notif', 'Tambah Tamu Berhasil!');
                    redirect('home/tamu');
                } else {
                    $this->session->set_flashdata('notif', 'Tambah Tamu Berhasil!');
                    redirect('home/tamu');
                }
            } else {
                $this->session->set_flashdata('notif', validation_errors());
                redirect('home/tamu');
            }
        }
    }

    public function ubah_surat_keluar()
    {
        if ($this->session->userdata('logged_in') == true) {
            if ($this->session->userdata('role') == 'ADMIN') {
                $this->form_validation->set_rules('ubah_nomor_surat', 'Nomor Surat', 'trim|required');
                $this->form_validation->set_rules('ubah_tgl_kirim', 'Tanggal Kirim', 'trim|required|date');
                $this->form_validation->set_rules('ubah_tujuan', 'Tujuan', 'trim|required');
                $this->form_validation->set_rules('ubah_perihal', 'Perihal', 'trim|required');

                if ($this->form_validation->run() == true) {
                    if ($this->HomeModel->ubah_surat_keluar() == true) {
                        $this->session->set_flashdata('notif', 'Ubah Surat Keluar Berhasil!');
                        redirect('home/surat_keluar');
                    } else {
                        $this->session->set_flashdata('notif', 'Ubah Surat Keluar Gagal!');
                        redirect('home/surat_keluar');
                    }
                } else {
                    $this->session->set_flashdata('notif', validation_errors());
                    redirect('home/surat_keluar');
                }
            } else {
                redirect('logout');
            }
        } else {
            redirect('login');
        }
    }

    public function ubah_surat_masuk()
    {
        if ($this->session->userdata('logged_in') == true) {
            if ($this->session->userdata('role') == 'ADMIN') {
                $this->form_validation->set_rules('ubah_nomor_surat', 'Nomor Surat', 'trim|required');
                $this->form_validation->set_rules('ubah_tgl_kirim', 'Tanggal Kirim', 'trim|required|date');
                $this->form_validation->set_rules('ubah_tgl_terima', "Tanggal Terima", 'trim|required');
                $this->form_validation->set_rules('ubah_pengirim', 'Pengirim', 'trim|required');
                $this->form_validation->set_rules('ubah_perihal', 'Perihal', 'trim|required');

                if ($this->form_validation->run() == true) {
                    if ($this->HomeModel->ubah_surat_masuk() == true) {
                        $this->session->set_flashdata('notif', 'Update Surat Masuk Berhasil!');
                        redirect('home/surat_masuk');
                    } else {
                        $this->session->set_flashdata('notif', 'Update Surat Masuk Gagal!');
                        redirect('home/surat_masuk');
                    }
                } else {
                    $this->session->set_flashdata('notif', validation_errors());
                    redirect('home/surat_masuk');
                }
            } else {
                redirect('logout');
            }
        } else {
            redirect('login');
        }
    }

    public function ubah_surat_keputusan()
    {
        $this->checkLogin();
        if ($this->checkRole('ADMIN')) {
            $this->form_validation->set_rules('ubah_nomor_surat', 'Nomor Surat', 'trim|required');
            $this->form_validation->set_rules('ubah_tgl_surat', 'Tanggal Surat', 'trim|required|date');
            $this->form_validation->set_rules('ubah_perihal', 'Perihal', 'trim|required');
            $this->form_validation->set_rules('ubah_bagian', 'Bagian', 'trim|required');

            if ($this->form_validation->run() == true) {
                if ($this->HomeModel->ubah_surat_keputusan() == true) {
                    $this->session->set_flashdata('notif', 'Ubah Surat Keputusan Berhasil!');
                    redirect('home/surat_keputusan');
                } else {
                    $this->session->set_flashdata('notif', 'Ubah Surat Keputusan Gagal!');
                    redirect('home/surat_keputusan');
                }
            } else {
                $this->session->set_flashdata('notif', validation_errors());
                redirect('home/surat_keputusan');
            }
        }
        if ($this->checkRole('KOORDINATOR')) {
            $this->form_validation->set_rules('ubah_nomor_surat', 'Nomor Surat', 'trim|required');
            $this->form_validation->set_rules('ubah_tgl_surat', 'Tanggal Surat', 'trim|required|date');
            $this->form_validation->set_rules('ubah_perihal', 'Perihal', 'trim|required');
            $this->form_validation->set_rules('ubah_bagian', 'Bagian', 'trim|required');

            if ($this->form_validation->run() == true) {
                if ($this->HomeModel->ubah_surat_keputusan() == true) {
                    $this->session->set_flashdata('notif', 'Ubah Surat Keputusan Berhasil!');
                    redirect('home/surat_keputusan');
                } else {
                    $this->session->set_flashdata('notif', 'Ubah Surat Keputusan Gagal!');
                    redirect('home/surat_keputusan');
                }
            } else {
                $this->session->set_flashdata('notif', validation_errors());
                redirect('home/surat_keputusan');
            }
        }
    }

    public function ubah_pegawai()
    {
        if ($this->session->userdata('logged_in') == true) {
            if ($this->session->userdata('role') == 'ADMIN') {
                $this->form_validation->set_rules('ubah_username', 'username', 'trim|required');
                $this->form_validation->set_rules('ubah_nama_pegawai', 'nama_pegawai', 'trim|required');
                $this->form_validation->set_rules('ubah_id_jabatan', "id_ jabatan", 'trim|required');
                $this->form_validation->set_rules('ubah_password', 'password', 'trim|required');

                if ($this->form_validation->run() == true) {
                    if ($this->HomeModel->ubah_pegawai() == true) {
                        $this->session->set_flashdata('notif', 'Update Pegawai Berhasil!');
                        redirect('home/pegawai');
                    } else {
                        $this->session->set_flashdata('notif', 'Update Pegawai Gagal!');
                        redirect('home/pegawai');
                    }
                } else {
                    $this->session->set_flashdata('notif', validation_errors());
                    redirect('home/pegawai');
                }
            } else {
                redirect('logout');
            }
        } else {
            redirect('login');
        }
    }

    public function ubah_jabatan()
    {
        if ($this->session->userdata('logged_in') == true) {
            if ($this->session->userdata('role') == 'ADMIN') {
                $this->form_validation->set_rules('ubah_nama_jabatan', 'nama_jabatan', 'trim|required');
                $this->form_validation->set_rules('ubah_role', 'role', 'trim|required');

                if ($this->form_validation->run() == true) {
                    if ($this->HomeModel->ubah_jabatan() == true) {
                        $this->session->set_flashdata('notif', 'Update Jabatan Berhasil!');
                        redirect('home/jabatan');
                    } else {
                        $this->session->set_flashdata('notif', 'Update Jabatan Gagal!');
                        redirect('home/jabatan');
                    }
                } else {
                    $this->session->set_flashdata('notif', validation_errors());
                    redirect('home/jabatan');
                }
            } else {
                redirect('logout');
            }
        } else {
            redirect('login');
        }
    }

    public function ubah_tamu()
    {
        $this->checkLogin();
        if ($this->checkRole('ADMIN')) {
            $this->form_validation->set_rules('ubah_nama_tamu', 'nama_tamu', 'trim|required');
            $this->form_validation->set_rules('ubah_tgl_masuk', 'tgl_masuk', 'trim|required|date');
            $this->form_validation->set_rules('ubah_alamat', 'alamat', 'trim|required');
            $this->form_validation->set_rules('ubah_keperluan', 'keperluan', 'trim|required');
            $this->form_validation->set_rules('ubah_suhu', 'suhu', 'trim|required');
            if ($this->form_validation->run() == true) {
                if ($this->HomeModel->ubah_tamu() == true) {
                    $this->session->set_flashdata('notif', 'Update Tamu Berhasil!');
                    redirect('home/tamu');
                } else {
                    $this->session->set_flashdata('notif', 'Update Tamu Gagal!');
                    redirect('home/tamu');
                }
            } else {
                $this->session->set_flashdata('notif', validation_errors());
                redirect('home/tamu');
            }
        }
        if ($this->checkRole('KEAMANAN')) {
            $this->form_validation->set_rules('ubah_nama_tamu', 'nama_tamu', 'trim|required');
            $this->form_validation->set_rules('ubah_tgl_masuk', 'tgl_masuk', 'trim|required|date');
            $this->form_validation->set_rules('ubah_alamat', 'alamat', 'trim|required');
            $this->form_validation->set_rules('ubah_keperluan', 'keperluan', 'trim|required');
            $this->form_validation->set_rules('ubah_suhu', 'suhu', 'trim|required');
            if ($this->form_validation->run() == true) {
                if ($this->HomeModel->ubah_tamu() == true) {
                    $this->session->set_flashdata('notif', 'Update Tamu Berhasil!');
                    redirect('home/tamu');
                } else {
                    $this->session->set_flashdata('notif', 'Update Tamu Gagal!');
                    redirect('home/tamu');
                }
            } else {
                $this->session->set_flashdata('notif', validation_errors());
                redirect('home/tamu');
            }
        }
    }

    public function ubah_file_surat_keluar()
    {
        if ($this->session->userdata('logged_in') == true) {
            if ($this->session->userdata('role') == 'ADMIN') {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'pdf';
                $config['max_size'] = 2000000;
                $this->load->library('upload', $config);
                $path = './uploads/' . $this->HomeModel->get_nama_file_surat_keluar($this->input->post('ubah_file_surat'));
                if (unlink($path)) {
                    if ($this->upload->do_upload('ubah_file_surat')) {
                        if ($this->HomeModel->ubah_file_surat_keluar($this->upload->data()) == true) {
                            $this->session->set_flashdata('notif', 'Ubah file surat keluar berhasil!');
                            redirect('home/surat_keluar');
                        } else {
                            $this->session->set_flashdata('notif', 'Ubah file surat keluar gagal!');
                            redirect('home/surat_keluar');
                        }
                    } else {
                        $this->session->set_flashdata('notif', $this->upload->display_errors());
                        redirect('home/surat_keluar');
                    }
                } else {
                    $this->session->set_flashdata('notif', 'Gagal menghapus file sebelumnya!');
                    redirect('home/surat_keluar');
                }
            } else {
                redirect('logout');
            }
        } else {
            redirect('login');
        }
    }

    public function ubah_file_surat_masuk()
    {
        if ($this->session->userdata('logged_in') == true) {
            if ($this->session->userdata('role') == 'ADMIN') {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'pdf';
                $config['max_size'] = 2000000;
                $this->load->library('upload', $config);
                $path = './uploads/' . $this->HomeModel->get_nama_file_surat_masuk($this->input->post('ubah_file_surat'));

                if (unlink($path)) {
                    if ($this->upload->do_upload('ubah_file_surat')) {
                        if ($this->HomeModel->ubah_file_surat_masuk($this->upload->data()) == true) {
                            $this->session->set_flashdata('notif', 'Ubah file surat masuk berhasil!');
                            redirect('home/surat_masuk');
                        } else {
                            $this->session->set_flashdata('notif', 'Ubah file surat masuk gagal!');
                            redirect('home/surat_masuk');
                        }
                    } else {
                        $this->session->set_flashdata('notif', $this->upload->display_errors());
                        redirect('home/surat_masuk');
                    }
                } else {
                    $this->session->set_flashdata('notif', 'Gagal menghapus file sebelumnya!');
                    redirect('home/surat_masuk');
                }
            } else {
                redirect('logout');
            }
        } else {
            redirect('login');
        }
    }

    public function ubah_file_surat_keputusan()
    {
        $this->checkLogin();
        if ($this->checkRole('ADMIN')) {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'pdf';
            $config['max_size'] = 2000000;
            $this->load->library('upload', $config);
            $path = './uploads/' . $this->HomeModel->get_nama_file_surat_keputusan($this->input->post('ubah_file_surat'));
            if (unlink($path)) {
                if ($this->upload->do_upload('ubah_file_surat')) {
                    if ($this->HomeModel->ubah_file_surat_keluar($this->upload->data()) == true) {
                        $this->session->set_flashdata('notif', 'Ubah file surat keputusan berhasil!');
                        redirect('home/surat_keputusan');
                    } else {
                        $this->session->set_flashdata('notif', 'Ubah file surat keputusan gagal!');
                        redirect('home/surat_keputusan');
                    }
                } else {
                    $this->session->set_flashdata('notif', $this->upload->display_errors());
                    redirect('home/surat_keputusan');
                }
            } else {
                $this->session->set_flashdata('notif', 'Gagal menghapus file sebelumnya!');
                redirect('home/surat_keputusan');
            }
        }
        if ($this->checkRole('KORRDINATOR')) {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'pdf';
            $config['max_size'] = 2000000;
            $this->load->library('upload', $config);
            $path = './uploads/' . $this->HomeModel->get_nama_file_surat_keputusan($this->input->post('ubah_file_surat'));
            if (unlink($path)) {
                if ($this->upload->do_upload('ubah_file_surat')) {
                    if ($this->HomeModel->ubah_file_surat_keluar($this->upload->data()) == true) {
                        $this->session->set_flashdata('notif', 'Ubah file surat keputusan berhasil!');
                        redirect('home/surat_keputusan');
                    } else {
                        $this->session->set_flashdata('notif', 'Ubah file surat keputusan gagal!');
                        redirect('home/surat_keputusan');
                    }
                } else {
                    $this->session->set_flashdata('notif', $this->upload->display_errors());
                    redirect('home/surat_keputusan');
                }
            } else {
                $this->session->set_flashdata('notif', 'Gagal menghapus file sebelumnya!');
                redirect('home/surat_keputusan');
            }
        }
    }

    public function get_surat_keluar_by_id($id_surat)
    {
        if ($this->session->userdata('logged_in') == true) {
            if ($this->session->userdata('role') == 'ADMIN') {
                $data_surat_keluar_by_id = $this->HomeModel->get_surat_keluar_by_id($id_surat);
                echo json_encode($data_surat_keluar_by_id);
            } else {
                redirect('logout');
            }
        } else {
            redirect('login');
        }
    }

    public function get_surat_masuk_by_id($id_surat)
    {
        if ($this->session->userdata('logged_in') == true) {
            if ($this->session->userdata('role') == 'ADMIN') {
                $data_surat_masuk_by_id = $this->HomeModel->get_surat_masuk_by_id($id_surat);
                echo json_encode($data_surat_masuk_by_id);
            } else {
                redirect('logout');
            }
        } else {
            redirect('login');
        }
    }

    public function get_surat_keputusan_by_id($id_surat)
    {
        $this->checkLogin();
        if ($this->checkRole('ADMIN')) {
            $data_surat_keputusan_by_id = $this->HomeModel->get_surat_keputusan_by_id($id_surat);
            echo json_encode($data_surat_keputusan_by_id);
        }
        if ($this->checkRole('KOORDINATOR')) {
            $data_surat_keputusan_by_id = $this->HomeModel->get_surat_keputusan_by_id($id_surat);
            echo json_encode($data_surat_keputusan_by_id);
        }
    }

    public function get_pegawai_by_jabatan($id_jabatan)
    {
        if ($this->session->userdata('logged_in') == true) {
            $data_pegawai_by_id_jabatan = $this->HomeModel->get_pegawai_by_jabatan($id_jabatan);
            echo json_encode($data_pegawai_by_id_jabatan);
        } else {
            redirect('login');
        }
    }

    public function get_pegawai_by_id($id_pegawai)
    {
        if ($this->session->userdata('logged_in') == true) {
            $data_pegawai_by_id_pegawai = $this->HomeModel->get_pegawai_by_id($id_pegawai);
            echo json_encode($data_pegawai_by_id_pegawai);
        } else {
            redirect('login');
        }
    }

    public function get_jabatan_by_id($id_jabatan)
    {
        if ($this->session->userdata('logged_in') == true) {
            $data_jabatan_by_id_jabatan = $this->HomeModel->get_jabatan_by_id($id_jabatan);
            echo json_encode($data_jabatan_by_id_jabatan);
        } else {
            redirect('login');
        }
    }

    public function get_tamu_by_id($id_tamu)
    {
        if ($this->session->userdata('logged_in') == true) {
            $data_tamu_by_id_tamu = $this->HomeModel->get_tamu_by_id($id_tamu);
            echo json_encode($data_tamu_by_id_tamu);
        } else {
            redirect('login');
        }
    }

    public function hapus_surat_keluar($id_surat)
    {
        if ($this->session->userdata('logged_in') == true) {
            if ($this->session->userdata('role') == 'ADMIN') {
                $path = './uploads/' . $this->HomeModel->get_nama_file_surat_keluar($id_surat);

                if (unlink($path)) {
                    if ($this->HomeModel->hapus_surat_keluar($id_surat) == true) {
                        $this->session->set_flashdata('notif', 'Hapus surat keluar berhasil!');
                        redirect('home/surat_keluar');
                    } else {
                        $this->session->set_flashdata('notif', 'Hapus surat keluar gagal');
                        redirect('home/surat_keluar');
                    }
                } else {
                    $this->session->set_flashdata('notif', 'Gagal menghapus file sebelumnya!');
                    redirect('home/surat_keluar');
                }
            } else {
                redirect('logout');
            }
        } else {
            redirect('login');
        }
    }

    public function hapus_surat_masuk($id_surat)
    {
        if ($this->session->userdata('logged_in') == true) {
            if ($this->session->userdata('role') == 'ADMIN') {
                $path = './uploads/' . $this->HomeModel->get_nama_file_surat_masuk($id_surat);
                if (unlink($path)) {
                    if ($this->HomeModel->hapus_surat_masuk($id_surat) == true) {
                        $this->session->set_flashdata('notif', 'Hapus Surat Berhasil!');
                        redirect('home/surat_masuk');
                    } else {
                        $this->session->set_flashdata('notif', 'Tidak dapat menghapus surat!');
                        redirect('home/surat_masuk');
                    }
                } else {
                    $this->session->set_flashdata('notif', 'Tidak dapat menghapus berkas dokumen!');
                    redirect('home/surat_masuk');
                }
            } else {
                redirect('logout');
            }
        } else {
            redirect('login');
        }
    }

    public function hapus_surat_keputusan($id_surat)
    {
        $this->checkLogin();
        if ($this->checkRole('ADMIN')) {
            $path = './uploads/' . $this->HomeModel->get_nama_file_surat_keputusan($id_surat);

            if (unlink($path)) {
                if ($this->HomeModel->hapus_surat_keputusan($id_surat) == true) {
                    $this->session->set_flashdata('notif', 'Hapus surat keputusan berhasil!');
                    redirect('home/surat_keputusan');
                } else {
                    $this->session->set_flashdata('notif', 'Hapus surat keputusan gagal');
                    redirect('home/surat_keputusan');
                }
            } else {
                $this->session->set_flashdata('notif', 'Gagal menghapus file sebelumnya!');
                redirect('home/surat_keputusan');
            }
        }
        if ($this->checkRole('KOORDINATOR')) {
            $path = './uploads/' . $this->HomeModel->get_nama_file_surat_keputusan($id_surat);

            if (unlink($path)) {
                if ($this->HomeModel->hapus_surat_keputusan($id_surat) == true) {
                    $this->session->set_flashdata('notif', 'Hapus surat keputusan berhasil!');
                    redirect('home/surat_keputusan');
                } else {
                    $this->session->set_flashdata('notif', 'Hapus surat keputusan gagal');
                    redirect('home/surat_keputusan');
                }
            } else {
                $this->session->set_flashdata('notif', 'Gagal menghapus file sebelumnya!');
                redirect('home/surat_keputusan');
            }
        }
    }

    public function hapus_pegawai($id_pegawai)
    {
        if ($this->session->userdata('logged_in') == true) {
            if ($this->session->userdata('role') == 'ADMIN') {

                if ($this->HomeModel->hapus_pegawai($id_pegawai) == true) {
                    $this->session->set_flashdata('notif', 'Hapus Pegawai Berhasil!');
                    redirect('home/pegawai');
                } else {
                    $this->session->set_flashdata('notif', 'Tidak dapat menghapus pegawai!');
                    redirect('home/pegawai');
                }
            } else {
                redirect('logout');
            }
        } else {
            redirect('login');
        }
    }

    public function hapus_jabatan($id_jabatan)
    {
        if ($this->session->userdata('logged_in') == true) {
            if ($this->session->userdata('role') == 'ADMIN') {

                if ($this->HomeModel->hapus_jabatan($id_jabatan) == true) {
                    $this->session->set_flashdata('notif', 'Hapus Jabatan Berhasil!');
                    redirect('home/jabatan');
                } else {
                    $this->session->set_flashdata('notif', 'Tidak dapat menghapus jabatan!');
                    redirect('home/jabatan');
                }
            } else {
                redirect('logout');
            }
        } else {
            redirect('login');
        }
    }

    public function hapus_tamu($id_tamu)
    {
        $this->checkLogin();
        if ($this->checkRole('ADMIN')) {
            if ($this->HomeModel->hapus_tamu($id_tamu) == true) {
                $this->session->set_flashdata('notif', 'Hapus Tamu Berhasil!');
                redirect('home/tamu');
            } else {
                $this->session->set_flashdata('notif', 'Tidak dapat menghapus tamu!');
                redirect('home/tamu');
            }
        }
        if ($this->checkRole('KEAMANAN')) {
            if ($this->HomeModel->hapus_tamu($id_tamu) == true) {
                $this->session->set_flashdata('notif', 'Hapus Tamu Berhasil!');
                redirect('home/tamu');
            } else {
                $this->session->set_flashdata('notif', 'Tidak dapat menghapus tamu!');
                redirect('home/tamu');
            }
        }
    }


    public function hapus_disposisi($id_disposisi, $id_surat)
    {
        if ($this->session->userdata('logged_in') == true) {
            if ($this->session->userdata('role') == 'ADMIN') {
                if ($this->HomeModel->hapus_disposisi($id_disposisi) == true) {
                    $this->session->set_flashdata('notif', 'Hapus Disposisi Surat Berhasil!');
                    redirect('home/disposisi/' . $id_surat);
                } else {
                    $this->session->set_flashdata('notif', 'Hapus Disposisi Surat Gagal!');
                    redirect('home/disposisi' . $id_surat);
                }
            } else {
                redirect('logout');
            }
        } else {
            redirect('login');
        }
    }

    public function hapus_disposisi_pegawai($id_disposisi, $id_surat)
    {
        if ($this->session->userdata('logged_in') == true) {
            if ($this->HomeModel->hapus_disposisi($id_disposisi) == true) {
                $this->session->set_flashdata('notif', 'Hapus Disposisi Surat Berhasil!');
                redirect('home/disposisi_keluar_pegawai/' . $id_surat);
            } else {
                $this->session->set_flashdata('notif', 'Hapus Disposisi Surat Gagal!');
                redirect('home/disposisi_keluar_pegawai/' . $id_surat);
            }
        } else {
            redirect('login');
        }
    }
}
