<?php
include 'koneksi.php';
include 'Mahasiswa.php';
include 'Matakuliah.php';
include 'Krs.php';

$mahasiswa = new Mahasiswa($conn);
$matakuliah = new Matakuliah($conn);
$krs = new Krs($conn);

// Proses CRUD berdasarkan aksi
$page = isset($_GET['page']) ? $_GET['page'] : 'krs';
$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($page == 'mahasiswa' && $action == 'insert') {
        $npm = $_POST['npm'];
        $nama = $_POST['nama'];
        $jurusan = $_POST['jurusan'];
        $alamat = $_POST['alamat'];
        if ($mahasiswa->tambah($npm, $nama, $jurusan, $alamat)) {
            header("Location: index.php?page=mahasiswa&success=Data mahasiswa berhasil ditambahkan");
        } else {
            header("Location: index.php?page=mahasiswa&error=Gagal menambahkan data mahasiswa");
        }
    } elseif ($page == 'mahasiswa' && $action == 'update') {
        $npm = $_POST['npm'];
        $nama = $_POST['nama'];
        $jurusan = $_POST['jurusan'];
        $alamat = $_POST['alamat'];
        if ($mahasiswa->perbarui($npm, $nama, $jurusan, $alamat)) {
            header("Location: index.php?page=mahasiswa&success=Data mahasiswa berhasil diperbarui");
        } else {
            header("Location: index.php?page=mahasiswa&error=Gagal memperbarui data mahasiswa");
        }
    } elseif ($page == 'matakuliah' && $action == 'insert') {
        $kodemk = $_POST['kodemk'];
        $nama = $_POST['nama'];
        $jumlah_sks = $_POST['jumlah_sks'];
        if ($matakuliah->cekKodeMK($kodemk)) {
            header("Location: index.php?page=matakuliah&error=Kode MK sudah ada, silakan gunakan Kode MK lain");
        } elseif ($matakuliah->tambah($kodemk, $nama, $jumlah_sks)) {
            header("Location: index.php?page=matakuliah&success=Data mata kuliah berhasil ditambahkan");
        } else {
            header("Location: index.php?page=matakuliah&error=Gagal menambahkan data mata kuliah");
        }
    } elseif ($page == 'matakuliah' && $action == 'update') {
        $kodemk = $_POST['kodemk'];
        $nama = $_POST['nama'];
        $jumlah_sks = $_POST['jumlah_sks'];
        if ($matakuliah->perbarui($kodemk, $nama, $jumlah_sks)) {
            header("Location: index.php?page=matakuliah&success=Data mata kuliah berhasil diperbarui");
        } else {
            header("Location: index.php?page=matakuliah&error=Gagal memperbarui data mata kuliah");
        }
    } elseif ($page == 'krs' && $action == 'insert') {
        $mahasiswa_npm = $_POST['mahasiswa_npm'];
        $matakuliah_kodemk = $_POST['matakuliah_kodemk'];
        if ($krs->tambah($mahasiswa_npm, $matakuliah_kodemk)) {
            header("Location: index.php?page=krs&success=Data KRS berhasil ditambahkan");
        } else {
            header("Location: index.php?page=krs&error=Gagal menambahkan data KRS");
        }
    } elseif ($page == 'krs' && $action == 'update') {
        $id = $_POST['id'];
        $mahasiswa_npm = $_POST['mahasiswa_npm'];
        $matakuliah_kodemk = $_POST['matakuliah_kodemk'];
        if ($krs->perbarui($id, $mahasiswa_npm, $matakuliah_kodemk)) {
            header("Location: index.php?page=krs&success=Data KRS berhasil diperbarui");
        } else {
            header("Location: index.php?page=krs&error=Gagal memperbarui data KRS");
        }
    }
}

// Proses hapus
if ($action == 'delete') {
    if ($page == 'mahasiswa' && isset($_GET['npm'])) {
        $npm = $_GET['npm'];
        if ($mahasiswa->hapus($npm)) {
            header("Location: index.php?page=mahasiswa&success=Data mahasiswa berhasil dihapus");
        } else {
            header("Location: index.php?page=mahasiswa&error=Gagal menghapus data mahasiswa");
        }
    } elseif ($page == 'matakuliah' && isset($_GET['kodemk'])) {
        $kodemk = $_GET['kodemk'];
        if ($matakuliah->hapus($kodemk)) {
            header("Location: index.php?page=matakuliah&success=Data mata kuliah berhasil dihapus");
        } else {
            header("Location: index.php?page=matakuliah&error=Gagal menghapus data mata kuliah");
        }
    } elseif ($page == 'krs' && isset($_GET['id'])) {
        $id = $_GET['id'];
        if ($krs->hapus($id)) {
            header("Location: index.php?page=krs&success=Data KRS berhasil dihapus");
        } else {
            header("Location: index.php?page=krs&error=Gagal menghapus data KRS");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen KRS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-4">Manajemen KRS</h1>

        <!-- Tombol Navigasi -->
        <div class="d-flex justify-content-center mb-4">
            <a href="index.php?page=krs" class="btn btn-nav <?php echo ($page == 'krs') ? 'btn-primary' : 'btn-outline-primary'; ?> mx-2">KRS</a>
            <a href="index.php?page=mahasiswa" class="btn btn-nav <?php echo ($page == 'mahasiswa') ? 'btn-primary' : 'btn-outline-primary'; ?> mx-2">Mahasiswa</a>
            <a href="index.php?page=matakuliah" class="btn btn-nav <?php echo ($page == 'matakuliah') ? 'btn-primary' : 'btn-outline-primary'; ?> mx-2">Mata Kuliah</a>
        </div>

        <!-- Tampilkan Pesan Sukses/Gagal -->
        <?php if (isset($_GET['success'])) { ?>
            <div class="alert alert-success"><?php echo $_GET['success']; ?></div>
        <?php } elseif (isset($_GET['error'])) { ?>
            <div class="alert alert-danger"><?php echo $_GET['error']; ?></div>
        <?php } ?>

        <?php
        // Halaman KRS
        if ($page == 'krs') {
            if ($action == 'insert' || $action == 'update') {
                $mahasiswa_result = $krs->ambilMahasiswa();
                $matakuliah_result = $krs->ambilMatakuliah();

                $edit_data = null;
                if ($action == 'update' && isset($_GET['id'])) {
                    $edit_data = $krs->ambilKrsById($_GET['id']);
                }
        ?>
                <!-- Form Tambah/Edit KRS -->
                <div class="card p-4 mb-4">
                    <h3 class="card-title"><?php echo ($action == 'insert') ? 'Tambah KRS' : 'Edit KRS'; ?></h3>
                    <form method="POST" action="index.php?page=krs&action=<?php echo $action; ?>">
                        <?php if ($action == 'update') { ?>
                            <input type="hidden" name="id" value="<?php echo $edit_data['id']; ?>">
                        <?php } ?>
                        <div class="mb-3">
                            <label for="mahasiswa_npm" class="form-label">Mahasiswa</label>
                            <select name="mahasiswa_npm" class="form-select" required>
                                <option value="">Pilih Mahasiswa</option>
                                <?php while ($row = mysqli_fetch_assoc($mahasiswa_result)) { ?>
                                    <option value="<?php echo $row['npm']; ?>" 
                                        <?php echo ($action == 'update' && $edit_data['mahasiswa_npm'] == $row['npm']) ? 'selected' : ''; ?>>
                                        <?php echo $row['nama'] . " (" . $row['npm'] . ")"; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="matakuliah_kodemk" class="form-label">Mata Kuliah</label>
                            <select name="matakuliah_kodemk" class="form-select" required>
                                <option value="">Pilih Mata Kuliah</option>
                                <?php while ($row = mysqli_fetch_assoc($matakuliah_result)) { ?>
                                    <option value="<?php echo $row['kodemk']; ?>" 
                                        <?php echo ($action == 'update' && $edit_data['matakuliah_kodemk'] == $row['kodemk']) ? 'selected' : ''; ?>>
                                        <?php echo $row['nama'] . " (" . $row['kodemk'] . ")"; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-custom"><?php echo ($action == 'insert') ? 'Tambah' : 'Perbarui'; ?></button>
                        <a href="index.php?page=krs" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
        <?php
            } else {
                $krs_result = $krs->ambilSemuaKrs();
        ?>
                <!-- Tabel KRS -->
                <div class="mb-4 text-end">
                    <a href="index.php?page=krs&action=insert" class="btn btn-custom">Tambah KRS</a>
                </div>
                <div class="card p-4 mb-4">
                    <h3 class="card-title">Daftar KRS</h3>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 5%;">No</th>
                                <th class="text-center" style="width: 20%;">Nama Lengkap</th>
                                <th class="text-center" style="width: 20%;">Mata Kuliah</th>
                                <th class="text-center" style="width: 40%;">Keterangan</th>
                                <th class="text-center" style="width: 15%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($krs_result)) {
                                $keterangan = $row['nama_mahasiswa'] . " Mengambil Mata Kuliah " . $row['nama_matakuliah'] . " dengan " . $row['jumlah_sks'] . " SKS";
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $no++; ?></td>
                                    <td class="text-center"><?php echo $row['nama_mahasiswa']; ?></td>
                                    <td class="text-center"><?php echo $row['nama_matakuliah']; ?></td>
                                    <td class="text-center"><?php echo $keterangan; ?></td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="index.php?page=krs&action=update&id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="index.php?page=krs&action=delete&id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
        <?php
            }
        }

        // Halaman Mahasiswa
        elseif ($page == 'mahasiswa') {
            if ($action == 'insert' || $action == 'update') {
                $edit_data = null;
                if ($action == 'update' && isset($_GET['npm'])) {
                    $edit_data = $mahasiswa->ambilMahasiswaByNpm($_GET['npm']);
                }
        ?>
                <!-- Form Tambah/Edit Mahasiswa -->
                <div class="card p-4 mb-4">
                    <h3 class="card-title"><?php echo ($action == 'insert') ? 'Tambah Mahasiswa' : 'Edit Mahasiswa'; ?></h3>
                    <form method="POST" action="index.php?page=mahasiswa&action=<?php echo $action; ?>">
                        <div class="mb-3">
                            <label for="npm" class="form-label">NPM</label>
                            <input type="text" name="npm" class="form-control" value="<?php echo ($action == 'update') ? $edit_data['npm'] : ''; ?>" <?php echo ($action == 'update') ? 'readonly' : 'required'; ?> maxlength="13">
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control" value="<?php echo ($action == 'update') ? $edit_data['nama'] : ''; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="jurusan" class="form-label">Jurusan</label>
                            <select name="jurusan" class="form-select" required>
                                <option value="">Pilih Jurusan</option>
                                <option value="Teknik Informatika" <?php echo ($action == 'update' && $edit_data['jurusan'] == 'Teknik Informatika') ? 'selected' : ''; ?>>Teknik Informatika</option>
                                <option value="Sistem Operasi" <?php echo ($action == 'update' && $edit_data['jurusan'] == 'Sistem Operasi') ? 'selected' : ''; ?>>Sistem Operasi</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea name="alamat" class="form-control" required><?php echo ($action == 'update') ? $edit_data['alamat'] : ''; ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-custom"><?php echo ($action == 'insert') ? 'Tambah' : 'Perbarui'; ?></button>
                        <a href="index.php?page=mahasiswa" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
        <?php
            } else {
                $mahasiswa_result = $mahasiswa->ambilSemuaMahasiswa();
        ?>
                <!-- Tabel Mahasiswa -->
                <div class="mb-4 text-end">
                    <a href="index.php?page=mahasiswa&action=insert" class="btn btn-custom">Tambah Mahasiswa</a>
                </div>
                <div class="card p-4 mb-4">
                    <h3 class="card-title">Daftar Mahasiswa</h3>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 5%;">No</th>
                                <th class="text-center" style="width: 15%;">NPM</th>
                                <th class="text-center" style="width: 20%;">Nama</th>
                                <th class="text-center" style="width: 20%;">Jurusan</th>
                                <th class="text-center" style="width: 25%;">Alamat</th>
                                <th class="text-center" style="width: 15%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($mahasiswa_result)) { ?>
                                <tr>
                                    <td class="text-center"><?php echo $no++; ?></td>
                                    <td class="text-center"><?php echo $row['npm']; ?></td>
                                    <td class="text-center"><?php echo $row['nama']; ?></td>
                                    <td class="text-center"><?php echo $row['jurusan']; ?></td>
                                    <td class="text-center"><?php echo $row['alamat']; ?></td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="index.php?page=mahasiswa&action=update&npm=<?php echo $row['npm']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="index.php?page=mahasiswa&action=delete&npm=<?php echo $row['npm']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
        <?php
            }
        }

        // Halaman Mata Kuliah
        elseif ($page == 'matakuliah') {
            if ($action == 'insert' || $action == 'update') {
                $edit_data = null;
                if ($action == 'update' && isset($_GET['kodemk'])) {
                    $edit_data = $matakuliah->ambilMatakuliahByKode($_GET['kodemk']);
                }
        ?>
                <!-- Form Tambah/Edit Mata Kuliah -->
                <div class="card p-4 mb-4">
                    <h3 class="card-title"><?php echo ($action == 'insert') ? 'Tambah Mata Kuliah' : 'Edit Mata Kuliah'; ?></h3>
                    <form method="POST" action="index.php?page=matakuliah&action=<?php echo $action; ?>">
                        <div class="mb-3">
                            <label for="kodemk" class="form-label">Kode MK</label>
                            <input type="text" name="kodemk" class="form-control" value="<?php echo ($action == 'update') ? $edit_data['kodemk'] : ''; ?>" <?php echo ($action == 'update') ? 'readonly' : 'required'; ?> maxlength="6">
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control" value="<?php echo ($action == 'update') ? $edit_data['nama'] : ''; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah_sks" class="form-label">Jumlah SKS</label>
                            <input type="number" name="jumlah_sks" class="form-control" value="<?php echo ($action == 'update') ? $edit_data['jumlah_sks'] : ''; ?>" required min="1" max="10">
                        </div>
                        <button type="submit" class="btn btn-custom"><?php echo ($action == 'insert') ? 'Tambah' : 'Perbarui'; ?></button>
                        <a href="index.php?page=matakuliah" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
        <?php
            } else {
                $matakuliah_result = $matakuliah->ambilSemuaMatakuliah();
        ?>
                <!-- Tabel Mata Kuliah -->
                <div class="mb-4 text-end">
                    <a href="index.php?page=matakuliah&action=insert" class="btn btn-custom">Tambah Mata Kuliah</a>
                </div>
                <div class="card p-4 mb-4">
                    <h3 class="card-title">Daftar Mata Kuliah</h3>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 5%;">No</th>
                                <th class="text-center" style="width: 15%;">Kode MK</th>
                                <th class="text-center" style="width: 40%;">Nama</th>
                                <th class="text-center" style="width: 15%;">Jumlah SKS</th>
                                <th class="text-center" style="width: 25%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($matakuliah_result)) { ?>
                                <tr>
                                    <td class="text-center"><?php echo $no++; ?></td>
                                    <td class="text-center"><?php echo $row['kodemk']; ?></td>
                                    <td class="text-center"><?php echo $row['nama']; ?></td>
                                    <td class="text-center"><?php echo $row['jumlah_sks']; ?></td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="index.php?page=matakuliah&action=update&kodemk=<?php echo $row['kodemk']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="index.php?page=matakuliah&action=delete&kodemk=<?php echo $row['kodemk']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
        <?php
            }
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>