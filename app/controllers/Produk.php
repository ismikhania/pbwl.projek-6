<?php

// Update November 2024

namespace App\Controllers;

use App\Core\Controller;

class Produk extends Controller
{
     public object $model;

     public function __construct()
     {
          $this->model = new \App\Models\Produk();
     }

     public function index()
     {
          $data['rows'] = $this->model->tampil();
          $this->dashboard('produk/index', $data);
     }

     public function input()
     {
          $data['listkategori'] = $this->model->listKategori();
          $this->dashboard('produk/input', $data);
     }

     public function simpan()
     {
          $produk_photo = $this->upload();
          $this->model->simpan($produk_photo);
          header('location:' . URL . '/produk');
     }

     public function edit($id)
     {
          $data['row'] = $this->model->edit($id);
          $data['listkategori'] = $this->model->listKategori();
          $this->dashboard('produk/edit', $data);
     }

     public function update()
     {
          $produk_photo = $this->upload();

          if ($produk_photo != "") {
               $lama = $this->model->edit($_POST['produk_id']);
               $this->hapusFoto($lama['produk_photo'] ?? "");
          }

          $this->model->update($produk_photo);
          header('location:' . URL . '/produk');
     }

     public function hapus($id)
     {
          $row = $this->model->edit($id);

          try {
               $this->model->hapus($id);
               $this->hapusFoto($row['produk_photo'] ?? "");
          } catch (\PDOException $e) {
               $_SESSION['pesan'] = "Produk tidak bisa dihapus karena sudah pernah terjual";
          }

          header('location:' . URL . '/produk');
     }

     private function upload()
     {
          $produk_photo = "";

          if (!empty($_FILES['produk_photo']['name']) && $_FILES['produk_photo']['error'] == 0) {
               $ekstensi = strtolower(pathinfo($_FILES['produk_photo']['name'], PATHINFO_EXTENSION));

               if (in_array($ekstensi, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                    if (!is_dir(ROOT . "uploads")) {
                         mkdir(ROOT . "uploads");
                    }

                    $produk_photo = time() . "_" . rand(100, 999) . "." . $ekstensi;
                    move_uploaded_file($_FILES['produk_photo']['tmp_name'], ROOT . "uploads/" . $produk_photo);
               }
          }

          return $produk_photo;
     }

     private function hapusFoto($produk_photo)
     {
          if ($produk_photo != "" && file_exists(ROOT . "uploads/" . $produk_photo)) {
               unlink(ROOT . "uploads/" . $produk_photo);
          }
     }
}
