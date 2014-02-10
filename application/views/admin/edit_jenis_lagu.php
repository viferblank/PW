	<label class='a' align='center'> <center>Tambah Jenis musik</center></label>
	<hr>
<?php echo form_open_multipart('c_admin/pr_edit_jenis_lagu',array('method'=>'post')) ?>
		<table border='0' cellspacing='20' align='center'>
	<?php
		foreach($editJenis as $jenis):
	?>
	<input type='hidden' name='id' value='<?php echo $jenis->id_jenis; ?>'/>
			<tr>
				<td width='100px'>Nama Jenis </td>
				<td ><input  name='name' style='width:200px;' class='a' type='name' placeholder='Masukkan Nama' value='<?php echo $jenis->nama_jenis; ?>' required></td>
			</tr>
	<?php
	endforeach;
	?>
			<tr>
				<td><input name='submit' type='submit' value='Submit'></td>
			</tr>
		</table>
<?php echo form_close(); ?>