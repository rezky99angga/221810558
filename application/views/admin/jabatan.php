<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-green">
            <div class="panel-heading">
                <?php echo 'Daftar ' . $judul ?>&nbsp;&nbsp;
                <button class="btn btn-info" data-toggle="modal" data-target="#tambah_jabatan">
                    <i class="fa fa-envelope"></i> Tambah <?php echo $judul ?>
                </button>
            </div>
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>Nama Jabatan</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($data_jabatan)) : ?>
                            <?php foreach ($data_jabatan as $jabatan) : ?>
                                <tr>
                                    <td class="text-center" style="vertical-align: middle;"><?= $jabatan->nama_jabatan ?></td>
                                    <td class="text-center" style="vertical-align: middle;"><?= $jabatan->nama_role ?></td>
                                    <td class="text-center" style="vertical-align: left;">
                                        <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#ubah_jabatan" title="Ubah Data" onclick="ubah_jabatan(<?= $jabatan->id_jabatan ?>)">
                                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                        </button>
                                        <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#hapus_jabatan" title="Hapus Data" onclick="hapus_jabatan(<?= $jabatan->id_jabatan ?>)">
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

<div class="modal fade" id="tambah_jabatan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" action="<?php echo base_url('home/tambah_jabatan') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title text-center" id="myModalLabel">Tambah <?php echo $judul ?></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Jabatan</label>
                        <input class="form-control" type="text" name="nama_jabatan" required>
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select class="form-control" name="role" onchange="get_jabatan_id_by_role(this.value)">
                            <option value="">-- Pilih Role --</option>
                            <?php
                            if (isset($drop_down_role)) {
                                foreach ($drop_down_role as $role) {
                                    echo '<option value="' . $role->id_role . '">' . $role->nama_role . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer"><button type="button" class="btn btn-info" data-dismiss="modal">Tutup</button><input type="submit" value="Tambah <?php echo $judul ?>" name="submit" class="btn btn-success"></div>
            </form>
        </div>
        <!-- < !-- /.modal-content -->
    </div>
    <!-- < !-- /.modal-dialog -->
</div>

<div class="modal fade" id="ubah_jabatan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" action="<?php echo base_url('home/ubah_jabatan') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title text-center" id="myModalLabel">Edit <?php echo $judul ?></h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="ubah_id_jabatan" id="ubah_id_jabatan">

                    <div class="form-group">
                        <label>Nama Jabatan</label>
                        <input class="form-control" type="text" name="ubah_nama_jabatan" id="ubah_nama_jabatan" required>
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select class="form-control" name="ubah_role" onchange="get_jabatan_id_by_role(this.value)">
                            <option value="">-- Pilih Role --</option>
                            <?php
                            if (isset($drop_down_role)) {
                                foreach ($drop_down_role as $role) {

                                    echo '<option value="' . $role->id_role . '">' . $role->nama_role . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer"><button type="button" class="btn btn-info" data-dismiss="modal">Tutup</button>
                    <input type="submit" value="Ubah <?php echo $judul ?>" name="submit" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="hapus_jabatan">
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
    function hapus_jabatan(id_pegawai) {
        const url = "<?= base_url('home/hapus_jabatan/') ?>"
        $('#deleteBtn').attr("href", url + id_pegawai);
    }
</script>

<script>
    function ubah_jabatan(id_jabatan) {
        $('#ubah_id_jabatan').empty();
        $('#ubah_nama_jabatan').empty();
        $('#ubah_role').empty();

        $.getJSON('<?php echo base_url('home/get_jabatan_by_id/') ?>' + id_jabatan, function(data) {
                $('#ubah_id_jabatan').val(data.id_jabatan);
                $('#ubah_nama_jabatan').val(data.nama_jabatan);
                $('#ubah_role').val(data.role);

            }

        )
    }
</script>