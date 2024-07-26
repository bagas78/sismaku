<?php
class Laporan extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('m_laporan_pembelian');
		$this->load->model('m_laporan_penjualan');
	} 
	function pembelian(){  
		if ( $this->session->userdata('login') == 1) {

			//filter sum
			if (@$_POST['tanggal']) {
				
				$dt = explode('-', $_POST['tanggal']);	
				$bln = $dt[1];
				$thn = $dt[0];

			}else{

				$bln = date('m');
				$thn = date('Y');
			}

			//sum tahun
			$sum_tahun = $this->db->query("SELECT SUM(a.pembelian_barang_subtotal) AS total FROM t_pembelian_barang AS a JOIN t_pembelian AS b ON a.pembelian_barang_nomor = b.pembelian_nomor WHERE b.pembelian_hapus = 0 AND date_format(b.pembelian_tanggal, '%Y') = '$thn'")->row_array();
			$data['sum_tahun'] = $sum_tahun['total'];

			//sum bulan
			$sum_bulan = $this->db->query("SELECT SUM(a.pembelian_barang_subtotal) AS total FROM t_pembelian_barang AS a JOIN t_pembelian AS b ON a.pembelian_barang_nomor = b.pembelian_nomor WHERE b.pembelian_hapus = 0 AND date_format(b.pembelian_tanggal, '%Y') = '$thn' AND date_format(b.pembelian_tanggal, '%m') = '$bln'")->row_array();
			$data['sum_bulan'] = $sum_bulan['total'];

			$data['tahun_'] = $thn;
			$data['bulan_'] = $bln;

			$data['title'] = 'Laporan Pembelian';

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('laporan/pembelian');
		    $this->load->view('v_template_admin/admin_footer');
 
		}
		else{
			redirect(base_url('login'));
		}
	} 
	function penjualan(){  
		if ( $this->session->userdata('login') == 1) {

			//filter sum
			if (@$_POST['tanggal']) {
				
				$dt = explode('-', $_POST['tanggal']);	
				$bln = $dt[1];
				$thn = $dt[0];

			}else{

				$bln = date('m');
				$thn = date('Y');
			}

			//sum tahun
			$sum_tahun = $this->db->query("SELECT SUM(a.penjualan_barang_subtotal) AS total FROM t_penjualan_barang AS a JOIN t_penjualan AS b ON a.penjualan_barang_nomor = b.penjualan_nomor WHERE b.penjualan_hapus = 0 AND date_format(b.penjualan_tanggal, '%Y') = '$thn'")->row_array();
			$data['sum_tahun'] = $sum_tahun['total'];

			//sum bulan
			$sum_bulan = $this->db->query("SELECT SUM(a.penjualan_barang_subtotal) AS total FROM t_penjualan_barang AS a JOIN t_penjualan AS b ON a.penjualan_barang_nomor = b.penjualan_nomor WHERE b.penjualan_hapus = 0 AND date_format(b.penjualan_tanggal, '%Y') = '$thn' AND date_format(b.penjualan_tanggal, '%m') = '$bln'")->row_array();
			$data['sum_bulan'] = $sum_bulan['total'];

			$data['tahun_'] = $thn;
			$data['bulan_'] = $bln;

			$data['title'] = 'Laporan Pembelian';

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('laporan/penjualan');
		    $this->load->view('v_template_admin/admin_footer');
 
		}
		else{
			redirect(base_url('login'));
		}
	} 
	function get_data($jenis, $bulan = '', $tahun = ''){

		if ($jenis == 'pembelian') {
			
			$where = array('pembelian_hapus' => 0, 'DATE_FORMAT(pembelian_barang_tanggal, "%m") =' => $bulan, 'DATE_FORMAT(pembelian_barang_tanggal, "%Y") =' => $tahun);

		    $data = $this->m_laporan_pembelian->get_datatables($where);
			$total = $this->m_laporan_pembelian->count_all($where);
			$filter = $this->m_laporan_pembelian->count_filtered($where);

		}else{

			$where = array('penjualan_hapus' => 0, 'DATE_FORMAT(penjualan_barang_tanggal, "%m") =' => $bulan, 'DATE_FORMAT(penjualan_barang_tanggal, "%Y") =' => $tahun);

		    $data = $this->m_laporan_penjualan->get_datatables($where);
			$total = $this->m_laporan_penjualan->count_all($where);
			$filter = $this->m_laporan_penjualan->count_filtered($where);
		}

		$output = array(
			"draw" => $_GET['draw'],
			"recordsTotal" => $total,
			"recordsFiltered" => $filter,
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}
	function pembelian_print(){

		$bulan = @$_POST['bulan'];
		$tahun = @$_POST['tahun'];

		if (@$bulan) {
			// bulan
			$data['data'] = $this->query_builder->view("SELECT * FROM t_pembelian AS a JOIN t_pembelian_barang AS b ON a.pembelian_nomor = b.pembelian_barang_nomor LEFT JOIN t_barang AS c ON b.pembelian_barang_barang = c.barang_id WHERE DATE_FORMAT(a.pembelian_tanggal, '%Y-%m') = '$bulan'");
			$data['status'] = 1;
		}else{
			//tahun
			$data['data'] = $this->query_builder->view("SELECT * FROM t_pembelian AS a JOIN t_pembelian_barang AS b ON a.pembelian_nomor = b.pembelian_barang_nomor LEFT JOIN t_barang AS c ON b.pembelian_barang_barang = c.barang_id WHERE DATE_FORMAT(a.pembelian_tanggal, '%Y') = '$tahun'");
			$data['status'] = 2;
		}

		if (@$data['data']) {
			$this->load->view('laporan/pembelian_print',$data);
		}else{
			$this->session->set_flashdata('gagal', 'Data tidak di temukan');
			redirect(base_url('laporan/pembelian'));
		}

	}
	function penjualan_print(){

		$bulan = @$_POST['bulan'];
		$tahun = @$_POST['tahun'];

		if (@$bulan) {
			// bulan
			$data['data'] = $this->query_builder->view("SELECT * FROM t_penjualan AS a JOIN t_penjualan_barang AS b ON a.penjualan_nomor = b.penjualan_barang_nomor LEFT JOIN t_barang AS c ON b.penjualan_barang_barang = c.barang_id WHERE DATE_FORMAT(a.penjualan_tanggal, '%Y-%m') = '$bulan'");
			$data['status'] = 1;
		}else{
			//tahun
			$data['data'] = $this->query_builder->view("SELECT * FROM t_penjualan AS a JOIN t_penjualan_barang AS b ON a.penjualan_nomor = b.penjualan_barang_nomor LEFT JOIN t_barang AS c ON b.penjualan_barang_barang = c.barang_id WHERE DATE_FORMAT(a.penjualan_tanggal, '%Y') = '$tahun'");
			$data['status'] = 2;
		}

		if (@$data['data']) {
			$this->load->view('laporan/penjualan_print',$data);
		}else{
			$this->session->set_flashdata('gagal', 'Data tidak di temukan');
			redirect(base_url('laporan/penjualan'));
		}

	}
}