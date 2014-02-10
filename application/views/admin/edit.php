<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>/css/full.css'/>
<?php
	if($this->session->userdata('level') == 'admin'){
?>
	<label class='a' align='center'> <center>Edit User</center></label>
	<hr>
<form action='<?php echo base_url(); ?>c_admin/edit_u' method='post'>
<table border='0' align='center'>

	<?php
		foreach($data as $row):
	?>
<input type='text' name='pass' value='<?php echo $row->password; ?>' style='position:absolute;visibility:hidden;'>
<input type='text' name='id' value='<?php echo $row->id_user; ?>' style='position:absolute;visibility:hidden;'>

	<tr >
		<td width='200px' >Fullname</td>
		<td width='200px' ><input type='text' name='name' value='<?php echo $row->fullname;  ?>'></td>
	</tr>
	<tr >
		<td width='200px' >Username</td>
		<td width='200px' ><input type='text' name='user' value='<?php echo $row->username;  ?>'></td>
	</tr>
	<tr   >
		<td width='200px' >Password</td>
		<td width='200px' ><input type='password' name='password' value='' placeholder='Masukkan Pass Baru'></td>
	</tr>
	<tr >
		<td width='200px' >Email</td>
		<td width='200px' ><input type='text' name='email' value='<?php echo $row->email;  ?>'></td>
	</tr>
	<tr   >
		<td >Level</td>
		<td >
			<select name='level'>
				<option value='User' <? if($row->level == "user")echo "selected" ?>>User</option>
				<option value='Admin' <? if($row->level == "admin")echo "selected" ?>>Admin</option>
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
	<tr >
		<td align='right' colspan='2'><input type='submit' name='submit' value='submit'></td>
	</tr>

<?php 
	endforeach;
?>

</table>
</form>
<?php
	}else{
		echo "<script>alert('Anda Tidak Mempunyai Akses Untuk Ke Halaman Ini');location='".base_url()."'</script>";
	}
?>