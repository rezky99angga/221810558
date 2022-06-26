<?php



defined('BASEPATH') or exit('No direct script access allowed');

class HomeModel extends CI_Model
{

    public function get_jumlah_surat()
    {
        $surat_masuk = $this->db->select('count(*) as total_surat_masuk')
            ->get('surat_masuk')->row();

        $surat_keluar = $this->db->select('count(*) as total_surat_keluar')
            ->get('surat_keluar')->row();

        $surat_keputusan = $this->db->select('count(*) as total_surat_keputusan')
            ->get('surat_keputusan')->row();

        $tamu = $this->db->select('count(*) as total_tamu')
            ->get('tamu')->row();
        $pegawai = $this->db->select('count(*) as total_pegawai')
            ->get('pegawai')->row();
        $jabatan = $this->db->select('count(*) as total_jabatan')
            ->get('jabatan')->row();



        return array(
            'surat_masuk' => $surat_masuk->total_surat_masuk,
            'surat_keluar' => $surat_keluar->total_surat_keluar,
            'surat_keputusan' => $surat_keputusan->total_surat_keputusan,
            'tamu' => $tamu->total_tamu,
            'pegawai' => $pegawai->total_pegawai,
            'jabatan' => $jabatan->total_jabatan


        );
    }

    public function get_jumlah_disposisi()
    {
        $disposisi_keluar = $this->db
            ->select('count(id_pegawai_pengirim) as total_disposisi_keluar')
            ->where('id_pegawai_pengirim', $this->session->userdata('id_pegawai'))
            ->get('disposisi')->row();

        $disposisi_masuk = $this->db
            ->select('count(id_pegawai_penerima) as total_disposisi_masuk')
            ->where('id_pegawai_penerima', $this->session->userdata('id_pegawai'))
            ->get('disposisi')->row();

        return array(
            'disposisi_keluar' => $disposisi_keluar->total_disposisi_keluar,
            'disposisi_masuk' => $disposisi_masuk->total_disposisi_masuk
        );
    }

    public function tambah_surat_keputusan($file_surat)
    {
        $data = array(
            'nomor_surat' => $this->input->post('nomor_surat'),
            'tgl_surat' => $this->input->post('tgl_surat'),
            'perihal' => $this->input->post('perihal'),
            'bagian' => $this->input->post('bagian'),
            'file_surat' => $file_surat['file_name']
        );

        $this->db->insert('surat_keputusan', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function tambah_surat_keluar($file_surat)
    {
        $data = array(
            'nomor_surat' => $this->input->post('nomor_surat'),
            'tgl_kirim' => $this->input->post('tgl_kirim'),
            'tujuan' => $this->input->post('tujuan'),
            'perihal' => $this->input->post('perihal'),
            'file_surat' => $file_surat['file_name']
        );

        $this->db->insert('surat_keluar', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function tambah_surat_masuk($file_surat)
    {
        $data = array(
            'nomor_surat' => $this->input->post('nomor_surat'),
            'tgl_kirim' => $this->input->post('tgl_kirim'),
            'tgl_terima' => $this->input->post('tgl_terima'),
            'pengirim' => $this->input->post('pengirim'),
            'perihal' => $this->input->post('perihal'),
            'file_surat' => $file_surat['file_name']
        );

        $this->db->insert('surat_masuk', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function tambah_pegawai()
    {
        $data = array(
            'username' => $this->input->post('username'),
            'nama_pegawai' => $this->input->post('nama_pegawai'),
            'id_jabatan' => $this->input->post('id_jabatan'),
            'password' => md5($this->input->post('password')),

        );

        $this->db->insert('pegawai', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function tambah_jabatan()
    {
        $data = array(
            'nama_jabatan' => $this->input->post('nama_jabatan'),
            'role' => $this->input->post('role'),
        );

        $this->db->insert('jabatan', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function tambah_tamu()
    {
        $data = array(
            'nama_tamu' => $this->input->post('nama_tamu'),
            'tgl_masuk' => $this->input->post('tgl_masuk'),
            'alamat' => $this->input->post('alamat'),
            'keperluan' => $this->input->post('keperluan'),
            'suhu' => $this->input->post('suhu'),

        );

        $this->db->insert('tamu', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function tambah_disposisi($id_surat)
    {
        $data = array(
            'id_surat' => $id_surat,
            'id_pegawai_pengirim' => $this->session->userdata('id_pegawai'),
            'id_pegawai_penerima' => $this->input->post('tujuan_pegawai'),
            'keterangan' => $this->input->post('keterangan')
        );

        $this->db->insert('disposisi', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function disposisi_selesai($id_surat)
    {
        $data['status'] = 'selesai';

        $this->db->where('id_surat', $id_surat)
            ->update('surat_masuk', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function ubah_surat_keputusan()
    {
        $data = array(
            'nomor_surat' => $this->input->post('ubah_nomor_surat'),
            'tgl_surat' => $this->input->post('ubah_tgl_surat'),
            'perihal' => $this->input->post('ubah_perihal'),
            'bagian' => $this->input->post('ubah_bagian'),
        );

        $this->db->where('id_surat', $this->input->post('ubah_id_surat'))
            ->update('surat_keputusan', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function ubah_surat_keluar()
    {
        $data = array(
            'nomor_surat' => $this->input->post('ubah_nomor_surat'),
            'tgl_kirim' => $this->input->post('ubah_tgl_kirim'),
            'tujuan' => $this->input->post('ubah_tujuan'),
            'perihal' => $this->input->post('ubah_perihal'),
        );

        $this->db->where('id_surat', $this->input->post('ubah_id_surat'))
            ->update('surat_keluar', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function ubah_surat_masuk()
    {
        $data = array(
            'nomor_surat' => $this->input->post('ubah_nomor_surat'),
            'tgl_kirim' => $this->input->post('ubah_tgl_kirim'),
            'tgl_terima' => $this->input->post('ubah_tgl_terima'),
            'pengirim' => $this->input->post('ubah_pengirim'),
            'perihal' => $this->input->post('ubah_perihal')
        );

        $this->db->where('id_surat', $this->input->post('ubah_id_surat'))
            ->update('surat_masuk', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function ubah_pegawai()
    {
        $user = $this->get_pegawai_by_id($this->input->post('ubah_id_pegawai'));

        $data = $user->password === $this->input->post('ubah_password')
            ? array(
                'username' => $this->input->post('ubah_username'),
                'nama_pegawai' => $this->input->post('ubah_nama_pegawai'),
                'id_jabatan' => $this->input->post('ubah_id_jabatan')
            ) :
            array(
                'username' => $this->input->post('ubah_username'),
                'nama_pegawai' => $this->input->post('ubah_nama_pegawai'),
                'id_jabatan' => $this->input->post('ubah_id_jabatan'),
                'password' => md5($this->input->post('ubah_password'))
            );

        $this->db->where('id_pegawai', $this->input->post('ubah_id_pegawai'))
            ->update('pegawai', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function ubah_jabatan()
    {
        $data = array(
            'nama_jabatan' => $this->input->post('ubah_nama_jabatan'),
            'role' => $this->input->post('ubah_role'),

        );

        $this->db->where('id_jabatan', $this->input->post('ubah_id_jabatan'))
            ->update('jabatan', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function ubah_tamu()
    {
        $data = array(
            'nama_tamu' => $this->input->post('ubah_nama_tamu'),
            'tgl_masuk' => $this->input->post('ubah_tgl_masuk'),
            'alamat' => $this->input->post('ubah_alamat'),
            'keperluan' => $this->input->post('ubah_keperluan'),
            'suhu' => $this->input->post('ubah_suhu'),
        );

        $this->db->where('id_tamu', $this->input->post('ubah_id_tamu'))
            ->update('tamu', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function ubah_file_surat_keputusan($file_surat)
    {
        $data = array(
            'file_surat' => $file_surat['file_name']
        );

        $this->db->where('id_surat', $this->input->post('ubah_file_surat'))
            ->update('surat_keputusan', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function ubah_file_surat_keluar($file_surat)
    {
        $data = array(
            'file_surat' => $file_surat['file_name']
        );

        $this->db->where('id_surat', $this->input->post('ubah_file_surat'))
            ->update('surat_keluar', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function ubah_file_surat_masuk($file_surat)
    {
        $data = array(
            'file_surat' => $file_surat['file_name']
        );

        $this->db->where('id_surat', $this->input->post('ubah_file_surat'))
            ->update('surat_masuk', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_disposisi($id_surat)
    {
        return $this->db->join('disposisi', 'disposisi.id_surat = surat_masuk.id_surat')
            ->join('pegawai', 'disposisi.id_pegawai_penerima = pegawai.id_pegawai', "left")
            ->join('jabatan', 'pegawai.id_jabatan = jabatan.id_jabatan', "left")
            ->where('disposisi.id_surat', $id_surat)
            ->get('surat_masuk')->result();
    }

    public function get_disposisi_masuk($id_pegawai)
    {
        return $this->db
            ->where('id_pegawai_penerima', $id_pegawai)
            ->join('disposisi', 'disposisi.id_surat = surat_masuk.id_surat', "left")
            ->join('pegawai', 'disposisi.id_pegawai_pengirim = pegawai.id_pegawai', "left")
            ->join('jabatan', 'jabatan.id_jabatan = pegawai.id_jabatan', "left")
            ->get('surat_masuk')->result();
    }

    public function get_disposisi_keluar($id_surat)
    {
        return $this->db->join('disposisi', 'disposisi.id_surat = surat_masuk.id_surat')
            ->join('pegawai', 'disposisi.id_pegawai_penerima = pegawai.id_pegawai')
            ->join('jabatan', 'jabatan.id_jabatan = pegawai.id_jabatan')
            ->where('disposisi.id_pegawai_pengirim', $this->session->userdata('id_jabatan'))
            ->where('disposisi.id_surat', $id_surat)
            ->get('surat_masuk')->result();
    }

    public function get_all_disposisi_keluar()
    {
        return $this->db->join('disposisi', 'disposisi.id_surat = surat_masuk.id_surat')
            ->join('pegawai', 'disposisi.id_pegawai_penerima = pegawai.id_pegawai')
            ->join('jabatan', 'jabatan.id_jabatan = pegawai.id_jabatan')
            ->where('disposisi.id_pegawai_pengirim', $this->session->userdata('id_jabatan'))
            ->get('surat_masuk')->result();
    }

    public function get_surat_keputusan()
    {
        return $this->db->join('jabatan', 'jabatan.id_jabatan = surat_keputusan.bagian')
            ->get('surat_keputusan')->result();
    }

    public function get_surat_keluar()
    {
        return $this->db->get('surat_keluar')->result();
    }

    public function get_surat_masuk()
    {
        return $this->db->get('surat_masuk')->result();
    }

    public function get_role()
    {
        return $this->db->get('role')->result();
    }

    public function get_tamu()
    {
        return $this->db->get('tamu')->result();
    }

    public function get_pegawai()
    {
        return $this->db->join('jabatan', 'jabatan.id_jabatan = pegawai.id_jabatan')
            ->get('pegawai')->result();
    }

    public function get_surat_keputusan_by_id($id_surat)
    {
        return $this->db->where('id_surat', $id_surat)->get('surat_keputusan')
            ->row();
    }

    public function get_surat_keluar_by_id($id_surat)
    {
        return $this->db->where('id_surat', $id_surat)->get('surat_keluar')
            ->row();
    }

    public function get_surat_masuk_by_id($id_surat)
    {
        return $this->db->where('id_surat', $id_surat)->get('surat_masuk')
            ->row();
    }

    public function get_nama_file_surat_keputusan($id_surat)
    {
        return $this->db->where('id_surat', $id_surat)
            ->get('surat_keputusan')->row()->file_surat;
    }

    public function get_nama_file_surat_keluar($id_surat)
    {
        return $this->db->where('id_surat', $id_surat)
            ->get('surat_keluar')->row()->file_surat;
    }

    public function get_nama_file_surat_masuk($id_surat)
    {
        return $this->db->where('id_surat', $id_surat)
            ->get('surat_masuk')->row()->file_surat;
    }

    public function get_jabatan()
    {
        return $this->db->join('role', 'jabatan.role = role.id_role')
            ->get('jabatan')->result();
    }

    public function get_jabatan_by_role($id_role)
    {
        return $this->db->where('id_role', $id_role)
            ->get('jabatan')->result();
    }

    public function get_jabatan_koordinator()
    {
        return $this->db->join('role', 'jabatan.role = role.id_role')
            ->where('nama_role', 'KOORDINATOR')
            ->get('jabatan')->result();
    }

    public function get_pegawai_koordinator()
    {
        return $this->db
            ->join('jabatan', 'pegawai.id_jabatan = jabatan.id_jabatan')
            ->join('role', 'role.id_role = jabatan.role')
            ->where('nama_role', 'KOORDINATOR')
            ->get('pegawai')->result();
    }

    public function get_pegawai_by_jabatan($id_jabatan)
    {
        return $this->db->where('id_jabatan', $id_jabatan)
            ->get('pegawai')->result();
    }

    public function get_pegawai_by_id($id_pegawai)
    {
        return $this->db->where('id_pegawai', $id_pegawai)
            ->get('pegawai')
            ->row();
    }

    public function get_jabatan_by_id($id_jabatan)
    {
        return $this->db->where('id_jabatan', $id_jabatan)
            ->get('jabatan')
            ->row();
    }

    public function get_tamu_by_id($id_tamu)
    {
        return $this->db->where('id_tamu', $id_tamu)->get('tamu')
            ->row();
    }

    public function cek_status_surat_masuk($id_surat)
    {
        $query = $this->db->where('id_surat', $id_surat)
            ->get('surat_masuk')->row()->status;

        if ($query == 'proses') {
            return true;
        } else {
            return false;
        }
    }

    public function hapus_surat_keputusan($id_surat)
    {
        $this->db->where('id_surat', $id_surat)
            ->delete('surat_keputusan');

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function hapus_surat_keluar($id_surat)
    {
        $this->db->where('id_surat', $id_surat)
            ->delete('surat_keluar');

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function hapus_pegawai($id_pegawai)
    {
        $this->db->where('id_pegawai', $id_pegawai)
            ->delete('pegawai');

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function hapus_jabatan($id_jabatan)
    {
        $this->db->where('id_jabatan', $id_jabatan)
            ->delete('jabatan');

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function hapus_tamu($id_tamu)
    {
        $this->db->where('id_tamu', $id_tamu)
            ->delete('tamu');

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function hapus_surat_masuk($id_surat)
    {
        $this->db->where('id_surat', $id_surat)
            ->delete('surat_masuk');

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function hapus_disposisi($id_disposisi)
    {
        $this->db->where('id_disposisi', $id_disposisi)
            ->delete('disposisi');

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
