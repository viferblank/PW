<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	    var $imagePath = 'image/';
		
		function __Construct(){
			parent::__Construct();
			$this->load->helper(array('form', 'url'));
			$this->load->model('msk');
			//$this->load->helper('parenta');
			
		}
		function logout(){
			$this->session->sess_destroy();
			redirect('first/allmusik');

		}
		//======================Login=================//		
		function loginl(){
			$user = mysql_real_escape_string($this->input->post('user'));
			$query = $this->db->query("SELECT * FROM user WHERE username ='$user'");
			$data = $query->row_array();
			$q = $this->msk->clogin();
			if($q){
				$session = array('user' => $user,
				'name' => $data['fullname'], 
				'foto' => $data['foto'], 
				'level' => $data['level'] , 
				'status' => $data['status'] ,
				'id' => $data['id_user']);
				$this->session->set_userdata($session);
				$data['jenis']=$this->msk->jenis();
				$data['data'] = $this->msk->m_musik();
				$data['menu'] = "all musik";
				$data['page'] = "allmusik";
				$this->load->view('view',$data);
			}else{
				$this->session->set_userdata('login','Maaf anda salah username/password');
				redirect('first/allmusik');
			}
		}
		function ADlogin(){
			$user = $this->input->post('user');
			$query = $this->db->query("SELECT * FROM user WHERE username ='$user'");
			$data = $query->row_array();
			$q = $this->msk->clogin();
			$data['page'] ='home';
			$data['jml']=$this->msk->jml_down();
			$data['jmlLa']=$this->msk->jml_lagu();
			if($q){
				$session = array('user' => $user,
				'name' => $data['fullname'], 
				'foto' => $data['foto'], 
				'level' => $data['level'] , 
				'status' => $data['status'] ,
				'id' => $data['id_user']);
				$this->session->set_userdata($session);
				$this->load->view('admin/view',$data);
			}else{
				$this->session->set_userdata('login','Maaf anda salah username/password');
				redirect('c_admin');
			}
		}
		//======================Register=================//		
		function Register(){
			$data['jenis']=$this->msk->jenis();
			$data['chapca']=$this->msk->chapca();
			$data['page']='register';
			$this->load->view('view',$data);
		}
		function Register1(){
			$user = $this->input->post('user');
			$email = $this->input->post('email');
			$query = $this->db->query("SELECT * FROM user WHERE username = '$user' or email = '$email' ");
			$nama_asli = $_FILES['userfile']['name'];
			$config['file_name'] = $nama_asli;
			$config['upload_path'] = './image/user';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '9000';
			$config['max_width']  = '9000';
			$config['max_height']  = '9000';
			$this->load->library('upload', $config);
			$chapca = $this->msk->pr_chapca();
			if($chapca){
				if($query->num_rows() == 1){
						$this->session->set_userdata('msgCek','maaf username atau email anda sudah terpakai');
						echo "<script>location='".base_url()."/login/Register'</script>";
					}
				else{
					if ( !  $this->upload->do_upload())
						{
							$msg=$this->upload->display_errors('<p>', '</p>');
							$this->session->set_userdata('msgCek',$msg);
							echo "<script>location='".base_url()."login/register'</script>";
						}
					else{
							$get_name = $this->upload->data();
							$nama_foto = $get_name['file_name'];
							$dt = $this->msk->regis($nama_foto);
							if($dt){
							$this->session->set_userdata('msgSukses','Sukses Register');
							echo "<script>location='".base_url()."/first/allmusik'</script>";
							}else{
								$this->session->set_userdata('msgGagal','Gagal register');
							echo "<script>location='".base_url()."/first/allmusik'</script>";								
							}
					}
				}
			}
			else{
				echo "<script>location='".base_url()."/login/Register'</script>";
			}
		}				
		function Register_admin(){
			$user = $this->input->post('user');
			$email = $this->input->post('email');
			$query = $this->db->query("SELECT * FROM user WHERE username = '$user' or email = '$email' ");
			$nama_asli = $_FILES['userfile']['name'];
			$config['file_name'] = $nama_asli;
			$config['upload_path'] = './image/user';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '9000';
			$config['max_width']  = '9000';
			$config['max_height']  = '9000';
			$this->load->library('upload', $config);
			$data['page']='user';
				if($query->num_rows == 1){
				$this->session->set_userdata('msgCek','maaf username atau email anda sudah terpakai');
						echo "<script>location='".base_url()."c_admin/user/'</script>"; 
					}
				else{
					if ( !  $this->upload->do_upload())
						{
						//	echo $this->upload->display_errors('<p>', '</p>');
							$this->load->view('admin/view', $data);
						}
					else{
							$get_name = $this->upload->data();
							$nama_foto = $get_name['file_name'];
							$dt = $this->msk->regis($nama_foto);
							if($dt){
							$data['jenis']=$this->msk->jenis();
							$this->session->set_userdata('msgT','Sukses menambah');
						echo "<script>location='".base_url()."c_admin/user/'</script>"; 
							}else{
								$this->session->set_userdata('msgUser','Maaf salah username/Password');
						echo "<script>location='".base_url()."c_admin/user/'</script>"; 
								
							}
					}
				}

			
		}
	}
