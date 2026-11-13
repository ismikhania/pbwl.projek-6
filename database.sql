CREATE TABLE tb_kategori (
	kat_id TINYINT(3) NOT NULL AUTO_INCREMENT,
	kat_nama VARCHAR(50) NOT NULL,
	kat_keterangan TEXT DEFAULT NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at DATETIME DEFAULT NULL,
	PRIMARY KEY(kat_id)
);

CREATE TABLE tb_produk (
	produk_id INT(11) NOT NULL AUTO_INCREMENT,
	produk_id_kat TINYINT(3) NOT NULL,
	produk_kode VARCHAR(50) NOT NULL,
	produk_nama VARCHAR(100) NOT NULL,
	produk_hrg INT DEFAULT '0',
	produk_keterangan TEXT,
	produk_stock INT DEFAULT '0',
	produk_photo VARCHAR(255),
	PRIMARY KEY(produk_id),
	FOREIGN KEY(produk_id_kat) REFERENCES tb_kategori(kat_id)
)

CREATE TABLE tb_penjualan (
    penjualan_id INT(11) NOT NULL AUTO_INCREMENT,
    penjualan_kode VARCHAR(50) NOT NULL,
    penjualan_tgl DATE NOT NULL,
    penjualan_total INT DEFAULT '0',
    penjualan_bayar INT DEFAULT '0',
    penjualan_kembali INT DEFAULT '0',
    PRIMARY KEY(penjualan_id)
);

CREATE TABLE tb_penjualan_detail (
    detail_id INT(11) NOT NULL AUTO_INCREMENT,
    detail_id_penjualan INT(11) NOT NULL,
    detail_id_produk INT(11) NOT NULL,
    detail_qty INT DEFAULT '0',
    detail_hrg INT DEFAULT '0',
    detail_subtotal INT DEFAULT '0',
    PRIMARY KEY(detail_id),
    FOREIGN KEY(detail_id_penjualan) REFERENCES tb_penjualan(penjualan_id),
    FOREIGN KEY(detail_id_produk) REFERENCES tb_produk(produk_id)
);