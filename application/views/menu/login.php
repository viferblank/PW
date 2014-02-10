<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>/css/full.css'/>
	<!--Script Untuk Login-->
	<hr>

<form action='<?php echo base_url(); ?>first/search' method='post'>
	<input type='search' name='search' maxlength='10' placeholder='Search'/>
	<input type='submit' name='submit'  value='Submit' style=''/>
</form>
	<?php

	if(($this->session->userdata('status') == "aktif") AND ($this->session->userdata('level') == "user")){
		?>
			Selamat Datang <?php echo $this->session->userdata('name'); ?>
			<a href='<?php echo base_url(); ?>login/logout' style='float:right;font-size:15px;'>Keluar</a>
		<?
	}else{ ?>
		<form action='<?php echo base_url(); ?>login/loginl/' method='post'>
			<h3 align='center'>Login</h3>
			<?php 
				$this->msk->msg('login','span9');
			?>
				<div class='text'>	
					<img src='<?php echo base_url(); ?>/image/usr.png'></img>
					<input type='text' name='user' placeholder='Username' class='text1'><br>
				</div>
				<div class='text'>
					<input type='password' name='pass' placeholder='Password' class='text1'>
					<img src='<?php echo base_url(); ?>/image/gembok.png'></img>

				</div>
				<a href='<?php echo base_url(); ?>login/register' align='left' >Daftar</a>
					<input type='submit' name='submit' value='Masuk' style='float:right;'>		
		</form>	
	<? }?>
