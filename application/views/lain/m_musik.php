<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>/css/full.css'/>
	<label class='a' align='center'> <center><?php echo $menu;?></center></label>
	<?php
			echo $this->msk->msg('msg','span0');
	?>
		<?php 
			foreach($data as $row): 
		$id=$row->id_album;
		$id_user=$row->id_user;				
			?>

<div class='span3'>

<table align='center' width='100%' border='0'>
		<div class='spanA'>
			<label class='c'><a href='<?php echo base_url(); ?>first/one/<?php echo $row->id_album; ?>'><?php echo $row->musik  ?></a></label><label style='margin-right:10px;float:right;font-size:10px;font-style:italic;'><?php echo $row->tgl_upload;  ?></label>
		</div>
		<div class='spanC'><audio >
			<source src="<?php echo base_url(); ?>/musik/<?php echo $row->file; ?>" type="audio/mpeg"/>Your browser does not support the audio element.
			</audio>
		</div>
		<div class='spanB'>
			<div class='spanB'>
				<label class='r'>upload by : </label>
				<label class='M'><?php echo $row->fullname; ?></label>
			</div>
			<img src='<?php echo base_url();?>image/<?php echo $row->level; ?>/<?php echo $row->foto; ?>' class='m'></img>
		</div>
		<div class='spanB'>
		</div>
		<div class='spanB'>
			<label class='e'><a href='<?php echo base_url(); ?>first/download/<?php echo $row->id_album; ?>'>Download</a> </label>
		</div>

		<div class='spanB'>
			<div class='spanB'>
				<label class='e'><?php echo $row->download; ?></label>
			</div>
		<label class='e'>Download</label>
		</div>

		<div class='spanB'>
			<div class='spanB'>
			<label class='M'>
			<?php 
				$list_komen =$this->db->query("SELECT * FROM coment WHERE id_album='$id' AND view='aktif'")->num_rows(); 
			?>
				<label class='e'><?php echo $list_komen; ?></label>
			</label>
			</div>
			<label class='e'>Coment</label> 
		</div>
		<div class='spanB'>
			<div class='spanB'>
				<label class='e'><?php echo $row->suka; ?></label>
			</div>
				<label class='e'><a href='<?php echo base_url(); ?>first/like/<?php echo $row->id_album;?>'>Like</a></label>
		</div>
		<div class='spanB'>
<?php if(($this->session->userdata('level') == 'admin') OR ($this->session->userdata('level') == 'user') AND ($this->session->userdata('id') == $row->id_user)) { ?> <a href='<?php echo base_url();?>first/hapus_musik/<?php echo $row->id_album; ?>/<?php echo $row->file; ?>' onclick="return confirm('Anda yakin ingin menghapus nya..!!')" ><img src='<?php echo base_url(); ?>image/trash.png' class='l' title='Hapus'></img></a><? } ?>
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