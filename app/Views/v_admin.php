<div class="col-lg-3 col-6">
  <!-- small box -->
  <div class="small-box bg-info">
    <div class="inner">
      <h3><?= $jml_produk ?></h3>

      <p>Produk</p>
    </div>
    <div class="icon">
      <i class="fas fa-boxes"></i>
    </div>
    <a href="<?= base_url('Produk') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
  </div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-6">
  <!-- small box -->
  <div class="small-box bg-success">
    <div class="inner">
      <h3><?= $jml_kategori ?><sup style="font-size: 20px">%</sup></h3>

      <p>Kategori</p>
    </div>
    <div class="icon">
      <i class="fas fa-th-list"></i>
    </div>
    <a href="<?= base_url('Kategori') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
  </div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-6">
  <!-- small box -->
  <div class="small-box bg-warning">
    <div class="inner">
      <h3><?= $jml_satuan ?></h3>

      <p>Satuan</p>
    </div>
    <div class="icon">
      <i class="fas fa-list"></i>
    </div>
    <a href="<?= base_url('User') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
  </div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-6">
  <!-- small box -->
  <div class="small-box bg-danger">
    <div class="inner">
      <h3><?= $jml_user ?></h3>

      <p>User</p>
    </div>
    <div class="icon">
      <i class="fas fa-users"></i>
    </div>
    <a href="<?= base_url('User') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
  </div>
</div>

<div class="col-md-4">
  <!-- Info Boxes Style 2 -->
  <div class="info-box mb-3 bg-primary">
    <span class="info-box-icon"><i class="fas fa-money-bill-wave"></i></span>

    <div class="info-box-content">
      <span class="info-box-text">Pendapatan Hari Ini</span>
      <span class="info-box-number">Rp <?= number_format($p_hari_ini['total_harga'] ?? 0, 0) ?></span>
    </div>
    <!-- /.info-box-content -->
  </div>
</div>

<div class="col-md-4">
  <!-- Info Boxes Style 2 -->
  <div class="info-box mb-3 bg-indigo">
    <span class="info-box-icon"><i class="fas fa-money-bill-wave"></i></span>

    <div class="info-box-content">
      <span class="info-box-text">Pendapatan Bulan Ini</span>
      <span class="info-box-number">Rp <?= number_format($p_bulan_ini['total_harga'] ?? 0, 0) ?></span>
    </div>
    <!-- /.info-box-content -->
  </div>
</div>

<div class="col-md-4">
  <!-- Info Boxes Style 2 -->
  <div class="info-box mb-3 bg-fuchsia">
    <span class="info-box-icon"><i class="fas fa-money-bill-wave"></i></span>

    <div class="info-box-content">
      <span class="info-box-text">Pendapatan Tahun Ini</span>
      <span class="info-box-number">Rp <?= number_format($p_tahun_ini['total_harga'] ?? 0, 0) ?></span>
    </div>
    <!-- /.info-box-content -->
  </div>
</div>

<div class="col-md-12">
  <canvas id="myChart" width="100%" height="40px"></canvas>
</div>

<?php

if ($grafik == null) {
  $tgl[] = 0;
  $total[] = 0;
  $untung[] = 0;
} else {
  foreach ($grafik as $key => $value) {
    $tgl[] = $value['tgl_jual'];
    $total[] = $value['total_harga'];
    $untung[] = $value['untung'];
  }
}

?>

<!-- Memunculkan Pesanan Terbaru -->
<div class="row mt-4">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Pesanan Terbaru</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-hover">
            <thead class="thead-light">
              <tr>
                <th>No Faktur</th>
                <th>Tanggal & Waktu</th>
                <th>Harga</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($pesanan_terbaru as $order): ?>
              <tr>
                <td><?= $order['no_faktur']; ?></td>
                <td><?= date('d-m-Y', strtotime($order['tgl_jual'])); ?></td>
                <td>Rp <?= number_format($order['grand_total'], 0, ',', '.'); ?></td>
                <td class="text-center">
                    <select 
                        class="form-control status-dropdown" 
                        data-nofaktur="<?= $order['no_faktur'] ?>" 
                        style="min-width: 120px;">
                        <option value="pending" <?= ($order['status_pembayaran'] == 'pending') ? 'selected' : '' ?>>Pending</option>
                        <option value="success" <?= ($order['status_pembayaran'] == 'success') ? 'selected' : '' ?>>Success</option>
                        <option value="failed" <?= ($order['status_pembayaran'] == 'failed') ? 'selected' : '' ?>>Failed</option>
                    </select>
                </td>
            </tr>
        <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'line',
    data: {
      labels: <?= json_encode($tgl) ?>,
      datasets: [{
          label: 'Grafik Pendapatan Penjualan Bulan <?= date('M Y') ?>',
          data: <?= json_encode($total) ?>,
          backgroundColor: [
            'rgba(54, 162, 235, 0.2)',
          ],
          borderColor: [
            'rgb(54, 162, 235)',
          ],
          borderWidth: 3
        },

        {
          label: 'Grafik Keuntungan Penjualan Bulan <?= date('M Y') ?>',
          data: <?= json_encode($untung) ?>,
          backgroundColor: [
            'rgba(153, 102, 255, 0.2)',
          ],
          borderColor: [
            'rgb(153, 102, 255, 1)',
          ],
          borderWidth: 3
        }

      ]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>

<script>
$(document).ready(function() {
    $('.status-dropdown').change(function() {
        const noFaktur = $(this).data('nofaktur');
        const newStatus = $(this).val();

        $.ajax({
            url: '<?= base_url('Admin/UpdateStatusPembayaran') ?>',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '<?= csrf_hash() ?>',
            },
            data: {
                no_faktur: noFaktur,
                status_pembayaran: newStatus,
            },
            success: function(response) {
                if (response.success) {
                    alert('Status berhasil diperbarui!');
                } else {
                    alert('Gagal memperbarui status.');
                }
            },
            error: function(xhr) {
                alert('Terjadi kesalahan saat memperbarui status.');
            }
        });
    });
});
</script>

