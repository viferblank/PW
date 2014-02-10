	<label class='a' align='center'> <center>Tambah Chapca</center></label>
	<hr>
<?php echo form_open_multipart('c_admin/pr_edit_chapca',array('method'=>'post')) ?>
		<table border='0' cellspacing='20' align='center'>
	<?php
		foreach($editChapca as $chapca):
	?>
	<input type='hidden' name='id' value='<?php echo $chapca->id_chapca; ?>'/>
			<tr>
				<td width='100px'>Chapca</td>
				<td ><input  name='name' style='width:200px;' class='a' type='name' placeholder='Masukkan Chapca' value='<?php echo $chapca->chapca; ?>' required></td>
			</tr>
			<tr>
				<td width='100px'>Value</td>
				<td ><input  name='value' style='width:200px;' class='a' type='name' placeholder='Masukkan Nama' value='<?php echo $chapca->value; ?>' required></td>
			</tr>
	<?php
	endforeach;
	?>
			<tr>
				<td><input name='submit' type='submit' value='Submit'></td>
			</tr>
		</table>
<?php echo form_close(); ?>