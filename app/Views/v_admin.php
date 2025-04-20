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
      <h3><?= $jml_kategori ?><sup style="font-size: 20px"></sup></h3>

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

<!-- Memunculkan Semua Pesanan -->
<div class="row mt-4">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Semua Pesanan</h4>
      </div>
      <form action="" method="get" class="form-inline">
            <input type="text" name="search" class="form-control form-control-sm mr-2" placeholder="Cari pesanan" value="<?= esc(\Config\Services::request()->getGet('search')) ?>">
            <button type="submit" class="btn btn-sm btn-light">Cari</button>
      </form>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped">

              <tr class="text-center bg-primary">
                <th>No Faktur</th>
                <th>Nama</th>
                <th>No Hp</th>
                <th>Masuk</th>
                <th>Selesai</th>
                <th>Deksripsi</th>
                <th>Before</th>
                <th>Harga</th>
                <th>Dibayar</th>
                <th>Sisa</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>

            <tbody>
            <?php foreach ($pesanan_terbaru as $order): ?>
              <tr>
                <td><?= $order['no_faktur']; ?></td>
                <td><?= $order['nama_konsumen'] ?? '-'; ?></td>
                <td><?= $order['no_hp'] ?? '-'; ?></td>
                <td><?= !empty($order['tanggal_masuk']) ? date('d-m-Y', strtotime($order['tanggal_masuk'])) : '-'; ?></td>
                <td><?= !empty($order['tanggal_selesai']) ? date('d-m-Y', strtotime($order['tanggal_selesai'])) : '-'; ?></td>
                <td><?= $order['deskripsi'] ?? '-'; ?></td>

                <td class="text-center">
                <div class="d-flex justify-content-center">
                  <?php if (!empty($order['gambar_before'])): ?>
                    <a href="<?= base_url($order['gambar_before']) ?>" target="_blank" class="mr-2" data-toggle="tooltip" title="Gambar Before">
                      <img src="<?= base_url($order['gambar_before']) ?>" alt="Before" class="img-thumbnail" style="max-width: 50px; max-height: 50px;">
                    </a>
                  <?php endif; ?>
                  <?php if (empty($order['gambar_before']) && empty($order['gambar_after'])): ?>
                    <?php endif; ?>
                  </div>
                </td>

                <td>Rp <?= number_format($order['grand_total'], 0, ',', '.'); ?></td>
                <td>Rp <?= number_format($order['dibayar'] ?? 0, 0, ',', '.'); ?></td>
                <td>
                  <?php 
                    // Hitung selisih antara harga dan pembayaran
                    $dibayar = $order['dibayar'] ?? 0;
                    $sisa = $order['grand_total'] - $dibayar;
                    if ($sisa <= 0): 
                  ?>
                      <span class="badge badge-success">Lunas</span>
                  <?php else: ?>
                      <span class="text-danger">Rp <?= number_format($sisa, 0, ',', '.'); ?></span>
                  <?php endif; ?>
                </td>
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

                <td class="text-center">
                    <button type="button" class="btn btn-sm btn-info edit-btn" data-nofaktur="<?= $order['no_faktur'] ?>" data-toggle="modal" data-target="#editModal<?= $order['no_faktur'] ?>">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-danger delete-btn" data-nofaktur="<?= $order['no_faktur'] ?>">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
            
            <!-- Modal Edit untuk pesanan <?= $order['no_faktur'] ?> -->
<div class="modal fade" id="editModal<?= $order['no_faktur'] ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Pesanan #<?= $order['no_faktur'] ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('Admin/updatePesanan') ?>" method="post">
        <div class="modal-body">
          <input type="hidden" name="no_faktur" value="<?= $order['no_faktur'] ?>">
          
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Nama Konsumen</label>
                <input type="text" name="nama_konsumen" class="form-control" value="<?= $order['nama_konsumen'] ?? '' ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>No HP</label>
                <input type="text" name="no_hp" class="form-control" value="<?= $order['no_hp'] ?? '' ?>">
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Tanggal Masuk</label>
                <input type="date" name="tanggal_masuk" class="form-control" 
                  value="<?= !empty($order['tanggal_masuk']) ? date('Y-m-d', strtotime($order['tanggal_masuk'])) : '' ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai" class="form-control" 
                  value="<?= !empty($order['tanggal_selesai']) ? date('Y-m-d', strtotime($order['tanggal_selesai'])) : '' ?>">
              </div>
            </div>
          </div>
          
          <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3"><?= $order['deskripsi'] ?? '' ?></textarea>
          </div>
          
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Harga Total</label>
                <input type="number" name="grand_total" class="form-control" value="<?= $order['grand_total'] ?? 0 ?>">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Dibayar</label>
                <input type="number" name="dibayar" class="form-control" value="<?= $order['dibayar'] ?? 0 ?>">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Status Pembayaran</label>
                <select name="status_pembayaran" class="form-control">
                  <option value="pending" <?= ($order['status_pembayaran'] == 'pending') ? 'selected' : '' ?>>Pending</option>
                  <option value="success" <?= ($order['status_pembayaran'] == 'success') ? 'selected' : '' ?>>Success</option>
                  <option value="failed" <?= ($order['status_pembayaran'] == 'failed') ? 'selected' : '' ?>>Failed</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Konfirmasi Delete -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah Anda yakin ingin menghapus pesanan ini?</p>
        <p>No Faktur: <strong id="delete-no-faktur"></strong></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <a id="delete-confirm-btn" href="#" class="btn btn-danger">Hapus</a>
      </div>
    </div>
  </div>
</div>


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

<script>
$(document).ready(function() {
    // Script untuk tombol delete
    $('.delete-btn').click(function() {
        const noFaktur = $(this).data('nofaktur');
        $('#delete-no-faktur').text(noFaktur);
        $('#delete-confirm-btn').attr('href', '<?= base_url('Admin/deletePesanan/') ?>' + noFaktur);
        $('#deleteModal').modal('show');
    });
});
</script>


