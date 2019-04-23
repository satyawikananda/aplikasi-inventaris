<?php include_once 'public/header.php'; ?>
<?php include_once 'public/sidenav.php'; ?>

<?php 
    if(isset($_POST['update'])){
        $nip = $_POST['nip'];
        $nama = $_POST['nama_petugas'];
        $alamat = $_POST['alamat'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $level = $_POST['id_level'];
        $id = $_GET['idPegawai'];

        $update = $db->updateData('tb_petugas',"nama_petugas='$nama',username='$username',password='$password',id_level='$level'","id_petugas='$id'");
        if($update == 1){
            $upd = $db->updateData('tb_pegawai',"nama_petugas='$nama',alamat='$alamat',nip='$nip'","id_pegawai='$id'");
            if($upd == 1){
                header('Location:index.php?page=upd_akun');
            }else{
                return false;
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
                    <h4 class="text-center lead">Selamat datang </h4>
                </div>
            </div>
            <div class="card col-lg-10 offset-1" style="margin-top:4%;">
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-center">Form Update akun</h4><hr>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-8 offset-2">
                                    <form action="#" method="post">
                                    <?php
                                        $id = $_GET['idPegawai'];
                                        $data = $db->getRelasiAkunId("id_petugas='$id'");
                                        foreach($data as $row){
                                    ?>
                                        <div class="form-group">
                                            <label for="">NIP</label>
                                            <input type="text" value="<?php echo $row['nip']; ?>" name="nip" class="form-control" required>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="">Nama Petugas</label>
                                            <input type="text" value="<?php echo $row['nama_petugas']; ?>" name="nama_petugas" class="form-control" required>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="">alamat</label>
                                            <input type="text" value="<?php echo $row['alamat']; ?>" name="alamat" id="" class="form-control" required>
                                        </div>
                                           
                                        <div class="form-group">
                                            <label for="">username</label>
                                            <input type="text" value="<?php echo $row['username']; ?>" name="username" id="" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Password</label>
                                            <input type="password" value="<?php echo $row['password']; ?>" name="password" id="" class="form-control" value="<?php echo date("Y/m/d"); ?>" required>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="">Pilih jenis level</label>
                                            <select name="id_level" id="" class="form-control" required>
                                                <option disabled selected required>Pilih jenis level</option>
                                                <?php 
                                                    $data = $db->getAll('tb_level');
                                                    foreach($data as $row){
                                                ?>
                                                <option value="<?php echo $row['id_level']; ?>"><?php echo $row['nama_level']; ?></option>
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