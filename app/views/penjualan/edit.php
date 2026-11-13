<h2>Edit Penjualan</h2>

<?php if (isset($_SESSION['pesan'])) { ?>
    <div class="alert alert-danger"><?php echo $_SESSION['pesan']; unset($_SESSION['pesan']); ?></div>
<?php } ?>

<form action="<?php echo URL; ?>/penjualan/update" method="post">
    <input type="hidden" name="penjualan_id" value="<?php echo $data['row']['penjualan_id']; ?>">
    <table class="table table-borderless" style="max-width: 800px;" id="tabel-item">
        <tr>
            <th>PRODUK</th>
            <th style="width: 150px;">JUMLAH</th>
        </tr>
        <?php foreach ($data['rows'] as $item) { ?>
            <tr class="item">
                <td>
                    <select name="produk_id[]" class="form-select">
                        <option value="">-- Pilih Produk --</option>
                        <?php foreach ($data['listproduk'] as $produk) { ?>
                            <option value="<?php echo $produk['produk_id']; ?>" <?php if ($produk['produk_id'] == $item['detail_id_produk']) { echo "selected"; } ?>>
                                <?php echo $produk['produk_kode']; ?> - <?php echo $produk['produk_nama']; ?>
                                (Rp <?php echo number_format($produk['produk_hrg'], 0, ',', '.'); ?>)
                            </option>
                        <?php } ?>
                    </select>
                </td>
                <td><input type="number" name="qty[]" value="<?php echo $item['detail_qty']; ?>" min="1" class="form-control"></td>
            </tr>
        <?php } ?>
    </table>

    <button type="button" class="btn btn-secondary" onclick="tambahBaris()">Tambah Produk</button>
    <input type="submit" name="btn_update" value="UPDATE" class="btn btn-primary">
    <a href="<?php echo URL; ?>/penjualan" class="btn btn-light">Batal</a>
</form>

<script>
    function tambahBaris() {
        var tabel = document.getElementById("tabel-item");
        var baris = tabel.querySelector(".item").cloneNode(true);

        baris.querySelector("select").value = "";
        baris.querySelector("input").value = 1;
        tabel.tBodies[0].appendChild(baris);
    }
</script>