<?php
class Recording extends CI_Controller{

	function __construct(){
		parent::__construct(); 
		$this->load->model('m_recording');
	}  
	function harian(){  
		$data['title'] = 'Recording Harian'; 
 
	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('recording/index');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function harian_get(){

		$level = $this->session->userdata('level');
		$user = $this->session->userdata('id');

		if ($level == 1) {
			//admin
			$where = array('recording_hapus' => 0);
		}else{
			//user
			$where = array('recording_hapus' => 0, 'recording_user' => $user);
		}

	    $data = $this->m_recording->get_datatables($where);
		$total = $this->m_recording->count_all($where);
		$filter = $this->m_recording->count_filtered($where);

		$output = array(
			"draw" => $_GET['draw'],
			"recordsTotal" => $total,
			"recordsFiltered" => $filter,
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	} 
	function harian_add(){

		//pakan
		$data['pakan_data'] = $this->query_builder->view("SELECT * FROM t_barang WHERE barang_hapus = 0 AND barang_kategori = 2");

		//obat
		$data['obat_data'] = $this->query_builder->view("SELECT * FROM t_barang WHERE barang_hapus = 0 AND barang_kategori = 3");

		//telur
		$data['telur_data'] = $this->query_builder->view("SELECT * FROM t_barang WHERE barang_hapus = 0 AND barang_kategori = 1");

		//kotoran
		$data['kotoran_data'] = $this->query_builder->view("SELECT * FROM t_barang WHERE barang_hapus = 0 AND barang_kategori = 4");

		//ayam
		$data['ayam_data'] = $this->query_builder->view("SELECT * FROM t_barang WHERE barang_hapus = 0 AND barang_kategori = 5");

		//populasi
		$data['populasi_data'] = $this->query_builder->view_row("SELECT * FROM t_barang WHERE barang_kategori = 5");

		$data['title'] = 'Recording Harian';

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('recording/add');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function get_barang($id){

		$get = $this->query_builder->view_row("SELECT * FROM t_barang WHERE barang_id = '$id'");

		echo json_encode($get);

	}
	function save(){

		//generate nomor
		$get = $this->query_builder->count("SELECT * FROM t_recording");
		$nomor = 'RC-'.date('dmy').'-'.($get + 1);

		$set = array(
						'recording_nomor' => $nomor,
						'recording_user' => $this->session->userdata('id'),
						'recording_tanggal' => strip_tags(@$_POST['tanggal']),
						'recording_keterangan' => strip_tags(@$_POST['keterangan']),
						'recording_bobot' => strip_tags(@$_POST['bobot']),
						'recording_populasi' => strip_tags(@$_POST['populasi']),
					);

		$db = $this->query_builder->add('t_recording', $set);
		if ($db == 1) {

			//save telur
			if (@$_POST['telur']) {

				$telur = count($_POST['telur']);
				
				for ($i = 0; $i < $telur; ++$i) {
				
					$this->query_builder->add('t_recording_barang', ['recording_barang_nomor' => $nomor, 'recording_barang_barang' => $_POST['telur'][$i], 'recording_barang_jumlah' => $_POST['telur_jumlah'][$i], 'recording_barang_kategori' => $_POST['telur_kategori'][$i]]);
				}	
			}
			

			//save pakan
			if (@$_POST['pakan']) {

				$pakan = count($_POST['pakan']);
				
				for ($i = 0; $i < $pakan; ++$i) {
					
					$this->query_builder->add('t_recording_barang', ['recording_barang_nomor' => $nomor, 'recording_barang_barang' => $_POST['pakan'][$i], 'recording_barang_jumlah' => $_POST['pakan_jumlah'][$i], 'recording_barang_stok' => $_POST['pakan_stok'][$i], 'recording_barang_kategori' => $_POST['pakan_kategori'][$i]]);
				}	
			}
			

			//save obat
			if (@$_POST['obat']) {

				$obat = count($_POST['obat']);
				
				for ($i = 0; $i < $obat; ++$i) {
				
					$this->query_builder->add('t_recording_barang', ['recording_barang_nomor' => $nomor, 'recording_barang_barang' => $_POST['obat'][$i], 'recording_barang_jumlah' => $_POST['obat_jumlah'][$i], 'recording_barang_stok' => $_POST['obat_stok'][$i], 'recording_barang_kategori' => $_POST['obat_kategori'][$i]]);
				}	
			}

			//save ayam
			if (@$_POST['ayam']) {

				$kotoran = count($_POST['ayam']);
				
				for ($i = 0; $i < $kotoran; ++$i) {
				
					$this->query_builder->add('t_recording_barang', ['recording_barang_nomor' => $nomor, 'recording_barang_barang' => $_POST['ayam'][$i], 'recording_barang_stok' => $_POST['ayam_stok'][$i], 'recording_barang_jumlah' => $_POST['ayam_jumlah'][$i], 'recording_barang_kategori' => $_POST['ayam_kategori'][$i]]);
				}	
			}

			//save kotoran
			if (@$_POST['kotoran']) {

				$kotoran = count($_POST['kotoran']);
				
				for ($i = 0; $i < $kotoran; ++$i) {
				
					$this->query_builder->add('t_recording_barang', ['recording_barang_nomor' => $nomor, 'recording_barang_barang' => $_POST['kotoran'][$i], 'recording_barang_jumlah' => $_POST['kotoran_jumlah'][$i], 'recording_barang_kategori' => $_POST['kotoran_kategori'][$i]]);
				}	
			}

			//update stok
			
			$this->stok->update_barang();

			$this->session->set_flashdata('success', 'Data berhasil di simpan');
		}else{
			$this->session->set_flashdata('gagal', 'Data gagal di simpan');
		}

		redirect(base_url('recording/harian'));
	}
	function delete($id){

		$set = ['recording_hapus' => 1];
		$where = ['recording_id' => $id];
		$db = $this->query_builder->update('t_recording',$set,$where);
		
		if ($db == 1) {

			//update stok
			
			$this->stok->update_barang();

			$this->session->set_flashdata('success','Data berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}
		
		redirect(base_url('recording/harian'));
	}
	function harian_view($id){

		//data
		$data['data'] = $this->query_builder->view_row("SELECT * FROM t_recording WHERE recording_id = '$id'");

		//barang
		$data['barang_data'] = $this->query_builder->view("SELECT * FROM t_recording as a JOIN t_recording_barang as b ON a.recording_nomor = b.recording_barang_nomor JOIN t_barang as c ON b.recording_barang_barang = c.barang_id WHERE a.recording_id = '$id'");

		//telur
		$data['telur_data'] = $this->query_builder->view("SELECT * FROM t_barang WHERE barang_hapus = 0 AND barang_kategori = 1");

		//pakan
		$data['pakan_data'] = $this->query_builder->view("SELECT * FROM t_barang WHERE barang_hapus = 0 AND barang_kategori = 2");

		//obat
		$data['obat_data'] = $this->query_builder->view("SELECT * FROM t_barang WHERE barang_hapus = 0 AND barang_kategori = 3");

		//kotoran
		$data['kotoran_data'] = $this->query_builder->view("SELECT * FROM t_barang WHERE barang_hapus = 0 AND barang_kategori = 4");

		//ayam
		$data['ayam_data'] = $this->query_builder->view("SELECT * FROM t_barang WHERE barang_hapus = 0 AND barang_kategori = 5");

		//populasi
		$data['populasi_data'] = $this->query_builder->view_row("SELECT * FROM t_barang WHERE barang_kategori = 5");

		$data['title'] = 'Recording Harian';

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('recording/add');
	    $this->load->view('recording/view');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function harian_edit($id){

		//data
		$data['data'] = $this->query_builder->view_row("SELECT * FROM t_recording WHERE recording_id = '$id'");

		//barang
		$data['barang_data'] = $this->query_builder->view("SELECT * FROM t_recording as a JOIN t_recording_barang as b ON a.recording_nomor = b.recording_barang_nomor JOIN t_barang as c ON b.recording_barang_barang = c.barang_id WHERE a.recording_id = '$id'");

		//telur
		$data['telur_data'] = $this->query_builder->view("SELECT * FROM t_barang WHERE barang_hapus = 0 AND barang_kategori = 1");

		//pakan
		$data['pakan_data'] = $this->query_builder->view("SELECT * FROM t_barang WHERE barang_hapus = 0 AND barang_kategori = 2");

		//obat
		$data['obat_data'] = $this->query_builder->view("SELECT * FROM t_barang WHERE barang_hapus = 0 AND barang_kategori = 3");

		//kotoran
		$data['kotoran_data'] = $this->query_builder->view("SELECT * FROM t_barang WHERE barang_hapus = 0 AND barang_kategori = 4");

		//ayam
		$data['ayam_data'] = $this->query_builder->view("SELECT * FROM t_barang WHERE barang_hapus = 0 AND barang_kategori = 5");

		//populasi
		$data['populasi_data'] = $this->query_builder->view_row("SELECT * FROM t_barang WHERE barang_kategori = 5");

		$data['title'] = 'Recording Harian';

		$data['edit'] = 1;

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('recording/add');
	    $this->load->view('recording/view');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function update($id){

		$nomor = strip_tags(@$_POST['nomor']);

		$set = array(
						'recording_user' => $this->session->userdata('id'),
						'recording_tanggal' => strip_tags(@$_POST['tanggal']),
						'recording_keterangan' => strip_tags(@$_POST['keterangan']),
						'recording_bobot' => strip_tags(@$_POST['bobot']),
						'recording_populasi' => strip_tags(@$_POST['populasi']),
					);

		$where = ['recording_id' => $id];
		$db = $this->query_builder->update('t_recording',$set,$where);
		if ($db == 1) {

			//delete
			$this->query_builder->delete('t_recording_barang',['recording_barang_nomor' => $nomor]);


			//save telur
			if (@$_POST['telur']) {

				$telur = count($_POST['telur']);
				
				for ($i = 0; $i < $telur; ++$i) {
				
					$this->query_builder->add('t_recording_barang', ['recording_barang_nomor' => $nomor, 'recording_barang_barang' => $_POST['telur'][$i], 'recording_barang_jumlah' => $_POST['telur_jumlah'][$i], 'recording_barang_kategori' => $_POST['telur_kategori'][$i]]);
				}	
			}
			

			//save pakan
			if (@$_POST['pakan']) {

				$pakan = count($_POST['pakan']);
				
				for ($i = 0; $i < $pakan; ++$i) {
					
					$this->query_builder->add('t_recording_barang', ['recording_barang_nomor' => $nomor, 'recording_barang_barang' => $_POST['pakan'][$i], 'recording_barang_jumlah' => $_POST['pakan_jumlah'][$i], 'recording_barang_stok' => $_POST['pakan_stok'][$i], 'recording_barang_kategori' => $_POST['pakan_kategori'][$i]]);
				}	
			}
			

			//save obat
			if (@$_POST['obat']) {

				$obat = count($_POST['obat']);
				
				for ($i = 0; $i < $obat; ++$i) {
				
					$this->query_builder->add('t_recording_barang', ['recording_barang_nomor' => $nomor, 'recording_barang_barang' => $_POST['obat'][$i], 'recording_barang_jumlah' => $_POST['obat_jumlah'][$i], 'recording_barang_stok' => $_POST['obat_stok'][$i], 'recording_barang_kategori' => $_POST['obat_kategori'][$i]]);
				}	
			}

			//save ayam
			if (@$_POST['ayam']) {

				$kotoran = count($_POST['ayam']);
				
				for ($i = 0; $i < $kotoran; ++$i) {
				
					$this->query_builder->add('t_recording_barang', ['recording_barang_nomor' => $nomor, 'recording_barang_barang' => $_POST['ayam'][$i], 'recording_barang_stok' => $_POST['ayam_stok'][$i], 'recording_barang_jumlah' => $_POST['ayam_jumlah'][$i], 'recording_barang_kategori' => $_POST['ayam_kategori'][$i]]);
				}	
			}

			//save kotoran
			if (@$_POST['kotoran']) {

				$kotoran = count($_POST['kotoran']);
				
				for ($i = 0; $i < $kotoran; ++$i) {
				
					$this->query_builder->add('t_recording_barang', ['recording_barang_nomor' => $nomor, 'recording_barang_barang' => $_POST['kotoran'][$i], 'recording_barang_jumlah' => $_POST['kotoran_jumlah'][$i], 'recording_barang_kategori' => $_POST['kotoran_kategori'][$i]]);
				}	
			}

			//update stok
			
			$this->stok->update_barang();

			$this->session->set_flashdata('success', 'Data berhasil di simpan');
		}else{
			$this->session->set_flashdata('gagal', 'Data gagal di simpan');
		}

		redirect(base_url('recording/harian'));
	}
}