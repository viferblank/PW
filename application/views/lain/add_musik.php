<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>/css/full.css'/>
	<?php
			echo $this->msk->msg('msgF','spanO');
	?>
	<label class='a' align='center'> <center>Add Musik</center></label>
	<hr>
<?php
	if($this->session->userdata('status') == 'aktif'){
		if(($this->session->userdata('level') == 'admin') || ($this->session->userdata('level') == 'user')){
?>
<?php echo form_open_multipart('first/add_musik_p',array('method'=>'post')) ?>
		<table border='0' cellspacing='20' align='center'>
			<tr>
				<td width='100px'>Nama Album</td>
				<td ><input  name='nama_album' style='width:200px;' class='a' type='name' placeholder='Masukkan Nama Album' ></td>
			</tr>
			<tr>
				<td>Nama Artis</td>
				<td ><input  name='nama_artis' style='width:200px;' class='a' type='name' placeholder='Masukkan Nama Artis' ></td>
			</tr>
			<tr>
				<td>File</td>
				<td ><input name='userfile' style='width:200px;' class='a' type='file'></td>
			</tr>
			<tr>
				<td>Jenis Lagu</td>
				<td ><select name='jenis' class='a' style='width:200px;border-radius:5px;'>
							<?php foreach($data as $row): ?>
									<option value='<?php echo $row->id_jenis; ?>'> <?php echo $row->nama_jenis; ?></option>
							<?php endforeach; ?>
				</select></td>
			</tr>
			<tr>
				<td>Ket Album</td>
				<td><textarea name='ket_album' placeholder='Keterangan Album'></textarea></td>
			</tr>
	<?php
	foreach($chapca as $chapca):
	?>
	<input name='id_capcha' value='<?php echo $chapca->id_chapca; ?>' type='hidden'>
			<tr>
				<td><?php echo $chapca->chapca; ?></td>
				<td align='right'><input name='chapca' style='width:200px;' class='a' type='text' placeholder='Masukkan Jumlah' required></td>
			</tr>	
		<tr>
		<td colspan="2" style='text-align:center;font-size:13px;'>*Diisi hasil operasi yang disebelah kiri</td>
		</tr>			
	<?php
	endforeach;
	?>
			<tr>
				<td colspan='2' align='right'><input name='submit' style='width:100px;border-radius:5px;' type='submit' value='Add'></td>
			</tr>			
		</table>
	</form>
<?php
	echo form_close();
		}
	}

 ?>