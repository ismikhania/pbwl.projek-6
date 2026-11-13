<?php

// Update November 2024

namespace App\Models;

use App\Core\Model;

class Penjualan extends Model
{
      public function tampil()
      {
            $sql = "SELECT * FROM tb_penjualan ORDER BY penjualan_id DESC";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();

            return $this->selects($stmt);
      }

      public function listProduk()
      {
            $sql = "SELECT * FROM tb_produk WHERE produk_stock > 0 ORDER BY produk_nama";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();

            return $this->selects($stmt);
      }

      public function listSemuaProduk()
      {
            $sql = "SELECT * FROM tb_produk ORDER BY produk_nama";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();

            return $this->selects($stmt);
      }

      public function simpan()
      {
            $this->db->beginTransaction();

            try {
                  $sql = "INSERT INTO tb_penjualan SET penjualan_tgl=NOW(), penjualan_total=0";
                  $stmt = $this->db->prepare($sql);
                  $stmt->execute();
                  $penjualan_id = $this->db->lastInsertId();

                  $this->isiDetail($penjualan_id, $_POST['produk_id'], $_POST['qty']);

                  $this->db->commit();

                  return "";
            } catch (\Exception $e) {
                  $this->db->rollBack();

                  return $e->getMessage();
            }
      }

      public function update()
      {
            $penjualan_id = $_POST['penjualan_id'];

            $this->db->beginTransaction();

            try {
                  $this->kembalikanStok($penjualan_id);
                  $this->hapusDetail($penjualan_id);
                  $this->isiDetail($penjualan_id, $_POST['produk_id'], $_POST['qty']);

                  $this->db->commit();

                  return "";
            } catch (\Exception $e) {
                  $this->db->rollBack();

                  return $e->getMessage();
            }
      }

      public function hapus($id)
      {
            $this->db->beginTransaction();

            try {
                  $this->kembalikanStok($id);
                  $this->hapusDetail($id);

                  $sql = "DELETE FROM tb_penjualan WHERE penjualan_id=:penjualan_id";
                  $stmt = $this->db->prepare($sql);
                  $stmt->bindParam(":penjualan_id", $id);
                  $stmt->execute();

                  $this->db->commit();

                  return "";
            } catch (\Exception $e) {
                  $this->db->rollBack();

                  return $e->getMessage();
            }
      }

      public function detail($id)
      {
            $query = "SELECT * FROM tb_penjualan WHERE penjualan_id=:penjualan_id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":penjualan_id", $id);
            $stmt->execute();

            return $this->select($stmt);
      }

      public function listDetail($id)
      {
            $query = "SELECT d.*, p.produk_kode, p.produk_nama FROM tb_penjualan_detail d
            LEFT JOIN tb_produk p
            ON d.detail_id_produk=p.produk_id
            WHERE d.detail_id_penjualan=:penjualan_id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":penjualan_id", $id);
            $stmt->execute();

            return $this->selects($stmt);
      }

      private function isiDetail($penjualan_id, $produk_id, $qty)
      {
            $total = 0;

            foreach ($produk_id as $i => $id) {
                  $jumlah = (int) $qty[$i];

                  if ($id == "" || $jumlah < 1) {
                        continue;
                  }

                  $sql = "SELECT produk_nama, produk_hrg, produk_stock FROM tb_produk WHERE produk_id=:produk_id FOR UPDATE";
                  $stmt = $this->db->prepare($sql);
                  $stmt->bindParam(":produk_id", $id);
                  $stmt->execute();
                  $produk = $this->select($stmt);

                  if (!$produk || $produk['produk_stock'] < $jumlah) {
                        throw new \Exception("Stok " . ($produk['produk_nama'] ?? "produk") . " tidak cukup");
                  }

                  $sql = "INSERT INTO tb_penjualan_detail SET detail_id_penjualan=:detail_id_penjualan, detail_id_produk=:detail_id_produk, detail_qty=:detail_qty, detail_hrg=:detail_hrg";
                  $stmt = $this->db->prepare($sql);
                  $stmt->bindParam(":detail_id_penjualan", $penjualan_id);
                  $stmt->bindParam(":detail_id_produk", $id);
                  $stmt->bindParam(":detail_qty", $jumlah);
                  $stmt->bindParam(":detail_hrg", $produk['produk_hrg']);
                  $stmt->execute();

                  $sql = "UPDATE tb_produk SET produk_stock=produk_stock-:jumlah WHERE produk_id=:produk_id";
                  $stmt = $this->db->prepare($sql);
                  $stmt->bindParam(":jumlah", $jumlah);
                  $stmt->bindParam(":produk_id", $id);
                  $stmt->execute();

                  $total += $produk['produk_hrg'] * $jumlah;
            }

            if ($total == 0) {
                  throw new \Exception("Belum ada produk yang dipilih");
            }

            $sql = "UPDATE tb_penjualan SET penjualan_total=:penjualan_total WHERE penjualan_id=:penjualan_id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":penjualan_total", $total);
            $stmt->bindParam(":penjualan_id", $penjualan_id);
            $stmt->execute();
      }

      private function kembalikanStok($id)
      {
            foreach ($this->listDetail($id) as $row) {
                  $jumlah = $row['detail_qty'];
                  $produk_id = $row['detail_id_produk'];

                  $sql = "UPDATE tb_produk SET produk_stock=produk_stock+:jumlah WHERE produk_id=:produk_id";
                  $stmt = $this->db->prepare($sql);
                  $stmt->bindParam(":jumlah", $jumlah);
                  $stmt->bindParam(":produk_id", $produk_id);
                  $stmt->execute();
            }
      }

      private function hapusDetail($id)
      {
            $sql = "DELETE FROM tb_penjualan_detail WHERE detail_id_penjualan=:penjualan_id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":penjualan_id", $id);
            $stmt->execute();
      }
}