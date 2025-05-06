<?php
include 'koneksi.php';

class Mahasiswa {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function ambilSemuaMahasiswa() {
        $sql = "SELECT * FROM mahasiswa";
        return mysqli_query($this->conn, $sql);
    }

    public function ambilMahasiswaByNpm($npm) {
        $sql = "SELECT * FROM mahasiswa WHERE npm='$npm'";
        $result = mysqli_query($this->conn, $sql);
        return mysqli_fetch_assoc($result);
    }

    public function tambah($npm, $nama, $jurusan, $alamat) {
        $sql = "INSERT INTO mahasiswa (npm, nama, jurusan, alamat) VALUES ('$npm', '$nama', '$jurusan', '$alamat')";
        return mysqli_query($this->conn, $sql);
    }

    public function perbarui($npm, $nama, $jurusan, $alamat) {
        $sql = "UPDATE mahasiswa SET nama='$nama', jurusan='$jurusan', alamat='$alamat' WHERE npm='$npm'";
        return mysqli_query($this->conn, $sql);
    }

    public function hapus($npm) {
        $sql = "DELETE FROM mahasiswa WHERE npm='$npm'";
        return mysqli_query($this->conn, $sql);
    }
}
?>