<?php
	class Msk extends CI_Model{
		function clogin()
		{
			$user=$this->input->post('user');
			$pass=md5($this->input->post('pass'));
			$this->db->where('username',$user);
			$this->db->where('password',$pass);
			$q=$this->db->get('user');
			if($q->num_rows == 1){
				return true;
			}
		}
		function creg()
		{
			$user=$this->input->post('user');
			$pass=$this->input->post('pass');
			$this->db->where('username',$user);
			$this->db->where('password',$pass);
			
			$q=$this->db->get('user');
			if($q->num_rows == 1){
				return true;
			}
		}
		function tampiluser()
		{
			$config['per_page']=7;
			$config['next_link']='Next >>';
			$config['prev_link']='<< Prev';
			$config['base_url']=base_url().'c_admin/user';
			$config['uri_segment']=3;
			$offset=$this->uri->segment(3);
			$config['total_rows']=$this->db->count_all('user');
			if(empty($offset)){
				$offset=0;
			}
			$page=$config['per_page'];
			$this->pagination->initialize($config);
			$query=$this->db->query("SELECT * FROM user LIMIT $offset,$page");
			return $query->result();
			
		}
		function edit_user($pass)
		{
			$query = array('fullname' => $this->input->post('name'),
				'username' => $this->input->post('user'),
				'password' => md5($pass),
				'email' => $this->input->post('email'),
				'level' => $this->input->post('level'),
				'status' => $this->input->post('status')
			);
			$this->db->where('id_user',$this->input->post('id'));
			$up=$this->db->update('user',$query);
			return $up;
		}
		function edit_profile($pass)
		{

			$user=$this->input->post('level');
			$img=$this->input->post('foto');
			if($this->session->userdata('level') == 'admin'){
			$fld="admin";
			}
			else{
			$fld="user";
			}
			$data = array();
			if($_FILES['userfile']['name']){
					$nama_asli = $_FILES['userfile']['name'];
					$config['file_name'] = $nama_asli;
					$config['upload_path'] = './image/'.$fld;
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size']	= '9000';
					$config['max_width']  = '9000';
					$config['max_height']  = '9000';
					$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload())
						{
						$msg = $this->upload->display_errors('<p>', '</p>');
						$this->session->set_userdata('msg',$msg);
							if($this->session->userdata('level')=='admin'){
							redirect('c_admin/profile');
							}else{
							redirect('first/profile');
							}
						}
				else{
					$get_name = $this->upload->data();
					$nama_file = $get_name['file_name'];
					$data =array('fullname' => $this->input->post('name'),
					'username' => $this->input->post('user'),
					'email' => $this->input->post('email'),
					'level' => $this->input->post('level'),
					'status' => $this->input->post('status'),
					'foto'=>$nama_file
				);
					$this->db->where('id_user',$this->input->post('id'));
					$this->db->update('user',$data);			
					return unlink('image/'.$user.'/'.$img);
				}
			}else if(empty($_FILES['userfile']['name'])){
				$data =array('fullname' => $this->input->post('name'),
				'username' => $this->input->post('user'),
				'email' => $this->input->post('email'),
				'level' => $this->input->post('level'),
				'status' => $this->input->post('status')
			);
				$this->db->where('id_user',$this->input->post('id'));
				return $this->db->update('user',$data);			

			}



		}
		function hapus_user($id_user)
		{
			$this->db->where('id_user',$id_user);
			$hapus = $this->db->delete('user');
		}
		function hapus_musik($id)
		{
			$this->db->query("DELETE FROM coment where coment.id_album='$id'");
			$this->db->where('id_album',$id);
			$hapus = $this->db->delete('album');
		}
		function tampilprofile($id)
		{
			$this->db->where('id_user',$id);
			$query = $this->db->get('user');
			return $query->result();
		}
		Function regis($nama_foto){

			$data = array('fullname' => $this->input->post('name'),
						'username' => $this->input->post('user'),
						'password' => md5($this->input->post('pass')),
						'email' => $this->input->post('email'),
						'foto' => $nama_foto,
						'level' => 'user',
						'status' => 'aktif',);
			$q = $this->db->insert('user',$data);
			return $q;
		}
		function add_user(){

			$data = array('fullname' => $this->input->post('name'),
						'username' => $this->input->post('user'),
						'password' => md5($this->input->post('pass')),
						'email' => $this->input->post('email'),
						'level' => $this->input->post('level'),
						'status' => 'aktif',);
			$q = $this->db->insert('user',$data);
			return $q;
		}
		function pass_change($id){
			$edit = array('password' => md5($this->input->post('pass')));
			$this->db->where('id_user',$id);
			$id = $this->db->update('user',$edit);
			return $id;
		}
		function record_count_user() {
				$this->db->where('level','user');
				return $this->db->count_all("user");
		}
		function record_count_album() {
				
				return $this->db->count_all("album");
		}
		function add_musik_p($nama_file,$ori){
			$datestring = "%Y-%m-%d";
			$time = time();
			$upl = mdate($datestring, $time);
			$id=$this->session->userdata('id');
			$data=array('id_user' => $id,
			'nama_album' => $this->input->post('nama_album'),
			'musik' => $ori,
			'artis' => $this->input->post('nama_artis'),
			'file' => $nama_file,
			'tgl_upload' => $upl,
			'id_jenis' => $this->input->post('jenis'),
			'ket_album' => $this->input->post('ket_album'));
			$id = $this->db->insert('album',$data);
			return $id;
		}
		function m_musik(){
			$config['per_page']=10;
			$config['base_url']=base_url().'first/allmusik';
			$config['last_link']='<button>Last >></button>';
			$config['first_link']='<button><< First</button>';
			$config['next_link']='<button>Next >></button>';
			$config['prev_link']='<button><< Prev</button>';
			$config['total_rows']=$this->db->query("SELECT * FROM album,user WHERE album.id_user=user.id_user ")->num_rows;
			$config['uri_segment']=3;
			$offset=$this->uri->segment(3);
			if(empty($offset)){
			$offset = 0;
			}
			$page=$config['per_page'];
			$this->pagination->initialize($config);
			$sql=$this->db->query("SELECT * FROM album,user WHERE album.id_user=user.id_user LIMIT $offset,$page");
			return $sql->result();
			
			
		}
		function m_musik_baru(){
			$config['base_url']=base_url().'first/musik_baru';
			$config['last_link']='<button>Last >></button>';
			$config['first_link']='<button><< First</button>';
			$config['next_link']='<button>Next >></button>';
			$config['prev_link']='<button><< Prev</button>';
			$config['per_page']=10;
			$config['uri_segment']=3;

			$config['total_rows']=$this->db->query("SELECT * FROM album,user WHERE album.id_user=user.id_user order by album.id_album DESC ")->num_rows();
			$offset=$this->uri->segment(3);
			if(empty($offset)){
				$offset=0;
			}
			$page=$config['per_page'];
			$this->pagination->initialize($config);
			$query=$this->db->query("SELECT * FROM album,user WHERE album.id_user=user.id_user order by album.id_album DESC LIMIT $offset,$page");
			$data = $query->result();
			if($query->num_rows() < 1){
			$this->session->set_userdata('msg','Musik tidak ada');
			}			
			return $data;	
		}
		function musik($id){
			$config['last_link']='<button>Last >></button>';
			$config['first_link']='<button><< First</button>';
			$config['next_link']='<button>Next >></button>';
			$config['prev_link']='<button><< Prev</button>';
			$config['per_page']=10;
			$config['uri_segment']=3;
			$config['base_url']=base_url().'first/musik/';

			$config['total_rows'] = $this->db->query("SELECT * FROM album WHERE id_user='$id'")->num_rows();
			$offset=$this->uri->segment(3);
			if(empty($offset)){
				$offset=0;
			}
			$page=$config['per_page'];
			$this->pagination->initialize($config);
			$query=$this->db->query("SELECT * FROM album,user WHERE album.id_user=user.id_user AND album.id_user='$id' LIMIT $offset,$page");
			$data = $query->result();
			if($query->num_rows() < 1){

			$this->session->set_userdata('msg','Musik tidak ada');
			}
			return $data;
		}
		function musik_ad($id){
			$config['last_link']='<button>Last >></button>';
			$config['first_link']='<button><< First</button>';
			$config['next_link']='<button>Next >></button>';
			$config['prev_link']='<button><< Prev</button>';
			$config['per_page']=10;
			$config['uri_segment']=3;
			$config['base_url']=base_url().'c_admin/musik_Ad/';
			$config['total_rows'] = $this->db->query("SELECT * FROM album WHERE id_user='$id'")->num_rows();
			$offset=$this->uri->segment(3);
			if(empty($offset)){
				$offset=0;
			}
			$page=$config['per_page'];
			$this->pagination->initialize($config);
			$query=$this->db->query("SELECT * FROM album,user WHERE album.id_user=user.id_user AND album.id_user='$id' LIMIT $offset,$page");
			$data = $query->result();
			if($query->num_rows() < 1){

			$this->session->set_userdata('msg','Musik tidak ada');
			}
			return $data;
		}
		function menu_musik($musik,$menu){
			$config['per_page']=10;
			$config['last_link']='<button>Last >></button>';
			$config['first_link']='<button><< First</button>';
			$config['next_link']='<button>Next >></button>';
			$config['prev_link']='<button><< Prev</button>';
			$config['base_url']=base_url().'first/menu/'.$musik;
			$config['uri_segment']=4;
			$offset=$this->uri->segment(4);

			$config['total_rows']=$this->db->query("SELECT * FROM album,user WHERE id_jenis='$musik' AND album.id_user=user.id_user")->num_rows();
			if(empty($offset)){
				$offset=0;
			}
			$page=$config['per_page'];
			$this->pagination->initialize($config);

			$query=$this->db->query("SELECT * FROM album,user WHERE id_jenis='$musik' AND album.id_user=user.id_user LIMIT $offset,$page");
			$print=$query->result();

			if($query->num_rows() < 1){
			$this->session->set_userdata('msg','Lagu jenis ' .$menu. ' tidak ada');
			}
			return $print;
		}
	function msg($session,$style){
		if($this->session->userdata($session)){
			echo "<div class='$style' align='center'>".$this->session->userdata($session)."</div>";
		$this->session->unset_userdata($session);
		}
	}
	function jenis(){
		$sql=$this->db->get('jenis_lagu');
		return $sql->result();
		}
	function chapca(){
		$this->db->limit(1);
		$this->db->order_by('id_chapca','random');
		$sql= $this->db->get('chapca');
		return $sql->result();
	}
	function pr_chapca(){
		$id = $this->input->post('id_capcha');
		$chapca = $this->input->post('chapca');
		$this->db->where('id_chapca',$id);
		$this->db->where('value',$chapca);	
		$q=$this->db->get('chapca');
		if($q->num_rows() < 1){
			$this->session->set_userdata('msgchapca','Chapca anda kurang tepat');
		}
		if($q->num_rows == 1){
			return true;
		}
	}
//================Admin jenis lagu=====================///
	function jenis_lagu(){
			$config['per_page']=8;
			$config['base_url']=base_url().'c_admin/jenis_lagu';
			$config['next_link']='Next >>';
			$config['prev_link']='<< Prev';
			$config['total_rows']=$this->db->count_all('jenis_lagu');
			$config['uri_segment']=3;
			$offset=$this->uri->segment(3);
			if(empty($offset)){
			$offset = 0;
			}
			$page=$config['per_page'];
			$this->pagination->initialize($config);
			$sql=$this->db->get('jenis_lagu',$page,$offset);
			if($sql->num_rows() < 1){
				$this->session->set_userdata('msg','Jenis lagu tidak ada');
			}
			return $sql->result();
		}
	function hapus_jenis_lagu(){
		$this->db->where('id_jenis',$this->uri->segment(3));
		$sql=$this->db->delete('jenis_lagu');
		return $sql;
	}
	function edit_jenis(){
		$this->db->where('id_jenis',$this->uri->segment(3));
		$sql=$this->db->get('jenis_lagu');
		return $sql->result();
	}
	function pr_edit_jenis(){
		$data = array('nama_jenis'=>$this->input->post('name'));
		$uri=$this->input->post('id');
		$this->db->where('id_jenis',$uri);
		$sql=$this->db->update('jenis_lagu',$data);
		return $sql;
	}
	function pr_add_jenis_lagu(){
		$data = array('nama_jenis'=>$this->input->post('name'));
		$sql=$this->db->insert('jenis_lagu',$data);		
		return $sql;
	}
//================End Admin jenis lagu=====================///
//================Admin Chapca=====================///
	function list_chapca(){
			$config['per_page']=10;
			$config['base_url']=base_url().'c_admin/chapca';
			$config['last_link']='<button>Last >></button>';
			$config['first_link']='<button><< First</button>';
			$config['next_link']='<button>Next >></button>';
			$config['prev_link']='<button><< Prev</button>';
			$config['total_rows']=$this->db->count_all('chapca');
			$config['uri_segment']=3;
			$offset=$this->uri->segment(3);
			if(empty($offset)){
			$offset = 0;
			}
			$page=$config['per_page'];
			$this->pagination->initialize($config);
			$sql=$this->db->query("SELECT * FROM chapca LIMIT $offset,$page");
			if($sql->num_rows() < 1){
				$this->session->set_userdata('msg','Chapca tidak ada');
			}
			return $sql->result();
			
		}
	function hapus_chapca(){
		$this->db->where('id_chapca',$this->uri->segment(3));
		$sql=$this->db->delete('chapca');
		return $sql;
	}
	function edit_chapca(){
		$this->db->where('id_chapca',$this->uri->segment(3));
		$sql=$this->db->get('chapca');
		return $sql->result();
	}
	function pr_edit_chapca(){
		$data = array('chapca'=>$this->input->post('name'),
				'value'=>$this->input->post('value')
		);
		$uri=$this->input->post('id');
		$this->db->where('id_chapca',$uri);
		$sql=$this->db->update('chapca',$data);
		return $sql;
	}
	function pr_add_chapca(){
		$data = array('chapca'=>$this->input->post('name'),
				'value'=>$this->input->post('value')
		);
		$sql=$this->db->insert('chapca',$data);		
		return $sql;
	}
//================End Admin Chapca=====================///
//================Search=====================///
	function search(){

			$src=$this->session->userdata('src');
			$config['per_page']=10;
			$config['last_link']='<button>Last >></button>';
			$config['first_link']='<button><< First</button>';
			$config['next_link']='<button>Next >></button>';
			$config['prev_link']='<button><< Prev</button>';
			$config['base_url']=base_url().'first/search/'.$src.'/';
			$config['uri_segment']=4;
			$uri3=$this->uri->segment(4);
			$config['total_rows']=$this->db->query("SELECT * FROM album,user where album.id_user=user.id_user AND musik LIKE '%$src%'")->num_rows();			
			$offset=$this->uri->segment(4);
			if(empty($offset)){
				$offset=0;
			}
			$page=$config['per_page'];
			$this->pagination->initialize($config);
			$query=$this->db->query("SELECT * FROM album,user where album.id_user=user.id_user AND musik LIKE '%$src%' LIMIT $offset,$page");
			$print =$query->result();
			if($query->num_rows() < 1){
				$this->session->set_userdata('msg','Lagu yang dicari tidak ada');
			}

			return $print;	
	}
//================END Search=====================///
//================Download=====================///
	function down($id,$dt){
		$tambah=$dt+1;
		$data=array('download'=>$tambah);
		$this->db->where('id_album',$id);
		return $this->db->update('album',$data);
	}
		function jml_down(){
		$sql = $this->db->query("SELECT SUM(download) as down FROM album ");
		return $sql->result();
		}
//================END Download=====================///
		function jml_lagu(){
		$sql = $this->db->query("SELECT * FROM album")->num_rows();
		return $sql;
		}
		function one($id){
		$query=$this->db->query("SELECT * FROM album,user WHERE album.id_user=user.id_user AND album.id_album='$id'");
		return $query->result();
		}
/*=========================Script Like=====================================*/
		function like($dt){
			$id=$this->uri->segment(3);
			$data=array('suka'=>$dt+1);
			$this->db->where('id_album',$id);
			return $this->db->update('album',$data);
		}
/*=========================End Script Like=====================================*/
/*========================= Comment=====================================*/


		function comment_pr(){
			$datestring = "%Y-%m-%d %h:%i:%a";
			$time = time();
			$upl = mdate($datestring, $time);
			$id_user=$this->input->post('id_user');
			$id_album=$this->input->post('id_album');
			$data=array('id_user'=>$id_user,
			'id_album'=>$id_album,
			'coment'=>$this->input->post('coment'),
			'tgl'=>$upl,
			);
			 $sql=$this->db->insert('coment',$data);
			 return $sql;
		}
		function list_comment(){
			$id=$this->uri->segment(3);
			$sql=$this->db->query("SELECT * FROM coment,user WHERE coment.id_user=user.id_user AND coment.id_album='$id' AND coment.view='aktif' order by id_coment DESC");
			return $sql->result();
		}
		function list_comment_l(){
			$id=$this->uri->segment(3);
			$sql=$this->db->query("SELECT *,coment.id_user as id_user_komen FROM coment,user WHERE coment.id_user=user.id_user AND coment.id_album='$id' order by id_coment DESC");
			return $sql->result();
		}
		function aktif($id_comment){
			$data=array('view'=>'tidak');
			$this->db->where('id_coment',$id_comment);
			$sql=$this->db->update('coment',$data);
			return $sql;
		}
		function tidakAktif($id_comment){
			$data=array('view'=>'aktif');
			$this->db->where('id_coment',$id_comment);
			$sql=$this->db->update('coment',$data);
			return $sql;
		}
		function hapus_comment($id_comment){
			$this->db->where('id_coment',$id_comment);
			$sql=$this->db->delete('coment');
			return $sql;
		}
/*=========================End Comment=====================================*/sssss
}
?>