<?php 
    include 'services/conn.php';

    $status ='';
    $result ='';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $tipe = $_POST['tipe'];

        if($tipe == 'mahasiswa'){
            $nrp_upd = $_POST['nrp'];
            $query = "DELETE FROM mhs WHERE nrp = '$nrp_upd'"; 
        } else if ($tipe == 'dosen'){
            $id_dosenUpd = $_POST['id_dosen'];
            $query = "DELETE FROM dosen WHERE id_dosen = $id_dosenUpd";
        } else if ($tipe == 'kelas'){
            $id_kelasUpd = $_POST['id_kelas'];
            $query = "DELETE FROM kelas WHERE id_kelas = $id_kelasUpd";
        }
        $result = mysqli_query($db, $query);
        if ($result){
            $status = 'ok';
        } else {
            $status = 'err';
        }

        header("Location:data.php?tipe=$tipe&status=$status");
    }
?>