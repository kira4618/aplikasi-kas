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
        <div class="box">
            <div class="box-header">
                <h4 class="box-title">Cari Siswa</h4>
            </div>
            <form class="form-horizontal" action="<?= base_url('index.php/admin/pembayaran/cari/') ?>" method="POST">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nama Siswa</label>

                        <div class="col-sm-10">
                            <select name="id_siswa" class="select2" style="width: 100%" required>
                                <option value="" disabled selected> -- Pilih Siswa -- </option>
                                <?php foreach ($siswa->result() as $dSiswa) { ?>
                                    <option value="<?= $dSiswa->id ?>"><?= $dSiswa->nama  ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right">
                        <div class="fa fa-search"></div> Search
                    </button>
                </div>
            </form>
        </div>
        <div class="box">
            <div class="box-header">
                <h4 class="box-title">Riwayat Pembayaran</h4>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="dataTable">
                        <thead>
                            <tr>
                                <th width="10px">#</th>
                                <th>Tanggal</th>
                                <th>Petugas</th>
                                <th>Siswa</th>
                                <th>Tanggal Bayar</th>
                                <th>Bulan Bayar</th>
                                <th>Tahun Bayar</th>
                                <th>Nominal SPP</th>
                                <th>Jumlah Bayar</th>
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
                                    <td>
                                        <?php
                                        $this->db->where('id', $row['id_siswa']);
                                        foreach ($this->db->get('tb_siswa')->result() as $dSiswa) {
                                            echo $dSiswa->nama;
                                        }
                                        ?>
                                    </td>
                                    <td><?= $row['tgl_bayar'] ?></td>
                                    <td><?= $row['bulan_bayar'] ?></td>
                                    <td>
                                        <?php
                                        $this->db->where('id', $row['id_spp']);
                                        foreach ($this->db->get('tb_spp')->result() as $dSpp) {
                                            echo $dSpp->tahun;
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $this->db->where('id', $row['id_spp']);
                                        foreach ($this->db->get('tb_spp')->result() as $dSpp) {
                                            echo 'Rp.' . number_format($dSpp->nominal,  0, ', ', '.');
                                        }
                                        ?>
                                    </td>
                                    <td>Rp. <?= number_format($row['jumlah_bayar'], 0, ',', '.') ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>