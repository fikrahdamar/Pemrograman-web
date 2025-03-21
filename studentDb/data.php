<?php include 'services/conn.php' ;
    if(isset($_GET['tipe'])){
        $tipe = $_GET['tipe'];
    } else {
        $tipe = '';
    }
    echo "<h2>Data ". ucfirst($tipe). "</h2>";

    if($tipe == "mahasiswa"){
        $query = "SELECT * FROM mhs";
    } else if ($tipe == "dosen"){
        $query = "SELECT * FROM dosen";
    } else if ($tipe == "kelas"){
        $query = "SELECT * FROM kelas";
    }

    $result = mysqli_query($db, $query);
    
mysqli_close($db);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    if($result){
        echo "<table border='1'>";
            echo "<tr>";
                while($dataInfo = mysqli_fetch_field($result)){
                    echo "<th>{$dataInfo->name}</th>";
                }
            echo "</tr>";
            echo "<tr>";
                while($rowInfo = mysqli_fetch_assoc($result)){
                    foreach($rowInfo as $dataRowInfo ){
                        echo "<td>{$dataRowInfo}</td>"; 
                        
                 }
                    echo "<td><a href='update.php?nrp=" . $rowInfo['nrp'] . "'>Update</a></td>";
                    echo "<td><a href='delete.php?nrp=" . $rowInfo['nrp'] . "'>Delete</a></td>";
                    echo "</tr>";
                }
        echo "</table>";
    }else {
        echo "Gagal Mengambil Data!!";
    } 
    ?>
</body>
</html>