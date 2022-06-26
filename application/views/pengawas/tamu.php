<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-red">
            <div class="panel-heading">
                <?php echo 'Daftar ' . $judul ?>&nbsp;&nbsp;
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>Nama Tamu</th>
                            <th>Tanggal Masuk</th>
                            <th>Alamat</th>
                            <th>Keperluan</th>
                            <th>Suhu (C)</th>
                        </tr>
                    </thead>
                    <tbody><?php
                            if (isset($data_tamu)) {
                                foreach ($data_tamu as $tamu) {
                                    echo '
                            <tr>
                                <td class="text-center" style="vertical-align: middle;">' . $tamu->nama_tamu . '</td>
                                <td class="text-center" style="vertical-align: middle;">' . $tamu->tgl_masuk . '</td>
                                <td class="text-center" style="vertical-align: middle;">' . $tamu->alamat . '</td>
                                <td class="text-center" style="vertical-align: middle;">' . $tamu->keperluan . '</td>
                                <td class="text-center" style="vertical-align: middle;">' . $tamu->suhu . '</td>
                            </tr>
                            ';
                                }
                            }
                            ?></tbody>
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