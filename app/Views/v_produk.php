<div class="col-md-12">
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title"><?= $subjudul ?></h3>

      <div class="card-tools">
        <button type="button" onclick="NewWin=window.open('<?= base_url('Laporan/PrintDataProduk') ?>','NewWin','toolbar=no,width=1100,height=1100,scrollbars=yes')" class="btn btn-tool"><i class="fas fa-print"></i> Print
        </button>
        <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#add-data"><i class="fas fa-plus"></i> Add Data
        </button>
      </div>
      <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">

      <?php
      if (session()->getFlashdata('pesan')) {
        echo '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i>';
        echo session()->getFlashdata('pesan');
        echo '</h5>
                    </div>';
      }
      ?>

      <?php
      $errors = session()->getFlashdata('errors');
      if (!empty($errors)) { ?>
        <div class="alert alert-danger alert-dismissible">
          <h4>Periksa Lagi Entry Form !!</h4>
          <ul>
            <?php foreach ($errors as $key => $error) { ?>
              <li><?= esc($error) ?></li>
            <?php } ?>
          </ul>
        </div>
      <?php } ?>
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
            <th width="100px">Aksi</th>
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
              <td>
                <button class="btn btn-warning btn-sm btn-flat" data-toggle="modal" data-target="#edit-data<?= $value['id_produk'] ?>"><i class="fas fa-pencil-alt"></i></button>
                <button class="btn btn-danger btn-sm btn-flat" data-toggle="modal" data-target="#delete-data<?= $value['id_produk'] ?>"><i class="fas fa-trash"></i></button>

              </td>
            </tr>
          <?php  } ?>
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>

<!-- Modal Add Data -->
<div class="modal fade" id="add-data">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Data <?= $subjudul ?></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php echo form_open('Produk/InsertData') ?>
      <div class="modal-body">

        <div class="form-group">
          <label for="">Kode Produk</label>
          <input name="kode_produk" class="form-control" value="<?= old('kode_produk') ?>" placeholder="Kode Produk" required>
        </div>

        <div class="form-group">
          <label for="">Nama Produk</label>
          <input name="nama_produk" class="form-control" value="<?= old('nama_produk') ?>" placeholder="Nama Produk" required>
        </div>

        <div class="form-group">
          <label for="">Kategori</label>
          <select name="id_kategori" class="form-control">.
            <option value="">--Pilih Kategori--</option>
            <?php foreach ($kategori as $key => $value) { ?>
              <option value="<?= $value['id_kategori'] ?>"><?= $value['nama_kategori'] ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group">
          <label for="">Satuan</label>
          <select name="id_satuan" class="form-control">.
            <option value="">--Pilih Satuan--</option>
            <?php foreach ($satuan as $key => $value) { ?>
              <option value="<?= $value['id_satuan'] ?>"><?= $value['nama_satuan'] ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group">
          <label for="">Harga Treat</label>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">Rp.</span>
            </div>
            <input name="harga_treat" id="harga_treat" value="<?= old('harga_treat') ?>" class="form-control" placeholder="Harga Treat" required>
          </div>
        </div>

        <div class="form-group">
          <label for="">Harga Akhir</label>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">Rp.</span>
            </div>
            <input name="harga_akhir" id="harga_akhir" value="<?= old('harga_akhir') ?>" class="form-control" placeholder="Harga Akhir" required>
          </div>
        </div>

      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary btn-flat">Save</button>
      </div>
    </div>
    <?php echo form_close() ?>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<?php foreach ($produk as $key => $value) { ?>
  <!-- Modal Edit Data -->
  <div class="modal fade" id="edit-data<?= $value['id_produk'] ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Data <?= $subjudul ?></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <?php echo form_open('Produk/UpdateData/' . $value['id_produk']) ?>
        <div class="modal-body">

          <div class="form-group">
            <label for="">Kode Produk</label>
            <input name="kode_produk" class="form-control" value="<?= $value['kode_produk'] ?>" placeholder="Kode Produk" readonly>
          </div>

          <div class="form-group">
            <label for="">Nama Produk</label>
            <input name="nama_produk" class="form-control" value="<?= $value['nama_produk'] ?>" placeholder="Nama Produk" required>
          </div>

          <div class="form-group">
            <label for="">Kategori</label>
            <select name="id_kategori" class="form-control">.
              <option value="">--Pilih Kategori--</option>
              <?php foreach ($kategori as $key => $k) { ?>
                <option value="<?= $k['id_kategori'] ?>" <?= $value['id_kategori'] == $k['id_kategori'] ? 'Selected' : '' ?>><?= $k['nama_kategori'] ?></option>
              <?php } ?>
            </select>
          </div>

          <div class="form-group">
            <label for="">Satuan</label>
            <select name="id_satuan" class="form-control">.
              <option value="">--Pilih Satuan--</option>
              <?php foreach ($satuan as $key => $s) { ?>
                <option value="<?= $s['id_satuan'] ?>" <?= $value['id_satuan'] == $s['id_satuan'] ? 'Selected' : '' ?>><?= $s['nama_satuan'] ?></option>
              <?php } ?>
            </select>
          </div>

          <div class="form-group">
            <label for="">Harga Treat</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">Rp.</span>
              </div>
              <input name="harga_treat" id="harga_treat<?= $value['id_produk'] ?>" value="<?= $value['harga_treat'] ?>" class="form-control" placeholder="Harga Treat" required>
            </div>
          </div>

          <div class="form-group">
            <label for="">Harga Akhir</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">Rp.</span>
              </div>
              <input name="harga_akhir" id="harga_akhir<?= $value['id_produk'] ?>" value="<?= $value['harga_akhir'] ?>" class="form-control" placeholder="Harga Akhir" required>
            </div>
          </div>

        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btn-flat">Save</button>
        </div>
      </div>
      <?php echo form_close() ?>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
<?php } ?>

<!-- Modal Delete Data -->
<?php foreach ($produk as $key => $value) { ?>
  <div class="modal fade" id="delete-data<?= $value['id_produk'] ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete Data <?= $subjudul ?></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <p>Yakin ingin menghapus data ini?</p>
          <p><strong><?= $value['nama_produk'] ?></strong></p>
        </div>

        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
          <a href="<?= base_url('Produk/DeleteData/' . $value['id_produk']) ?>" class="btn btn-danger btn-flat">Delete</a>
        </div>
      </div>
      <?php echo form_close() ?>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
<?php } ?>

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

  new AutoNumeric('#harga_treat', {
    digitGroupSeparator: ',',
    decimalPlaces: 0
  });

  new AutoNumeric('#harga_akhir', {
    digitGroupSeparator: ',',
    decimalPlaces: 0,
  });

  <?php foreach ($produk as $key => $value) { ?>
    new AutoNumeric('#harga_treat<?= $value['id_produk'] ?>', {
      digitGroupSeparator: ',',
      decimalPlaces: 0
    });

    new AutoNumeric('#harga_akhir<?= $value['id_produk'] ?>', {
      digitGroupSeparator: ',',
      decimalPlaces: 0,
    });
  <?php } ?>
</script>