<?php
require_once 'nodes/node_transaksi.php';
require_once 'nodes/node_barang.php';
require_once 'nodes/node_user.php';
class modelTransaksi {
    private $transaksis = [];
    private $nextId = 1;
    private $objTransaksi;

    public function __construct() {
        if (isset($_SESSION['transaksis'])) {
            $this->transaksis = unserialize($_SESSION['transaksis']);
            $this->nextId = count($this->transaksis) + 1;
        } else {
            $this->initializeDefaultTransaksi();
        }
    }

    public function addTransaksi($barang, $jumlah, $customer, $kasir) {
        $transaksi = new \Transaksi($this->nextId++, $barang, $jumlah, $customer, $kasir);
        $this->transaksis[] = $transaksi;
        $this->saveToSession();
    }

    private function saveToSession() {
        $_SESSION['transaksis'] = serialize($this->transaksis);
    }

    public function getAllTransaksi() {
        return $this->transaksis;
    }

    // public function initDefaultTransaksi() {
    //     $this->addTransaksi();
    // }

    public function getBarangInTransaksi($id) {
        foreach ($this->transaksis as $transaksi) {
            if ($transaksi->idTransaksi == $id) {
                return $transaksi;
            }
        }
        return null;
    }

    private function initializeDefaultTransaksi() {
        $objectUser = new modelUser();
        $obj_barang = new modelBarang();
        $barang1 = $obj_barang->getBarangById(1);
        $jumlah1 = 2;
        $barang2 = $obj_barang->getBarangById(2);
        $jumlah2 = 3;

        $barangsA[] = $barang1;
        $barangsA[] = $barang2;
        $barangsB[] = $barang1;

        $jumlahsA[] = 2;
        $jumlahsA[] = 6;
        $jumlahsB[] = 2;

        $this->addTransaksi($barangsA, $jumlahsA, $objectUser->getUserById(1), $objectUser->getUserById(2));
        $this->addTransaksi($barangsB, $jumlahsB, $objectUser->getUserById(1), $objectUser->getUserById(2));

    }
}
?>