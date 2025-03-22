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
            $query = "SELECT * FROM jurusan";
            $result = mysqli_query($db, $query);
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
                echo ' <label for="id_jurusan">Pilih Jurusan:</label>';
                echo "<select name='id_jurusan' required>";
                echo '<option value="">-- Pilih Jurusan --</option>';
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['id_jurusan'] . '">' . $row['nama_jurusan'] . ' - ' . $row['id_jurusan'] . '</option>';
                }
                echo "</select>";
            } elseif ($tipe == "dosen") {
            $query = "SELECT * FROM jurusan";
            $result = mysqli_query($db, $query);
                echo '<h4>Tambah Dosen</h4>';
                echo '<label>ID Dosen</label>';
                echo '<input type="text" name="id_dosen" class="form-control" required>';
                echo '<label>Nama Dosen</label>';
                echo '<input type="text" name="nama_dosen" class="form-control" required>';
                echo ' <label for="id_jurusan">Pilih Jurusan:</label>';
                echo "<select name='id_jurusan' required>";
                echo '<option value="">-- Pilih Jurusan --</option>';
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['id_jurusan'] . '">' . $row['nama_jurusan'] . ' - ' . $row['id_jurusan'] . '</option>';
                }
                echo "</select>";
            } elseif ($tipe == "kelas") {
            $queryMatkul = "SELECT id_matkul, nama_matkul FROM mata_kuliah";
            $resultMatkul = mysqli_query($db, $queryMatkul);
            
            $queryDosen = "SELECT id_dosen, nama_dosen FROM dosen";
            $resultDosen = mysqli_query($db, $queryDosen);
                echo '<h4>Tambah Kelas</h4>';
                echo '<label>ID Kelas</label>';
                echo '<input type="text" name="id_kelas" class="form-control" required>';
                echo '<label>Nama Kelas</label>';
                echo '<input type="text" name="nama_kelas" class="form-control" required>';
                echo '<label for="id_matkul">Mata Kuliah</label>';
                echo '<select name="id_matkul" required';
                echo '<option value="">-- Pilih mata kuliah --</option>';
                while ($row = $resultMatkul->fetch_assoc()) {
                    echo '<option value="' . $row['id_matkul'] . '">' . $row['nama_matkul'] . ' - ' . $row['id_matkul'] . '</option>';
                }
                echo "</select><br>";
                echo '<label for="id_dosen">Dosen</label>';
                echo '<select name="id_dosen" required>';
                echo '<option value="">-- Pilih Dosen --</option>';
                while ($row = $resultDosen->fetch_assoc()) {
                    echo '<option value="' . $row['id_dosen'] . '">' . $row['nama_dosen'] . ' - ' . $row['id_dosen'] . '</option>';
                }
                echo "</select>";
            }

            echo '<br>';
            echo '<input type="submit" value="Tambah Data" class="btn btn-success">';
            echo '</form>';
        }
        ?>
    </div>
</body>
</html>
