<?php include_once 'core/init.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Laporan</title>
    <style>
        @media print{
            button{
                display:none;
            }
            form{
                display:none;
            }
        }
    </style>
</head>
<body>
    <center>
        <h1>Laporan Inventaris bulan ke</h1>
        <p><?php echo date("d-m-Y"); ?></p>
    </center>
    <form action="" method="post">
        <select name="bulan" id="">
            <option value="" disabled selected>Pilih Jenis Bulan</option>
            <option value="1">Januari</option>
            <option value="2">Februari</option>
            <option value="3">Maret</option>
            <option value="4">April</option>
            <option value="5">Mei</option>
            <option value="6">Juni</option>
            <option value="7">Juli</option>
            <option value="8">Agustus</option>
            <option value="9">September</option>
            <option value="10">Oktober</option>
            <option value="11">Nopember</option>
            <option value="12">Desember</option>
        </select><br><br>
        <input type="submit" value="Filter" name="filter">
    </form>
    <center><table border="2" width="100%" valign="center">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama peminjam</th>
                <th>Nama barang</th>
                <th>Jumlah</th>
                <th>Tanggal Pinjam</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $no = 1;
                if(isset($_POST['filter'])){
                    $bulan = $_POST['bulan'];
                    $data = $db->getRelasiLaporan($bulan);
                    foreach($data as $row){
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $row['nama_petugas']; ?></td>
                <td><?php echo $row['nama']; ?></td>
                <td><?php echo $row['jumlah']; ?></td>
                <td><?php echo $row['tanggal_pinjam']; ?></td>
            </tr>
                    <?php }?>
                    <?php }?>
        </tbody>
    </table><br>
    <button onclick="window.print()">Cetak</button>
    </center>
</body>
</html>
