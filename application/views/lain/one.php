<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>/css/full.css'/>

	<?php
			echo "<label style='float:right;'>" .$this->msk->msg('msg','')."</label>";
	?>
			<?php 
			foreach($one as $row): 
		$id=$row->id_album;
		$id_user=$row->id_user;			
			?>
	<div class='span3'>

<table align='center' width='100%' border='0'>
		<div class='spanA'>
			<label class='c'><a href='<?php echo base_url(); ?>first/one/<?php echo $row->id_album; ?>'><?php echo $row->musik  ?></a></label><label style='margin-right:10px;float:right;font-size:10px;font-style:italic;'><?php echo $row->tgl_upload;  ?></label>
		</div>
		<div class='spanC'><audio controls>
			<source src="<?php echo base_url(); ?>/musik/<?php echo $row->file; ?>" type="audio/mpeg"/>Your browser does not support the audio element.
			</audio>
		</div>
		<div class='spanB'>
			<div class='spanB'>
				<label class='r'>upload by : </label>
				<label class='M'><?php echo $row->fullname; ?></label>
			</div>
			<img src='<?php echo base_url();?>image/<?php echo $row->level; ?>/<?php echo $row->foto ?>' class='m'></img>
		</div>
		<div class='spanB'>
		</div>
		<div class='spanB'>
			<label class='e'><a href='<?php echo base_url(); ?>first/download/<?php echo $row->id_album;?>'>Download</a> </label>
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
<?php if($this->session->userdata('level') == 'admin') { ?> <a href='<?php echo base_url();?>first/hapus_musik/<?php echo $row->id_album; ?>/<?php echo $row->file; ?>' onclick="return confirm('Anda yakin ingin menghapus nya..!!')"><img src='<?php echo base_url(); ?>image/trash.png' class='l' title='Hapus'></img></a><? } ?>
		</div>
		<div class='spanA'>
				<label class='r'>Dekripsi</label> : <?php echo $row->ket_album;?>
		</div>
</table>
</div>

<div class='span5'>
	<div class='span6'>
	<?php	echo $list_komen;?>
		Comment
	</div>
	<div class='span3'>
	<?php
			echo $this->msk->msg('msgLogin','spanO');
			echo $this->msk->msg('msgchapca','spanO');
	?>
<?php echo form_open_multipart('first/komment_pr',array('method'=>'post'))?>
		<textarea rows='5' cols='50' name='coment' placeholder='Comment disini' max-length='10'></textarea><br>
		<input name='id_album' type='hidden' value='<?php echo $row->id_album;?>'/>
		<input name='id_user' type='hidden' value='<?php echo $this->session->userdata('id'); ?>'/><br>
<?php foreach($chapca as $ch): ?>
		<table width='400px'>
		<tr>
		<input name='id_capcha' value='<?php echo $ch->id_chapca; ?>' type='hidden'>
		<td><label><?php echo $ch->chapca ?></label></td>
		<td><input type='number' name='chapca' value='' required></td>
		</tr>
				<td colspan="2" style='text-align:center;font-size:13px;'>*Diisi hasil operasi yang disebelah kiri</td>
		</tr>
		</table>
<?php endforeach; ?>
		<label style='text-align:left;'><input name='submit' type='submit' value='submit'></label>
<?php form_close();?>
	</div>
	<?php	
	endforeach; 
	
	?>
<?php 
if(($this->session->userdata('level')=='admin') OR ($this->session->userdata('level')=='user') AND ($this->session->userdata('status')=='aktif')){
 foreach($komenL as $asL):
 $id_user_komen=$asL->id_user_komen;
 $id_user_dat=$this->session->userdata('id');
 ?>
	<div class='span3'>
		<table width='100%'>
			<tr>
				<td width='100px' rowspan='2'><img src='<?php echo base_url(); ?>/image/<?php echo $asL->level; ?>/<?php echo $asL->foto; ?>' class='o' ></img></td>
				<td><label class='r' style='font-style:italic;font-size:20px;'><?php echo $asL->fullname; ?></label> <label class='r' style='font-style:italic;'><?php echo $asL->tgl; ?></label></td>
			<?php if(($this->session->userdata('level')=='admin') OR ($this->session->userdata('level')=='user') AND ($this->session->userdata('status')=='aktif')
			){
				if(($id_user_komen == $id_user_dat)){
			?> 
				<td align='right' width='200px'>
				<?php 
				if(($asL->view)=='tidak'){ ?><a href='<?php echo base_url();?>first/tidakAktif/<?php echo $asL->id_album; ?>/<?php echo $asL->id_coment; ?>'><img src='<?php echo base_url(); ?>image/no.png' title='Tidak' class='l'></img></a>
				<?php }else{ ?><a href='<?php echo base_url();?>first/aktif/<?php echo $asL->id_album; ?>/<?php echo $asL->id_coment; ?>'><img src='<?php echo base_url(); ?>image/ya.png' class='l' title='Aktif'></img></a>
				<?php }?><a href='<?php echo base_url();?>first/hapus_comment/<?php echo $asL->id_album; ?>/<?php echo $asL->id_coment; ?>' onclick="return confirm('Anda yakin ingin menghapus nya..!!')"><img src='<?php echo base_url(); ?>image/trash.png' class='l' title='Hapus'></img></a></td>
			<?php }}?>
			</tr>
			<tr>
				<td width=''><div class='span'><?php echo $asL->coment; ?></div></td>
			</tr>

		</table>
	</div>
<?php endforeach; 
}else{
 foreach($komen as $asL):
 $id_user_dat=$this->session->userdata('id');
 ?>
	<div class='span3'>
		<table width='100%'>
			<tr>
				<td width='100px' rowspan='2'><img src='<?php echo base_url(); ?>/image/<?php echo $asL->level; ?>/<?php echo $asL->foto; ?>' class='o' ></img></td>
				<td><label class='r' style='font-style:italic;font-size:20px;'><?php echo $asL->fullname; ?></label> <label class='r' style='font-style:italic;'><?php echo $asL->tgl; ?></label></td>
			<?php if(($this->session->userdata('level')=='admin') OR ($this->session->userdata('level')=='user') AND ($this->session->userdata('status')=='aktif')
			){

			?> 
				<td align='right' width='200px'>
				<?php 
				if(($asL->view)=='tidak'){ ?><a href='<?php echo base_url();?>first/tidakAktif/<?php echo $asL->id_album; ?>/<?php echo $asL->id_coment; ?>'><img src='<?php echo base_url(); ?>image/no.png' title='Tidak' class='l'></img></a>
				<?php }else{ ?><a href='<?php echo base_url();?>first/aktif/<?php echo $asL->id_album; ?>/<?php echo $asL->id_coment; ?>'><img src='<?php echo base_url(); ?>image/ya.png' class='l' title='Aktif'></img></a>
				<?php }?><a href='<?php echo base_url();?>first/hapus_comment/<?php echo $asL->id_album; ?>/<?php echo $asL->id_coment; ?>' onclick="return confirm('Anda yakin ingin menghapus nya..!!')" ><img src='<?php echo base_url(); ?>image/trash.png' class='l' title='Hapus'></img></a></td>
			<?php }?>
			</tr>
			<tr>
				<td width=''><div class='span'><?php echo $asL->coment; ?></div></td>
			</tr>

		</table>
	</div>
<?php endforeach; 
}
?>
</div>

