<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>/css/full.css'/>
	<label class='a' align='center'> <center>Register User</center></label>
	<hr>
	<?php
			echo $this->msk->msg('msgchapca','spanO');
			echo $this->msk->msg('msgUser','spanO');
			echo $this->msk->msg('msgCek','spanO');
	?>
	
<?php echo form_open_multipart('login/Register1',array('method'=>'post')) ?>
		<table border='0' cellspacing='20' align='center'>
			<tr>
				<td width='100px'>Fullname</td>
				<td ><input  name='name' style='width:200px;' class='a' type='name' placeholder='Masukkan Nama' required></td>
			</tr>
			<tr>
				<td>Username</td>
				<td><input  name='user' style='width:200px;' class='a' type='name' placeholder='Masukkan Username' required></td>
			</tr>
			<tr>
				<td>Password</td>
				<td ><input name='pass' style='width:200px;' class='a' type='password' placeholder='Masukkan Password' required></td>
			</tr>
			<tr>
				<td>Email</td>
				<td ><input name='email' style='width:200px;' class='a' type='email' placeholder='Masukkan Email' required></td>
			</tr>
			<tr>
				<td>Foto</td>
				<td><input type="file" name="userfile" size="20" style='width:200px;' class='a' /></td>
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
				<td><input name='submit' type='submit' value='Submit'></td>
			</tr>
		</table>
<?php echo form_close(); ?>