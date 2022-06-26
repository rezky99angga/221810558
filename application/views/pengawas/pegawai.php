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
                            <th>Username</th>
                            <th>Nama Pegawai</th>
                            <th>Jabatan</th>

                        </tr>
                    </thead>
                    <tbody><?php if (isset($data_pegawai)) : ?>
                            <?php foreach ($data_pegawai as $pegawai) : ?>
                                <tr>
                                    <td class="text-center" style="vertical-align: middle;"><?= $pegawai->username ?></td>
                                    <td class="text-center" style="vertical-align: middle;"><?= $pegawai->nama_pegawai ?></td>
                                    <td class="text-center" style="vertical-align: middle;"><?= $pegawai->nama_jabatan ?></td>

                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
                <!-- < !-- /.table-responsive -->
            </div>
            <!-- < !-- /.panel-body -->
        </div>
        <!-- < !-- /.panel -->
    </div>
    <!-- < !-- /.col-lg-12 -->
</div>
<!-- < !-- /.row -->