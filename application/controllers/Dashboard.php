<?php
class Dashboard extends CI_Controller{

	function __construct(){
		parent::__construct();
	}  
	function index(){  
		if ( $this->session->userdata('login') == 1) {

			$data['dashboard'] = 'class="active"'; 
		    $data['title'] = 'Dashboard';

		    //data
		    $get = $this->db->query("SELECT  a.barang_kategori_nama AS nama,SUM(b.barang_stok) AS stok, a.barang_kategori_satuan AS satuan FROM t_barang_kategori AS a LEFT JOIN t_barang AS b ON a.barang_kategori_id = b.barang_kategori WHERE b.barang_hapus = 0 GROUP BY a.barang_kategori_id")->result_array();

		    //telur
		   	$data['telur_'] = @$get[0]['stok'];
		   	$data['pakan_'] = @$get[1]['stok'];
		   	$data['obat_'] = @$get[2]['stok'];

		   	//satuan
		   	$data['telur_satuan_'] = @$get[0]['satuan'];
		   	$data['pakan_satuan_'] = @$get[1]['satuan'];
		   	$data['obat_satuan_'] = @$get[2]['satuan'];

		   	//peforma
		   	$bulan = date('Y-m');
		   	$data['peforma'] = $this->db->query("SELECT karyawan_nama AS nama ,SUM(CASE WHEN absen_status = 'masuk' THEN 1 ELSE 0 END) AS masuk, SUM(CASE WHEN absen_status = 'tidak' THEN 1 ELSE 0 END) AS tidak FROM t_karyawan AS a LEFT JOIN t_absen AS b ON a.karyawan_id = b.absen_karyawan WHERE a.karyawan_hapus = 0 AND DATE_FORMAT(b.absen_tanggal, '%Y-%m') = '$bulan' GROUP BY a.karyawan_id ORDER BY masuk DESC")->result_array();

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('dashboard/dashboard');
		    $this->load->view('v_template_admin/admin_footer');
 
		}
		else{
			redirect(base_url('login'));
		}
	} 
}