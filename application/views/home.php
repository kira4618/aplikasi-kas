<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Aplikasi Keuangan Kas</title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="<?= base_url('assets') ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="<?= base_url('assets') ?>/bower_components/font-awesome/css/font-awesome.min.css">

    <link rel="stylesheet" href="<?= base_url('assets') ?>/bower_components/Ionicons/css/ionicons.min.css">

    <link rel="stylesheet" href="<?= base_url('assets') ?>/dist/css/AdminLTE.min.css">

    <link rel="stylesheet" href="<?= base_url('assets') ?>/dist/css/skins/_all-skins.min.css">


    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <script nonce="956ad86e-78f1-4b82-b742-96b6a6c90915">
        (function(w, d) {
            ! function(bw, bx, by, bz) {
                bw[by] = bw[by] || {};
                bw[by].executed = [];
                bw.zaraz = {
                    deferred: [],
                    listeners: []
                };
                bw.zaraz.q = [];
                bw.zaraz._f = function(bA) {
                    return function() {
                        var bB = Array.prototype.slice.call(arguments);
                        bw.zaraz.q.push({
                            m: bA,
                            a: bB
                        })
                    }
                };
                for (const bC of ["track", "set", "debug"]) bw.zaraz[bC] = bw.zaraz._f(bC);
                bw.zaraz.init = () => {
                    var bD = bx.getElementsByTagName(bz)[0],
                        bE = bx.createElement(bz),
                        bF = bx.getElementsByTagName("title")[0];
                    bF && (bw[by].t = bx.getElementsByTagName("title")[0].text);
                    bw[by].x = Math.random();
                    bw[by].w = bw.screen.width;
                    bw[by].h = bw.screen.height;
                    bw[by].j = bw.innerHeight;
                    bw[by].e = bw.innerWidth;
                    bw[by].l = bw.location.href;
                    bw[by].r = bx.referrer;
                    bw[by].k = bw.screen.colorDepth;
                    bw[by].n = bx.characterSet;
                    bw[by].o = (new Date).getTimezoneOffset();
                    if (bw.dataLayer)
                        for (const bJ of Object.entries(Object.entries(dataLayer).reduce(((bK, bL) => ({
                                ...bK[1],
                                ...bL[1]
                            }))))) zaraz.set(bJ[0], bJ[1], {
                            scope: "page"
                        });
                    bw[by].q = [];
                    for (; bw.zaraz.q.length;) {
                        const bM = bw.zaraz.q.shift();
                        bw[by].q.push(bM)
                    }
                    bE.defer = !0;
                    for (const bN of [localStorage, sessionStorage]) Object.keys(bN || {}).filter((bP => bP.startsWith("_zaraz_"))).forEach((bO => {
                        try {
                            bw[by]["z_" + bO.slice(7)] = JSON.parse(bN.getItem(bO))
                        } catch {
                            bw[by]["z_" + bO.slice(7)] = bN.getItem(bO)
                        }
                    }));
                    bE.referrerPolicy = "origin";
                    bE.src = "/cdn-cgi/zaraz/s.js?z=" + btoa(encodeURIComponent(JSON.stringify(bw[by])));
                    bD.parentNode.insertBefore(bE, bD)
                };
                ["complete", "interactive"].includes(bx.readyState) ? zaraz.init() : bw.addEventListener("DOMContentLoaded", zaraz.init)
            }(w, d, "zarazData", "script");
        })(window, document);
    </script>
</head>

<body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">
        <header class="main-header">
            <nav class="navbar navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <a href="../../index2.html" class="navbar-brand"><b>Aplikasi Keuangan Kas</a>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>

                    <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="<?= base_url('index.php/home/auth') ?>">Login <span class="sr-only">(current)</span></a></li>
                            <!-- <li><a href="#">Link</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Separated link</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">One more separated link</a></li>
                                </ul>
                            </li> -->
                        </ul>
                        <!-- <form class="navbar-form navbar-left" role="search">
                            <div class="form-group">
                                <input type="text" class="form-control" id="navbar-search-input" placeholder="Search">
                            </div>
                        </form> -->
                    </div>




                </div>

            </nav>
        </header>

        <div class="content-wrapper">
            <div class="container">

                <section class="content-header">
                    <h1>
                        Top Navigation
                        <small>Example 2.0</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Layout</a></li>
                        <li class="active">Top Navigation</li>
                    </ol>
                </section>

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

        </div>

        <footer class="main-footer">
            <div class="container">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 1.0.0
                </div>
                <strong>Copyright &copy; 2023 <a href="#">Jagodigital</a>.</strong> All rights
                reserved.
            </div>

        </footer>
    </div>


    <script src="<?= base_url('assets') ?>/bower_components/jquery/dist/jquery.min.js"></script>

    <script src="<?= base_url('assets') ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <script src="<?= base_url('assets') ?>/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>

    <script src="<?= base_url('assets') ?>/bower_components/fastclick/lib/fastclick.js"></script>

    <script src="<?= base_url('assets') ?>/dist/js/adminlte.min.js"></script>

    <script src="<?= base_url('assets') ?>/dist/js/demo.js"></script>
</body>

</html>