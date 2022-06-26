<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php echo 'Daftar ' . $judul ?>&nbsp;&nbsp;

            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>Nomor Surat</th>
                            <th>Tanggal Kirim</th>
                            <th>Tujuan</th>
                            <th>Perihal</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($data_surat_keluar)) : ?>
                            <?php foreach ($data_surat_keluar as $surat_keluar) : ?>
                                <tr>
                                    <td class="text-center" style="vertical-align: middle;"><?= $surat_keluar->nomor_surat ?></td>
                                    <td class="text-center" style="vertical-align: middle;"><?= $surat_keluar->tgl_kirim ?></td>
                                    <td class="text-center" style="vertical-align: middle;"><?= $surat_keluar->tujuan ?></td>
                                    <td class="text-center" style="vertical-align: middle;"><?= $surat_keluar->perihal ?></td>
                                    <td class="text-center" style="vertical-align: left;">
                                        <a href="<?= base_url('uploads/' . $surat_keluar->file_surat) ?>" title="Lihat Surat" class="btn btn-info btn-sm">
                                            <span class=" glyphicon glyphicon-file" aria-hidden="true"></span>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
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