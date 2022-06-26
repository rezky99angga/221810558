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