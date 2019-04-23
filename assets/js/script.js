$(document).ready(function(){
    $('#cari').on('keyup',function(){
        $('#load').load('ajax_barang.php?cari='+$('#cari').val());
    });
    
});