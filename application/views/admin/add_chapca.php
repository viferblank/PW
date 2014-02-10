	<label class='a' align='center'> <center>Tambah Jenis musik</center></label>
	<hr>
<?php echo form_open_multipart('c_admin/pr_add_chapca',array('method'=>'post')) ?>
		<table border='0' cellspacing='20' align='center'>
			<tr>
				<td width='100px'>Chapca </td>
				<td ><input  name='name' style='width:200px;' class='a' type='name' placeholder='Masukkan Chapca' required></td>
			</tr>			
			<tr>
				<td width='100px'>Value </td>
				<td ><input  name='value' style='width:200px;' class='a' type='name' placeholder='Masukkan Jawaban' required></td>
			</tr>
			<tr>
				<td><input name='submit' type='submit' value='Submit'></td>
			</tr>
		</table>
<?php echo form_close(); ?>