<?php include_once 'public/header.php'; ?>
<?php include_once 'public/sidenav.php'; ?>

<?php 
    if(isset($_POST['pinjam'])){
        $tgl_pinjam = $_POST['tanggal_pinjam'];
        $tgl_kembali = $_POST['tanggal_kembali'];
        $jumlah = $_POST['jumlah'];
        $invent = $_GET['idBarang'];
        $pegawai = $_GET['idSession'];

        $insert = $db->insertData('tb_peminjaman','tanggal_pinjam,tanggal_kembali,jumlah,status_peminjaman,id_inventaris,id_pegawai',
        "'$tgl_pinjam','$tgl_kembali','$jumlah','pinjam','$invent','$pegawai'");
        if($insert == 1){
            $ins = $db->insertData('tb_detail_pinjam','jumlah,tanggal_pinjam,tanggal_kembali,id_inventaris,id_pegawai',
            "'$jumlah','$tgl_pinjam','$tgl_kembali','$invent','$pegawai'");
            if($ins == 1){
                header('Location:index.php');
            }
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
                        <h4 class="text-center">Form pinjam barang</h4><hr>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-8 offset-2">
                                    <form action="" method="POST">
                                    <?php
                                        $seminggu = mktime(0,0,0,date('n'),date('j')+7,date('Y'));
                                        $idBarang = $_GET['idBarang'];
                                        $data = $db->getIdPinjam("$idBarang");
                                        foreach($data as $row){
                                    ?>
                                        <div class="form-group">
                                            <label for="">Kode inventaris</label>
                                            <input type="text" value="<?php echo $row['kode_inventaris']; ?>" name="kode_inventaris" class="form-control" required disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Nama barang</label>
                                            <input type="text" value="<?php echo $row['nama']; ?>" name="nama" class="form-control" required disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Tanggal pinjam barang</label>
                                            <input type="text" value="<?php echo date('Y-m-d');?>" name="tanggal_pinjam" id="" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Tanggal kembali barang</label>
                                            <input type="text" value="<?php echo date('Y-m-d',$seminggu); ?>" name="tanggal_kembali" id="" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Jumlah barang yang dipinjam</label>
                                            <input type="text" placeholder="Masukkan jumlah barang" name="jumlah" class="form-control">
                                        </div>
                                        <?php }?>
                                        <center><input type="submit" value="Pinjam" name="pinjam" class="btn btn-primary"></center>
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