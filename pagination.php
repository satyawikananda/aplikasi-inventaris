<?php include_once 'public/header.php'; ?>
<?php 
	$perPage = 5;
	$halaman = '';

	if(isset($_POST['perPage'])){
		$halaman = $_POST['perPage'];
	}else{
		$halaman = 1;
	}

	$mulai = ($halaman - 1) * $perPage;
	$data = $db->limitBarang($mulai,$perPage);
?>
<table class="table table-stripped">
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
                                    <a href="index.php?page=dft_brg&id=<?php echo $row['id_inventaris']; ?>" class="btn btn-primary">Hapus</a><br><br>
                                    <?php }?>
                                    <a href="index.php?page=pjm_brg&idBarang=<?php echo $row['id_inventaris'] ?>&idSession=<?php echo $_SESSION['id_petugas']; ?>" class="btn btn-primary">Pinjam</a>
                                </td>
                            </tr>
                        <?php }?>
                        </tbody>
</table>
<?php 
	$querys = $db->getRelasiBarang();
	$total_records = count($querys);
	$total_page = ceil($total_records/$perPage);
	$output = '';
	for ($i=0; $i <=$total_page ; $i++) {
		$output.= "<span class='pagination-link' style='text-align: center;width: 10%;cursor: pointer;background-color: #1abc9c;' id='".$i."'>".$i."</span>";
	}
	echo $output;