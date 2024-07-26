<?php
class Gaji extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('m_gaji');
		$this->load->model('m_gaji_riwayat');
	}  
	function bulan(){
		
		//filter
		$bulan = @$_POST['bulan'];
		if (@$bulan) {
			$data['bulan_'] = $bulan;
		}else{
			$data['bulan_'] = date('Y-m');
		}

		$data['title'] = 'Gaji Bulanan';		

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('gaji/bulan');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function get_data($bulan){

		$where = array('karyawan_hapus' => 0, 'DATE_FORMAT(absen_tanggal, "%Y-%m") =' => $bulan);

	    $data = $this->m_gaji->get_datatables($where);
		$total = $this->m_gaji->count_all($where);
		$filter = $this->m_gaji->count_filtered($where);

		$output = array(
			"draw" => $_GET['draw'],
			"recordsTotal" => $total,
			"recordsFiltered" => $filter,
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}
	function bayar($id){

		//nominal
		$get = $this->db->query("SELECT SUM(absen_upah) as upah FROM t_absen WHERE absen_karyawan = '$id' AND absen_bayar = 'belum'")->row_array();
		$nominal = $get['upah'];

		$this->db->where(['absen_karyawan' => $id, 'absen_bayar' => 'belum']);
		$this->db->set('absen_bayar','sudah');

		if ($this->db->update('t_absen')) {
			
			$this->session->set_flashdata('success','Data berhasil di bayar');

			//gaji
			$set = array(
						'gaji_karyawan' => $id,
						'gaji_nominal' => $nominal,
						'gaji_keterangan' => strip_tags($_POST['keterangan']),
						'gaji_tanggal' => strip_tags($_POST['tanggal']),
					);
			$this->db->set($set);
			$this->db->insert('t_gaji');

		} else {

			$this->session->set_flashdata('gagal','Data gagal di bayar');
		}

		redirect(base_url('gaji/bulan'));
	}
	function riwayat(){

		//filter
		$bulan = @$_POST['bulan'];
		if (@$bulan) {
			$data['bulan_'] = $bulan;
		}else{
			$data['bulan_'] = date('Y-m');
		}

		$data['title'] = 'Riwayat Gaji';

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('gaji/riwayat');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function riwayat_get_data($bulan){

		$where = array('DATE_FORMAT(gaji_tanggal, "%Y-%m") =' => $bulan);

	    $data = $this->m_gaji_riwayat->get_datatables($where);
		$total = $this->m_gaji_riwayat->count_all($where);
		$filter = $this->m_gaji_riwayat->count_filtered($where);

		$output = array(
			"draw" => $_GET['draw'],
			"recordsTotal" => $total,
			"recordsFiltered" => $filter,
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}
}