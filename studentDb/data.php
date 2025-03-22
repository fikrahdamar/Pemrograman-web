<?php 
include 'services/conn.php';

$query = ""; 
$result = null;

if (isset($_GET['tipe'])) {
    $tipe = $_GET['tipe'];
} else {
    $tipe = '';
}

echo "<h2>Data " . ucfirst($tipe) . "</h2>";

if ($tipe == "mahasiswa") {
    $query = "SELECT mhs.*, jurusan.nama_jurusan FROM mhs 
              LEFT JOIN jurusan ON mhs.id_jurusan = jurusan.id_jurusan";
} else if($tipe == "dosen" && isset($_GET['id_dosen'])){
    $id_dosen = $_GET['id_dosen'];
    $query = "SELECT * FROM dosen WHERE id_dosen = '$id_dosen'";
}else if ($tipe == "dosen") {
    $query = "SELECT dosen.*, jurusan.nama_jurusan FROM dosen
              LEFT JOIN jurusan ON dosen.id_jurusan = jurusan.id_jurusan";
} else if ($tipe == "kelas") {
    $query = "SELECT kelas.*, dosen.nama_dosen, mata_kuliah.nama_matkul 
              FROM kelas
              LEFT JOIN dosen ON kelas.id_dosen = dosen.id_dosen
              LEFT JOIN mata_kuliah ON kelas.id_matkul = mata_kuliah.id_matkul";
}else if ($tipe == "jurusan" && isset($_GET['id_jurusan'])) {
    $id_jurusan = $_GET['id_jurusan'];
    $query = "SELECT * FROM jurusan WHERE id_jurusan = '$id_jurusan'";
}else if ($tipe == "mata_kuliah" && isset($_GET['id_matkul'])){
    $id_matkul = $_GET['id_matkul'];
    $query = "SELECT * FROM mata_kuliah WHERE id_matkul ='$id_matkul'";
}

if (!empty($query)) {
    $result = mysqli_query($db, $query);

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
    if ($result && mysqli_num_rows($result) > 0) { 
        echo "<table border='1'>";
        echo "<tr>";
        while ($dataInfo = mysqli_fetch_field($result)) {
            echo "<th>{$dataInfo->name}</th>";
        }
        echo "<th>Fitur</th>"; 
        echo "</tr>";

        while ($rowInfo = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            foreach ($rowInfo as $key => $dataRowInfo) {
                if ($key == "id_jurusan") {
                    echo "<td><a href='data.php?tipe=jurusan&id_jurusan={$dataRowInfo}'>{$dataRowInfo}</a></td>";
                } else if($key == "id_dosen"){
                    echo "<td><a href='data.php?tipe=dosen&id_dosen={$dataRowInfo}'>{$dataRowInfo}</a></td>";
                }else if($key == 'id_matkul'){
                    echo "<td><a href='data.php?tipe=mata_kuliah&id_matkul={$dataRowInfo}'>{$dataRowInfo}</a></td>";
                }else {
                    echo "<td>{$dataRowInfo}</td>";
                }
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
    mysqli_close($db);
    ?>

</body>
</html>
