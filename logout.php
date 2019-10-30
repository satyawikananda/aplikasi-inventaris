<?php 
// script untuk logout dan menghapus session
	session_destroy();
	header('Location:login.php');
?>