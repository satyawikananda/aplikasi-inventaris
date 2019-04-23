<?php include_once 'public/header.php'?>
<?php 
    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $data = $db->login('tb_petugas',"username='$username'","password='$password'");

        foreach($data as $row){
            if($username == $row['username'] && $password == $row['password']){
                $_SESSION['user'] = $username;
                $_SESSION['username'] = $row['username'];
                $_SESSION['nama_petugas'] = $row['nama_petugas'];
                $_SESSION['id_level'] = $row['id_level'];
                $_SESSION['id_petugas'] = $row['id_petugas'];
                if($_SESSION['id_level'] == 1 || $_SESSION['id_level'] == 2 || $_SESSION['id_level'] == 3){
                    header('Location:index.php');
                    echo "<script>alert('Berhasil login');</script>";
                }
            }else{
                echo "<script>alert('data ada yang salah');</script>";
            }
        }
    }
?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card login">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center text-muted">Inventaris school</h3>
                            <h4 class="text-center lead">L O G I N</h2>
                            <hr>
                        </div>
                        <form action="#" method="POST">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" id="" placeholder="Username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name="password" id="" placeholder="Password" class="form-control">
                            </div>
                            <div class="form-group">
                                <center><input type="submit" name="login" value="Login" class="btn btn-outline-success"></center>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once 'public/footer.php';?>