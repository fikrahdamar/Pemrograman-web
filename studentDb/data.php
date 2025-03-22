<?php 
include 'services/conn.php';

$query = ""; // Inisialisasi variabel agar tidak undefined
$result = null;

if (isset($_GET['tipe'])) {
    $tipe = $_GET['tipe'];
} else {
    $tipe = '';
}

echo "<h2>Data " . ucfirst($tipe) . "</h2>";

if ($tipe == "mahasiswa") {
    $query = "SELECT * FROM mhs";
} elseif ($tipe == "dosen") {
    $query = "SELECT * FROM dosen";
} elseif ($tipe == "kelas") {
    $query = "SELECT * FROM kelas";
}

// Cek apakah query tidak kosong sebelum dieksekusi
if (!empty($query)) {
    $result = mysqli_query($db, $query);

    // Cek jika query gagal
    if (!$result) {
        die("Query Error: " . mysqli_error($db));
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <title>Data</title>
</head>
<body>
    <header>
        <a href="index.php">Home</a>
        <a href="data.php?tipe=mahasiswa">Data Mahasiswa</a>
        <a href="data.php?tipe=dosen">Data Dosen</a>
        <a href="data.php?tipe=kelas">Data Kelas</a>
        <a href="form.php">Tambah Data</a>
    </header>

    <?php 
    // Menampilkan pesan status setelah update atau delete
    if (isset($_GET['status'])) {
        $status = $_GET['status'];
        if ($status == 'ok') {
            echo '<br><br><div class="alert alert-success" role="alert">Data berhasil diperbarui!</div>';
        } elseif ($status == 'err') {
            echo '<br><br><div class="alert alert-danger" role="alert">Gagal memperbarui data!</div>';
        }
    } 
    ?>

    <?php
    if ($result && mysqli_num_rows($result) > 0) { // Cek apakah data ada
        echo "<table border='1'>";
        echo "<tr>";
        while ($dataInfo = mysqli_fetch_field($result)) {
            echo "<th>{$dataInfo->name}</th>";
        }
        echo "<th>Aksi</th>"; // Kolom tambahan untuk update & delete
        echo "</tr>";

        while ($rowInfo = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            foreach ($rowInfo as $dataRowInfo) {
                echo "<td>{$dataRowInfo}</td>"; 
            }

            echo "<td>"; 
            if ($tipe == 'mahasiswa') {
                echo '<form action="update.php" method="POST" style="display:inline;">
                        <input type="hidden" name="tipe" value="' . $tipe . '">
                        <input type="hidden" name="nrp" value="' . $rowInfo['nrp'] . '">
                        <input type="submit" value="Update">
                      </form>';

                echo '<form action="delete.php" method="POST" style="display:inline; margin-left:5px;">
                        <input type="hidden" name="tipe" value="' . $tipe . '">
                        <input type="hidden" name="nrp" value="' . $rowInfo['nrp'] . '">
                        <input type="submit" value="Delete" onclick="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\');">
                      </form>';
            } elseif ($tipe == 'dosen') {
                echo '<form action="update.php" method="POST" style="display:inline;">
                        <input type="hidden" name="tipe" value="' . $tipe . '">
                        <input type="hidden" name="id_dosen" value="' . $rowInfo['id_dosen'] . '">
                        <input type="submit" value="Update">
                      </form>';

                echo '<form action="delete.php" method="POST" style="display:inline; margin-left:5px;">
                        <input type="hidden" name="tipe" value="' . $tipe . '">
                        <input type="hidden" name="id_dosen" value="' . $rowInfo['id_dosen'] . '">
                        <input type="submit" value="Delete" onclick="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\');">
                      </form>';
            } elseif ($tipe == 'kelas') {
                echo '<form action="update.php" method="POST" style="display:inline;">
                        <input type="hidden" name="tipe" value="' . $tipe . '">
                        <input type="hidden" name="id_kelas" value="' . $rowInfo['id_kelas'] . '">
                        <input type="submit" value="Update">
                      </form>';

                echo '<form action="delete.php" method="POST" style="display:inline; margin-left:5px;">
                        <input type="hidden" name="tipe" value="' . $tipe . '">
                        <input type="hidden" name="id_kelas" value="' . $rowInfo['id_kelas'] . '">
                        <input type="submit" value="Delete" onclick="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\');">
                      </form>';
            }
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p><strong>Data tidak ditemukan!</strong></p>";
    } 

    // Pindahkan koneksi ditutup ke sini
    mysqli_close($db);
    ?>

</body>
</html>
