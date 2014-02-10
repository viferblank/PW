<!DOCTYPE html>
<?php
if(($this->session->userdata('level')== 'admin' ) AND ($this->session->userdata('status')== 'aktif' )){
?>
<html>
<head>
	<title>M2 Control Admin</title>
<link rel='stylesheet' type='text/css' href='<?php echo base_url();?>css/full.css'/>
<link rel='shortcut icon' type='image/x-con' href='<?php echo base_url();?>image/icon.ico'/>
</head>

<body class='z'>
<?php 
	$this->load->view('admin/header');
 ?>
 <div class='content_admin'>
	 <div class='menu_admin'>
					<!--Menu Navigasi Sebelah Kanan-->
						<ul>
							<a href='<?php echo base_url();?>c_admin/home/'><li>Home</li></a>
							<a href='<?php echo base_url();?>c_admin/allmusik/'><li>All Musik</li></a>	
							<a href='<?php echo base_url();?>c_admin/musik/'><li>Musik</li></a>
							<a href='<?php echo base_url();?>c_admin/jenis_lagu/'><li>Jenis lagu</li></a>	
							<a href='<?php echo base_url();?>c_admin/chapca/'><li>Chapca</li></a>	
							<a href='<?php echo base_url();?>c_admin/user/'><li>User</li></a	>
							<a href='<?php echo base_url();?>c_admin/profile/'><li>Profile</li></a>
							<a href='<?php echo base_url();?>c_admin/password/'><li>Password</li></a>
							<a href='<?php echo base_url();?>login/logout/'><li>Logout</li></a>
						</ul>
	 </div>
	<div class='content_admin_a'>
				<?php
					if($page == "home"){
						$this->load->view('admin/home');
					}
					else if($page == "profile"){
						$this->load->view('admin/profile');
					}
					else if($page == "profile_edit"){
						$this->load->view('admin/edit_profile');
					}
					else if($page == "user"){
						$this->load->view('admin/user');
					}					
					else if($page == "musik"){
						$this->load->view('admin/musik');
					}
					else if($page == "tambah_user"){
						$this->load->view('admin/tambah');
					}
					else if($page == "add_jenis"){
						$this->load->view('admin/add_jenis');
					}
					else if($page == "jenis_lagu"){
						$this->load->view('admin/jenis_lagu');
					}
					else if($page == "edit_jenis"){
						$this->load->view('admin/edit_jenis_lagu');
					}
					else if($page == "chapca"){
						$this->load->view('admin/chapca');
					}
					else if($page == "edit_chapca"){
						$this->load->view('admin/edit_chapca');
					}
					else if($page == "add_chapca"){
						$this->load->view('admin/add_chapca');
					}
					else if($page == "edit_user"){
						$this->load->view('admin/edit');
					}
					else if($page == "password"){
						$this->load->view('admin/password');
					}
					else if($page == "allmusik"){
						$this->load->view('admin/allmusik');
					}
					else if($page == "add_musik"){
						$this->load->view('admin/add_musik');
					}
					else if($page == "one"){
						$this->load->view('admin/one');
					}					
				?>
	</div>
 </div>
<?php 
	$this->load->view('admin/footer');
 ?>
</body>
</html>
<?php
	}
	else{
		redirect('c_admin');
	}
?>