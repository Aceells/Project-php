<?php
require_once 'models/model_transaksi.php';
class controllerTransaksi {
    private $modelTransaksi;

    public function __construct() {
        $this->modelTransaksi = new modelTransaksi();
    }

    public function listTransaksi() {
        $transaksis = $this->modelTransaksi->getAllTransaksi();
        include 'views/transaksi_list.php';
    }

    public function addTransaksi($barang, $jumlah, $customer, $kasir) {
        $this->modelTransaksi->addTransaksi($barang, $jumlah, $customer, $kasir);
        header('location: index.php?modul=transaksi');
    }
}
?>