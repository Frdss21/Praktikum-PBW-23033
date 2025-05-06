<?php
include 'koneksi.php';

class Krs {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function ambilSemuaKrs() {
        $sql = "SELECT krs.id, mahasiswa.npm, mahasiswa.nama AS nama_mahasiswa, matakuliah.kodemk, matakuliah.nama AS nama_matakuliah, matakuliah.jumlah_sks 
                FROM krs 
                JOIN mahasiswa ON krs.mahasiswa_npm = mahasiswa.npm 
                JOIN matakuliah ON krs.matakuliah_kodemk = matakuliah.kodemk";
        return mysqli_query($this->conn, $sql);
    }

    public function ambilMahasiswa() {
        $sql = "SELECT npm, nama FROM mahasiswa";
        return mysqli_query($this->conn, $sql);
    }

    public function ambilMatakuliah() {
        $sql = "SELECT kodemk, nama FROM matakuliah";
        return mysqli_query($this->conn, $sql);
    }

    public function ambilKrsById($id) {
        $sql = "SELECT * FROM krs WHERE id=$id";
        $result = mysqli_query($this->conn, $sql);
        return mysqli_fetch_assoc($result);
    }

    public function tambah($mahasiswa_npm, $matakuliah_kodemk) {
        $sql = "INSERT INTO krs (mahasiswa_npm, matakuliah_kodemk) VALUES ('$mahasiswa_npm', '$matakuliah_kodemk')";
        return mysqli_query($this->conn, $sql);
    }

    public function perbarui($id, $mahasiswa_npm, $matakuliah_kodemk) {
        $sql = "UPDATE krs SET mahasiswa_npm='$mahasiswa_npm', matakuliah_kodemk='$matakuliah_kodemk' WHERE id=$id";
        return mysqli_query($this->conn, $sql);
    }

    public function hapus($id) {
        $sql = "DELETE FROM krs WHERE id=$id";
        return mysqli_query($this->conn, $sql);
    }
}
?>