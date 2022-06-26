<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-green">
            <div class="panel-heading">
                <?php echo 'Daftar ' . $judul ?>&nbsp;&nbsp;
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>Nama Jabatan</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody> <?php if (isset($data_jabatan)) : ?>
                            <?php foreach ($data_jabatan as $jabatan) : ?>
                                <tr>
                                    <td class="text-center" style="vertical-align: middle;"><?= $jabatan->nama_jabatan ?></td>
                                    <td class="text-center" style="vertical-align: middle;"><?= $jabatan->nama_role ?></td>

                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>