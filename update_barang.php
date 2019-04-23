<?php include_once 'public/header.php'; ?>
<?php include_once 'public/sidenav.php'; ?>

<?php 
    if(isset($_POST['update'])){
        $nama = $_POST['nama'];
        $kondisi = $_POST['kondisi'];
        $ket = $_POST['keterangan'];
        $stok = $_POST['stok'];
        $tgl = $_POST['tanggal_register'];
        $jenis = $_POST['id_jenis'];
        $ruang = $_POST['id_ruang'];
        $id = $_GET['getId'];

        $upd = $db->updateData('tb_inventaris',"nama='$nama',kondisi='$kondisi',keterangan='$ket',stok='$stok',tanggal_register='$tgl',
        id_jenis='$jenis',id_ruang='$ruang'","id_inventaris='$id'");
        if($upd == true){
            header('Location:index.php?page=dft_brg');
        }else{
            return false;
        }
    }
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
            <div class="card col-lg-10 offset-1" style="margin-top:4%;">
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-center">Form update barang</h4><hr>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-8 offset-2">
                                    <form action="#" method="post">
                                    <?php 
                                        $id = $_GET['getId'];
                                        $data = $db->getId('tb_inventaris',"id_inventaris='$id'");
                                        foreach($data as $row){
                                    ?>
                                        <div class="form-group">
                                            <label for="">Kode inventaris</label>
                                            <input type="text" value="<?php echo $row['kode_inventaris']; ?>" name="kode_inventaris" class="form-control" required disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Nama barang</label>
                                            <input type="text" value="<?php echo $row['nama']; ?>" name="nama" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Pilih kondisi barang</label>
                                            <select name="kondisi" id="" class="form-control" required>
                                                <option disabled selected required>Pilih kondisi barang</option>
                                                <option value="bagus">Bagus</option>
                                                <option value="lumayan bagus">Lumayan bagus</option>
                                                <option value="rusak">Rusak</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Keterangan barang</label>
                                            <input type="text" value="<?php echo $row['keterangan']; ?>" name="keterangan" id="" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Stok</label>
                                            <input type="text" value="<?php echo $row['stok']; ?>" name="stok" id="" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Tanggal masuk barang</label>
                                            <input type="text" value="<?php echo $row['tanggal_register']; ?>" name="tanggal_register" id="" class="form-control" value="<?php echo date("Y/m/d"); ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Pilih jenis barang</label>
                                            <select name="id_jenis" id="" class="form-control" required>
                                                <option disabled selected required>Pilih jenis barang</option>
                                                <?php 
                                                    $data = $db->getAll('tb_jenis');
                                                    foreach($data as $row){
                                                ?>
                                                <option value="<?php echo $row['id_jenis'] ?>"><?php echo $row['nama_jenis']; ?></option>
                                                    <?php }?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Pilih ruangan</label>
                                            <select name="id_ruang" id="" class="form-control" required>
                                                <option disabled selected required>Pilih ruangan</option>
                                                <?php 
                                                    $data = $db->getAll('tb_ruang');
                                                    foreach($data as $row){
                                                ?>
                                                <option value="<?php echo $row['id_ruang']; ?>"><?php echo $row['nama_ruang']; ?></option>
                                                    <?php }?>
                                            </select>
                                        </div>
                                        <?php }?>
                                        <center><input type="submit" value="Update" name="update" class="btn btn-primary"></center>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<?php include_once 'public/footer.php'; ?>