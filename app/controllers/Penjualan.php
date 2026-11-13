<?php

// Update November 2024

namespace App\Controllers;

use App\Core\Controller;

class Penjualan extends Controller
{
     public object $model;

     public function __construct()
     {
          $this->model = new \App\Models\Penjualan();
     }

     public function index()
     {
          $data['rows'] = $this->model->tampil();
          $this->dashboard('penjualan/index', $data);
     }

     public function input()
     {
          $data['listproduk'] = $this->model->listProduk();
          $this->dashboard('penjualan/input', $data);
     }

     public function simpan()
     {
          $pesan = $this->model->simpan();

          if ($pesan != "") {
               $_SESSION['pesan'] = $pesan;
               header('location:' . URL . '/penjualan/input');
          } else {
               header('location:' . URL . '/penjualan');
          }
     }

     public function detail($id)
     {
          $data['row'] = $this->model->detail($id);
          $data['rows'] = $this->model->listDetail($id);
          $this->dashboard('penjualan/detail', $data);
     }

     public function edit($id)
     {
          $data['row'] = $this->model->detail($id);
          $data['rows'] = $this->model->listDetail($id);
          $data['listproduk'] = $this->model->listSemuaProduk();
          $this->dashboard('penjualan/edit', $data);
     }

     public function update()
     {
          $pesan = $this->model->update();

          if ($pesan != "") {
               $_SESSION['pesan'] = $pesan;
               header('location:' . URL . '/penjualan/edit/' . $_POST['penjualan_id']);
          } else {
               header('location:' . URL . '/penjualan');
          }
     }

     public function hapus($id)
     {
          $pesan = $this->model->hapus($id);

          if ($pesan != "") {
               $_SESSION['pesan'] = $pesan;
          }

          header('location:' . URL . '/penjualan');
     }
}