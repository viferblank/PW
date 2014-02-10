<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>/css/full.css'/>
<?php
	if(($this->session->userdata('status') == 'aktif') AND ($this->session->userdata('level') == 'user')){

					foreach ($data as $row):
					?>
	<?php
			echo $this->msk->msg('msgSukses','spanO');
			echo $this->msk->msg('msgFailed','spanO');
	?>
	<label class='a' align='center'> <center>Profile</center></label>
	<hr>
				<table border='0' cellpadding='6px' width='700px'>
					<tr bgcolor='#e2e5ef'>
						<td >Nama </td>
						<td>:</td>
						<td align='center'><?php echo $row->fullname; ?></td>
						<td colspan='2' rowspan='5' width='30%'><img src='<?php echo base_url(); ?>/image/<?php echo $row->level; ?>/<?php echo $row->foto; ?>' class='c'></img></td>
					</tr>
					<tr bgcolor='#bfddff'>
						<td>Username</td>
						<td>:</td>
						<td align='center'><?php echo $row->username; ?></td>
					</tr>
					<tr bgcolor='#e2e5ef'>
						<td >Email</td>
						<td>:</td>
						<td align='center'><?php echo $row->email; ?></td>
					</tr>
					<tr bgcolor='#bfddff'>
						<td>Level </td>
						<td>:</td>
						<td align='center'><?php echo $row->level; ?></td>
					</tr>
					<tr bgcolor='#e2e5ef'>
						<td>Status </td>
						<td>:</td>
						<td align='center'><?php echo $row->status; ?></td>
					</tr>
					<tr>
						<td colspan='4' align='right'><a href='<?php echo base_url(); ?>first/profile_edit'><button>Edit</button></a></td>
					</tr>

				</table>
			<?
				endforeach;
		}else{
			redirect('first/allmusik');
		}
?>