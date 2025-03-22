<?php include 'services/conn.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Tambah Data</h2>
        <form method="GET">
            <label for="tipe" class="form-label">Pilih Tipe Data</label>
            <select name="tipe" class="form-control" required>
                <option value="">-- Pilih --</option>
                <option value="mahasiswa">Mahasiswa</option>
                <option value="dosen">Dosen</option>
                <option value="kelas">Kelas</option>
            </select>
            <br>
            <input type="submit" value="Pilih" class="btn btn-primary">
        </form>

        <hr>

        <?php
        if (isset($_GET['tipe'])) {
            $tipe = $_GET['tipe'];
            echo '<form action="proses_tambah.php" method="POST">';
            echo '<input type="hidden" name="tipe" value="' . $tipe . '">';

            if ($tipe == "mahasiswa") {
                echo '<h4>Tambah Mahasiswa</h4>';
                echo '<label>NRP</label>';
                echo '<input type="text" name="nrp" class="form-control" required>';
                echo '<label>Nama Mahasiswa</label>';
                echo '<input type="text" name="nama" class="form-control" required>';
                echo '<label>Jenis Kelamin</label>';
                echo '<select name="jenis_kelamin" class="form-control" required>';
                echo '<option value="Laki-laki">Laki-laki</option>';
                echo '<option value="Perempuan">Perempuan</option>';
                echo '</select>';
                echo '<label>Alamat</label>';
                echo '<textarea name="alamat" class="form-control" required></textarea>';
                echo '<label>ID Jurusan</label>';
                echo '<input type="text" name="id_jurusan" class="form-control" required>';
            } elseif ($tipe == "dosen") {
                echo '<h4>Tambah Dosen</h4>';
                echo '<label>ID Dosen</label>';
                echo '<input type="text" name="id_dosen" class="form-control" required>';
                echo '<label>Nama Dosen</label>';
                echo '<input type="text" name="nama_dosen" class="form-control" required>';
                echo '<label>ID Jurusan</label>';
                echo '<input type="text" name="id_jurusan" class="form-control" required>';
            } elseif ($tipe == "kelas") {
                echo '<h4>Tambah Kelas</h4>';
                echo '<label>ID Kelas</label>';
                echo '<input type="text" name="id_kelas" class="form-control" required>';
                echo '<label>Nama Kelas</label>';
                echo '<input type="text" name="nama_kelas" class="form-control" required>';
                echo '<label>ID Mata Kuliah</label>';
                echo '<input type="text" name="id_matkul" class="form-control" required>';
                echo '<label>ID Dosen</label>';
                echo '<input type="text" name="id_dosen" class="form-control" required>';
            }

            echo '<br>';
            echo '<input type="submit" value="Tambah Data" class="btn btn-success">';
            echo '</form>';
        }
        ?>
    </div>
</body>
</html>
