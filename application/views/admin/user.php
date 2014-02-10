<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>/css/full.css'/>
<?php
	if($this->session->userdata('level') == 'admin'){
?>
<a href='<?php echo base_url(); ?>c_admin/tambah_user'><div class='b'>Tambah</div></a>
	<?php
			echo $this->msk->msg('msgSukses','spanO');
			echo $this->msk->msg('msgGagal','spanO');
			echo $this->msk->msg('msgHapus','spanO');
			echo $this->msk->msg('msgT','spanO');
			echo $this->msk->msg('msgCek','spanO');
	?>
<hr>
	<label class='a' align='center'> <center>Data User</center></label>
<table align='center'>
	<tr bgcolor='#ffffff'>
		<td width='3%'>No</td>
		<td width='15%'>Fullname</td>
		<td width='10%'>Username</td>
		<td width='10%'>Password</td>
		<td width='10%'>Email</td>
		<td width='10%'>Level</td>
		<td width='10%'>Status</td>
		<td width='10%'>Action</td>
	</tr>
		<?php
		$i=1;
		foreach($data as $row):
	?>
	<tr <?php if($i % 2 == 1){echo "bgcolor='#e2e5ef'";}else{echo "bgcolor='#bfddff'";}?>>

		<td><?php echo $i+$this->uri->segment(3); ?></td>
		<td><?php echo $row->fullname; ?></td>
		<td><?php echo $row->username; ?></td>
		<td>******</td>
		<td><?php echo $row->email; ?></td>
		<td><?php echo $row->level; ?></td>
		<td><?php echo $row->status; ?></td>
		<td align='center'><a href='<?php echo base_url();?>c_admin/edit_user/<?php echo $row->id_user; ?>'><img src='<?php echo base_url(); ?>image/edit.png' width='25px' title='Change'></img></a><a onclick="return confirm('Anda yakin ingin menghapus nya')" href='<?php echo base_url();?>c_admin/hapus_user/<?php echo $row->id_user; ?>/<?php echo $row->foto; ?> '><img src='<?php echo base_url(); ?>image/hapus.png' width='25px' title='Delete'></img></a></td>
	</tr>
<?php
	$i++;
	endforeach;
?>

</table >
<hr>
			<?php echo $links;
	}else{
		echo "<script>alert('Anda Tidak Mempunyai Akses Untuk Ke Halaman Ini');location='".base_url()."'</script>";
	}
?>