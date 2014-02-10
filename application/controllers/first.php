<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class First extends CI_Controller {
		function __Construct(){
			parent::__Construct();
			$this->load->model('msk');
			$this->load->library('pagination');
			$this->load->helper('download');
			$data['jenis']=$this->msk->jenis();
			$this->cek_login = (($this->session->userdata('status')=='aktif')AND $this->session->userdata('level')=='user');
		}

		//======================Musik Baru=================//
		function musik_baru()
		{
			$data['jenis']=$this->msk->jenis();
			$data["data"] = $this->msk->m_musik_baru();
			$data['menu'] = "Musik Baru";
			$data['page'] = "allmusik";
			$this->load->view('view',$data);
		}
		//======================Musik=================//
		function musik()
		{
			$data['jenis']=$this->msk->jenis();
			if($this->session->userdata('level') == "admin"){
				$id=$this->session->userdata('id');				
			}
			else if($this->session->userdata('level') == "user"){
				$id=$this->session->userdata('id');
			}
			$this->msk->musik($id);
			$data['data']=$this->msk->musik($id);
			$data['page'] = "musik";
			$this->load->view('view',$data);
		}

		function allmusik()
		{
			$data['jenis']=$this->msk->jenis();
			$data['data'] = $this->msk->m_musik();
			$data['menu'] = "all musik";
			$data['page'] = "allmusik";
			$this->load->view('view',$data);
		}
		//======================Delete Musik=================//	
		function hapus_musik(){
		$id=$this->uri->segment(3);
		$file=$this->uri->segment(4);
		$this->msk->hapus_musik($id);
		$data['page']='allmusik';
			$this->load->view('view',$data);
			$this->session->set_userdata('msgHapusMusik','Hapus Musik Beerhasil');
			echo "<script>location='".base_url()."first/allmusik'</script>"; 
			return unlink('musik/'.$file);
		}
		//======================Menu=================//		
		function menu(){
			$data['jenis']=$this->msk->jenis();
			$musik=$this->uri->segment(3);
			$q=$this->db->query("SELECT * FROM jenis_lagu WHERE id_jenis='$musik' ");
			$row = $q->row_array();
			$menu = $row['nama_jenis'];
			$data['menu'] = $row['nama_jenis'];
			$data['data'] = $this->msk->menu_musik($musik,$menu);
			$data['page'] = "m_musik";
			$this->load->view('view',$data);
		}
		//======================Profile=================//
		function profile()
		{
			if($this->cek_login){
			$data['jenis']=$this->msk->jenis();
			$id = $this->session->userdata('id');
			$config['base_url'] = base_url().'lain/profile/';
			$this->pagination->initialize($config);
			$data['data'] = $this->msk->tampilprofile($id);
			$data['page'] = "profile";
			$this->load->view('view',$data);
			}else{
				redirect('first/allmusik');
				
			}
		}
		//======================Change password=================//
		function password()
		{
		if($this->cek_login){
			$id = $this->session->userdata('id');
			$data['jenis']=$this->msk->jenis();
			$data['data'] = $this->msk->tampilprofile($id);
			$data['page'] = "password";
			$this->load->view('view',$data);
			}else{
				redirect('first/allmusik');
			}
		}
		function password_c()
		{
		if($this->cek_login){
			$id=$this->session->userdata('id');
			$lib=$this->msk->pass_change($id);
			$data['page'] = "password";
			$data['img'] = "password";
			$pass=$this->input->post('pass');
			$pass_con=$this->input->post('confir');
			if($pass == $pass_con){
				if($lib){
					$this->session->set_userdata('msgChangeSukses','Ganti Password Sukses');
					echo "<script>location='".base_url()."first/password'</script>";
				}else{
					$this->session->set_userdata('msgChangeGagal','Ganti Password Gagal');
					echo "<script>location='".base_url()."first/password'</script>";
				}
			}
			else{
					$this->session->set_userdata('msgChangeBeda','Password Anda berbeda');
					echo "<script>location='".base_url()."first/password'</script>";
			}
			}else{
				redirect('first/allmusik');
			}
		}
		function profile_edit(){
		if($this->cek_login){
			$data['jenis']=$this->msk->jenis();
			$id = $this->session->userdata('id');
			$data['page']='profile_edit';
			$data['data'] = $this->msk->tampilprofile($id);
			$this->load->view('view',$data);
			}else{
			}
		}
		function profile_edit_p(){
		if($this->cek_login){
			if($this->input->post('password') == ''){
				$pass=$this->input->post('pass');
				}
			else{
				$pass=$this->input->post('password');			
			}
					$data['page']='profile';
					$query= $this->msk->edit_profile($pass);
					if($query){
						$this->session->set_userdata('msgSukses','Sukses Edit Profil');
						echo "<script>location='".base_url()."first/profile'</script>";
					}
					else{
						$this->session->set_userdata('msgFailed','Failed Edit Profil ...!!');
						$this->load->view('view',$data);
					echo "<script>location='".base_url()."first/profile'</script>";
					}
			}else{
				redirect('first/allmusik');
			}
		}
		function add_musik(){
		if($this->cek_login){
			$data['chapca']=$this->msk->chapca();
			$data['jenis']=$this->msk->jenis();
			$data['page']='add_musik';
			$data['data']=$this->msk->jenis_lagu();
			$this->load->view('view',$data);
			}else{
				redirect('first/allmusik');			
			}
		}
		function add_musik_p(){
		if($this->cek_login){
			$chapca = $this->msk->pr_chapca();
			$data['jenis']=$this->msk->jenis();
			$nama_asli = $_FILES['userfile']['name'];
			$config['orig_name'] = $nama_asli;
			$config['file_name'] = $nama_asli;
			$config['upload_path'] = './musik';
			$config['allowed_types'] = 'mp3|Wav|Amr|aac';
			$config['max_size']	= '9000';
			$config['max_width']  = '9000';
			$config['max_height']  = '9000';
			$this->load->library('upload', $config);
			if($chapca){
				if ( ! $this->upload->do_upload())
					{
					$msg = $this->upload->display_errors('<p>', '</p>');
					$this->session->set_userdata('msgF',$msg);
					echo "<script>location='".base_url()."first/add_musik'</script>";					}
				else{
				$get_name = $this->upload->data();
				$nama_file = $get_name['file_name'];
				$ori = $get_name['orig_name'];
				$query=$this->msk->add_musik_p($nama_file,$ori);
					if($query){
						$this->session->set_userdata('msgSukses','Sukses Upload Musik');
						echo "<script>location='".base_url()."first/musik'</script>";
						}
						else{
						$this->session->set_userdata('msgGagal','Failed Upload Musik ...!!');
						echo "<script>location='".base_url()."first/musik'</script>";
						}
					}
				}else{
					echo "<script>location='".base_url()."/first/add_musik'</script>";
				}
			}else{
				redirect('first/allmusik');
			}
		}
		function download(){
			$id=$this->uri->segment(3);
			$sql =$this->db->query("SELECT * FROM album WHERE id_album='$id'");
			$sql_down = $sql->row_array();
			$dt=$sql_down['download'];
			$filename=$sql_down['file'];
			$data = file_get_contents("musik/".$filename);	
			$down=$this->msk->down($id,$dt);
			$this->load->helper('download');
			$dl=force_download($filename, $data); 
			echo $dl;
			return $down;
		
		}
		function search(){
			if($this->input->post('search')){
				$this->session->set_userdata('src',$this->input->post('search'));
			}
			$data['data']=$this->msk->search();
			$data['jenis']=$this->msk->jenis();
			$data['menu']='Search';
			$data['page']='allmusik';
			$this->load->view('view',$data);
		}
		function one(){
			$id=$this->uri->segment(3);
			$data['chapca']=$this->msk->chapca();
			$data['one']=$this->msk->one($id);
			$data['komenL']=$this->msk->list_comment_l();
			$data['komen']=$this->msk->list_comment();
			$data['jenis']=$this->msk->jenis();
			$data['page']='one';
			$data['menu']=$this->uri->segment(4);
			$this->load->view('view',$data);
		}
		function like(){
			$id=$this->uri->segment(3);
			$sql =$this->db->query("SELECT * FROM album WHERE id_album='$id'");
			$sql_down = $sql->row_array();
			$data['komenL']=$this->msk->list_comment_l();
			$data['komen']=$this->msk->list_comment();
			$dt=$sql_down['suka'];
			$sql=$this->msk->like($dt);
			if($sql){
				$id=$this->uri->segment(3);
				$data['chapca']=$this->msk->chapca();
				$data['komenL']=$this->msk->list_comment_l();
				$data['one']=$this->msk->one($id);
				$data['jenis']=$this->msk->jenis();
				$data['page']='one';
				$this->load->view('view',$data);	
			}
		}
		function komment_pr(){
				$aktif=$this->session->userdata('status');
				$level=$this->session->userdata('level');
				$id=$this->input->post('id_album');
				$chapca = $this->msk->pr_chapca();
				if($chapca){
					if(($this->session->userdata('level')== 'user' ) OR ($this->session->userdata('level')== 'admin' ) AND ($this->session->userdata('status')== 'aktif' )){
						if($this->msk->comment_pr()){

							echo "<script>location='".base_url()."first/one/".$id."';</script>";
							}
					}
					else{
						$this->session->set_userdata('msgLogin','Anda harus login dulu');
						echo "<script>location='".base_url()."first/one/".$id."';</script>";
					}
				}
				else{
					echo "<script>location='".base_url()."first/one/".$id."';</script>";
				}
		}
		//======================Aktif atau tidak aktif musik nya=================//	
		function aktif(){
			$id_comment=$this->uri->segment(4);
			$sql=$this->msk->aktif($id_comment);
			if($sql){
				$id=$this->uri->segment(3);
				echo "<script>location='".base_url()."first/one/".$id."';</script>";
			}			
		}
		function tidakAktif(){
			$id_comment=$this->uri->segment(4);
			$sql=$this->msk->tidakAktif($id_comment);
			if($sql){
				$id=$this->uri->segment(3);
				echo "<script>location='".base_url()."first/one/".$id."';</script>";			}			
		}
		function hapus_comment(){
			$id_comment=$this->uri->segment(4);
			$sql=$this->msk->hapus_comment($id_comment);
			if($sql){
				$id=$this->uri->segment(3);
				echo "<script>location='".base_url()."first/one/".$id."';</script>";
			}			
		}

	}
