<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-green">
            <div class="panel-heading">
                <?php echo 'Daftar ' . $judul ?>&nbsp;&nbsp;
                <button class="btn btn-info" data-toggle="modal" data-target="#tambah_pegawai">
                    <i class="fa fa-envelope"></i> Tambah <?php echo $judul ?>
                </button>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Nama Pegawai</th>
                            <th>Jabatan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($data_pegawai)) : ?>
                            <?php foreach ($data_pegawai as $pegawai) : ?>
                                <tr>
                                    <td class="text-center" style="vertical-align: middle;"><?= $pegawai->username ?></td>
                                    <td class="text-center" style="vertical-align: middle;"><?= $pegawai->nama_pegawai ?></td>
                                    <td class="text-center" style="vertical-align: middle;"><?= $pegawai->nama_jabatan ?></td>
                                    <td class="text-center" style="vertical-align: left;">
                                        <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#ubah_pegawai" title="Ubah Data" onclick="ubah_pegawai(<?= $pegawai->id_pegawai ?>)">
                                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                        </button>
                                        <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#hapus_pegawai" title="Hapus Data" onclick="hapus_pegawai(<?= $pegawai->id_pegawai ?>)">
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
<div class="modal fade" id="tambah_pegawai" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" action="<?php echo base_url('home/tambah_pegawai') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title text-center" id="myModalLabel">Tambah <?php echo $judul ?></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>username </label>
                        <input class="form-control" type="text" name="username" required>
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input class="form-control" type="text" name="nama_pegawai" required>
                    </div>
                    <div class="form-group">
                        <label>Jabatan</label>
                        <select class="form-control" name="id_jabatan" onchange="get_pegawai_id_by_jabatan(this.value)">
                            <option value="">-- Pilih Jabatan --</option>
                            <?php
                            if (isset($drop_down_jabatan)) {
                                foreach ($drop_down_jabatan as $jabatan) {

                                    echo '<option value="' . $jabatan->id_jabatan . '">' . $jabatan->nama_jabatan . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input class="form-control" type="password" name="password" required>
                    </div>
                </div>
                <div class="modal-footer"><button type="button" class="btn btn-info" data-dismiss="modal">Tutup</button><input type="submit" value="Tambah <?php echo $judul ?>" name="submit" class="btn btn-success"></div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="hapus_pegawai">
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

<div class="modal fade" id="ubah_pegawai" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" action="<?php echo base_url('home/ubah_pegawai') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title text-center" id="myModalLabel">Edit <?php echo $judul ?></h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="ubah_id_pegawai" id="ubah_id_pegawai">
                    <div class="form-group">
                        <label>username </label>
                        <input class="form-control" type="text" name="ubah_username" id="ubah_username" required>
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input class="form-control" type="text" name="ubah_nama_pegawai" id="ubah_nama_pegawai" required>
                    </div>
                    <div class="form-group">
                        <label>Jabatan</label>
                        <select class="form-control" name="ubah_id_jabatan" onchange="get_pegawai_id_by_jabatan(this.value)">
                            <option value="">-- Pilih Jabatan --</option>
                            <?php
                            if (isset($drop_down_jabatan)) {
                                foreach ($drop_down_jabatan as $jabatan) {

                                    echo '<option value="' . $jabatan->id_jabatan . '">' . $jabatan->nama_jabatan . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group"><label>Password</label><input class="form-control" type="password" name="ubah_password" id="ubah_password" required></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Tutup</button>
                    <input type="submit" value="Ubah <?php echo $judul ?>" name="submit" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function hapus_pegawai(id_pegawai) {
        const url = "<?= base_url('home/hapus_pegawai/') ?>"
        $('#deleteBtn').attr("href", url + id_pegawai);
    }
</script>

<script>
    function ubah_pegawai(id_pegawai) {
        $('#ubah_id_pegawai').empty();
        $('#ubah_username').empty();
        $('#ubah_nama_pegawai').empty();
        $('#ubah_id_jabatan').empty();
        $('#ubah_password').empty();

        $.getJSON('<?php echo base_url('home/get_pegawai_by_id/') ?>' + id_pegawai, function(data) {
                $('#ubah_id_pegawai').val(data.id_pegawai);
                $('#ubah_username').val(data.username);
                $('#ubah_nama_pegawai').val(data.nama_pegawai);
                $('#ubah_password').val(data.password);
            }

        )
    }
</script>