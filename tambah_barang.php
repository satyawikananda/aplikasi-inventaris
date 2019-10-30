<?php include_once 'public/header.php'; ?>
<?php include_once 'public/sidenav.php'; ?>

<?php 
// file untuk menambah data pada table barang
    if(isset($_POST['tambah'])){
        $kode = $_POST['kode_inventaris'];
        $nama = $_POST['nama'];
        $kondisi = $_POST['kondisi'];
        $ket = $_POST['keterangan'];
        $stok = $_POST['stok'];
        $tgl = $_POST['tanggal_register'];
        $jenis = $_POST['id_jenis'];
        $ruang = $_POST['id_ruang'];
        $pegawai = $_GET['idSession'];

        $insert = $db->insertData('tb_inventaris','nama,kondisi,keterangan,kode_inventaris,tanggal_register,stok,id_ruang,id_jenis,id_petugas',
        "'$nama','$kondisi','$ket','$kode','$tgl','$stok','$ruang','$jenis','$pegawai'");
        if($insert == true){
            echo "<script>alert('Berhasil tambah barang');</script>";
            header('Location:index.php?page=dft_brg');
        }else{
            echo "<script>alert('gagal tambah barang');</script>";
        }
    }
?>

<div class="container-fluid">
    <main class="col-lg-10 offset-2">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center">Aplikasi Inventaris school</h4>
                    <h4 class="text-center lead">Selamat datang </h4>
                </div>
            </div>
            <div class="card col-lg-10 offset-1" style="margin-top:4%;">
            <div id="form">
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-center">Form tambah barang</h4><hr>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-8 offset-2">
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <label for="">Kode inventaris</label>
                                            <input type="text" name="kode_inventaris" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Nama barang</label>
                                            <input type="text" name="nama" class="form-control" required>
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
                                            <input type="text" name="keterangan" id="" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Stok</label>
                                            <input type="text" name="stok" id="" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Tanggal masuk barang</label>
                                            <input type="text" name="tanggal_register" id="" class="form-control" value="<?php echo date("Y/m/d"); ?>" required>
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
                                                <option value="<?php echo $row['id_ruang'] ?>"><?php echo $row['nama_ruang']; ?></option>
                                                    <?php }?>
                                            </select>
                                        </div>
                                        <center><input type="submit" value="Tambah" name="tambah" class="btn btn-primary"></center>
                                        <center><input type="button" id="tambah" value="Tambah" class="btn btn-primary"></center>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <div id="box">
                    
                </div>
            </div>
        </div>
    </main>
</div>

<?php include_once 'public/footer.php'; ?>