<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>/css/full.css'/>
<?php
	if($this->session->userdata('status') == 'aktif'){
		if(($this->session->userdata('level') == 'admin') || ($this->session->userdata('level') == 'user')){
?>
	<label class='a' align='center'> <center>Edit User</center></label>
	<hr>
<?php echo form_open_multipart('first/profile_edit_p',array('method'=>'post')) ?>
<table border='0' align='center'>

	<?php
		foreach($data as $row):
	?>
<input type='hidden' name='pass' value='<?php echo $row->password; ?>' >
<input type='hidden' name='id' value='<?php echo $row->id_user; ?>'>
<input type='hidden' name='foto' value='<?php echo $row->foto; ?>' >
<input type='hidden' value='<?php echo $row->level; ?>' name='level'>

	<tr >
		<td width='200px' >Fullname</td>
		<td width='200px' ><input type='text' name='name' value='<?php echo $row->fullname;  ?>'></td>
	</tr>
	<tr >
		<td width='200px' >Username</td>
		<td width='200px' ><input type='text' name='user' value='<?php echo $row->username;  ?>' disabled></td>
	</tr>
	<tr>
		<td width='200px' >Email</td>
		<td width='200px' ><input type='text' name='email' value='<?php echo $row->email;  ?>'></td>
	</tr>
	<tr   >
		<td >Level</td>
		<td >
			<select name='level'>
				<option value='User' <? if($row->level == "user")echo "selected" ?>>User</option>
			</select>
		</td>
	</tr>	
	<tr>
		<td width='200px' >Status</td>
		<td width='200px' >
			<select name='status'>
				<option value='aktif' <? if($row->status == "aktif")echo "selected" ?>>Aktif</option>
				<option value='Tidak' <? if($row->status == "tidak")echo "selected" ?>>Tidak</option>
			</select>
		</td>
	</tr>
	<tr>
		<td width='200px'  >Foto</td>
		<td><input name="userfile" type="file"></td>
	</tr>
	<tr>
		<td colspan='2'><img src='<?php echo base_url(); ?>/image/<?php echo $row->level; ?>/<?php echo $row->foto; ?>' class='c'></img></td>
	</tr>
	<tr >
		<td align='right' colspan='2'><input type='submit' name='submit' value='submit'></td>
	</tr>

<?php 
	endforeach;
?>

</table>
</form>
<?php
	form_close();
	
	}else{
		echo "<script>alert('Anda Tidak Mempunyai Akses Untuk Ke Halaman Ini');location='".base_url()."'</script>";
	}
	}
?>