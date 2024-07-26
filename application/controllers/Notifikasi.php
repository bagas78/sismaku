<?php
class Notifikasi extends CI_Controller{

	function __construct(){
		parent::__construct();
	}  
	function pembelian(){

		$date = date('Y-m-d');
		$level = $this->session->userdata('level');
		$user = $this->session->userdata('id');

		if ($level == 1) {
			//admin
			$get = $this->db->query("SELECT * FROM t_pembelian WHERE pembelian_status = 'belum' AND pembelian_jatuh_tempo < '$date' AND pembelian_hapus = 0")->result_array();
		}else{
			//user
			$get = $this->db->query("SELECT * FROM t_pembelian WHERE pembelian_user = '$user' AND pembelian_status = 'belum' AND pembelian_jatuh_tempo < '$date' AND pembelian_hapus = 0")->result_array();
		}

		echo json_encode(count($get));
	}
	function penjualan(){
		
		$date = date('Y-m-d');
		$level = $this->session->userdata('level');
		$user = $this->session->userdata('id');

		if ($level == 1) {
			//admin
			$get = $this->db->query("SELECT * FROM t_penjualan WHERE penjualan_status = 'belum' AND penjualan_jatuh_tempo < '$date' AND penjualan_hapus = 0")->result_array();
		}else{
			//user
			$get = $this->db->query("SELECT * FROM t_penjualan WHERE penjualan_user = '$user' AND penjualan_status = 'belum' AND penjualan_jatuh_tempo < '$date' AND penjualan_hapus = 0")->result_array();
		}

		echo json_encode(count($get));
	}
}