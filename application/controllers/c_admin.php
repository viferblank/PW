<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class c_admin extends CI_Controller {

	//======================Default=================//		
	function index(){

		$this->load->view('admin/login');
	}
	//======================Home=================//		
	function home(){
		$data['page']='home';
		$data['jml']=$this->msk->jml_down();
		$data['jmlLa']=$this->msk->jml_lagu();
		$this->load->view('admin/view',$data);
	}
	//======================End=================//				
	//======================All Musik=================//		
		function allmusik()
		{
			$data['jenis']=$this->msk->jenis();
			$data['data'] = $this->msk->m_musik();
			$data['menu'] = "all musik";
			$data['page'] = "allmusik";
			$this->load->view('admin/view',$data);
		}
		//======================Musik=================//
		function musik()
		{
			if($this->session->userdata('level') == "admin"){
				$id=$this->session->userdata('id');				
			}
			else if($this->session->userdata('level') == "user"){
				$id=$this->session->userdata('id');
			}
			$this->msk->musik($id);
			$data['data']=$this->msk->musik($id);
			$data['page'] = "musik";
			$this->load->view('admin/view',$data);
		}
		//======================Profile=================//
	function profile(){
			$id = $this->session->userdata('id');
			$config['base_url'] = base_url().'admin/profile/';
			$this->pagination->initialize($config);
			$data['data'] = $this->msk->tampilprofile($id);
			$data['page'] = "profile";
			$this->load->view('admin/view',$data);

	}
		function profile_edit(){
			$data['jenis']=$this->msk->jenis();
			$id = $this->session->userdata('id');
			$config['base_url'] = base_url().'admin/edit/';
			$this->pagination->initialize($config);
			$data['data'] = $this->msk->tampilprofile($id);
			$data['page']='profile_edit';
			$this->load->view('admin/view',$data);
		}
		function profile_edit_p(){
			if($this->input->post('password') == ''){
				$pass=$this->input->post('pass');
				}
			else{
				$pass=$this->input->post('password');			
				}

			$data['page']='home';
					$query= $this->msk->edit_profile($pass);
					if($query){
					$this->load->view('admin/view',$data);
					$this->session->set_userdata('msgSukses','Sukses Edit Profil');
					echo "<script>location='".base_url()."c_admin/profile'</script>";
					}
					else{
					$this->session->set_userdata('msgFailed','Gagal Edit Profil');
					$this->load->view('admin/view',$data);
					echo "<script>location='".base_url()."c_admin/profile'</script>";
					}
		}
		//======================Musik=================//
		function user(){
			$data["data"] = $this->msk->tampiluser();
			$data["links"] = $this->pagination->create_links();
			$data['page'] = "user";
			$data['judul'] = "User";
			$this->load->view('admin/view',$data);
		}
		function edit_user(){
			$id = $this->uri->segment(3);
			$config['base_url'] = base_url().'admin/edit/';
			$this->pagination->initialize($config);
			$data['data'] = $this->msk->tampilprofile($id);
			$data['page']='edit_user';
			$this->load->view('admin/view',$data);
		}
		function edit_u(){
			if($this->input->post('password') == ''){
				$pass=$this->input->post('pass');
				}
			else{
				$pass=$this->input->post('password');			
			}
			$query= $this->msk->edit_user($pass);
				if($query){

					$this->session->set_userdata('msgSukses','Sukses Edit User');
					echo "<script>location='".base_url()."c_admin/user'</script>";
				}else{
					$this->session->set_userdata('msgGagal','Gagal Edit User');
					echo "<script>location='".base_url()."c_admin/user'</script>";
				}
			
		}
		function hapus_user(){
			$id_user=$this->uri->segment(3);
			$sql=$this->db->query("SELECT * FROM user,album WHERE user.id_user=album.id_user and user.id_user='$id_user'");
			$row=$sql->row_array();
			$tempat=$row['level'];
			$musik=$row['file'];
			$image='image/'.$tempat.'/';
			$file=$this->uri->segment(4);
			$this->msk->hapus_user($id_user);
			$this->session->set_userdata('msgHapus','Hapus User berhasil');
			echo "<script>location='".base_url()."c_admin/user/'</script>";
			echo unlink('musik'.$musik);
			echo unlink($image.$file);
		}
		function tambah_user(){
			$data['chapca']=$this->msk->chapca();
			$data['page']='tambah_user';
			$this->load->view('admin/view',$data);
		}
		function tambah(){
			$dt = $this->msk->add_user();
			if($dt){

				$this->session->set_userdata('msgSukses','Sukses Add User');
				echo "<script>location='".base_url()."c_admin/user'</script>";
			}else{
				$this->session->set_userdata('msgGagal','Gagal Add User');
				echo "<script>location='".base_url()."c_admin/user'</script>";
			}
		}
		function add_jenis_lagu(){
			$data['page']='add_jenis';
			$data['jenis']=$this->msk->jenis();
			$this->load->view('admin/view',$data);
		}
		function pr_add_jenis_lagu(){
			$sql=$this->msk->pr_add_jenis_lagu();
				if($sql){
					redirect('c_admin/jenis_lagu');
				}else{
				$this->session->set_userdata('msgGagal','Gagal tambah jenis lagu');
				echo "<script>alert('Gagal Tambah');location='".base_url()."c_admin/add_jenis_lagu';</script>";
				}
		}
		function jenis_lagu(){
			$data['jenisLagu']=$this->msk->jenis_lagu();
			$data['jenis']=$this->msk->jenis();
			$data['page']='jenis_lagu';
			$this->load->view('admin/view',$data);

		}

		function hapus_jenis_lagu(){
		$sql=$this->msk->hapus_jenis_lagu();
		if($sql){
			redirect('c_admin/jenis_lagu');
		}else{
			$this->session->set_userdata('msgGagal','Gagal hapus jenis lagu');
			echo "<script>location='".base_url()."c_admin/jenis_lagu';</script>";
		}
		}
		function edit_jenis_lagu(){
			$data['page']='edit_jenis';
			$data['editJenis']=$this->msk->edit_jenis();
			$data['jenis']=$this->msk->jenis();
			$this->load->view('admin/view',$data);		
		}
		function pr_edit_jenis_lagu(){
			$sql=$this->msk->pr_edit_jenis();
		if($sql){
			redirect('c_admin/jenis_lagu');
		}else{
			$this->session->set_userdata('msgGagal','Gagal Edit jenis lagu');
			echo "<script>location='".base_url()."c_admin/edit_jenis_lagu';</script>";			
		}

		}
/*============================Chapca================================*/
		function chapca(){
			$data['listChapca']=$this->msk->list_chapca();
			$data['page']='chapca';
			$this->load->view('admin/view',$data);
		}
		function hapus_chapca(){
		$sql=$this->msk->hapus_chapca();
		if($sql){
			$this->session->set_userdata('msgSukses','Sukses hapus chapca');
			echo "<script>location='".base_url()."c_admin/chapca';</script>";
		}else{
			$this->session->set_userdata('msgGagal','Gagal hapus chapca');
			echo "<script>location='".base_url()."c_admin/chapca';</script>";
			}
		}
		function edit_chapca(){
			$data['page']='edit_chapca';
			$data['editChapca']=$this->msk->edit_chapca();
			$this->load->view('admin/view',$data);		
		}
		function pr_edit_chapca(){
			$sql=$this->msk->pr_edit_chapca();
		if($sql){
				$this->session->set_userdata('msgSukses','Sukses edit chapca');
				echo "<script>location='".base_url()."c_admin/edit_chapca';</script>";			
			}else{
				$this->session->set_userdata('msgGagal','Gagal edit chapca');
				echo "<script>location='".base_url()."c_admin/edit_chapca';</script>";			
			}

		}
		function add_chapca(){
			$data['page']='add_chapca';
			$this->load->view('admin/view',$data);
		}
		function pr_add_chapca(){
			$sql=$this->msk->pr_add_chapca();
				if($sql){
					redirect('c_admin/chapca');
				}else{
				$this->session->set_userdata('msgGagal','Gagal tambah chapca');
				echo "<script>location='".base_url()."c_admin/add_chapca';</script>";
				}
		}

/*============================END SCRIPT Chapca================================*/
		//======================Change password=================//
		function password()
		{
			$id = $this->session->userdata('id');
			$data['data'] = $this->msk->tampilprofile($id);
			$data['page'] = "password";
			$this->load->view('admin/view',$data);
		}
		function password_c()
		{
			$id=$this->session->userdata('id');
			$lib=$this->msk->pass_change($id);
			$data['page'] = "password";
			$data['img'] = "password";
			$pass=$this->input->post('pass');
			$pass_con=$this->input->post('confir');
			if($pass == $pass_con){
				if($lib){
					$this->session->set_userdata('msgSukses','Ganti Passwrod Sukses');
					echo "<script>location='".base_url()."c_admin/password'</script>";
				}else{
					$this->session->set_userdata('msgGagal','Ganti Passwrod Gagal');
					echo "<script>location='".base_url()."c_admin/password'</script>";
				}
			}
			else{
					$this->session->set_userdata('msgBeda','Ganti Password Berbeda');
					echo "<script>location='".base_url()."c_admin/password'</script>";
			}
		}
		function add_musik(){
			$data['jenis']=$this->msk->jenis();
			$data['page']='add_musik';
			$data['data']=$this->msk->jenis_lagu();
			$this->load->view('admin/view',$data);
		}
		function add_musik_p(){
			$data['jenis']=$this->msk->jenis();
			$nama_asli = $_FILES['userfile']['name'];
			$config['file_name'] = $nama_asli;
			$config['orig_name'] = $nama_asli;
			$config['upload_path'] = './musik';
			$config['allowed_types'] = 'mp3|Wav|Amr|aac';
			$config['max_size']	= '9000';
			$config['max_width']  = '9000';
			$config['max_height']  = '9000';
			$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload())
					{
					$msg = $this->upload->display_errors('<p>', '</p>');
					$this->session->set_userdata('msg',$msg);
					echo "<script>location='".base_url()."c_admin/musik'</script>";					}
				else{
				$get_name = $this->upload->data();
				$nama_file = $get_name['file_name'];
				$ori = $get_name['orig_name'];
				$query=$this->msk->add_musik_p($nama_file,$ori);
					if($query){
						$this->session->set_userdata('msgSukses','Sukses Upload Musik');
						echo "<script>location='".base_url()."c_admin/musik'</script>";
						}
						else{
						$this->session->set_userdata('msgGagal','gagal Upload Musik');
						echo "<script>location='".base_url()."c_admin/add_musik'</script>";
						}
					}
		}
		//======================Delete Musik=================//	
		function hapus_musik(){
		$id=$this->uri->segment(3);
		$file=$this->uri->segment(4);
		$this->msk->hapus_musik($id);
		$data['page']='allmusik';
			$this->load->view('admin/view',$data);
			$this->session->set_userdata('msgHapus','Hapus musik berhasil ');
			echo "<script>location='".base_url()."c_admin/allmusik'</script>"; 
			return unlink('musik/'.$file);
		}
		//======================END Delete Musik=================//	
		function one(){
			$id=$this->uri->segment(3);
			$data['chapca']=$this->msk->chapca();
			$data['one']=$this->msk->one($id);
			$data['komenL']=$this->msk->list_comment_l();
			$data['komen']=$this->msk->list_comment();
			$data['jenis']=$this->msk->jenis();
			$data['page']='one';
			$data['menu']=$this->uri->segment(4);
			$this->load->view('admin/view',$data);
		}
		function like(){
			$id=$this->uri->segment(3);
			$sql =$this->db->query("SELECT * FROM album WHERE id_album='$id'");
			$sql_down = $sql->row_array();

			$dt=$sql_down['suka'];
			$sql=$this->msk->like($dt);
			if($sql){
				$id=$this->uri->segment(3);
				$data['chapca']=$this->msk->chapca();
				$data['komenL']=$this->msk->list_comment_l();
				$data['one']=$this->msk->one($id);
				$data['jenis']=$this->msk->jenis();
				$data['page']='one';
				$this->load->view('admin/view',$data);	
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
							
							echo "<script>location='".base_url()."c_admin/one/".$id."';</script>";
							}
					}
					else{
						$this->session->set_userdata('msgLogin','Anda harus login dulu');
						echo "<script>location='".base_url()."c_admin/one/".$id."';</script>";
					}
				}
				else{
					echo "<script>location='".base_url()."c_admin/one/".$id."';</script>";
				}
		}
		//======================Aktif atau tidak aktif musik nya=================//	
		function aktif(){
			$id_comment=$this->uri->segment(4);
			$sql=$this->msk->aktif($id_comment);
			if($sql){
				$id=$this->uri->segment(3);
				echo "<script>location='".base_url()."c_admin/one/".$id."';</script>";
			}			
		}
		function tidakAktif(){
			$id_comment=$this->uri->segment(4);
			$sql=$this->msk->tidakAktif($id_comment);
			if($sql){
				$id=$this->uri->segment(3);
				echo "<script>location='".base_url()."c_admin/one/".$id."';</script>";			}			
		}
		function hapus_comment(){
			$id_comment=$this->uri->segment(4);
			$sql=$this->msk->hapus_comment($id_comment);
			if($sql){
				$id=$this->uri->segment(3);
				echo "<script>location='".base_url()."c_admin/one/".$id."';</script>";
			}			
		}

	}
	?>
