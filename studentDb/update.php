<?php 
    include 'services/conn.php';

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $tipe = $_POST['tipe'];
    
    if($tipe == 'mahasiswa'){
        $id = $_POST['nrp'];
        $query = "SELECT * FROM mhs WHERE nrp = '$id'";
    } else if ($tipe == 'dosen'){
        $id  = $_POST['id_dosen'];
        $query = "SELECT * FROM dosen WHERE id_dosen = $id";
    } else if ($tipe == 'kelas'){
        $id  = $_POST['id_kelas'];
        $query = "SELECT * FROM kelas WHERE id_kelas = $id";
    } else {
        echo "Tipe tidak valid!";
        exit();
    }
    $result = mysqli_query($db, $query);
    if ($result && mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "Data tidak ada";
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <title>Updata Data</title>
</head>
<body>
<header>
        <a href="index.php">Home</a>
        <a href="data.php?tipe=mahasiswa">Data Mahasiswa</a>
        <a href="data.php?tipe=dosen">Data Dosen</a>
        <a href="data.php?tipe=kelas">Data Kelas</a>
        <a href="form.php">Tambah Data</a>
    </header>
    <h2>Update Data <?php echo ucfirst($tipe); ?></h2>
    <form action="proses_update.php" method="POST">
        <input type="hidden" name="tipe" value="<?php echo $tipe?>">
        <input type="hidden" name="id" value="<?php echo $id?>">

        <?php if ($tipe == 'mahasiswa'){ ?>
            <label for="nrp">NRP : </label>
             <input type="text" id="nrp" name="nrp" value="<?php echo $row['nrp']; ?>" readonly><br>

            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" value="<?php echo $row['nama']; ?>" required><br>

            <label for="jenis_kelamin">Jenis Kelamin:</label>
            <select id="jenis_kelamin" name="jenis_kelamin">
                <option value="L" <?php if ($row['jenis_kelamin'] == 'L') echo 'selected'; ?>>Laki-laki</option>
                <option value="P" <?php if ($row['jenis_kelamin'] == 'P') echo 'selected'; ?>>Perempuan</option>
            </select><br>

            <label for="id_jurusan">ID Jurusan:</label>
            <input type="number" id="id_jurusan" name="id_jurusan" value="<?php echo $row['id_jurusan']; ?>" required><br>

            <label for="alamat">Alamat:</label>
            <input type="text" id="alamat" name="alamat" value="<?php echo $row['alamat']; ?>" required><br>
        <?php } else if ($tipe == 'dosen') {?>
            <label for="id_dosen">ID Dosen : </label>
            <input type="text" id="id_dosen" name="id_dosen" value="<?php echo $row['id_dosen']?>" readonly><br>

            <label for="nama_dosen">Nama:</label>
            <input type="text" id="nama_dosen" name="nama_dosen" value="<?php echo $row['nama_dosen']; ?>" required><br>

            <label for="id_jurusan">ID Jurusan:</label>
            <input type="number" id="id_jurusan" name="id_jurusan" value="<?php echo $row['id_jurusan']; ?>" required><br>
        <?php } else if ($tipe == 'kelas') { ?>
            <label for="id_kelas">ID Kelas : </label>
            <input type="text" id="id_kelas" name="id_kelas" value="<?php echo $row['id_kelas']?>" readonly><br>

            <label for="nama_kelas">Nama Kelas:</label>
            <input type="text" id="nama_kelas" name="nama_kelas" value="<?php echo $row['nama_kelas']; ?>" required><br>

            <label for="id_dosen">id dosen:</label>
            <input type="number" id="id_dosen" name="id_dosen" value="<?php echo $row['id_dosen']; ?>" required><br>   

            <label for="id_matkul">ID Matkul : </label>
            <input type="text" id="id_matkul" name="id_matkul" value="<?php echo $row['id_matkul']?>" readonly><br>
        <?php } ?>
    </form>
</body>
</html>