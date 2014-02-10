<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>/css/full.css'/>
<?php
	if(($this->session->userdata('level') == 'admin') AND ($this->session->userdata('status') == 'aktif')){
?>
<a href='<?php echo base_url(); ?>c_admin/add_jenis_lagu'><div class='b'>Tambah</div></a>
<?php
	echo $this->msk->msg('msgGagal','spanO');
	echo $this->msk->msg('msgchapca','spanO');
?>
<hr>
	<label class='a' align='center'> <center>Jenis Lagu</center></label>
<table width='100%' align='center'>
		<tr bgcolor='#bfddff'>
			<td>No</td>
			<td>Nama Jenis</td>
			<td align='center'>Action</td>
		</tr>
<?php
$no=1;
foreach($jenisLagu as $lagu):
?>
		<tr <?php if ($no %2 ==1){echo "bgcolor='#e2e5ef'";}else { echo "bgcolor='#bfddff'";} ?>>
			<td><?php echo $no+$this->uri->segment(3); ?></td>
			<td><?php echo $lagu->nama_jenis; ?></td>
			<td align='center'><a href='<?php echo base_url();?>c_admin/edit_jenis_lagu/<?php echo $lagu->id_jenis;?>' ><img src='<?php echo base_url(); ?>image/edit.png' width='25px' title='Change'></img></a> | <a href='<?php echo base_url();?>c_admin/hapus_jenis_lagu/<?php echo $lagu->id_jenis;?>' onclick="return confirm('Anda yakin ingin menghapus nya..!!')"><img src='<?php echo base_url(); ?>image/hapus.png' width='25px' title='Delete'></img></a></td>
		</tr>
<?php
$no++;
endforeach;
?>
</table>
<?php
echo $this->pagination->create_links();
	}else{
		echo "<script>alert('Anda Tidak Mempunyai Akses Untuk Ke Halaman Ini');location='".base_url()."'</script>";
	}
?>