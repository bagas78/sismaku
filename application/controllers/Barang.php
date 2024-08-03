<?php
class Barang extends CI_Controller{
 
	function __construct(){
		parent::__construct();
		$this->load->model('m_barang');
		$this->load->model('m_stok_gudang');
		$this->load->model('m_stok_kandang');
	}
	function index($id){ 

		$get = $this->query_builder->view_row("SELECT * FROM t_barang_kategori WHERE barang_kategori_id = '$id'");

		$data['kategori'] = $get['barang_kategori_nama'];
		$data['kategori_id'] = $get['barang_kategori_id'];
		$data['title'] = $get['barang_kategori_nama']; 

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('barang/index'); 
	    $this->load->view('v_template_admin/admin_footer');
	}
	function get_data($id){

		$where = array('barang_kategori' => $id,'barang_hapus' => 0);

	    $data = $this->m_barang->get_datatables($where);
		$total = $this->m_barang->count_all($where);
		$filter = $this->m_barang->count_filtered($where);

		$output = array(
			"draw" => $_GET['draw'],
			"recordsTotal" => $total,
			"recordsFiltered" => $filter,
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}
	function add($id){ 
		
		$get = $this->query_builder->view_row("SELECT * FROM t_barang_kategori WHERE barang_kategori_id = '$id'");
		$data['kategori'] = $get['barang_kategori_nama'];
		$data['kategori_id'] = $get['barang_kategori_id'];
		$data['title'] = $get['barang_kategori_nama'];
		$data['satuan'] = $get['barang_kategori_satuan'];

	    //generate kode
	    $num = $this->query_builder->count("SELECT * FROM t_barang") + 1;
	    $data['kode'] = 'KB00'.$num;

		$this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('barang/add');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function save($kategori){
		$set = array(
						'barang_kode' => strip_tags($_POST['kode']),
						'barang_nama' => strip_tags($_POST['nama']),
						'barang_kategori' => strip_tags($_POST['kategori']),
						'barang_satuan' => strip_tags($_POST['satuan']),
					);

		$db = $this->query_builder->add('t_barang',$set);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di tambah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di tambah');
		}
		
		redirect(base_url('barang/'.$kategori));	
	}
	function delete($id,$kategori){

		$set = ['barang_hapus' => 1];
		$where = ['barang_id' => $id];
		$db = $this->query_builder->update('t_barang',$set,$where);
		
		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}
		
		redirect(base_url('barang/'.@$kategori));
	}
	function edit($id){

		$get = $this->query_builder->view_row("SELECT * FROM t_barang_kategori as a JOIN t_barang as b ON a.barang_kategori_id = b.barang_kategori WHERE b.barang_id = '$id'");

		$data['kategori'] = $get['barang_kategori_nama'];
		$data['kategori_id'] = $get['barang_kategori_id'];
		$data['title'] = $get['barang_kategori_nama'];

		$data['data'] = $get;

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('barang/add');
	    $this->load->view('barang/edit');
	    $this->load->view('v_template_admin/admin_footer');

	}
	function update($id,$kategori){
		$set = array(
						'barang_nama' => strip_tags($_POST['nama']),
						'barang_kategori' => strip_tags($_POST['kategori']),
						'barang_satuan' => strip_tags($_POST['satuan']),
					);

		$where = ['barang_id' => $id];
		$db = $this->query_builder->update('t_barang',$set,$where);
		
		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di rubah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di rubah');
		}
		
		redirect(base_url('barang/'.$kategori));
	}

	////////////////////////////////////////////////

	function telur(){
		$this->index(1);
	}
	function telur_add(){
		$this->add(1);
	}
	function telur_edit($id){
		$this->edit($id);
	}
	function telur_detail($id, $kategori){
		$this->detail($id, $kategori);
	}

	/////////////////////////////////////////////////

	function pakan(){
		$this->index(2);
	}
	function pakan_add(){
		$this->add(2);
	}
	function pakan_edit($id){
		$this->edit($id);
	}
	function pakan_detail($id, $kategori){
		$this->detail($id, $kategori);
	}

	/////////////////////////////////////////////////

	function obat(){
		$this->index(3);
	}
	function obat_add(){
		$this->add(3);
	}
	function obat_edit($id){
		$this->edit($id);
	}
	function obat_detail($id, $kategori){
		$this->detail($id, $kategori);
	}

	////////////////////////////////////////////////

	function kotoran(){
		$this->index(4);
	}
	function kotoran_add(){
		$this->add(4);
	}
	function kotoran_edit($id){
		$this->edit($id);
	}
	function kotoran_detail($id, $kategori){
		$this->detail($id, $kategori);
	}

	/////////////////////////////////////////////////

	function ayam(){
		$this->index(5);
	}
	function ayam_add(){
		$this->add(5);
	}
	function ayam_edit($id){
		$this->edit($id);
	}
	function ayam_detail($id, $kategori){
		$this->detail($id, $kategori);
	}

	////////////////////////////////////////////////
}