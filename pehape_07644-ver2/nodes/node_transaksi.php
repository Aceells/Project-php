<?php
class Transaksi {
    public $idTransaksi;
    public $barangs=[];
    public $jumlahs=[];
    public $total;
    public $customer;
    public $kasir;

    public function __construct($idTransaksi, $barang, $jumlah, $customer, $kasir) {
        $this->idTransaksi = $idTransaksi;
        $this->barangs = $barang;
        $this->jumlahs = $jumlah;
        // $this->total = $this->calculateTotal();
        $this->customer = $customer;
        $this->kasir = $kasir;
    }
}
?>