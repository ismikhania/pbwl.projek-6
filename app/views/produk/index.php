<h2>Produk</h2>

<?php if (isset($_SESSION['pesan'])) { ?>
      <div class="alert alert-danger"><?php echo $_SESSION['pesan']; unset($_SESSION['pesan']); ?></div>
<?php } ?>

<a href="<?php echo URL; ?>/produk/input" class="btn btn-primary mb-3">Input Produk</a>

<table class="table table-bordered">
      <tr>
            <th>NO</th>
            <th>FOTO</th>
            <th>KATEGORI</th>
            <th>KODE</th>
            <th>NAMA</th>
            <th>HARGA</th>
            <th>STOK</th>
            <th>EDIT</th>
            <th>HAPUS</th>
      </tr>

      <?php $no = 1; ?>
      <?php foreach ($data['rows'] as $row) { ?>
            <tr>
                  <td><?php echo $no++; ?></td>
                  <td>
                        <?php if ($row['produk_photo'] != "") { ?>
                              <img src="<?php echo URL; ?>/uploads/<?php echo $row['produk_photo']; ?>" width="80">
                        <?php } ?>
                  </td>
                  <td><?php echo $row['ktgr']; ?></td>
                  <td><?php echo $row['produk_kode']; ?></td>
                  <td><?php echo $row['produk_nama']; ?></td>
                  <td><?php echo number_format($row['produk_hrg'], 0, ',', '.'); ?></td>
                  <td><?php echo $row['produk_stock']; ?></td>
                  <td><a href="<?php echo URL; ?>/produk/edit/<?php echo $row['produk_id']; ?>" class="btn btn-primary">Edit</a></td>
                  <td><a href="<?php echo URL; ?>/produk/hapus/<?php echo $row['produk_id']; ?>" class="btn btn-danger" onclick="return confirm('Yakin hapus data ini?')">Hapus</a></td>
            </tr>
      <?php } ?>

</table>
