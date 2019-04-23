<?php 
    require_once 'public/header.php';
?>
<?php 
    require_once 'public/sidenav.php';
?>

<div class="container-fluid">
    <main class="col-lg-10 offset-2">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center">Aplikasi Inventaris school</h4>
                    <h4 class="text-center lead">Selamat datang <?php echo $_SESSION['nama_petugas']; ?></h4>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-lg-4">
                    <div class="card">
                        <div class="card-body bg-primary">
                            <h4 class="text-white">Jumlah barang</h4>
                            <?php 
                                $data = $db->sum('stok','jumlah','tb_inventaris');
                                foreach($data as $row){
                                    if($row['jumlah'] > 0){
                            ?>
                            <h4 class="text-white"><?php echo $row['jumlah']; ?></h4>
                                <?php }else{echo "0";}?>
                                <?php }?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-4">
                    <div class="card">
                        <div class="card-body bg-success">
                            <h4 class="text-white">Jumlah pengguna</h4>
                            <?php 
                                $data = $db->count('jumlah','tb_petugas');
                                foreach($data as $row){
                                    if($row['jumlah'] > 0){
                            ?>
                            <h4 class="text-white"><?php echo $row['jumlah']; ?></h4>
                            <?php }else{echo "0";}?>
                                <?php }?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-4">
                    <div class="card">
                        <div class="card-body bg-white">
                            <h4>Jumlah barang pinjam</h4>
                            <?php 
                                $id = $_SESSION['id_petugas'];
                                $data = $db->sumPinjam('jumlah','jumlah','tb_peminjaman',"id_pegawai='$id'");
                                foreach($data as $row){
                                    if($row['jumlah'] > 0){
                            ?>
                            <h4><?php echo $row['jumlah']; ?></h4>
                            <?php }else{echo "0";}?>
                                <?php }?>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="text-center">Daftar pinjam barang</h4>
                    <table class="table table-hover table-stripped">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Nama peminjam</th>
                                <th>Nama barang</th>
                                <th>jumlah</th>
                                <th>tanggal pinjam</th>
                                <th>tanggal kembali</th>
                                <th>status pengembalian</th>
                                <?php 
                                    if($_SESSION['id_level'] == 1){
                                ?>
                                <th>Aksi</th>
                                    <?php }?>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            if(isset($_GET['getId'])){
                                $id = $_GET['getId'];
                                $del = $db->deleteData('tb_peminjaman',"id_peminjaman='$id'");
                                if($del == true){
                                    echo "<script>alert('Berhasil kembalikan barang');</script>";
                                    @@header('Location:index.php');
                                }else{
                                    echo "<script>alert('gagal kembalikan barang');</script>";
                                }
                            }
                        ?>
                            <?php 
                                $no = 1;
                                $data = $db->getRelasiPinjam();
                                foreach($data as $row){
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $row['nama_petugas']; ?></td>
                                <td><?php echo $row['nama']; ?></td>
                                <td><?php echo $row['jumlah']; ?></td>
                                <td><?php echo $row['tanggal_pinjam']; ?></td>
                                <td><?php echo $row['tanggal_kembali']; ?></td>
                                <td><?php echo $row['status_peminjaman']; ?></td>
                                <?php 
                                    if($_SESSION['id_level'] == 1){
                                ?>
                                <td>
                                    <a href="index.php?getId=<?php echo $row['id_peminjaman']; ?>" class="btn btn-danger">Kembali</a>
                                </td>
                                    <?php }?>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>

<?php 
    require_once 'public/footer.php';
?>