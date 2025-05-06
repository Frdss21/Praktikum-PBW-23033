<?php
include 'koneksi.php';

class Matakuliah {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function ambilSemuaMatakuliah() {
        $sql = "SELECT * FROM matakuliah";
        return mysqli_query($this->conn, $sql);
    }

    public function ambilMatakuliahByKode($kodemk) {
        $sql = "SELECT * FROM matakuliah WHERE kodemk='$kodemk'";
        $result = mysqli_query($this->conn, $sql);
        return mysqli_fetch_assoc($result);
    }

    // Fungsi untuk memeriksa apakah Kode MK sudah ada
    public function cekKodeMK($kodemk) {
        $sql = "SELECT * FROM matakuliah WHERE kodemk='$kodemk'";
        $result = mysqli_query($this->conn, $sql);
        return mysqli_num_rows($result) > 0;
    }

    public function tambah($kodemk, $nama, $jumlah_sks) {
        // Validasi: Cek apakah Kode MK sudah ada
        if ($this->cekKodeMK($kodemk)) {
            return false; // Kode MK sudah ada, gagal menambah
        }
        $sql = "INSERT INTO matakuliah (kodemk, nama, jumlah_sks) VALUES ('$kodemk', '$nama', $jumlah_sks)";
        return mysqli_query($this->conn, $sql);
    }

    public function perbarui($kodemk, $nama, $jumlah_sks) {
        // Tidak perlu validasi duplikat saat update karena Kode MK tidak berubah (readonly)
        $sql = "UPDATE matakuliah SET nama='$nama', jumlah_sks=$jumlah_sks WHERE kodemk='$kodemk'";
        return mysqli_query($this->conn, $sql);
    }

    public function hapus($kodemk) {
        $sql = "DELETE FROM matakuliah WHERE kodemk='$kodemk'";
        return mysqli_query($this->conn, $sql);
    }
}
?>