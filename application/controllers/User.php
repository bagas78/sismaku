<?php
class User extends CI_Controller{

	function __construct(){
		parent::__construct();
	} 
	function index(){ 
		if ( $this->session->userdata('login') == 1) {
			$data['title'] = 'Akun';
		    $data['data'] = $this->db->query("SELECT * FROM t_user as a WHERE a.user_hapus = 0")->result_array();

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('user/index');
		    $this->load->view('v_template_admin/admin_footer');

		} 
		else{
			redirect(base_url('login'));
		}
	}  
	function add(){ 
		$x = $_POST['user_password'];
        $cek = $this->db->query("SELECT * FROM t_user WHERE user_email = '$x'")->num_rows();

		if ($cek > 0) {
			$this->session->set_flashdata('gagal','Email sudah di gunakan !!');
			redirect(base_url('siswa'));
		}else{
			$cek = $this->db->query("SELECT * FROM t_user order by user_id desc limit 1")->row_array();
			$id = $cek['user_id']+1;
			$set = array(
							'user_id' => $id,
							'user_nama' => $_POST['user_nama'], 
							'user_email' => $_POST['user_email'],
							'user_password' => md5($x),
							'user_tanggal'	=> date('Y-m-d'),
						);
			$this->query_builder->add('t_user',$set);

			$set1 = array('detail_id_user' => $id);
			$this->query_builder->add('t_detail_user',$set1);

			$this->session->set_flashdata('success','Data berhasil di tambah');
			redirect(base_url('user'));
		}
	}
	function delete($id){

		if ($id != $this->session->userdata('id')) {
			
			//hapus user
	        $this->db->set('user_hapus',1);
	        $this->db->where('user_id',$id);
	        $this->db->update('t_user');

	        //hapus detail user
	        $this->db->set('detail_hapus',1);
	        $this->db->where('detail_id_user',$id);
	        $this->db->update('t_detail_user');

			$this->session->set_flashdata('success','Data berhasil di hapus');

		}else{

			$this->session->set_flashdata('gagal','Tidak bisa hapus akun sendiri');
		}

		redirect(base_url('user'));
	}
	function update($id){
		$x = $_POST['user_password'];
		@$cek = $this->db->query("SELECT * FROM t_user WHERE user_password = '$x'")->num_rows();

		if ($cek > 0) {
			$set = array(
				'user_nama' => $_POST['user_nama'], 
				'user_email' => $_POST['user_email'],
			);
			$this->query_builder->update('t_user',$set,'user_id ='.$id);

		} else {
			$set = array(
				'user_nama' => $_POST['user_nama'], 
				'user_email' => $_POST['user_email'], 
				'user_password' => md5($x),
			);
			$this->query_builder->update('t_user',$set,'user_id ='.$id);
		}

		$this->session->set_flashdata('success','Data berhasil di rubah');
		redirect(base_url('user'));
	}
}