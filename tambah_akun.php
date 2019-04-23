<?php include_once 'public/header.php'; ?>
<?php include_once 'public/sidenav.php'; ?>

<?php 
    if(isset($_POST['tambah'])){
        $nama = $_POST['nama_petugas'];
        $nip  = $_POST['nip'];
        $alamat = $_POST['alamat'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $level = $_POST['id_level'];

        $insert = $db->insertData('tb_petugas','nama_petugas,username,password,id_level',"'$nama','$username','$password','$level'");
        if($insert == 1){
            $ins = $db->insertData('tb_pegawai','nama_petugas,alamat,nip',"'$nama','$alamat','$nip'");
            if($ins == 1){
                header('Location:index.php?page=dft_akun');
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
                        <h4 class="text-center">Form tambah akun</h4><hr>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-8 offset-2">
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <label for="">Nama lengkap</label>
                                            <input type="text" name="nama_petugas" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">NIP</label>
                                            <input type="text" name="nip" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Alamat</label>
                                            <input type="text" name="alamat" id="" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Username</label>
                                            <input type="text" name="username" id="" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                        <?php 
                                            $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                                            srand((double) microtime() * 1000000);
                                            $i = 1;
                                            $unik = '';
                                            
                                            while($i <=6){
                                                $num = rand() % 36;
                                                $tmp = substr($chars,$num,1);
                                                $unik = $unik.$tmp;
                                                $i++;
                                            }
                                        ?>
                                            <label for="">Password</label>
                                            <input type="password" name="password" id="" value="<?php echo $unik; ?>" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Pilih jenis level</label>
                                            <select name="id_level" id="" class="form-control" required>
                                                <option disabled selected required>Pilih jenis level</option>
                                                <?php 
                                                    $data = $db->getAll('tb_level');
                                                    foreach($data as $row){
                                                ?>
                                                <option value="<?php echo $row['id_level'] ?>"><?php echo $row['nama_level']; ?></option>
                                                    <?php }?>
                                            </select>
                                        </div>
                                        <center><input type="submit" value="Tambah" name="tambah" class="btn btn-primary"></center>
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