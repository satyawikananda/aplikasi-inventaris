<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 bg-light sidebar position-fixed" style="height:100%;z-index:1">
                <div class="sidebar-sticky">
                    <center><img src="assets/img/user.png" style="width:60%;" class="img-responsive"></img></center>
                    
                    <h4 class="text-muted text-center"><?php echo $_SESSION['nama_petugas']; ?></h4>
                    <h6 class="text-muted text-center"><?php
                        if($_SESSION['id_level'] == 1){
                            echo "admin";
                        }else if($_SESSION['id_level'] == 2){
                            echo "operator";
                        }else if($_SESSION['id_level'] == 3){
                            echo "pegawai";
                        }
                    ?></h6>
                        
                    <ul class="nav flex-column">
                        <li class="nav-item"><a href="index.php" class="nav-link">Dashboard</a></li>
                        <li class="nav-item"><a href="index.php?page=dft_brg" class="nav-link">Daftar barang</a></li>
                        
                        <li class="nav-item"><a href="cetak_laporan.php" target="_blank" class="nav-link">Laporan</a></li>
                        <li class="nav-item"><a href="index.php?page=dft_akun" class="nav-link">Daftar akun</a></li>
                            
                        <li class="nav-item"><a href="index.php?page=upd_akun&id_petugas=" class="nav-link">Edit akun</a></li> 
                        <li class="nav-item"><a href="logout.php" class="nav-link">Logout</a></li>
                    </ul>
                </div>
            </nav>
    </div>
</div>