<?php 
    include 'services/conn.php';

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $tipe = $_POST['tipe'];
        $id = $_POST['id'];

        if($tipe == 'mahasiswa'){
            $nama = $_POST['nama'];
            $jenis_kelamin = $_POST['jenis_kelamin'];
            $id_jurusan = $_POST['id_jurusan'];
            $alamat = $_POST['alamat'];

            $query = "UPDATE mhs SET 
                    nama = '$nama', 
                    jenis_kelamin = '$jenis_kelamin', 
                    id_jurusan = '$id_jurusan',
                    alamat = '$alamat' 
                  WHERE nrp = '$id'";
        } else if ($tipe == 'dosen'){
            $nama_dosen = $_POST['nama_dosen'];
            $id_jurusan = $_POST['id_jurusan'];

            $query = "UPDATE dosen SET
                    nama_dosen = '$nama_dosen',
                    id_jurusan = '$id_jurusan'
                    WHERE id_dosen = $id";
        } else if ($tipe == 'kelas'){
            $nama_kelas = $_POST['nama_kelas'];
            $id_dosen = $_POST['id_dosen'];

            $query = "UPDATE kelas SET
                    nama_kelas = '$nama_kelas',
                    id_dosen = $id_dosen
                    WHERE id_kelas = $id";
        } else {
            echo "Tipe tidak valid!";
            exit();
        }

        if(mysqli_query($db, $query)){
            header("Location:data.php?tipe=$tipe&status=ok");
        } else {
            echo "ERROR : " . mysqli_error($db);
        }

    }
    mysqli_close($db);
?>