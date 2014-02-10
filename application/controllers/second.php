<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Second extends CI_Controller {
		function __Construct(){
			parent::__Construct();
			$this->load->model('msk');
			$this->session->userdata('log');
			$this->load->library('pagination');
			
		}
		//======================User=================//		
		function user(){
			$config['base_url'] = base_url().'second/user';
			$config['total_rows'] = $this->db->count_all('user');
			$config['per_page'] = 10;
			$config['num_links'] = 5;
			$config['uri_segment'] = 3;
			$config['next_tag']='Next';
			$config['prev_page']='Previus';
			$config['next_tag_open'] ="Next";
			$this->pagination->initialize($config);
			$data["data"] = $this->msk->tampiluser($config["per_page"], $this->uri->segment(3));
			$data["links"] = $this->pagination->create_links();
			$data['page'] = "user";
			$data['judul'] = "User";

			$this->load->view('view',$data);
		}
		function edit_user(){
			$id = $this->uri->segment(3);
			$config['base_url'] = base_url().'admin/edit/';
			$this->pagination->initialize($config);
			$data['data'] = $this->msk->tampilprofile($id);
			$data['page']='edit_user';
			$this->load->view('view',$data);
		}
		function edit_u(){
			if($this->input->post('password') == ''){
				$pass=$this->input->post('pass');
				}
			else{
				$pass=$this->input->post('password');			
			}
			$query= $this->msk->edit_user($pass);
			$data['page']='user';
				if($query){
					$this->load->view('view',$data);
					echo "<script>alert('Sukses Edit User');location='".base_url()."second/user'</script>";
				}else{
					$this->load->view('view',$data);
					echo "<script>alert('Failed Edit User');location='".base_url()."second/user'</script>";
				}
			
		}
		function hapus_user(){
		$id_user=$this->uri->segment(3);
		$this->msk->hapus_user($id_user);
			echo "<script>alert('Hapus User Berhasil');location='".base_url()."second/user/'</script>"; 
		}
		function tambah_user(){
			$data['page']='tambah_user';
			$this->load->view('view',$data);
		}
		function tambah(){
			$dt = $this->msk->add_user();
			if($dt){
				$this->load->view('view',$data);
				echo "<script>alert('Sukses Add User');location='".base_url()."second/user'</script>";
			}else{
				$this->load->view('view',$datas);
				echo "<script>alert('Failed Add User');location='".base_url()."second/user'</script>";
			}
		}

	}
