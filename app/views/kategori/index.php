<h2>Kategori</h2>

<?php if (isset($_SESSION['pesan'])) { ?>
      <div class="alert alert-danger"><?php echo $_SESSION['pesan']; unset($_SESSION['pesan']); ?></div>
<?php } ?>

<a href="<?php echo URL; ?>/kategori/input" class="btn btn-primary mb-3">Input Kategori</a>

<table class="table table-bordered">
      <tr>
            <th>NO</th>
            <th>NAMA</th>
            <th>KETERANGAN</th>
            <th>EDIT</th>
            <th>HAPUS</th>
      </tr>

      <?php foreach ($data['rows'] as $row) { ?>
            <tr>
                  <td><?php echo $row['kat_id']; ?></td>
                  <td><?php echo $row['kat_nama']; ?></td>
                  <td><?php echo $row['kat_keterangan']; ?></td>
                  <td><a href="<?php echo URL; ?>/kategori/edit/<?php echo $row['kat_id']; ?>" class="btn btn-primary">Edit</a></td>
                  <td><a href="<?php echo URL; ?>/kategori/hapus/<?php echo $row['kat_id']; ?>" class="btn btn-danger" onclick="return confirm('Yakin hapus data ini?')">Hapus</a></td>
            </tr>
      <?php } ?>

</table>