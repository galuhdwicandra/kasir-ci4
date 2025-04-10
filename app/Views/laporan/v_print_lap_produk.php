<div class="col-12">
<table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr class="text-center">
            <th width="50px">No</th>
            <th>Kode</th>
            <th>Nama Produk</th>
            <th>Kategori</th>
            <th>Satuan</th>
            <th>Harga Treat</th>
            <th>Harga Akhir</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach ($produk as $key => $value) { ?>
            <tr>
              <td class="text-center"><?= $no++ ?></td>
              <td class="text-center"><?= $value['kode_produk'] ?></td>
              <td><?= $value['nama_produk'] ?></td>
              <td class="text-center"><?= $value['nama_kategori'] ?></td>
              <td class="text-center"><?= $value['nama_satuan'] ?></td>
              <td class="text-right">Rp. <?= number_format($value['harga_treat'], 0) ?></td>
              <td class="text-right">Rp. <?= number_format($value['harga_akhir'], 0) ?></td>
            </tr>
          <?php  } ?>
        </tbody>
        <b>Print Date :</b><?= date('d M Y H:i:s') ?>
      </table>
</div>