<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>G-Kasir | Top Navigation</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- HTML2Canvas -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/dist/css/adminlte.min.css">

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="<?= base_url('AdminLTE') ?>/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('AdminLTE') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="<?= base_url('AdminLTE') ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="<?= base_url('AdminLTE') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/jszip/jszip.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('AdminLTE') ?>/dist/js/adminlte.min.js"></script>
    <!-- Auto Numeric -->
    <script src="https://cdn.jsdelivr.net/npm/autonumeric@4.8.1"></script>
    <!-- Terbilang-->
    <script src="<?= base_url('terbilang') ?>/terbilang.js"></script>

</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
                <a href="../../index3.html" class="navbar-brand">
                    <span class="brand-text font-weight-light"><i class="fas fa-shopping-cart text-primary"></i><b> Transaksi Penjualan</b></span>
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">

                </div>

                <!-- Right navbar links -->
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">

                    <li class="nav-item">
                        <?php if (session()->get('level') == '1') { ?>
                            <a class="nav-link" href="<?= base_url('Admin') ?>">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                        <?php } else { ?>
                            <a class="nav-link" href="<?= base_url('Home/Logout') ?>">
                                <i class="fas fa-sign-in-alt"></i> Logout
                            </a>
                        <?php } ?>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Main content -->
            <div class="content">
                <div class="row">

                    <!-- /.col-md-6 -->

                    <div class="col-lg-7">
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>No Faktur</label>
                                            <input name="no_faktur" class="form-control form-control-lg text-danger" value="<?= $no_faktur ?>" autocomplete="off" readonly>
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Tanggal</label>
                                            <label class="form-control form-control-lg"><?= date('d M Y') ?></label>
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Jam</label>
                                            <label class="form-control form-control-lg" id="jam"></label>
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Kasir</label>
                                            <label class="form-control form-control-lg text-primary"><?= session()->get('nama_user') ?></label>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h5 class="card-title m-0"></h5>
                            </div>
                            <div class="card-body bg-black color-palette text-right">
                                <label class="display-4 text-green">Rp. <?= number_format($grand_total, 0) ?>,-</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <?php echo form_open('Penjualan/InsertCart') ?>
                                        <div class="row">
                                            <div class="col-2 input-group">
                                                <input name="kode_produk" id="kode_produk" class="form-control" placeholder="Kode Produk" autocomplete="off">
                                                <span class="input-group-append">
                                                    <a class="btn btn-primary btn-flat" data-toggle="modal" data-target="#cari-produk">
                                                        <i class="fas fa-search"></i>
                                                    </a>

                                                    <button type="reset" class="btn btn-danger btn-flat">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </span>
                                            </div>

                                            <div class="col-3">
                                                <input name="nama_produk" class="form-control" placeholder="Nama Produk" readonly>
                                            </div>

                                            <div class="col-1">
                                                <input name="nama_kategori" class="form-control" placeholder="Kategori" readonly>
                                            </div>

                                            <div class="col-1">
                                                <input name="nama_satuan" class="form-control" placeholder="Satuan" readonly>
                                            </div>

                                            <div class="col-1">
                                                <input name="harga_akhir" class="form-control" placeholder="Harga" readonly>
                                            </div>

                                            <div class="col-1">
                                                <input id="qty" type="text" min="1" value="1" name="qty" class="form-control text-center" placeholder="QTY">
                                            </div>
                                            <input name="harga_treat" type="hidden">

                                            <div class="col-3">
                                                <button type="submit" class="btn btn-flat btn-primary"><i class="fas fa-cart-plus"></i> Add</button>

                                                <a href="<?= base_url('Penjualan/ResetCart') ?>" class="btn btn-flat btn-warning"><i class="fas fa-sync"></i> Reset</a>

                                                <a class="btn btn-flat btn-success" data-toggle="modal" data-target="#pembayaran" onclick="Pembayaran()"><i class="fas fa-cash-register"></i> Bayar</a>

                                                <button id="btnPrint" class="btn btn-primary" onclick="printInvoice()">Print</button>

                                            </div>
                                        </div>
                                        <?php echo form_close() ?>

                                    </div>

                                </div>
                                <hr>
    <div class="row">
        <div class="col-12">
            <table class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>Kode</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga Treat</th>
                        <th width="100px">Qty</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart as $key => $value) { ?>

                        <tr>
                            <td><?= $value['id'] ?></td>
                            <td><?= $value['name'] ?></td>
                            <td><?= $value['options']['nama_kategori'] ?></td>
                            <td class="text-right">Rp. <?= number_format($value['price'], 0) ?>.-</td>
                            <td class="text-center"><?= $value['qty'] ?> <?= $value['options']['nama_satuan'] ?></td>
                            <td class="text-right">Rp. <?= number_format($value['subtotal'], 0) ?></td>
                            <td class="text-center">
                                <a href="<?= base_url('Penjualan/RemoveItemCart/' . $value['rowid']) ?>" class="btn btn-flat btn-danger btn-sm"><i class="fa fa-times"></i></a>
                            </td>
                            <td><?= ucfirst($item['status_pembayaran'] ?? 'pending'); ?></td>
                        <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h5 class="card-title m-0"></h5>
                            </div>
                            <div class="card-body bg-black color-palette text-center">
                                <h1 class="text-warning" id="terbilang"></h1>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <?php
                        if (session()->getFlashdata('pesan')) {
                            echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon fas fa-check"></i>';
                            echo session()->getFlashdata('pesan');
                            echo '</div>';
                        }
                        ?>

                    </div>
                    <!-- /.col-md-6 -->
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Modal Cari Produk -->
        <div class="modal fade" id="cari-produk">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Cari Data Produk</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table id="example1" class="table table-bordered table-striped text-sm">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Nama Produk</th>
                                    <th>Harga Treat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($produk as $key => $value) { ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $value['kode_produk'] ?></td>
                                        <td><?= $value['nama_produk'] ?></td>
                                        <td><?= $value['harga_treat'] ?></td>
                                        <td><a onclick="PilihProduk(<?= $value['kode_produk'] ?>)" class="btn btn-success btn-xs">Pilih</a></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <!-- Modal Pembayaran Produk -->
        <div class="modal fade" id="pembayaran">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Transaksi Pembayaran</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php echo form_open_multipart('Penjualan/SimpanTransaksi') ?>

                        <div class="form-group">
                            <label for="">No Faktur</label>
                            <input name="no_faktur" id="modal_no_faktur" class="form-control form-control-lg text-danger" required>
                        </div>

                        <div class="form-group">
                            <label>Nama Konsumen</label>
                            <input type="text" name="nama_konsumen" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>No Hp</label>
                            <input type="text" name="no_hp" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Tanggal Masuk</label>
                            <input type="date" name="tanggal_masuk" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Tanggal Selesai</label>
                            <input type="date" name="tanggal_selesai" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Gambar Before</label>
                            <div class="custom-file">
                                <input type="file" name="gambar_before" class="custom-file-input" id="gambar_before" accept="image/*">
                                <label class="custom-file-label" for="gambar_before">Pilih Gambar</label>
                            </div>
                            <div class="mt-2">
                                <img id="preview_before" src="#" alt="Preview Gambar Before" style="max-width: 100px; display: none;">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Grand Total</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp.</span>
                                </div>
                                <input name="grand_total" id="grand_total" value="<?= number_format($grand_total, 0) ?>" class="form-control form-control-lg text-right text-danger" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Dibayar</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp.</span>
                                </div>
                                <input name="dibayar" id="dibayar" class="form-control form-control-lg text-right text-success" autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Kembalian</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp.</span>
                                </div>
                                <input name="kembalian" id="kembalian" class="form-control form-control-lg text-right text-primary" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-group form-control-lg text-center"> Status</label>
                        <select name="status_pembayaran" class="form-group form-control-lg text-center">
                            <option value="pending" class="text-danger">Pending</option>
                            <option value="success" class="text-green">Success</option>
                            <option value="failed" class="text-yellow">Failed</option>
                        </select>
                    </div>

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                        <button type="button" onclick="printPaymentForm()"  class="btn btn-info btn-flat mr-2">
                            <i class="fas fa-print"></i> Print
                        </button>
                        <button type="button" onclick="sendToWhatsAppAsImage()" class="btn btn-success btn-flat mr-2">
                            <i class="fab fa-whatsapp"></i> Kirim Gambar WhatsApp
                        </button>
                        <button type="submit" class="btn btn-primary btn-flat"><i class="fas fa-save"></i> Simpan Transaksi</button>
                    </div>

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <!-- Template cetak untuk transaksi pembayaran -->
<div id="printPaymentTemplate" style="display: none;">
    <div style="padding: 20px; font-family: Arial, sans-serif;">
        <div style="text-align: center; margin-bottom: 20px;">
        <h2 style="margin-bottom: 0;"><b>Salve Cleaning Shoes and Bag</b></h2>
        <div style="margin-bottom: 5px;">
            Permata Biru Blok Ar.06, Jl.Ahmad Nasuiton No.112, &amp; Jl. Rancabolang no.3
        </div>
        <div style="margin-bottom: 10px;">
            <b>Telp/WA: 081-222-400-448</b>
        </div>
        <h3 style="margin-top: 10px;">BUKTI TRANSAKSI PEMBAYARAN</h3>
    </div>
        
        <table style="width: 100%; margin-bottom: 20px; border-collapse: collapse;">
            <tr>
                <td style="padding: 8px; width: 40%;"><strong>No Faktur</strong></td>
                <td style="padding: 8px;" id="print_no_faktur"></td>
            </tr>
            <tr>
                <td style="padding: 8px;"><strong>Nama Konsumen</strong></td>
                <td style="padding: 8px;" id="print_nama_konsumen"></td>
            </tr>
            <tr>
                <td style="padding: 8px;"><strong>No HP</strong></td>
                <td style="padding: 8px;" id="print_no_hp"></td>
            </tr>
            <tr>
                <td style="padding: 8px;"><strong>Tanggal Masuk</strong></td>
                <td style="padding: 8px;" id="print_tanggal_masuk"></td>
            </tr>
            <tr>
                <td style="padding: 8px;"><strong>Tanggal Selesai</strong></td>
                <td style="padding: 8px;" id="print_tanggal_selesai"></td>
            </tr>
            <tr>
                <td style="padding: 8px;"><strong>Deskripsi</strong></td>
                <td style="padding: 8px;" id="print_deskripsi"></td>
            </tr>
            <tr>
                <td style="padding: 8px;"><strong>Tanggal</strong></td>
                <td style="padding: 8px;"><?= date('d M Y'); ?></td>
            </tr>
            <tr>
                <td style="padding: 8px;"><strong>Jam</strong></td>
                <td style="padding: 8px;" id="print_jam"></td>
            </tr>
            <tr>
                <td style="padding: 8px;"><strong>Kasir</strong></td>
                <td style="padding: 8px;"><?= session()->get('nama_user') ?></td>
            </tr>
            <tr>
                <td style="padding: 8px;"><strong>Grand Total</strong></td>
                <td style="padding: 8px;" id="print_grand_total"></td>
            </tr>
            <tr>
                <td style="padding: 8px;"><strong>Dibayar</strong></td>
                <td style="padding: 8px;" id="print_dibayar"></td>
            </tr>
            <tr>
                <td style="padding: 8px;"><strong>Kembalian</strong></td>
                <td style="padding: 8px;" id="print_kembalian"></td>
            </tr>
            <tr>
                <td style="padding: 8px;"><strong>Status Pembayaran</strong></td>
                <td style="padding: 8px;" id="print_status"></td>
            </tr>
        </table>
        
        <div style="margin-top: 30px;">
            <p><strong>Daftar Produk:</strong></p>
            <table style="width: 100%; border-collapse: collapse; border: 1px solid #ddd;">
                <thead>
                    <tr style="background-color: #f2f2f2;">
                        <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Kode</th>
                        <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Produk</th>
                        <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Kategori</th>
                        <th style="border: 1px solid #ddd; padding: 8px; text-align: right;">Harga</th>
                        <th style="border: 1px solid #ddd; padding: 8px; text-align: center;">Qty</th>
                        <th style="border: 1px solid #ddd; padding: 8px; text-align: right;">Total</th>
                    </tr>
                </thead>
                <tbody id="print_product_list">
                    <!-- Daftar produk akan ditampilkan di sini -->
                </tbody>
            </table>
        </div>
        <div style="margin-top: 30px; text-align: center;">
            <p>Terima kasih Pelanggan Salve</p>
        </div>
    </div>
</div>

        <div id="invoiceContent">
            <h2><b>Invoice</b></h2>
            <p>No Faktur: <?= $no_faktur; ?></p>
            <p>Tanggal: <?= date('d M Y'); ?></p>
            <p>Kasir: <?= session()->get('nama_user') ?></p>
            <table border="1" style="width: 100%; text-align: left;">
                <thead>
                    <tr>
                        <th>Kode Produk</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga Treat</th>
                        <th>Qty</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart as $item): ?>
                        <tr>
                            <td><?= $item['id']; ?></td>
                            <td><?= $item['name']; ?></td>
                            <td><?= $item['options']['nama_kategori']; ?></td>
                            <td><?= number_format($item['price'], 0, ',', '.'); ?></td>
                            <td><?= $item['qty']; ?></td>
                            <td><?= $item['subtotal']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <h3>Total Harga: Rp <?= number_format($grand_total, 0, ',', '.'); ?></h3>
        </div>
        <?php echo form_close() ?>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2025 <a href="https://adminlte.io">G-Kasir</a>.</strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <script>
        $(document).ready(function() {
            $('#kode_produk').focus();
            <?php if ($grand_total == 0) { ?>
                document.getElementById("terbilang").innerHTML = ' Nol Rupiah';
            <?php } else { ?>
                document.getElementById("terbilang").innerHTML = terbilang(<?= $grand_total ?>) + ' Rupiah';
            <?php } ?>

            $('#qty').keydown(function(e) {
                let kode_produk = $('#kode_produk').val();
                if (e.keyCode == 13) {
                    e.preventDefault();
                    if (kode_produk.length == 0) {
                        Swal.fire("Input Kode Produk");
                    } else {
                        CekProduk();
                    }
                }
            });

            //hitung kembalian
            $('#dibayar').keyup(function(e) {
                HitungKembalian();
            });
        });

        function CekProduk() {
            $.ajax({
                type: "POST",
                url: "<?= base_url('Penjualan/CekProduk') ?>",
                data: {
                    kode_produk: $('#kode_produk').val(),
                },
                dataType: "JSON",
                success: function(response) {
                    if (response.nama_produk == '') {
                        Swal.fire("Kode Produk Ditemukan");
                    } else {
                        $('[name="nama_produk"]').val(response.nama_produk);
                        $('[name="nama_kategori"]').val(response.nama_kategori);
                        $('[name="nama_satuan"]').val(response.nama_satuan);
                        $('[name="harga_akhir"]').val(response.harga_akhir);
                        $('[name="harga_treat"]').val(response.harga_treat);
                        $('#qty').focus();
                    }
                }
            });
        }

        function PilihProduk(kode_produk) {
            $('#kode_produk').val(kode_produk);
            $('#cari-produk').modal('hide');
            $('#kode_produk').focus();
        }

        function Pembayaran() {
            $('#pembayaran').modal('show');
        }

        // AutoNumeric
        new AutoNumeric('#dibayar', {
            digitGroupSeparator: ',',
            decimalPlaces: 0
        });

        function HitungKembalian() {
            let grand_total = $('#grand_total').val().replace(/[^.\d]/g, '').toString();
            let dibayar = $('#dibayar').val().replace(/[^.\d]/g, '').toString();

            let kembalian = parseFloat(dibayar) - parseFloat(grand_total);
            $('#kembalian').val(kembalian);

            // AutoNumeric
            new AutoNumeric('#kembalian', {
                digitGroupSeparator: ',',
                decimalPlaces: 0,
            });
        }
    </script>

    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "paging": true,
                "info": true,
                "ordering": false,
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>

    <script>
        window.onload = function() {
            jam();
        }

        function jam() {
            var e = document.getElementById('jam');
            d = new Date();
            h = d.getHours();
            m = set(d.getMinutes());
            s = set(d.getSeconds());
            e.innerHTML = h + ":" + m + ":" + s;
            setTimeout('jam()', 1000);
        }

        function set(e) {
            e = e < 10 ? '0' + e : e;
            return e;
        }
    </script>

    <script>
        function printInvoice() {
            const printContents = document.getElementById('invoiceContent').innerHTML;
            const originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>

    <!-- Send Picture Print WA method -->
    <script>
function sendToWhatsAppAsImage() {
    // Format nomor HP
    let noHp = $('[name="no_hp"]').val().replace(/\D/g, '');
    if (noHp.startsWith('0')) {
        noHp = '62' + noHp.substring(1);
    } else if (!noHp.startsWith('62')) {
        noHp = '62' + noHp;
    }
    
    if (!noHp) {
        Swal.fire({
            title: 'Error!',
            text: 'Nomor HP harus diisi untuk mengirim WhatsApp',
            icon: 'error'
        });
        return;
    }
    
    // Siapkan data untuk template
    let noFaktur = $('#modal_no_faktur').val();
    let namaKonsumen = $('[name="nama_konsumen"]').val();
    let tanggalMasuk = $('[name="tanggal_masuk"]').val();
    let tanggalSelesai = $('[name="tanggal_selesai"]').val();
    let deskripsi = $('[name="deskripsi"]').val();
    let grandTotal = $('#grand_total').val();
    let dibayar = $('#dibayar').val();
    let kembalian = $('#kembalian').val();
    let status = $('select[name="status_pembayaran"] option:selected').text();
    
    // Isi template print dengan data form
    $('#print_no_faktur').text(noFaktur);
    $('#print_nama_konsumen').text(namaKonsumen || '-');
    $('#print_no_hp').text(noHp || '-');
    $('#print_tanggal_masuk').text(tanggalMasuk || '-');
    $('#print_tanggal_selesai').text(tanggalSelesai || '-');
    $('#print_deskripsi').text(deskripsi || '-');
    $('#print_jam').text(new Date().getHours() + ":" + 
                         new Date().getMinutes() + ":" + 
                         new Date().getSeconds());
    $('#print_grand_total').text('Rp. ' + grandTotal);
    $('#print_dibayar').text('Rp. ' + dibayar);
    $('#print_kembalian').text('Rp. ' + kembalian);
    $('#print_status').text(status);
    
    // Isi daftar produk
    let productListHtml = '';
    <?php foreach ($cart as $item): ?>
    productListHtml += '<tr>' +
        '<td style="border: 1px solid #ddd; padding: 8px;"><?= $item['id'] ?></td>' +
        '<td style="border: 1px solid #ddd; padding: 8px;"><?= $item['name'] ?></td>' +
        '<td style="border: 1px solid #ddd; padding: 8px;"><?= $item['options']['nama_kategori'] ?></td>' +
        '<td style="border: 1px solid #ddd; padding: 8px; text-align: right;">Rp. <?= number_format($item['price'], 0) ?></td>' +
        '<td style="border: 1px solid #ddd; padding: 8px; text-align: center;"><?= $item['qty'] ?> <?= $item['options']['nama_satuan'] ?></td>' +
        '<td style="border: 1px solid #ddd; padding: 8px; text-align: right;">Rp. <?= number_format($item['subtotal'], 0) ?></td>' +
        '</tr>';
    <?php endforeach; ?>
    $('#print_product_list').html(productListHtml);
    
    // Siapkan div khusus untuk screenshot
    const printContent = document.getElementById('printPaymentTemplate');
    printContent.style.display = 'block';
    printContent.style.position = 'fixed';
    printContent.style.left = '0';
    printContent.style.top = '0';
    printContent.style.width = '100%';
    printContent.style.backgroundColor = 'white';
    printContent.style.zIndex = '9999';

        // Tambahkan watermark ke DOM
        for (let i = 0; i < 6; i++) {
        const watermark = document.createElement('div');
        watermark.className = 'watermark-html2canvas';
        watermark.innerText = 'SALVE';
        watermark.style.position = 'absolute';
        watermark.style.top = (10 + i * 15) + '%';
        watermark.style.left = '50%';
        watermark.style.transform = 'translate(-50%, -50%) rotate(-30deg)';
        watermark.style.fontSize = '100px';
        watermark.style.color = 'rgba(200,200,200,0.15)';
        watermark.style.zIndex = '10';
        watermark.style.pointerEvents = 'none';
        watermark.style.userSelect = 'none';
        watermark.style.width = '100%';
        watermark.style.textAlign = 'center';
        printContent.appendChild(watermark);
    }
    
    // Munculkan loading
    Swal.fire({
        title: 'Memproses...',
        text: 'Sedang membuat screenshot invoice',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    
    // Gunakan timeout untuk memastikan template sudah dirender
    setTimeout(function() {
        // Opsi untuk html2canvas
        const options = {
            allowTaint: true,
            useCORS: true,
            scale: 2, // Meningkatkan kualitas
            backgroundColor: '#ffffff',
            logging: true,
            width: printContent.offsetWidth,
            height: printContent.offsetHeight
        };
        
        // Capture dengan html2canvas
        html2canvas(printContent, options).then(function(canvas) {
            // Sembunyikan kembali template
            printContent.style.display = 'none';
            Swal.close();
            
            try {
                // Konversi ke Blob
                canvas.toBlob(function(blob) {
                    if (!blob) {
                        throw new Error("Gagal membuat blob");
                    }
                    
                    // Simpan dan beri instruksi
                    const url = URL.createObjectURL(blob);
                    
                    // Tampilkan hasil dan opsi
                    Swal.fire({
                        title: 'Screenshot Berhasil',
                        html: 'Screenshot invoice berhasil dibuat.<br><br>' +
                              '<img src="' + url + '" style="max-width:100%; max-height:300px; margin-bottom:15px;"><br>' +
                              '<a href="' + url + '" download="invoice-' + noFaktur + '.png" class="btn btn-success mb-2">Download Gambar</a><br>' +
                              '<a href="https://wa.me/' + noHp + '" target="_blank" class="btn btn-success">Buka WhatsApp</a>',
                        showConfirmButton: false,
                        showCloseButton: true,
                        width: 600
                    });
                    
                }, 'image/png', 1.0);
            } catch (error) {
                console.error('Error:', error);
                Swal.fire('Error', 'Gagal membuat screenshot: ' + error.message, 'error');
            }
        }).catch(function(error) {
            printContent.style.display = 'none';
            Swal.fire('Error', 'Gagal membuat screenshot: ' + error.message, 'error');
            console.error('Error with html2canvas:', error);
        });
    }, 500); // Delay 500ms untuk memastikan template dirender
}

    </script>

    <!-- Send Text WA method -->
     <script>
        function sendToWhatsApp() {
    // Ambil nilai dari form modal
    let noFaktur = $('#modal_no_faktur').val();
    let namaKonsumen = $('[name="nama_konsumen"]').val();
    let noHp = $('[name="no_hp"]').val();
    let tanggalMasuk = $('[name="tanggal_masuk"]').val();
    let tanggalSelesai = $('[name="tanggal_selesai"]').val();
    let deskripsi = $('[name="deskripsi"]').val();
    let grandTotal = $('#grand_total').val();
    let dibayar = $('#dibayar').val();
    let kembalian = $('#kembalian').val();
    let status = $('select[name="status_pembayaran"] option:selected').text();
    
    // Validasi nomor HP
    if (!noHp) {
        Swal.fire({
            title: 'Error!',
            text: 'Nomor HP harus diisi untuk mengirim WhatsApp',
            icon: 'error'
        });
        return;
    }
    
    // Format nomor HP (menghapus karakter non-digit dan menambahkan 62 jika dimulai dengan 0)
    noHp = noHp.replace(/\D/g, '');
    if (noHp.startsWith('0')) {
        noHp = '62' + noHp.substring(1);
    } else if (!noHp.startsWith('62')) {
        noHp = '62' + noHp;
    }
    
    // Buat pesan untuk WhatsApp
    let message = `*BUKTI TRANSAKSI PEMBAYARAN*\n\n`;
    message += `No Faktur: ${noFaktur}\n`;
    message += `Nama Konsumen: ${namaKonsumen || '-'}\n`;
    message += `Tanggal Masuk: ${tanggalMasuk || '-'}\n`;
    message += `Tanggal Selesai: ${tanggalSelesai || '-'}\n`;
    message += `Deskripsi: ${deskripsi || '-'}\n`;
    message += `Tanggal: <?= date('d M Y') ?>\n`;
    message += `Jam: ${new Date().getHours()}:${new Date().getMinutes()}:${new Date().getSeconds()}\n`;
    message += `Kasir: <?= session()->get('nama_user') ?>\n\n`;
    
    // Tambahkan informasi produk
    message += `*DAFTAR PRODUK:*\n`;
    <?php foreach ($cart as $item): ?>
    message += `- <?= $item['name'] ?> (<?= $item['qty'] ?> <?= $item['options']['nama_satuan'] ?>) : Rp. <?= number_format($item['subtotal'], 0) ?>\n`;
    <?php endforeach; ?>
    
    // Tambahkan total pembayaran
    message += `\n*Grand Total:* Rp. ${grandTotal}\n`;
    message += `*Dibayar:* Rp. ${dibayar}\n`;
    message += `*Kembalian:* Rp. ${kembalian}\n`;
    message += `*Status:* ${status}\n\n`;
    message += `Terima kasih pelanggan SALVE <?= session()->get('nama_toko') ?>!`;
    
    // Encode pesan untuk URL
    let encodedMessage = encodeURIComponent(message);
    
    // Buka WhatsApp Web dengan pesan yang telah disiapkan
    window.open(`https://wa.me/${noHp}?text=${encodedMessage}`, '_blank');
}

     </script>

    <!-- print method -->
    <script>
        function printPaymentForm() {
    // Ambil nilai dari form modal
    let noFaktur = $('#modal_no_faktur').val();
    let namaKonsumen = $('[name="nama_konsumen"]').val();
    let noHp = $('[name="no_hp"]').val();
    let tanggalMasuk = $('[name="tanggal_masuk"]').val();
    let tanggalSelesai = $('[name="tanggal_selesai"]').val();
    let deskripsi = $('[name="deskripsi"]').val();
    let grandTotal = $('#grand_total').val();
    let dibayar = $('#dibayar').val();
    let kembalian = $('#kembalian').val();
    let status = $('select[name="status_pembayaran"] option:selected').text();
    let gambarBefore = document.getElementById('gambar_before').files[0]; // gambar before

        // Tampilkan gambar Before jika ada
        if (gambarBefore) {
        let readerBefore = new FileReader();
        readerBefore.onload = function(e) {
            $('#print_gambar_before').attr('src', e.target.result);
            $('#print_gambar_before').css('display', 'block');
            $('#print_no_gambar_before').css('display', 'none');
        }
        readerBefore.readAsDataURL(gambarBefore);
    } else {
        $('#print_gambar_before').css('display', 'none');
        $('#print_no_gambar_before').css('display', 'block');
    }
    
    // Isi template cetak dengan data
    $('#print_no_faktur').text(noFaktur);
    $('#print_nama_konsumen').text(namaKonsumen || '-');
    $('#print_no_hp').text(noHp || '-');
    $('#print_tanggal_masuk').text(tanggalMasuk || '-');
    $('#print_tanggal_selesai').text(tanggalSelesai || '-');
    $('#print_deskripsi').text(deskripsi || '-');
    $('#print_jam').text(new Date().getHours() + ":" + 
                         new Date().getMinutes() + ":" + 
                         new Date().getSeconds());
    $('#print_grand_total').text('Rp. ' + grandTotal);
    $('#print_dibayar').text('Rp. ' + dibayar);
    $('#print_kembalian').text('Rp. ' + kembalian);
    $('#print_status').text(status);
    
    // Isi daftar produk
    let productListHtml = '';
    <?php foreach ($cart as $item): ?>
    productListHtml += '<tr>' +
        '<td style="border: 1px solid #ddd; padding: 8px;"><?= $item['id'] ?></td>' +
        '<td style="border: 1px solid #ddd; padding: 8px;"><?= $item['name'] ?></td>' +
        '<td style="border: 1px solid #ddd; padding: 8px;"><?= $item['options']['nama_kategori'] ?></td>' +
        '<td style="border: 1px solid #ddd; padding: 8px; text-align: right;">Rp. <?= number_format($item['price'], 0) ?></td>' +
        '<td style="border: 1px solid #ddd; padding: 8px; text-align: center;"><?= $item['qty'] ?> <?= $item['options']['nama_satuan'] ?></td>' +
        '<td style="border: 1px solid #ddd; padding: 8px; text-align: right;">Rp. <?= number_format($item['subtotal'], 0) ?></td>' +
        '</tr>';
    <?php endforeach; ?>
    $('#print_product_list').html(productListHtml);
    
    // Buka jendela baru untuk cetak
    const printContent = document.getElementById('printPaymentTemplate').innerHTML;
    const printWindow = window.open('', '_blank');
    
    printWindow.document.write(`
        <html>
            <head>
                <title>Bukti Pembayaran #${noFaktur}</title>
                <style>
                    @media print {
                        body {
                            font-family: Arial, sans-serif;
                            padding: 20px;
                            position: relative;
                        }
                         /* Watermark dengan dua metode berbeda */
                        body::before {
                            content: "";
                            position: fixed;
                            top: 0;
                            left: 0;
                            width: 100%;
                            height: 100%;
                            opacity: 0.15;
                            pointer-events: none;
                            z-index: -1;
                            background-image: repeating-linear-gradient(-45deg, 
                                rgba(255,255,255,0) 0px, rgba(255,255,255,0) 20px, 
                                rgba(200,200,200,0.8) 20px, rgba(200,200,200,0.8) 40px);
                        }
                        /* Watermark teks */
                        body::after {
                            content: "salve";
                            position: fixed;
                            top: 0;
                            left: 0;
                            width: 100%;
                            height: 100%;
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            color: rgba(200, 200, 200, 0.2);
                            font-size: 120px;
                            transform: rotate(-45deg);
                            pointer-events: none;
                            z-index: -1;
                        }
                        
                        /* Penempatan watermark berulang */
                        .watermark-container {
                            position: fixed;
                            top: 0;
                            left: 0;
                            width: 100%;
                            height: 100%;
                            z-index: -1;
                            overflow: hidden;
                        }
                        
                        .watermark-text {
                            position: absolute;
                            font-size: 40px;
                            color: rgba(200, 200, 200, 0.15);
                            pointer-events: none;
                            transform: rotate(-30deg);
                        }
                        table {
                            width: 100%;
                            border-collapse: collapse;
                            position: relative;
                            z-index: 1;
                        }
                        th, td {
                            padding: 8px;
                            text-align: left;
                            position: relative;
                            z-index: 1;
                        }
                        th {
                            background-color: #f2f2f2;
                        }
                        /* Memastikan watermark muncul saat print */
                        @media print {
                            body::before, body::after, .watermark-container {
                                -webkit-print-color-adjust: exact !important;
                                color-adjust: exact !important;
                        } 
                    }
                </style>
                
            </head>
            <body>
                <div class="watermark">salve</div>
                ${printContent}
            </body>
        </html>
    `);
    
    printWindow.document.close();
    printWindow.focus();
    
    // Cetak setelah konten dimuat
    printWindow.onload = function() {
        printWindow.print();
        // printWindow.close();
    };
}

    </script>

<script>
    // Script yang sudah ada
    
    // Fungsi untuk preview gambar before & after
    $(document).ready(function() {
        // Preview gambar before
        $('#gambar_before').change(function() {
            previewImage(this, '#preview_before');
            
            // Update label dengan nama file
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').html(fileName);
        });
        
        // Fungsi utama preview
        function previewImage(input, previewElem) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                    $(previewElem).attr('src', e.target.result);
                    $(previewElem).css('display', 'block');
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
    });
</script>

</body>
</html>