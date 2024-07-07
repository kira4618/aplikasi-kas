<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <?= $title ?>
            <small><?= $subtitle ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('index.php/admin/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><?= $title ?></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">Informasi Siswa</h4>
                        <button class="btn btn-primary btn-sm pull-right" onclick="history.back(-1)">
                            <div class="fa fa-arrow-left"></div> Kembali
                        </button>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <?php foreach ($siswa->result_array() as $dSiswa) { ?>
                                    <tr>
                                        <td>NISN</td>
                                        <td>:</td>
                                        <td><?= $dSiswa['nisn'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nama</td>
                                        <td>:</td>
                                        <td><?= $dSiswa['nama'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>:</td>
                                        <td><?= $dSiswa['alamat'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Telpon</td>
                                        <td>:</td>
                                        <td><?= $dSiswa['no_telpon'] ?></td>
                                    </tr>

                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">Riwayat Pembayaran</h4>
                        <button class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#tambahData">
                            <div class="fa fa-plus"></div> Tambah Data
                        </button>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover" id="dataTable">
                                <thead>
                                    <tr>
                                        <th width="10px">#</th>
                                        <th>Tanggal</th>
                                        <th>Petugas</th>
                                        <th>Bayar</th>
                                        <th>Pembayaran</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($pembayaran->result_array() as $row) {
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= date('d F Y', strtotime($row['tgl_bayar'])) ?></td>
                                            <td>
                                                <?php
                                                $this->db->where('id', $row['id_user']);
                                                foreach ($this->db->get('tb_user')->result() as $dUser) {
                                                    echo $dUser->nama;
                                                }
                                                ?>
                                            </td>
                                            <td> <?= 'Bulan ' . $row['bulan_bayar'] . ' Rp. ' . number_format($row['jumlah_bayar'], 0, ',', '.') ?></td>
                                            <td>
                                                <?php
                                                $this->db->where('id', $row['id_spp']);
                                                foreach ($this->db->get('tb_spp')->result() as $dSpp) {
                                                    echo 'Tahun: ' . $dSpp->tahun . ' Nominal: ' . number_format($dSpp->nominal);
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#editData<?= $row['id'] ?>">
                                                    <div class="fa fa-edit"></div> Edit
                                                </button>
                                                <a href="<?= base_url('index.php/admin/pembayaran/delete/') . $row['id'] . '/' . $id_siswa ?>" class="btn btn-danger btn-xs tombol-yakin" data-isidata="Ingin menghapus data pembayaran ini?">
                                                    <div class="fa fa-trash"></div> Delete
                                                </a>
                                            </td>
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

<!-- Modal Tambah Data -->
<div class="modal fade" id="tambahData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah Pembayaran</h4>
            </div>
            <form action="<?= base_url('index.php/admin/pembayaran/insert/') . $id_siswa ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                        <input type="date" name="tgl_bayar" class="form-control" placeholder="Tanggal" required>
                    </div>

                    <div class="form-group">
                        <label>SPP</label>
                        <select name="id_spp" class="select2" style="width: 100%" required>
                            <option value="" disabled selected>-- Pilih SPP --</option>
                            <?php foreach ($spp->result_array() as $a) { ?>
                                <option value="<?= $a['id'] ?>"><?= $a['tahun'] . ' - Rp. ' . number_format($a['nominal'], 0, ',', '.') ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Bayar</label>
                        <input type="number" name="jumlah_bayar" class="form-control" value="<?= $row['jumlah_bayar'] ?>" placeholder="Bayar" required>
                    </div>
                    <div class="form-group">
                        <label>Bulan</label>
                        <input type="number" name="bulan_bayar" class="form-control" value="<?= $row['bulan_bayar'] ?>" placeholder="Bayar" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-danger">
                        <div class="fa fa-trash"></div> Reset
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <div class="fa fa-save"></div> Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Data -->
<?php foreach ($pembayaran->result() as $edit) { ?>
    <div class="modal fade" id="editData<?= $edit->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit Pembayaran</h4>
                </div>
                <form action="<?= base_url('index.php/admin/pembayaran/update/') . $edit->id . '/' . $id_siswa ?>" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                            <input type="date" name="tgl_bayar" class="form-control" value="<?= $edit->tgl_bayar ?>" placeholder="Tanggal" required>
                        </div>
                        <div class="form-group">
                            <label>SPP</label>
                            <select name="id_spp" class="form-control " required>
                                <?php foreach ($spp->result() as $a) {
                                ?>
                                    <option <?php if ($a->id == $edit->id_spp) {
                                                echo 'selected="selected"';
                                            } ?> value="<?= $a->id ?>"><?php echo $a->tahun . ' - Rp. ' . number_format($a->nominal, 0, ',', '.') ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nominal Bayar</label>
                            <input type="number" name="jumlah_bayar" class="form-control" value="<?= $edit->jumlah_bayar ?>" placeholder="Nominal" required>
                        </div>
                        <div class="form-group">
                            <label>Bulan Bayar</label>
                            <input type="number" name="bulan_bayar" class="form-control" value="<?= $edit->bulan_bayar ?>" placeholder="Nominal" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-danger">
                            <div class="fa fa-trash"></div> Reset
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <div class="fa fa-save"></div> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>