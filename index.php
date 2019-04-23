<?php 
    require_once 'public/header.php';
?>

<?php 
    require_once 'public/sidenav.php';
?>

<?php 
    if(isset($_REQUEST['page'])){
        $page = $_REQUEST['page'];
        switch($page){
            case 'dft_brg':
                include_once 'daftar_barang.php';
                break;
            case 'tmb_brg':
                include_once 'tambah_barang.php';
                break;
            case 'pjm_brg':
                include_once 'pinjam_barang.php';
                break;
            case 'upd_brg':
                include_once 'update_barang.php';
                break;
            case 'dft_akun':
                include_once 'daftar_akun.php';
                break;
            case 'tmb_akun':
                include_once 'tambah_akun.php';
                break;
            case 'upd_akun':
                include_once 'update_akun.php';
                break;
        }
    }else{
        include_once 'dashboard.php';
    }
?>

<?php 
    require_once 'public/footer.php';
?>