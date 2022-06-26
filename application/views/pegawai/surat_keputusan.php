<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php echo 'Daftar ' . $judul ?>&nbsp;&nbsp;
                <button class="btn btn-info" data-toggle="modal" data-target="#tambah_surat_keputusan">
                    <i class="fa fa-envelope"></i> Tambah <?php echo $judul ?>
                </button>
            </div>
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>Nomor Surat</th>
                            <th>Tanggal Surat</th>
                            <th>Perihal</th>
                            <th>Bagian</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($data_surat_keputusan)) : ?>
                            <?php foreach ($data_surat_keputusan as $surat_keputusan) : ?>
                                <tr>
                                    <td class="text-center" style="vertical-align: middle;"><?= $surat_keputusan->nomor_surat ?></td>
                                    <td class="text-center" style="vertical-align: middle;"><?= $surat_keputusan->tgl_surat ?></td>
                                    <td class="text-center" style="vertical-align: middle;"><?= $surat_keputusan->perihal ?></td>
                                    <td class="text-center" style="vertical-align: middle;"><?= $surat_keputusan->nama_jabatan ?></td>
                                    <td class="text-center" style="vertical-align: middle;">
                                        <a href="<?= base_url('/uploads/' . $surat_keputusan->file_surat) ?>" title="Lihat Surat" class="btn btn-sm btn-info">
                                            <span class=" glyphicon glyphicon-file" aria-hidden="true"></span>
                                        </a>
                                        <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#ubah_surat_keputusan" title="Ubah Data" onclick="ubah_surat(<?= $surat_keputusan->id_surat ?>)">
                                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                        </button>
                                        <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#ubah_file_surat_keputusan" title="Ubah Surat" onclick="ubah_surat(<?= $surat_keputusan->id_surat ?>)">
                                            <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                                        </button>
                                        <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#hapus_surat_keputusan" title="Hapus Data" onclick="hapus_surat(<?= $surat_keputusan->id_surat ?>)">
                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="tambah_surat_keputusan" tabindex="-1" role="dialog" aria-labelledby="tambah_surat_keputusan" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" action="<?php echo base_url('home/tambah_surat_keputusan') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title text-center" id="myModalLabel">Tambah <?php echo $judul ?></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nomor Surat </label>
                        <input class="form-control" type="text" name="nomor_surat" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Surat</label>
                        <input class="form-control" type="date" name="tgl_surat" required>
                    </div>
                    <div class="form-group">
                        <label>Perihal</label>
                        <textarea class="form-control" rows="1" name="perihal" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Bagian</label>
                        <select class="form-control" name="bagian" onchange="get_pegawai_id_by_jabatan(this.value)">
                            <option value="">-- Pilih Bagian --</option>
                            <?php
                            if (isset($drop_down_jabatan)) {
                                foreach ($drop_down_jabatan as $jabatan) {

                                    echo '<option value="' . $jabatan->id_jabatan . '">' . $jabatan->nama_jabatan . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <!-- <div class="form-group">
                        <label>Bagian</label>
                        <input class="form-control" type="text" name="bagian" required>
                    </div> -->
                    <div class="form-group">
                        <label>File Surat</label>
                        <input class="form-control" type="file" accept="application/pdf" name="file_surat" required>
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

<div class="modal fade" id="ubah_surat_keputusan" tabindex="-1" role="dialog" aria-labelledby="ubah_surat_keputusan" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" action="<?php echo base_url('home/ubah_surat_keputusan') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title text-center" id="myModalLabel">Ubah <?php echo $judul ?></h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="ubah_id_surat" id="ubah_id_surat">
                    <div class="form-group">
                        <label>Nomor Surat </label>
                        <input class="form-control" type="text" name="ubah_nomor_surat" id="ubah_nomor_surat" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Surat</label>
                        <input class="form-control" type="date" name="ubah_tgl_surat" id="ubah_tgl_surat" required>
                    </div>
                    <div class="form-group">
                        <label>Perihal</label>
                        <textarea class="form-control" rows="1" name="ubah_perihal" id="ubah_perihal" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Bagian</label>
                        <select class="form-control" name="bagian" onchange="get_pegawai_id_by_jabatan(this.value)">
                            <option value="">-- Pilih Bagian --</option>
                            <?php
                            if (isset($drop_down_jabatan)) {
                                foreach ($drop_down_jabatan as $jabatan) {

                                    echo '<option value="' . $jabatan->id_jabatan . '">' . $jabatan->nama_jabatan . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Tutup</button>
                    <input type="submit" value="Ubah <?php echo $judul ?>" name="submit" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="ubah_file_surat_keputusan" tabindex="-1" role="dialog" aria-labelledby="ubah_file_surat_keputusan" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" action="<?php echo base_url('home/ubah_file_surat_keputusan') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title text-center" id="myModalLabel">Ubah File <?php echo $judul ?></h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="ubah_file_surat" id="ubah_file_surat">
                    <div class="form-group">
                        <label>File Surat</label>
                        <input class="form-control" type="file" accept="application/pdf" name="ubah_file_surat" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Tutup</button>
                    <input type="submit" value="Ubah File <?php echo $judul ?>" name="submit" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="hapus_surat_keputusan">
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
    function hapus_surat(id_surat) {
        const url = "<?= base_url('home/hapus_surat_keputusan/') ?>"
        $('#deleteBtn').attr("href", url + id_surat);
    }
</script>


<script>
    function ubah_surat(id_surat) {
        $('#ubah_id_surat').empty();
        $('#ubah_nomor_surat').empty();
        $('#ubah_tgl_surat').empty();
        $('#ubah_perihal').empty();
        $('#ubah_bagian').empty();
        $('#ubah_file_surat').empty();

        $.getJSON('<?php echo base_url('home/get_surat_keputusan_by_id/') ?>' + id_surat, function(data) {
            $('#ubah_id_surat').val(data.id_surat);
            $('#ubah_nomor_surat').val(data.nomor_surat);
            $('#ubah_tgl_surat').val(data.tgl_surat);
            $('#ubah_perihal').val(data.perihal);
            $('#ubah_bagian').val(data.bagian);
            $('#ubah_file_surat').val(data.id_surat);
        })
    }
</script>