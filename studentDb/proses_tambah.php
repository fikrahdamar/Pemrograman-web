<?php
include 'services/conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipe = $_POST['tipe'];

    if ($tipe == "mahasiswa") {
        $nrp = $_POST['nrp'];
        $nama = $_POST['nama'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $alamat = $_POST['alamat'];
        $id_jurusan = $_POST['id_jurusan'];

        $query = "INSERT INTO mhs (nrp, nama, jenis_kelamin, alamat, id_jurusan) 
                  VALUES ('$nrp', '$nama', '$jenis_kelamin', '$alamat', '$id_jurusan')";

    } elseif ($tipe == "dosen") {
        $id_dosen = $_POST['id_dosen'];
        $nama_dosen = $_POST['nama_dosen'];
        $id_jurusan = $_POST['id_jurusan'];

        $query = "INSERT INTO dosen (id_dosen, nama_dosen, id_jurusan) 
                  VALUES ('$id_dosen', '$nama_dosen', '$id_jurusan')";

    } elseif ($tipe == "kelas") {
        $id_kelas = $_POST['id_kelas'];
        $nama_kelas = $_POST['nama_kelas'];
        $id_matkul = $_POST['id_matkul'];
        $id_dosen = $_POST['id_dosen'];

        $query = "INSERT INTO kelas (id_kelas, nama_kelas, id_matkul, id_dosen) 
                  VALUES ('$id_kelas', '$nama_kelas', '$id_matkul', '$id_dosen')";
    }

    if (mysqli_query($db, $query)) {
        header("Location:data.php?tipe=$tipe&status=ok");
        exit();
    } else {
        header("Location:data.php?tipe=$tipe&status=err");
        exit();
    }
}
?>
