<h2>Input Penjualan</h2>

<?php if (isset($_SESSION['pesan'])) { ?>
    <div class="alert alert-danger"><?php echo $_SESSION['pesan']; unset($_SESSION['pesan']); ?></div>
<?php } ?>

<form action="<?php echo URL; ?>/penjualan/simpan" method="post">
    <table class="table table-borderless" style="max-width: 800px;" id="tabel-item">
        <tr>
            <th>PRODUK</th>
            <th style="width: 150px;">JUMLAH</th>
        </tr>
        <tr class="item">
            <td>
                <select name="produk_id[]" class="form-select">
                    <option value="">-- Pilih Produk --</option>
                    <?php foreach ($data['listproduk'] as $produk) { ?>
                        <option value="<?php echo $produk['produk_id']; ?>">
                            <?php echo $produk['produk_kode']; ?> - <?php echo $produk['produk_nama']; ?>
                            (Rp <?php echo number_format($produk['produk_hrg'], 0, ',', '.'); ?>, stok <?php echo $produk['produk_stock']; ?>)
                        </option>
                    <?php } ?>
                </select>
            </td>
            <td><input type="number" name="qty[]" value="1" min="1" class="form-control"></td>
        </tr>
    </table>

    <button type="button" class="btn btn-secondary" onclick="tambahBaris()">Tambah Produk</button>
    <input type="submit" name="btn_simpan" value="SIMPAN" class="btn btn-primary">
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