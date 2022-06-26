<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php echo 'Daftar ' . $judul ?>
                <?php
                if ($this->uri->segment(3) == null) {
                } else if ($this->HomeModel->cek_status_surat_masuk($this->uri->segment(3)) == true) {
                    echo '
                    &nbsp;&nbsp;
                    <button class="btn btn-success" data-toggle="modal" data-target="#tambah_surat_masuk">
                        <i class="fa fa-envelope"></i> Tambah ' . $judul . '
                    </button>&nbsp;&nbsp;
                    ';
                } else {
                    echo '<b style="color: white">(DISPOSISI SELESAI)</b>';
                }
                ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tujuan Unit</th>
                            <th>Tujuan Pegawai</th>
                            <th>Tanggal Disposisi</th>
                            <th>Keterangan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($data_disposisi_keluar)) {
                            $no = 0;
                            foreach ($data_disposisi_keluar as $disposisi_keluar) {
                                echo '
                            <tr>
                                <td class="text-center" style="vertical-align: middle;">' . ++$no . '</td>
                                <td class="text-center" style="vertical-align: middle;">' . $disposisi_keluar->nama_jabatan . '</td>
                                <td class="text-center" style="vertical-align: middle;">' . $disposisi_keluar->nama_pegawai . '</td>
                                <td class="text-center" style="vertical-align: middle;">' . $disposisi_keluar->tgl_disposisi . '</td>
                                <td class="text-center" style="vertical-align: middle;">' . $disposisi_keluar->keterangan . '</td>
                                <td class="text-center" style="vertical-align: middle;">
                                    <a href="' . base_url('/uploads/' . $disposisi_keluar->file_surat) . '"title="Lihat Surat" class="btn btn-sm btn-success">
                                         <span class=" glyphicon glyphicon-file" aria-hidden="true"></span>
                                    </a>
                                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#hapus_disposisi_pegawai" title="Hapus Data" onclick="hapus_disposisi_pegawai(<?= $disposisi_keluar->id_surat ?>)">
                                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                    </button>
                                </td>
                            </tr>
                            ';
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="tambah_surat_masuk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" action="<?php echo base_url('home/tambah_disposisi_pegawai/' . $this->uri->segment(3)) ?>" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title text-center" id="myModalLabel">Tambah <?php echo $judul ?></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tujuan Unit</label>
                        <select class="form-control" name="tujuan_unit" onchange="get_pegawai_id_by_jabatan(this.value)">
                            <option value="">-- Pilih Tujuan Unit --</option>
                            <?php
                            if (isset($drop_down_jabatan)) {
                                foreach ($drop_down_jabatan as $jabatan) {
                                    if ($jabatan->id_jabatan != $this->session->userdata('id_jabatan')) {
                                        echo '<option value="' . $jabatan->id_jabatan . '">' . $jabatan->nama_jabatan . '</option>';
                                    }
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tujuan Pegawai</label>
                        <select class="form-control" name="tujuan_pegawai" id="tujuan_pegawai">
                            <option value="">-- Pilih Nama Pegawai --</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea class="form-control" name="keterangan" rows="5"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Tutup</button>
                    <input type="submit" value="Tambah <?php echo $judul ?>" name="submit" class="btn btn-success">
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="hapus_disposisi_pegawai">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- header-->
            <div class="modal-header">
                <button class="close" data-dismiss="modal"><span>&times;</span></button>
                <h4 class="modal-title">Hapus Data</h4>
            </div>
            <!--body-->
            <div class="modal-body">
                Apakah yakin akan menghapus data?
            </div>
            <!--footer-->
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <a id="deleteBtn" class="btn btn-danger">Yakin</a>
            </div>
        </div>
    </div>
</div>

<script>
    function hapus_disposisi_keluar(id_disposisi) {
        const url = "<?= base_url('home/hapus_disposisi_pegawai/') ?>"
        $('#deleteBtn').attr("href", url + id_disposisi);
    }
</script>

<script>
    function get_pegawai_id_by_jabatan(id_jabatan) {
        $('#tujuan_pegawai').empty();
        $.getJSON('<?php echo base_url('home/get_pegawai_by_jabatan/') ?>' + id_jabatan, function(data) {
            $('#tujuan_pegawai').append('<option value="">-- Pilih Nama Pegawai --</option>');
            $.each(data, function(index, value) {
                $('#tujuan_pegawai').append('<option value="' + value.id_pegawai + '">' + value.nama_pegawai + '</option>');
            })
        })
    }
</script>