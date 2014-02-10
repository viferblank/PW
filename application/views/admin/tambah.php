<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>/css/full.css'/>
	<label class='a' align='center'> <center>Add User</center></label>
	<hr>
<?php
	if($this->session->userdata('status') == 'aktif'){
		if(($this->session->userdata('level') == 'admin') || ($this->session->userdata('level') == 'user')){
?>
<?php echo form_open_multipart('login/register_admin',array('method'=>'post')) ?>
		<table border='0' cellspacing='20' align='center'>
			<tr>
				<td width='100px'>Fullname</td>
				<td align='right'><input  name='name' style='width:200px;' class='a' type='name' placeholder='Masukkan Nama' required></td>
			</tr>
			<tr>
				<td>Username</td>
				<td align='right'><input  name='user' style='width:200px;' class='a' type='name' placeholder='Masukkan Username' required></td>
			</tr>
			<tr>
				<td>Password</td>
				<td align='right'><input name='pass' style='width:200px;' class='a' type='password' placeholder='Masukkan Password' required></td>
			</tr>
			<tr>
				<td>Email</td>
				<td align='right'><input name='email' style='width:200px;' class='a' type='email' placeholder='Masukkan Email' required></td>
			</tr>
			<tr>
				<td>Level</td>
				<td align='right'><select name='level' style='width:200px;border-radius:5px;'>
									<option value='user'>User</option>
									<option value='admin'>Admin</option>
				</select></td>
			</tr>
			<tr>
				<td>Foto</td>
				<td><input type="file" name="userfile" style='border-radius:5px;' ></td>
			</tr>
			<tr>
				<td colspan='2' align='right'><input name='submit' style='width:100px;border-radius:5px;' type='submit' value='Register'></td>
			</tr>			
		</table>
	</form>
<?php
	echo form_close();
		}
	}

 ?>