<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
$var = $_REQUEST;
//var_dump($var);
$servername = "localhost";
$username = "root";
$password = "0852";
$dbname = "coba1";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($_POST['klasifikasi'] == 'nama') {
    $query = "SELECT * FROM pasien WHERE nama LIKE '%$_POST[f_cari]%'";
}
elseif ($_POST['klasifikasi'] == 'alamat') {
    $query = "SELECT * FROM pasien WHERE alamat LIKE '%$_POST[f_cari]%'";
}
elseif ($_POST['klasifikasi'] == 'penyakit') {
    $query = "SELECT * FROM pasien WHERE penyakit LIKE '%$_POST[f_cari]%'";
}
elseif ($_POST['klasifikasi'] == 'gol_darah') {
    $query = "SELECT * FROM pasien WHERE gol_darah LIKE '%$_POST[f_cari]%'";
} else {
    $query = "SELECT * FROM pasien";

}
if ($_REQUEST['id']) {
    $query = "SELECT * FROM pasien WHERE id=$_REQUEST[id]";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "tidak ditemukan";
    }
    }
//    if (mysqli_query($conn, $query)) {
//        /*echo "New record created successfully";*/
//    } else {
//        echo "Error: " . $query . "<br>" . mysqli_error($conn);
//    }
//    mysqli_close($conn);
//}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Adi Prasetiyo</title>
    <link rel="icon" href="img/LOGO.png">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link type="text/css"  rel="stylesheet" href="css/bootstrap.css">
    <link type="text/css" rel="stylesheet" href="css/font-awesome.min.css">
</head>
<body>
<a href="tampil.php" data-toggle="tooltip" title="Lihat Data Pasien" class="btn btn-info" role="button"><span class="glyphicon glyphicon-list"></span> Lihat Data Pasien</a>
<a href="pasien.php" data-toggle="tooltip" title="Tambah Data Pasien" class="btn btn-success" role="button"><span class="glyphicon glyphicon-user"></span> Tambah Data</a>
<div id="filter_nama">
    <form action="tampil.php" method="post">
        <table>
            <tr>
                <td><select name="klasifikasi">
                        <option value="" disabled selected>-Filter Berdasarkan-</option>
                        <option value="nama">Nama</option>
                        <option value="alamat">Alamat</option>
                        <option value="penyakit">Penyakit</option>
                        <option value="gol_darah">Golongan Darah</option>
                    </select></td>
                <td><input type="text" id="f_cari" name="f_cari" placeholder="Cari..."></td>
                <td>
                    <button type="submit" value="search" id="filter" name="filter"><i
                            class="linknew fa fa-search"></i></button>
                </td>
            </tr>
        </table>
    </form>
</div>
<table border="1" align="center" style="margin: auto; padding: auto">
    <tr>
        <th style="text-align: center">No</th>
        <th style="text-align: center">ID</th>
        <th style="text-align: center" width="200px">Nama</th>
        <th style="text-align: center">Alamat</th>
        <th style="text-align: center">Penyakit</th>
        <th style="text-align: center">Gol_Darah</th>

    </tr>
    <?php
    $result = mysqli_query($conn, $query);
    $no = 0;
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            $no++;
            ?>
            <tr>
                <td align="center"><?php echo $no; ?> </td>
                <td align="center"><?php echo $row ['id']; ?></td>
                <td align="left"><?php echo $row ['nama']; ?></td>
                <td align="center"><?php echo $row ['alamat']; ?></td>
                <td align="center"><?php echo $row ['penyakit']; ?></td>
                <td align="center"><?php echo $row ['gol_darah']; ?></td>

            </tr>
            <?php
        }
        echo "Tabel Pasien";
    } else {
        echo "Tidak ada data";
    }
    ?>

</table>
</body>
</html>
