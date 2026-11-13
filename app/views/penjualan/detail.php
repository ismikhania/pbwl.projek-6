<h2>Detail Penjualan</h2>

<p>Tanggal : <?php echo date('d-m-Y H:i', strtotime($data['row']['penjualan_tgl'])); ?></p>

<table class="table table-bordered">
      <tr>
            <th>NO</th>
            <th>KODE</th>
            <th>NAMA</th>
            <th>HARGA</th>
            <th>JUMLAH</th>
            <th>SUBTOTAL</th>
      </tr>

      <?php $no = 1; ?>
      <?php foreach ($data['rows'] as $row) { ?>
            <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $row['produk_kode']; ?></td>
                  <td><?php echo $row['produk_nama']; ?></td>
                  <td><?php echo number_format($row['detail_hrg'], 0, ',', '.'); ?></td>
                  <td><?php echo $row['detail_qty']; ?></td>
                  <td><?php echo number_format($row['detail_hrg'] * $row['detail_qty'], 0, ',', '.'); ?></td>
            </tr>
      <?php } ?>

      <tr>
            <th colspan="5">TOTAL</th>
            <th>Rp <?php echo number_format($data['row']['penjualan_total'], 0, ',', '.'); ?></th>
      </tr>
</table>

<a href="<?php echo URL; ?>/penjualan" class="btn btn-primary">Kembali</a>