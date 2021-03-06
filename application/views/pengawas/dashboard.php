<div class="row">
    <div class="col-lg-6 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-envelope fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $jumlah_surat['surat_masuk'] ?></div>
                        <div>Jumlah Surat Masuk</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo base_url('home/surat_masuk') ?>">
                <div class="panel-footer">
                    <span class="pull-left">Daftar Surat Masuk</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-6 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-envelope fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $jumlah_surat['surat_keluar'] ?></div>
                        <div>Jumlah Surat Keluar</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo base_url('home/surat_keluar') ?>">
                <div class="panel-footer">
                    <span class="pull-left">Daftar Surat Keluar</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-6 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-envelope fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $jumlah_surat['surat_keputusan'] ?></div>
                        <div>Jumlah Surat Keputusan</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo base_url('home/surat_keputusan') ?>">
                <div class="panel-footer">
                    <span class="pull-left">Daftar Surat Keputusan</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-6 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-users fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $jumlah_surat['pegawai'] ?></div>
                        <div>Jumlah Pegawai</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo base_url('home/pegawai') ?>">
                <div class="panel-footer">
                    <span class="pull-left">Daftar Pegawai</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-lg-6 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-tasks fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $jumlah_surat['jabatan'] ?></div>
                        <div>Jumlah Jabatan</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo base_url('home/jabatan') ?>">
                <div class="panel-footer">
                    <span class="pull-left">Daftar Jabatan</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-lg-6 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $jumlah_surat['tamu'] ?></div>
                        <div>Jumlah Tamu</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo base_url('home/tamu') ?>">
                <div class="panel-footer">
                    <span class="pull-left">Daftar Tamu</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

</div>
<!-- /.row -->