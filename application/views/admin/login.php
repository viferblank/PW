<!DOCTYPE html>
<html>
<head><title>M2</title>
<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>/css/full.css' />
<link rel='shortcut icon' href='<?php echo base_url(); ?>/image/icon.ico' type='image/x-icon'/>
</head>
<div class='spanK' >
			<?php 
				$this->msk->msg('login','spanO');
			?>
<div class='spanR' style='background:gray;text-align:left;height:60px;'>
<img src='<?php echo base_url()?>image/user_g.png' width='50px' height='50px'></img>
<label class='a'>Administrator</label>
</div>
<table width='200px' align='center'>
<form action='<?php echo base_url(); ?>login/ADlogin/' method='post'>
<tr>
	<td colspan='2'>		<h3 align='center'>Login</h3></td>
</tr>
			<tr>
			<td><div class='text'>	
					<input type='text' name='user' placeholder='Username' class='text1'>
					<img src='<?php echo base_url(); ?>/image/usr.png'></img>
				</div>
			</td>
			</tr>
			<tr>
			<td>
				<div class='text'>
					<input type='password' name='pass' placeholder='Password' class='text1'>
					<img src='<?php echo base_url(); ?>/image/gembok.png'></img>

				</div>
			</td>
			</tr>

			<tr>
						<td><input type='submit' name='submit' value='Log In' style='float:right;'>		
						</td></tr>
</form>	
</table>
</div>