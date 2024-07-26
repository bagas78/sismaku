<?php
class produksi extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('m_pakan');
		$this->load->model('m_pakan_view');
		$this->load->model('m_premix');
		$this->load->model('m_premix_view');
	}  
	function pakan(){
		$data['title'] = 'Campur Pakan';

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('produksi/pakan');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function pakan_get_data(){ 
 
		$where = array('pakan_hapus' => 0);

	    $data = $this->m_pakan->get_datatables($where);
		$total = $this->m_pakan->count_all($where);
		$filter = $this->m_pakan->count_filtered($where);

		$output = array(
			"draw" => $_GET['draw'],
			"recordsTotal" => $total,
			"recordsFiltered" => $filter,
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}
	function pakan_add(){
		$data['title'] = 'Campur Pakan';

		$data['pakan_data'] = $this->query_builder->view("SELECT * FROM t_barang WHERE barang_hapus = 0 AND barang_kategori = 3");

		$data['satuan_data'] = $this->query_builder->view("SELECT * FROM t_barang WHERE barang_hapus = 0 AND barang_kategori = 3");

		//generate kode
	    $num = $this->query_builder->count("SELECT * FROM t_pakan") + 1;
	    $data['kode'] = 'PC00'.$num;

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('produksi/pakan_add');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function pakan_save(){

		$kode = strip_tags(@$_POST['kode']);

		$set1 = array(
						'pakan_kode' => $kode,
						'pakan_nama' => strip_tags(@$_POST['nama']),
						'pakan_satuan' => strip_tags(@$_POST['satuan']),
						'pakan_keterangan' => strip_tags(@$_POST['keterangan']),
					);

		$this->db->set($set1);
		if ($this->db->insert('t_pakan')) {

			//qty
			$set4 = array(
							'pakan_qty_kode' => $kode,
							'pakan_qty_qty' => strip_tags(@$_POST['qty']),
						);

			$this->db->set($set4);
			$this->db->insert('t_pakan_qty');

			// barang
			$jum = count($_POST['pakan']);

			for ($i=0; $i < $jum; $i++) { 
				
				//barang
				$set2 = array(
								'pakan_barang_kode' => $kode,
								'pakan_barang_barang' => strip_tags(@$_POST['pakan'][$i]),
								'pakan_barang_qty' => strip_tags(str_replace(',', '', @$_POST['pakan_jumlah'][$i])),
								'pakan_barang_stok' => strip_tags(str_replace(',', '', @$_POST['pakan_stok'][$i])),
								'pakan_barang_harga' => strip_tags(str_replace(',', '', @$_POST['pakan_harga'][$i])),
								'pakan_barang_subtotal' => strip_tags(str_replace(',', '', @$_POST['pakan_subtotal'][$i])),
							);

				$this->db->set($set2);
				$this->db->insert('t_pakan_barang');

				//campur
				$set3 = array(
								'pakan_campur_kode' => $kode,
								'pakan_campur_barang' => strip_tags(@$_POST['pakan'][$i]),
								'pakan_campur_qty' => strip_tags(@$_POST['pakan_jumlah'][$i]),
							);

				$this->db->set($set3);
				$this->db->insert('t_pakan_campur');

			}


			//update stok
			$this->stok->update_barang();

		}

		$this->session->set_flashdata('success', 'Data berhasil di simpan');
		redirect(base_url('produksi/pakan'));

	}
	function pakan_delete($id){
		$set = ['pakan_hapus' => 1];
		$where = ['pakan_id' => $id];
		$db = $this->query_builder->update('t_pakan',$set,$where);
		
		if ($db == 1) {
			
			//update stok
			$this->stok->update_barang();

			$this->session->set_flashdata('success','Data berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}
		
		redirect(base_url('produksi/pakan'));
	}
	function pakan_stok(){
		$data['title'] = 'Campur Pakan';

		$data['nama_data'] = $this->query_builder->view("SELECT * FROM t_pakan WHERE pakan_hapus = 0");

		$data['pakan_data'] = $this->query_builder->view("SELECT * FROM t_barang WHERE barang_hapus = 0 AND barang_kategori = 3");

		$data['satuan_data'] = $this->query_builder->view("SELECT * FROM t_barang WHERE barang_hapus = 0 AND barang_kategori = 3");

		$this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('produksi/pakan_stok');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function pakan_get_pakan($kode){

		$data = $this->query_builder->view("SELECT * FROM t_pakan_campur WHERE pakan_campur_kode = '$kode'");
		echo json_encode($data);
	}
	function pakan_tambah_stok($kode){
		$jumlah = strip_tags(@$_POST['qty']);

		$update = $this->db->query("UPDATE t_pakan SET pakan_stok = pakan_stok + {$jumlah} WHERE pakan_kode = '$kode'");

		if ($update) {

			//qty
			$set4 = array(
							'pakan_qty_kode' => $kode,
							'pakan_qty_qty' => $jumlah,
						);

			$this->db->set($set4);
			$this->db->insert('t_pakan_qty');

			// barang
			$jum = count($_POST['pakan']);

			for ($i=0; $i < $jum; $i++) { 
				
				$set2 = array(
								'pakan_barang_kode' => $kode,
								'pakan_barang_barang' => strip_tags(@$_POST['pakan'][$i]),
								'pakan_barang_qty' => strip_tags(str_replace(',', '', @$_POST['pakan_jumlah'][$i])),
								'pakan_barang_stok' => strip_tags(str_replace(',', '', @$_POST['pakan_stok'][$i])),
								'pakan_barang_harga' => strip_tags(str_replace(',', '', @$_POST['pakan_harga'][$i])),
								'pakan_barang_subtotal' => strip_tags(str_replace(',', '', @$_POST['pakan_subtotal'][$i])),
							);

				$this->db->set($set2);
				$this->db->insert('t_pakan_barang');
			}

			//update stok
			$this->stok->update_barang();

			$this->session->set_flashdata('success','Stok berhasil di tambah');
		} else {
			$this->session->set_flashdata('gagal','Stok gagal di tambah');
		}
		
		redirect(base_url('produksi/pakan'));
	}

	/////////////////// edit data //////////////////
	function pakan_edit($id){

		$data['data'] = $this->query_builder->view_row("SELECT * FROM t_pakan WHERE pakan_id = '$id'");

		$this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('produksi/pakan_edit');
	    $this->load->view('v_template_admin/admin_footer');

	}
	function pakan_update($id){

		$set = array(
						'pakan_nama' => strip_tags(@$_POST['nama']),
						'pakan_satuan' => strip_tags(@$_POST['satuan']),
						'pakan_keterangan' => strip_tags(@$_POST['keterangan']),
					);

		$where = ['pakan_id' => $id];
		$db = $this->query_builder->update('t_pakan',$set,$where);
		
		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}
		
		redirect(base_url('produksi/pakan'));
	}
	function pakan_view($id){

		$data['title'] = 'Campur Pakan';
		$data['id'] = $id;

		$db = $this->query_builder->view_row("SELECT * FROM t_pakan WHERE pakan_id = '$id'");
		$data['nama'] = $db['pakan_nama'];

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('produksi/pakan_view');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function pakan_view_get_data($id){

		$where = array('pakan_hapus' => 0, 'pakan_id' => $id);

	    $data = $this->m_pakan_view->get_datatables($where);
		$total = $this->m_pakan_view->count_all($where);
		$filter = $this->m_pakan_view->count_filtered($where);

		$output = array(
			"draw" => $_GET['draw'],
			"recordsTotal" => $total,
			"recordsFiltered" => $filter,
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}
	function pakan_print($date){

		$data['data'] = $this->query_builder->view("SELECT * FROM t_pakan as a JOIN t_pakan_barang as b ON a.pakan_kode = b.pakan_barang_kode LEFT JOIN t_barang AS c ON b.pakan_barang_barang = c.barang_id WHERE b.pakan_barang_tanggal = '$date'");

		$this->load->view('produksi/pakan_print',$data);
	}
	function premix(){
		$data['title'] = 'Campur premix';

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('produksi/premix');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function premix_get_data(){ 
 
		$where = array('premix_hapus' => 0);

	    $data = $this->m_premix->get_datatables($where);
		$total = $this->m_premix->count_all($where);
		$filter = $this->m_premix->count_filtered($where);

		$output = array(
			"draw" => $_GET['draw'],
			"recordsTotal" => $total,
			"recordsFiltered" => $filter,
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}
	function premix_add(){
		$data['title'] = 'Campur premix';

		$data['premix_data'] = $this->query_builder->view("SELECT * FROM t_barang WHERE barang_hapus = 0 AND barang_kategori = 4");

		$data['satuan_data'] = $this->query_builder->view("SELECT * FROM t_barang WHERE barang_hapus = 0 AND barang_kategori = 4");

		//generate kode
	    $num = $this->query_builder->count("SELECT * FROM t_premix") + 1;
	    $data['kode'] = 'PX00'.$num;

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('produksi/premix_add');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function premix_save(){

		$kode = strip_tags(@$_POST['kode']);

		$set1 = array(
						'premix_kode' => $kode,
						'premix_nama' => strip_tags(@$_POST['nama']),
						'premix_satuan' => strip_tags(@$_POST['satuan']),
						'premix_keterangan' => strip_tags(@$_POST['keterangan']),
					);

		$this->db->set($set1);
		if ($this->db->insert('t_premix')) {

			//qty
			$set4 = array(
							'premix_qty_kode' => $kode,
							'premix_qty_qty' => strip_tags(@$_POST['qty']),
						);

			$this->db->set($set4);
			$this->db->insert('t_premix_qty');

			// barang
			$jum = count($_POST['premix']);

			for ($i=0; $i < $jum; $i++) { 
				
				//barang
				$set2 = array(
								'premix_barang_kode' => $kode,
								'premix_barang_barang' => strip_tags(@$_POST['premix'][$i]),
								'premix_barang_qty' => strip_tags(str_replace(',', '', @$_POST['premix_jumlah'][$i])),
								'premix_barang_stok' => strip_tags(str_replace(',', '', @$_POST['premix_stok'][$i])),
								'premix_barang_harga' => strip_tags(str_replace(',', '', @$_POST['premix_harga'][$i])),
								'premix_barang_subtotal' => strip_tags(str_replace(',', '', @$_POST['premix_subtotal'][$i])),
							);

				$this->db->set($set2);
				$this->db->insert('t_premix_barang');

				//campur
				$set3 = array(
								'premix_campur_kode' => $kode,
								'premix_campur_barang' => strip_tags(@$_POST['premix'][$i]),
								'premix_campur_qty' => strip_tags(@$_POST['premix_jumlah'][$i]),
							);

				$this->db->set($set3);
				$this->db->insert('t_premix_campur');

			}


			//update stok
			$this->stok->update_barang();

		}

		$this->session->set_flashdata('success', 'Data berhasil di simpan');
		redirect(base_url('produksi/premix'));

	}
	function premix_delete($id){
		$set = ['premix_hapus' => 1];
		$where = ['premix_id' => $id];
		$db = $this->query_builder->update('t_premix',$set,$where);
		
		if ($db == 1) {
			
			//update stok
			$this->stok->update_barang();

			$this->session->set_flashdata('success','Data berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}
		
		redirect(base_url('produksi/premix'));
	}
	function premix_stok(){
		$data['title'] = 'Campur premix';

		$data['nama_data'] = $this->query_builder->view("SELECT * FROM t_premix WHERE premix_hapus = 0");

		$data['premix_data'] = $this->query_builder->view("SELECT * FROM t_barang WHERE barang_hapus = 0 AND barang_kategori = 4");

		$data['satuan_data'] = $this->query_builder->view("SELECT * FROM t_barang WHERE barang_hapus = 0 AND barang_kategori = 4");

		$this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('produksi/premix_stok');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function premix_get_premix($kode){

		$data = $this->query_builder->view("SELECT * FROM t_premix_campur WHERE premix_campur_kode = '$kode'");
		echo json_encode($data);
	}
	function premix_tambah_stok($kode){
		$jumlah = strip_tags(@$_POST['qty']);

		$update = $this->db->query("UPDATE t_premix SET premix_stok = premix_stok + {$jumlah} WHERE premix_kode = '$kode'");

		if ($update) {

			//qty
			$set4 = array(
							'premix_qty_kode' => $kode,
							'premix_qty_qty' => $jumlah,
						);

			$this->db->set($set4);
			$this->db->insert('t_premix_qty');

			// barang
			$jum = count($_POST['premix']);

			for ($i=0; $i < $jum; $i++) { 
				
				$set2 = array(
								'premix_barang_kode' => $kode,
								'premix_barang_barang' => strip_tags(@$_POST['premix'][$i]),
								'premix_barang_qty' => strip_tags(str_replace(',', '', @$_POST['premix_jumlah'][$i])),
								'premix_barang_stok' => strip_tags(str_replace(',', '', @$_POST['premix_stok'][$i])),
								'premix_barang_harga' => strip_tags(str_replace(',', '', @$_POST['premix_harga'][$i])),
								'premix_barang_subtotal' => strip_tags(str_replace(',', '', @$_POST['premix_subtotal'][$i])),
							);

				$this->db->set($set2);
				$this->db->insert('t_premix_barang');
			}

			//update stok
			$this->stok->update_barang();

			$this->session->set_flashdata('success','Stok berhasil di tambah');
		} else {
			$this->session->set_flashdata('gagal','Stok gagal di tambah');
		}
		
		redirect(base_url('produksi/premix'));
	}

	/////////////////// edit data //////////////////
	function premix_edit($id){

		$data['data'] = $this->query_builder->view_row("SELECT * FROM t_premix WHERE premix_id = '$id'");

		$this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('produksi/premix_edit');
	    $this->load->view('v_template_admin/admin_footer');

	}
	function premix_update($id){

		$set = array(
						'premix_nama' => strip_tags(@$_POST['nama']),
						'premix_satuan' => strip_tags(@$_POST['satuan']),
						'premix_keterangan' => strip_tags(@$_POST['keterangan']),
					);

		$where = ['premix_id' => $id];
		$db = $this->query_builder->update('t_premix',$set,$where);
		
		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}
		
		redirect(base_url('produksi/premix'));
	}
	function premix_view($id){

		$data['title'] = 'Campur premix';
		$data['id'] = $id;

		$db = $this->query_builder->view_row("SELECT * FROM t_premix WHERE premix_id = '$id'");
		$data['nama'] = $db['premix_nama'];

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('produksi/premix_view');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function premix_view_get_data($id){

		$where = array('premix_hapus' => 0, 'premix_id' => $id);

	    $data = $this->m_premix_view->get_datatables($where);
		$total = $this->m_premix_view->count_all($where);
		$filter = $this->m_premix_view->count_filtered($where);

		$output = array(
			"draw" => $_GET['draw'],
			"recordsTotal" => $total,
			"recordsFiltered" => $filter,
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}
	function premix_print($date){

		$data['data'] = $this->query_builder->view("SELECT * FROM t_premix as a JOIN t_premix_barang as b ON a.premix_kode = b.premix_barang_kode LEFT JOIN t_barang AS c ON b.premix_barang_barang = c.barang_id WHERE b.premix_barang_tanggal = '$date'");

		$this->load->view('produksi/premix_print',$data);
	}
}