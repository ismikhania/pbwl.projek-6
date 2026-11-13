<h2>Penjualan</h2>

<?php if (isset($_SESSION['pesan'])) { ?>
      <div class="alert alert-danger"><?php echo $_SESSION['pesan']; unset($_SESSION['pesan']); ?></div>
<?php } ?>

<a href="<?php echo URL; ?>/penjualan/input" class="btn btn-primary mb-3">Input Penjualan</a>

<table class="table table-bordered">
      <tr>
            <th>NO</th>
            <th>TANGGAL</th>
            <th>TOTAL</th>
            <th>DETAIL</th>
            <th>EDIT</th>
            <th>HAPUS</th>
      </tr>

      <?php $no = 1; ?>
      <?php foreach ($data['rows'] as $row) { ?>
            <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo date('d-m-Y H:i', strtotime($row['penjualan_tgl'])); ?></td>
                  <td>Rp <?php echo number_format($row['penjualan_total'], 0, ',', '.'); ?></td>
                  <td><a href="<?php echo URL; ?>/penjualan/detail/<?php echo $row['penjualan_id']; ?>" class="btn btn-primary">Detail</a></td>
                  <td><a href="<?php echo URL; ?>/penjualan/edit/<?php echo $row['penjualan_id']; ?>" class="btn btn-warning">Edit</a></td>
                  <td><a href="<?php echo URL; ?>/penjualan/hapus/<?php echo $row['penjualan_id']; ?>" class="btn btn-danger" onclick="return confirm('Yakin hapus penjualan ini? Stok produk akan dikembalikan.')">Hapus</a></td>
            </tr>
      <?php } ?>

</table>