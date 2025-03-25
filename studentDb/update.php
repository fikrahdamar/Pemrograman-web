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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Updata Data</title>
</head>
<body>
    <h2>Update Data <?php echo ucfirst($tipe); ?></h2>
    <form action="proses_update.php" method="POST">
        <input type="hidden" name="tipe" value="<?php echo $tipe?>">
        <input type="hidden" name="id" value="<?php echo $id?>">

        <?php if ($tipe == 'mahasiswa'){ ?>
        <?php $queryMhs = "SELECT * FROM jurusan";
              $resultMhs = mysqli_query($db, $queryMhs);?>
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
            <select name='id_jurusan' required>
            <option value="">-- Pilih Jurusan --</option>
            <?php  while ($rowMhs = $resultMhs->fetch_assoc()) {
                    echo '<option value="' . $rowMhs['id_jurusan'] . '">' . $rowMhs['nama_jurusan'] . ' - ' . $rowMhs['id_jurusan'] . '</option>';
                }?>
            </select><br>
            <label for="alamat">Alamat:</label>
            <input type="text" id="alamat" name="alamat" value="<?php echo $row['alamat']; ?>" required><br>

        <?php } else if ($tipe == 'dosen') {?>
        <?php $queryDosen = "SELECT * FROM jurusan";
              $resultDosen = mysqli_query($db, $queryDosen);?>
            <label for="id_dosen">ID Dosen : </label>
            <input type="text" id="id_dosen" name="id_dosen" value="<?php echo $row['id_dosen']?>" readonly><br>

            <label for="nama_dosen">Nama:</label>
            <input type="text" id="nama_dosen" name="nama_dosen" value="<?php echo $row['nama_dosen']; ?>" required><br>
            
            <div class="form-floating" style="width: 300px;">
            <select name='id_jurusan' class="form-select" id="floatingSelect" aria-label="Floating label select example" required>
            <option value="">-- Pilih Jurusan --</option>
            <?php  while ($rowDosen = $resultDosen->fetch_assoc()) {
                    echo '<option value="' . $rowDosen['id_jurusan'] . '">' . $rowDosen['nama_jurusan'] . ' - ' . $rowDosen['id_jurusan'] . '</option>';
                }?>
            </select>
            <label for="id_jurusan">ID Jurusan:</label><br>
        <?php } else if ($tipe == 'kelas') { ?>
        <?php $queryKelas = "SELECT id_dosen, nama_dosen FROM dosen";
              $resultKelas = mysqli_query($db, $queryKelas);?>
            <label for="id_kelas">ID Kelas : </label>
            <input type="text" id="id_kelas" name="id_kelas" value="<?php echo $row['id_kelas']?>" readonly><br>

            <label for="nama_kelas">Nama Kelas:</label>
            <input type="text" id="nama_kelas" name="nama_kelas" value="<?php echo $row['nama_kelas']; ?>" required><br>
            <div class="form-floating" style="width: 300px;">
            <select name="id_dosen" class="form-select" id="floatingSelect" aria-label="Floating label select example" required>
            <option value="">-- Pilih Dosen --</option>
            <?php while ($rowKelas = $resultKelas->fetch_assoc()) {
                    echo '<option value="' . $rowKelas['id_dosen'] . '">' . $rowKelas['nama_dosen'] . ' - ' . $rowKelas['id_dosen'] . '</option>';
                }?>
            </select>
            <label for="id_dosen">id dosen</label>  
            </div>
            <label for="id_matkul">ID Matkul : </label>
            <input type="text" id="id_matkul" name="id_matkul" value="<?php echo $row['id_matkul']?>" readonly><br>
        <?php } ?>
        <input type="submit" value="Update">
    </form>
    <br>
    <a href="index.php">Kembali</a>
</body>
</html>