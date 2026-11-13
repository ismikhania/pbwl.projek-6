<?php

// Update November 2024

namespace App\Models;

use App\Core\Model;

class Produk extends Model
{
      public function tampil()
      {
            $sql = "SELECT p.*, k.kat_nama AS ktgr FROM tb_produk p
            LEFT JOIN tb_kategori k
            ON p.produk_id_kat=k.kat_id";

            $stmt = $this->db->prepare($sql);
            $stmt->execute();

            return $this->selects($stmt);
      }

      public function listKategori()
      {
            $query = "SELECT * FROM tb_kategori";
            $stmt = $this->db->prepare($query);
            $stmt->execute();

            return $this->selects($stmt);
      }

      public function simpan($produk_photo)
      {
            $produk_id_kat = $_POST['produk_id_kat'];
            $produk_kode = $_POST['produk_kode'];
            $produk_nama = $_POST['produk_nama'];
            $produk_hrg = $_POST['produk_hrg'];
            $produk_keterangan = $_POST['produk_keterangan'];
            $produk_stock = $_POST['produk_stock'];

            $sql = "INSERT INTO tb_produk SET produk_id_kat=:produk_id_kat, produk_kode=:produk_kode, produk_nama=:produk_nama, produk_hrg=:produk_hrg, produk_keterangan=:produk_keterangan, produk_stock=:produk_stock, produk_photo=:produk_photo";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":produk_id_kat", $produk_id_kat);
            $stmt->bindParam(":produk_kode", $produk_kode);
            $stmt->bindParam(":produk_nama", $produk_nama);
            $stmt->bindParam(":produk_hrg", $produk_hrg);
            $stmt->bindParam(":produk_keterangan", $produk_keterangan);
            $stmt->bindParam(":produk_stock", $produk_stock);
            $stmt->bindParam(":produk_photo", $produk_photo);
            $stmt->execute();
      }

      public function edit($id)
      {
            $query = "SELECT * FROM tb_produk WHERE produk_id=:produk_id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":produk_id", $id);
            $stmt->execute();

            return $this->select($stmt);
      }

      public function update($produk_photo)
      {
            $produk_id = $_POST['produk_id'];
            $produk_id_kat = $_POST['produk_id_kat'];
            $produk_kode = $_POST['produk_kode'];
            $produk_nama = $_POST['produk_nama'];
            $produk_hrg = $_POST['produk_hrg'];
            $produk_keterangan = $_POST['produk_keterangan'];
            $produk_stock = $_POST['produk_stock'];

            $sql = "UPDATE tb_produk SET produk_id_kat=:produk_id_kat, produk_kode=:produk_kode, produk_nama=:produk_nama, produk_hrg=:produk_hrg, produk_keterangan=:produk_keterangan, produk_stock=:produk_stock";

            if ($produk_photo != "") {
                  $sql .= ", produk_photo=:produk_photo";
            }

            $sql .= " WHERE produk_id=:produk_id";

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":produk_id_kat", $produk_id_kat);
            $stmt->bindParam(":produk_kode", $produk_kode);
            $stmt->bindParam(":produk_nama", $produk_nama);
            $stmt->bindParam(":produk_hrg", $produk_hrg);
            $stmt->bindParam(":produk_keterangan", $produk_keterangan);
            $stmt->bindParam(":produk_stock", $produk_stock);
            $stmt->bindParam(":produk_id", $produk_id);

            if ($produk_photo != "") {
                  $stmt->bindParam(":produk_photo", $produk_photo);
            }

            $stmt->execute();
      }

      public function hapus($id)
      {
            $sql = "DELETE FROM tb_produk WHERE produk_id=:produk_id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":produk_id", $id);
            $stmt->execute();
      }
}