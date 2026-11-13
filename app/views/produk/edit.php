<h2>Edit Produk</h2>

<form action="<?php echo URL; ?>/produk/update" method="post" enctype="multipart/form-data">
    <input type="hidden" name="produk_id" value="<?php echo $data['row']['produk_id']; ?>">
    <table class="table table-borderless" style="max-width: 800px;">
        <tr>
            <td style="width: 200px;">Kategori</td>
            <td>
                <select name="produk_id_kat" class="form-select" required>
                    <?php foreach ($data['listkategori'] as $kat) { ?>
                        <option value="<?php echo $kat['kat_id']; ?>" <?php if ($kat['kat_id'] == $data['row']['produk_id_kat']) { echo "selected"; } ?>><?php echo $kat['kat_nama']; ?></option>
                    <?php } ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Kode Produk</td>
            <td><input type="text" name="produk_kode" value="<?php echo $data['row']['produk_kode']; ?>" class="form-control" maxlength="50" required></td>
        </tr>
        <tr>
            <td>Nama Produk</td>
            <td><input type="text" name="produk_nama" value="<?php echo $data['row']['produk_nama']; ?>" class="form-control" maxlength="100" required></td>
        </tr>
        <tr>
            <td>Harga Produk</td>
            <td><input type="number" name="produk_hrg" value="<?php echo $data['row']['produk_hrg']; ?>" class="form-control" min="0" required></td>
        </tr>
        <tr>
            <td>Keterangan</td>
            <td><textarea name="produk_keterangan" class="form-control" rows="4"><?php echo $data['row']['produk_keterangan']; ?></textarea></td>
        </tr>
        <tr>
            <td>Stok Produk</td>
            <td><input type="number" name="produk_stock" value="<?php echo $data['row']['produk_stock']; ?>" class="form-control" min="0" required></td>
        </tr>
        <tr>
            <td>Foto Produk</td>
            <td>
                <?php if ($data['row']['produk_photo'] != "") { ?>
                    <img src="<?php echo URL; ?>/uploads/<?php echo $data['row']['produk_photo']; ?>" width="100" class="mb-2"><br>
                <?php } ?>
                <input type="file" name="produk_photo" class="form-control" accept="image/*">
                <small>Kosongkan jika foto tidak diganti</small>
            </td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="btn_update" value="UPDATE" class="btn btn-primary"></td>
        </tr>
    </table>
</form>