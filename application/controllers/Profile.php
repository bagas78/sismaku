<?php
class Profile extends CI_Controller{

	function __construct(){
		parent::__construct();
	}
	function index(){
		if ( $this->session->userdata('login') == 1) {
			$id = $this->session->userdata('id');
			$data['data'] = $this->db->query("SELECT * FROM t_user AS a LEFT JOIN t_detail_user AS b ON a.user_id = b.detail_id_user WHERE a.user_id = '$id'")->result_array();

			$data['title'] = 'profile';
			$this->load->view('v_template_admin/admin_header',$data);
			$this->load->view('profile/index');
			$this->load->view('v_template_admin/admin_footer');
		}else{ 
			redirect(base_url('login')); 
		}
	}
	function update($id){
		$data = $this->input->post();

		if (@$_FILES['foto']['name']) {
			
			if($_FILES['foto']['size'] <= 0){
				$this->session->set_flashdata('gagal','Foto tidak boleh lebih dari 2 MB');
				redirect(base_url('profile'));
			}
			else{

				//replace Karakter name foto
		        $filename = $_FILES['foto']['name'];

		        //replace name foto
		        $type = explode(".", $filename);
		        $no = count($type) - 1;
		        $new_name = md5($i.time()).'.'.$type[$no];

				//config uplod foto
				  $config = array(
				  'upload_path' 	=> './assets/gambar/user',
				  'allowed_types' 	=> "gif|jpg|png|jpeg",
				  'overwrite' 		=> TRUE,
				  'file_name'       => $new_name,
				  // 'max_size' 		=> "2048000",
				  // 'max_height' 		=> "10000",
				  // 'max_width' 		=> "20000"
				  );

				//upload foto
				$this->load->library('upload', $config);

				if ($this->upload->do_upload('foto')) {

					//t_user
					$set2 = array(
									'user_nama' => $data['username'], 
									'user_email' => $data['email'],
									'user_foto' => $new_name,
								);
					$this->db->set($set2);
					$this->db->where('user_id',$id);
					$this->db->update('t_user');

					//t_detail_user
					$set1 = array(
									'detail_jabatan' => $data['position'], 
									'detail_pendidikan' => $data['education'],
									'detail_alamat' => $data['address'],
									'detail_biodata' => $data['biodata']
								);
					$this->db->set($set1);
					$this->db->where('detail_id_user',$id);
					$this->db->update('t_detail_user');


				    $this->session->set_flashdata('success','Data berhasil di perbaharui');

				}else{

					$this->session->set_flashdata('gagal','Data gagal di perbaharui');
				}
				
			}

		}else{
			//t_user
			$set2 = array(
							'user_nama' => $data['username'], 
							'user_email' => $data['email'],
						);
			$this->db->set($set2);
			$this->db->where('user_id',$id);
			$this->db->update('t_user');

			//t_detail_user
			$set1 = array(
							'detail_jabatan' => $data['position'], 
							'detail_pendidikan' => $data['education'],
							'detail_alamat' => $data['address'],
							'detail_biodata' => $data['biodata']
						);
			$this->db->set($set1);
			$this->db->where('detail_id_user',$id);
			$this->db->update('t_detail_user');


			$this->session->set_flashdata('success','Data berhasil di perbaharui');
		}

		$url = $data['url'];
		redirect($url.'profile');
		
	}
	function update_password($id){
		$data = $this->input->post();

		$url = $data['url'];
		
		$this->db->set('user_password' , md5($data['newpass']));
		$this->db->where('user_id',$id);
		$this->db->update('t_user');

		redirect($url.'profile');
	}
} 