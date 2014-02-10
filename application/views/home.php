<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>/css/full.css' />
<?php
	if(($this->session->userdata('status') == "aktif") AND ($this->session->userdata('level')=="admin")){
		echo"<p align='center'>Selamat Datang control admin jumlah musik yang tersedia ".$this->db->count_all('album') ;
		echo" Musik";
		echo"<br>";
		echo"jumlah User saat ini yang aktif ".$this->db->count_all('user') ;
		echo" Orang";
		echo "</p>";
	}else if(($this->session->userdata('status') == "aktif") AND ($this->session->userdata('level') == "user")){
		echo"<p align='center'>Selamat Datang ";
		echo $this->session->userdata('user');
		echo "";
		echo"</p>";
	}
	else{
		echo "<p align='center'>";
		echo"Selamat Datang Di Website MAX.Mp3 ,";
		echo"</p>";
	}
?>