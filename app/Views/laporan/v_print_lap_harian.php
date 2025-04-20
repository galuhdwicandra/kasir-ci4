<div class="col-12">
        <b>Tanggal:</b> <?= $tgl ?>
    <table class="table table-bordered table-striped">
    <tr>
        <th>No</th>
        <th>Kode</th>
        <th>Nama Produk</th>
        <th>No Faktur</th>
        <th>Nama</th>
        <th>No_hp</th>
        <th>Deskripsi</th>
        <th>Treat</th>
        <th>Akhir</th>
        <th>QTY</th>
        <th>Harga</th>
        <th>Untung</th>
    </tr>
    <?php $no = 1;
    foreach ($dataharian as $key => $value) {
        $grandtotal[] = $value['total_harga'];
        $granduntung[] = $value['untung'];
    ?>
        <tr>
            <td class="text-center"><?= $no++ ?></td>
            <td class="text-center"><?= $value['kode_produk'] ?></td>
            <td><?= $value['nama_produk'] ?></td>
            <td><?= $value['no_faktur'] ?></td>
            <td><?= $value['nama_konsumen'] ?></td>
            <td><?= $value['no_hp'] ?></td>
            <td><?= $value['deskripsi'] ?></td>
            <td class="text-right">Rp. <?= number_format($value['modal'], 0) ?></td>
            <td class="text-right">Rp. <?= number_format($value['harga'], 0) ?></td>
            <td class="text-center"><?= $value['qty'] ?></td>
            <td class="text-right">Rp. <?= number_format($value['total_harga'], 0) ?></td>
            <td class="text-right">Rp. <?= number_format($value['untung'], 0) ?></td>
        </tr>
    <?php } ?>
    <tr class="text-center bg-cyan">
        <td colspan="6">
            <h5>Grand Total</h5>
        </td>
        <td class="text-right">
            Rp. <?= $dataharian == null ? '' : number_format(array_sum($grandtotal), 0) ?>
        </td>
        <td class="text-right">
            Rp. <?= $dataharian == null ? '' : number_format(array_sum($granduntung), 0) ?>
        </td>
    </tr>
</table>
    </div>