<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>/css/full.css' />
<div class='menukiri'>
	<?php
			//=========================Menu User==========================//
			if(($this->session->userdata('status') == "aktif") AND ($this->session->userdata('level') == "user")){
			
			?>
				<div class='menukiri' >
					<!--Menu Navigasi Sebelah Kanan-->
						<ul>
							<li><a href='<?php echo base_url(); ?>first/allmusik/'>Beranda<a/></li>
							<li><a href='<?php echo base_url(); ?>first/musik/'>My Musik<a/></li>	
							<li>Jenis Musik
							<ul>
					<?php
						foreach($jenis as $jenis):
					?>
							<li><a href='<?php echo base_url(); ?>first/menu/<?php echo $jenis->id_jenis;?>'><?php echo $jenis->nama_jenis;?><a/></li>					
					<?php
						endforeach;
					?>
							</ul>
							</li>
							<li><a href='<?php echo base_url();?>first/profile/'>Profile<a/></li>
							<li><a href='<?php echo base_url();?>first/password/'>Password<a/></li>
						</ul>
						
				</div>
		<? }
			//=========================Menu Pengunjung==========================//
			else{
		?>
				<div class='menukiri' >
					<!--Menu Navigasi Sebelah Kanan-->
						<ul>
							<li><a href='<?php echo base_url(); ?>first/allmusik/'>Beranda<a/></li>
							<li><a href='<?php echo base_url(); ?>first/musik_baru/'>Musik Baru<a/></li>	
							<li>Jenis Musik
							<ul>
					<?php
						foreach($jenis as $jenis):
					?>
							<li><a href='<?php echo base_url(); ?>first/menu/<?php echo $jenis->id_jenis;?>'><?php echo $jenis->nama_jenis;?><a/></li>					
					<?php
						endforeach;
					?>
							</ul>
							</li>
						</ul>
						
				</div>
		<? } ?>

	<?php 
		$this->load->view('menu/login');
	?>
		</div>