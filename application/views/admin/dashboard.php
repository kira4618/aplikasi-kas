<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control Panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('index.php/admin/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Home</li>
        </ol>
    </section>
    <?php
    date_default_timezone_set('Asia/Jakarta');
    ?>
    <section class="content">
        <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="ion ion-ios-cloud-download-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Pemasukan</span>
                        <span class="info-box-number">
                            <h3>
                                <?php
                                $pemasukan = $this->db->query('SELECT id, SUM(jumlah) AS total FROM tb_kas  WHERE jenis_kas="Pemasukan"')->row_array();
                                echo "Rp." . number_format($pemasukan['total'], 0, ',', '.');
                                ?>
                            </h3>
                        </span>
                    </div>

                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="ion ion-ios-cloud-upload-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Pemasukan</span>
                        <span class="info-box-number">
                            <h3>
                                <?php
                                $pengeluaran = $this->db->query('SELECT id, SUM(jumlah) AS total FROM tb_kas  WHERE jenis_kas="Pengeluaran"')->row_array();
                                echo "Rp." . number_format($pengeluaran['total'], 0, ',', '.');
                                ?>
                            </h3>
                        </span>
                    </div>

                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="ion ion-ios-cloud-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Sisa Saldo</span>
                        <span class="info-box-number">
                            <h3>
                                <?php

                                // echo $pemasukan - $pengeluaran;
                                echo "Rp." . number_format($pemasukan['total'] - $pengeluaran['total'], 0, ',', '.');
                                ?>
                            </h3>
                        </span>
                    </div>

                </div>
            </div>

            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">Data Kas Bayar Bulan Ini (<?= date('F Y') ?>)</h4>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable">
                                <thead>
                                    <tr>
                                        <th width="10px">#</th>
                                        <th>Tanggal</th>
                                        <th>Jenis Kas</th>
                                        <th>Jumlah</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($kas->result_array() as $row) {
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $row['tanggal'] ?></td>
                                            <td>
                                                <?php if ($row['jenis_kas'] == 'Pemasukan') { ?>
                                                    <div class="label label-success">
                                                        <?= $row['jenis_kas'] ?>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="label label-danger">
                                                        <?= $row['jenis_kas'] ?>
                                                    </div>
                                                <?php } ?>
                                            </td>
                                            <td>Rp. <?= number_format($row['jumlah'], 0, ',', '.') ?></td>
                                            <td><?= $row['keterangan'] ?></td>

                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </section>
</div>