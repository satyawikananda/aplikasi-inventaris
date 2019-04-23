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
            <div class="card" style="margin-top:4%;">
                <div class="card-body">
                    <h4 class="text-center">Daftar Akun</h4>
                    <a href="index.php?page=tmb_akun" class="btn btn-primary">Tambah Akun</a><br><br>
                    <table class="table table-stripped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama petugas</th>
                                <th>Alamat</th>
                                <th>NIP</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Level</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            if(isset($_GET['id'])){
                                $id = $_GET['id'];
                                $delete = $db->deleteData('tb_petugas',"id_petugas='$id'");
                                if($delete == 1){
                                    $del = $db->deleteData('tb_pegawai',"id_pegawai='$id'");
                                    if($del == 1){
                                        header('Location:index.php?page=dft_akun');
                                    }else{
                                        return false;
                                    }
                                }
                            }
                        ?>
                            <?php 
                                $no = 1;
                                $data = $db->getRelasiAkun();
                                foreach($data as $row){
                            ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $row['nama_petugas']; ?></td>
                                    <td><?php echo $row['alamat']; ?></td>
                                    <td><?php echo $row['nip']; ?></td>
                                    <td><?php echo $row['username']; ?></td>
                                    <td><?php echo $row['password']; ?></td>
                                    <td><?php echo $row['nama_level']; ?></td>
                                    <td>
                                        <a href="index.php?page=upd_akun&idPegawai=<?php echo $row['id_petugas']; ?>" class="btn btn-primary">Update</a>
                                        <a href="index.php?page=dft_akun&id=<?php echo $row['id_petugas']; ?>" class="btn btn-danger">Hapus</a>
                                    </td>
                                </tr>
                            <?php }?>
                        </tbody>
                    </table>
            </div>
        </div>
    </main>
</div>

<?php 
    require_once 'public/footer.php';
?>