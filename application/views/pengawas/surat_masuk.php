<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php echo 'Daftar ' . $judul ?>&nbsp;&nbsp;

            </div>
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>Nomor Surat</th>
                            <th>Tanggal Kirim</th>
                            <th>Tanggal Terima</th>
                            <th>Pengirim</th>
                            <th>Perihal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($data_surat_masuk)) : ?>
                            <?php foreach ($data_surat_masuk as $surat_masuk) : ?>
                                <tr>
                                    <td class="text-center" style="vertical-align: middle;"><?= $surat_masuk->nomor_surat ?></td>
                                    <td class="text-center" style="vertical-align: middle;"><?= $surat_masuk->tgl_kirim ?></td>
                                    <td class="text-center" style="vertical-align: middle;"><?= $surat_masuk->tgl_terima ?></td>
                                    <td class="text-center" style="vertical-align: middle;"><?= $surat_masuk->pengirim ?></td>
                                    <td class="text-center" style="vertical-align: middle;"><?= $surat_masuk->perihal ?></td>
                                    <td class="text-center" style="vertical-align: left;">
                                        <a href="<?= base_url('/uploads/' . $surat_masuk->file_surat) ?>" title="Lihat Surat" class="btn btn-sm btn-info">
                                            <span class="glyphicon glyphicon-file" aria-hidden="true"></span>
                                        </a>
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