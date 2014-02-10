<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>/css/full.css'/>
	<label class='a' align='center'> <center><?php echo $menu;?></center></label>
	<?php
			echo $this->msk->msg('msg','span2');
	?>
		<?php 
			foreach($data as $row): 
		$id=$row->id_album;
		$id_user=$row->id_user;				
			?>

<div class='span3'>

<table align='center' width='100%' border='0'>
		<div class='spanQ'>
			<label class='c'><a href='<?php echo base_url(); ?>c_admin/one/<?php echo $row->id_album; ?>'><?php echo $row->musik  ?></a></label>
		</div>
		<div class='spanR'><audio >
			<source src="<?php echo base_url(); ?>/musik/<?php echo $row->file; ?>" type="audio/mpeg"/>Your browser does not support the audio element.
			</audio>
		</div>
		<div class='spanW'>
			<div class='spanW'>
				<label class='r'>upload by : </label>
				<label class='M'><?php echo $row->fullname; ?></label>
			</div>
			<img src='<?php echo base_url();?>image/<?php echo $row->level ?>/<?php echo $row->foto ?>' class='m'></img>
		</div>
		<div class='spanW'>
		</div>
		<div class='spanW'>
			<label class='e'><a href='<?php echo base_url(); ?>first/download/<?php echo $row->id_album; ?>'>Download</a> </label>
		</div>

		<div class='spanW'>
			<div class='spanW'>
				<label class='e'><?php echo $row->download; ?></label>
			</div>
		<label class='e'>Download</label>
		</div>

		<div class='spanW'>
			<div class='spanW'>
			<label class='M'>
			<?php 
				$list_komen =$this->db->query("SELECT * FROM coment WHERE id_album='$id' AND view='aktif'")->num_rows(); 
			?>
				<label class='e'><?php echo $list_komen; ?></label>
			</label>
			</div>
			<label class='e'>Coment</label> 
		</div>
		<div class='spanW'>
			<div class='spanW'>
				<label class='e'><?php echo $row->suka; ?></label>
			</div>
				<label class='e'><a href='<?php echo base_url(); ?>c_admin/like/<?php echo $row->id_album;?>'>Like</a></label>
		</div>
		<div class='spanW'>
<?php if($this->session->userdata('level') == 'admin') { ?> <a onclick="return confirm('Anda yakin ingin menghapus nya..!!')" href='<?php echo base_url();?>c_admin/hapus_musik/<?php echo $row->id_album; ?>/<?php echo $row->file; ?>'><img src='<?php echo base_url(); ?>image/trash.png' class='l' title='Hapus'></img></a><? } ?>
		</div>
</table>
</div>

	<?php	
	endforeach; ?>
<div class='span4'>
<?php
	echo $this->pagination->create_links(); 
?>
</div>