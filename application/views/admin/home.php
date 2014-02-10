<div class='span2' align='center'>
	Selamat datang di control admin <?php echo $this->session->userdata('user'); ?>
</div>
<div class='span1'>
<table width='100%' align='center'>
	<tr >
		<td colspnan='2' align='center'>Jumlah User Yang aktif</td>
	</tr>	
	<tr>
		<td>Admin</td>
		<td><?php echo $this->db->query("SELECT * FROM user WHERE level ='admin'")->num_rows(); ?></td>
	</tr>	
	<tr>
		<td>User</td>
		<td><?php echo $this->db->query("SELECT * FROM user WHERE level ='user'")->num_rows(); ?></td>
	</tr>	
</table>
</div>
<div class='span1' >
<table width='100%' align='center' >
	<tr>
		<td colspnan='2' align='center'>Jumlah Lagu</td>
	</tr>	
	<tr>
		<td>Jumlah musik</td>
		<td><?php echo $this->db->query("SELECT * FROM album")->num_rows(); ?></td>
	</tr>		
</table>
</div>
<div class='span1' >
<table width='100%' align='center' >
	<tr >
		<td colspnan='2' align='center'>File yang sudah di download</td>
	</tr>	
	<tr>
		<td>Jumlah musik yang sudah di download</td>
<?php 
	foreach($jml as $ml):
?>
		<td><?php echo $ml->down; ?></td>
<?php
	endforeach;
?>
	</tr>		
</table>
</div>