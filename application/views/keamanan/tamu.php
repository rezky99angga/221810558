<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-red">
            <div class="panel-heading">
                <?php echo 'Daftar ' . $judul ?>&nbsp;&nbsp;
                <button class="btn btn-info" data-toggle="modal" data-target="#tambah_tamu">
                    <i class="fa fa-envelope"></i> Tambah <?php echo $judul ?>
                </button>
            </div>
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>Nama Tamu</th>
                            <th>Tanggal Masuk</th>
                            <th>Alamat</th>
                            <th>Keperluan</th>
                            <th>Suhu (C)</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($data_tamu)) : ?>
                            <?php foreach ($data_tamu as $tamu) : ?>
                                <tr>
                                    <td class="text-center" style="vertical-align: middle;"><?= $tamu->nama_tamu ?></td>
                                    <td class="text-center" style="vertical-align: middle;"><?= $tamu->tgl_masuk ?></td>
                                    <td class="text-center" style="vertical-align: middle;"><?= $tamu->alamat ?></td>
                                    <td class="text-center" style="vertical-align: middle;"><?= $tamu->keperluan ?></td>
                                    <td class="text-center" style="vertical-align: middle;"><?= $tamu->suhu ?></td>
                                    <td class="text-center" style="vertical-align: left;">
                                        <button class=" btn btn-sm btn-success" data-toggle="modal" data-target="#ubah_tamu" title="Ubah Data" onclick="ubah_tamu(<?= $tamu->id_tamu ?>)">
                                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                        </button>
                                        <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#hapus_tamu" title="Hapus Data" onclick="hapus_tamu(<?= $tamu->id_tamu ?>)">
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

<div class="modal fade" id="tambah_tamu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" action="<?php echo base_url('home/tambah_tamu') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title text-center" id="myModalLabel">Tambah <?php echo $judul ?></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Tamu </label>
                        <input class="form-control" type="text" name="nama_tamu" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Masuk</label>
                        <input class="form-control" type="date" name="tgl_masuk" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input class="form-control" type="paragraph" name="alamat" required>
                    </div>
                    <div class="form-group">
                        <label>Keperluan</label>
                        <input class="form-control" type="paragraph" name="keperluan" required>
                    </div>
                    <div class="form-group">
                        <label>Suhu (C)</label>
                        <input class="form-control" type="number" name="suhu" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Tutup</button>
                    <input type="submit" value="Tambah <?php echo $judul ?>" name="submit" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="ubah_tamu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" action="<?php echo base_url('home/ubah_tamu') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title text-center" id="myModalLabel">Edit <?php echo $judul ?></h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="ubah_id_tamu" id="ubah_id_tamu">
                    <div class="form-group">
                        <label>Nama Tamu </label>
                        <input class="form-control" type="text" name="ubah_nama_tamu" id="ubah_nama_tamu" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Masuk</label>
                        <input class="form-control" type="date" name="ubah_tgl_masuk" id="ubah_tgl_masuk" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input class="form-control" type="paragraph" name="ubah_alamat" id="ubah_alamat" required>
                    </div>
                    <div class="form-group">
                        <label>Keperluan</label>
                        <input class="form-control" type="paragraph" name="ubah_keperluan" id="ubah_keperluan" required>
                    </div>
                    <div class="form-group">
                        <label>Suhu (C)</label>
                        <input class="form-control" type="number" name="ubah_suhu" id="ubah_suhu" required></textarea>
                    </div>
                </div>
                <div class="modal-footer"><button type="button" class="btn btn-info" data-dismiss="modal">Tutup</button><input type="submit" value="Ubah <?php echo $judul ?>" name="submit" class="btn btn-success"></div>
            </form>
        </div>
        <!-- < !-- /.modal-content -->
    </div>
    <!-- < !-- /.modal-dialog -->
</div>

<div class="modal fade" id="hapus_tamu">
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
    function hapus_tamu(id_tamu) {
        const url = "<?= base_url('home/hapus_tamu/') ?>"
        $('#deleteBtn').attr("href", url + id_tamu);
    }
</script>

<script>
    function ubah_tamu(id_tamu) {
        $('#ubah_id_tamu').empty();
        $('#ubah_nama_tamu').empty();
        $('#ubah_tgl_masuk').empty();
        $('#ubah_alamat').empty();
        $('#ubah_keperluan').empty();
        $('#ubah_suhu').empty();

        $.getJSON('<?php echo base_url('home/get_tamu_by_id/') ?>' + id_tamu, function(data) {
                $('#ubah_id_tamu').val(data.id_tamu);
                $('#ubah_nama_tamu').val(data.nama_tamu);
                $('#ubah_tgl_masuk').val(data.tgl_masuk);
                $('#ubah_alamat').val(data.alamat);
                $('#ubah_keperluan').val(data.keperluan);
                $('#ubah_suhu').val(data.suhu);

            }

        )
    }
</script>