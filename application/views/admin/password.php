<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>/css/full.css'/>
<?php
	if(($this->session->userdata('status') == 'aktif') AND ($this->session->userdata('level') == 'admin')){
					foreach ($data as $row):
?>
	<?php
			echo $this->msk->msg('msgSukses','spanO');
			echo $this->msk->msg('msgGagal','spanO');
			echo $this->msk->msg('msgBeda','spanO');
	?>
	<label class='a' align='center'> <center>Psssword</center></label>
	<hr>
			<form action='<?php echo base_url(); ?>c_admin/password_c' method='post'>
				<table border='0' align='center' cellpadding='7px'>
					<tr>
						<td>Username</td>
						<td>:</td>
						<td><input name='' type='text' value='<?php echo $row->username; ?>' disabled></td>
					</tr>
					<tr>
						<td>Password New</td>
						<td>:</td>
						<td><input name='pass' type='password'></td>
					</tr>
					<tr>
						<td>Confir Password</td>
						<td>:</td>
						<td><input name='confir' type='password' ></td>
					</tr>
					<tr>
						<td ><input name='submit' type='submit' value='Change' class='a'/></td>
					</tr>
				</table>
			</form>
			<?php
				endforeach;
				}
?>