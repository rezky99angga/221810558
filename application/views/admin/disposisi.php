<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <?php echo 'Daftar ' . $judul ?>
                <?php
                if ($this->HomeModel->cek_status_surat_masuk($this->uri->segment(3)) == true) {
                    echo '
                    &nbsp;&nbsp;
                    <button class="btn btn-success" data-toggle="modal" data-target="#tambah_surat_masuk">
                        <i class="fa fa-envelope"></i> Tambah ' . $judul . '
                    </button>&nbsp;&nbsp;
                    
                    ';
                } else {
                    echo '<b style="color: green">(DISPOSISI SELESAI)</b>';
                }
                ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Jabatan Penerima</th>
                            <th>Nama Penerima</th>
                            <th>Tanggal Disposisi</th>
                            <th>Keterangan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($data_disposisi)) :?>
			<?php foreach ($data_disposisi as  $idx => $disposisi) :?>
                            <tr>
                                <td class="text-center" style="vertical-align: middle;"><?= ($idx + 1) ?></td>
                                <td class="text-center" style="vertical-align: middle;"><?= $disposisi->nama_jabatan ?></td>
                                <td class="text-center" style="vertical-align: middle;"><?= $disposisi->nama_pegawai ?></td>
                                <td class="text-center" style="vertical-align: middle;"><?= $disposisi->tgl_disposisi ?></td>
                                <td class="text-center" style="vertical-align: middle;"><?= $disposisi->keterangan ?></td>
                                <td class="text-center" style="vertical-align: middle;">
                                   <a href="<?= base_url('/uploads/' . $disposisi->file_surat) ?>" class="btn btn-sm btn-success" title="Lihat Surat">
                                   	<span class=" glyphicon glyphicon-file" aria-hidden="true"></span>
                                   </a>
                                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#hapus_disposisi" title="Hapus Data" onclick="hapus_disposisi(<?= $disposisi->id_disposisi ?>)">
                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                    </button>
                                </td>
                            </tr>
                         <?php endforeach ;?>
                         <?php endif ;?>
                    </tbody>
                </table>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<div class="modal fade" id="tambah_surat_masuk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" action="<?php echo base_url('home/tambah_disposisi/' . $this->uri->segment(3)) ?>" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title text-center" id="myModalLabel">Tambah <?php echo $judul ?></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tujuan Unit</label>
                        <select class="form-control" name="tujuan_unit" onchange="get_jabatan_koordinator(this.value)">
                            <option value="">-- Pilih Tujuan Unit --</option>
                            <?php if (isset($drop_down_jabatan_koordinator)) : ?>
                                <?php foreach ($drop_down_jabatan_koordinator as $jabatan) : ?>
                                    <?php if ($jabatan->id_jabatan != $this->session->userdata('id_jabatan')) : ?>
                                        <option value="<?= $jabatan->id_jabatan ?>"><?= $jabatan->nama_jabatan ?>
                                        </option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tujuan Pegawai</label>
                        <select class="form-control" name="tujuan_pegawai" onchange="get_pegawai_koordinator(this.value)">
                            <option value="">-- Pilih Tujuan Pegawai --</option>
                            <?php if (isset($drop_down_pegawai_koordinator)) : ?>
                                <?php foreach ($drop_down_pegawai_koordinator as $pegawai) : ?>
                                    <?php if ($pegawai->id_pegawai != $this->session->userdata('id_pegawai')) : ?>
                                        <option value="<?= $pegawai->id_pegawai ?>"><?= $pegawai->nama_pegawai ?>
                                        </option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
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

<div class="modal fade" id="hapus_disposisi">
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
    function hapus_disposisi(id_disposisi) {
        const url = "<?= base_url('home/hapus_disposisi/' . $disposisi->id_disposisi . '/' . $disposisi->id_surat) ?>"
        $('#deleteBtn').attr("href", url);
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