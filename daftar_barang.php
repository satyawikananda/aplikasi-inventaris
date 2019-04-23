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
                    <h4 class="text-center lead">Selamat datang</h4>
                </div>
            </div>
            <div class="card" style="margin-top:4%;">
                <div class="card-body">
                    <h4 class="text-center">Daftar barang</h4>
                    <div class="row">
                        <div class="col-lg-3">
                            <a href="index.php?page=tmb_brg&idSession=<?php echo $_SESSION['id_petugas']; ?>" class="btn btn-primary text-white">Tambah barang</a><br><br>
                        </div>
                        <div class="col-lg-4">
                            <form action="" method="POST">
                                <div class="form-group">
                                    <input type="text" name="cari" id="cari" class="form-control" placeholder="Cari barang">
                                    <input type="submit" name="search" value="Cari">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div id="load">
                    <table class="table table-stripped" id="pagination-data">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama barang</th>
                                <th>Kd inventaris</th>
                                <th>kondisi</th>
                                <th>Keterangan</th>
                                <th>Stok</th>
                                <th>Tanggal Register</th>
                                <th>Jenis</th>
                                <th>Ruang</th>
                                <th>Nama Petugas</th>
                                <?php 
                                    if($_SESSION['id_level'] == 1){
                                ?>
                                <th>Aksi</th>
                                    <?php }?>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            if(isset($_GET['id'])){
                                $id = $_GET['id'];
                                $del = $db->deleteData('tb_inventaris',"id_inventaris='$id'");
                                if($del == true){
                                    header('Location:index.php?page=dft_brg');
                                }else{
                                    return false;
                                }
                            }
                        ?>
                            <?php 
                                $perPage = 3;
                                $page = isset($_GET['hal']) ? (int)$_GET['hal'] : 1;
                                $mulai = ($page > 1) ? ($page * $perPage) - $perPage : 0;
                                $data = $db->limitBarang($mulai,$perPage);

                                $query = $db->getRelasiBarang();
                                $total = count($query);
                                $pages = ceil($total/$perPage); 
                                $no = 1;
                                foreach($data as $row){
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $row['nama']; ?></td>
                                <td><?php echo $row['kode_inventaris']; ?></td>
                                <td><?php echo $row['kondisi']; ?></td>
                                <td><?php echo $row['keterangan']; ?></td>
                                <td><?php echo $row['stok']; ?></td>
                                <td><?php echo $row['tanggal_register']; ?></td>
                                <td><?php echo $row['nama_jenis']; ?></td>
                                <td><?php echo $row['nama_ruang']; ?></td>
                                <td><?php echo $row['nama_petugas']; ?></td>
                                <td>
                                <?php 
                                    if($_SESSION['id_level'] == 1){
                                ?>
                                    <a href="index.php?page=upd_brg&getId=<?php echo $row['id_inventaris'];?>" class="btn btn-primary">Update</a><br><br>
                                    <a href="index.php?page=dft_brg&id=<?php echo $row['id_inventaris']; ?>" onclick="confirm('Anda yakin?');" class="btn btn-primary">Hapus</a><br><br>
                                    <?php }?>
                                    <a href="index.php?page=pjm_brg&idBarang=<?php echo $row['id_inventaris'] ?>&idSession=<?php echo $_SESSION['id_petugas']; ?>" class="btn btn-primary">Pinjam</a>
                                </td>
                            </tr>
                            
                            <?php }?>
                            
                        </tbody>
                    </table>
                    <?php 
                                for($i = 1; $i<=$pages;$i++){
                            ?>
                            <a href="index.php?page=dft_brg&hal=<?php echo $i;?>"><?php echo $i; ?></a>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<?php 
    require_once 'public/footer.php';
?>