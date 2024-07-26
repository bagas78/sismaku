<?php
class Absen extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('m_karyawan');
	}  
	function harian(){
		$data['title'] = 'Absensi Harian';

		$data['tanggal_'] = date('Y-m-d');

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('absen/harian');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function get_data(){

		$where = array('karyawan_hapus' => 0);
		$tgl = 'AND t_absen.absen_tanggal = "'.date('Y-m-d').'"';

	    $data = $this->m_karyawan->get_datatables($where, $tgl);
		$total = $this->m_karyawan->count_all($where, $tgl);
		$filter = $this->m_karyawan->count_filtered($where, $tgl);

		$output = array(
			"draw" => $_GET['draw'],
			"recordsTotal" => $total,
			"recordsFiltered" => $filter,
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}
	function save($status, $id){
		
		$tgl = date('Y-m-d');

		if ($status != 'reset') {
			//masuk / tidak

			if ($status == 'masuk') {
				
				$get = $this->db->query("SELECT * FROM t_karyawan WHERE karyawan_id = '$id'")->row_array();
				$upah = $get['karyawan_upah'];

			}else{

				$upah = 0;
			}

			$set = array(
							'absen_karyawan' => $id,
							'absen_upah' => $upah,
							'absen_jam' => date('h:i:s'),
							'absen_tanggal' => $tgl,
							'absen_status' => $status,
						);

			//cek
			$cek = $this->db->query("SELECT * FROM t_absen WHERE absen_karyawan = '$id' AND absen_tanggal = '$tgl'")->row_array();
			
			if (@$cek) {
				$db = 0;
			}else{
				$db = $this->query_builder->add('t_absen',$set);	
			}

		}else{

			//reset
			$db = $this->query_builder->delete('t_absen',['absen_karyawan' => $id, 'absen_tanggal' => $tgl]);
		}

		//status
		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di tambah');
		} else {
			$this->session->set_flashdata('gagal','Data sudah ada');
		}
		
		redirect(base_url('absen/harian'));	

	}
	function riwayat(){

		//filter
		$tanggal = @$_POST['tanggal'];
		if (@$tanggal) {

			$data['tanggal_'] = $tanggal;	
		}else{

			$data['tanggal_'] = date('Y-m-d');
		}
		

		$data['title'] = 'Riwayat Absensi';

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('absen/riwayat');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function riwayat_get_data($tanggal){

		$where = array('karyawan_hapus' => 0, 'absen_tanggal' => $tanggal);

	    $data = $this->m_karyawan->get_datatables($where);
		$total = $this->m_karyawan->count_all($where);
		$filter = $this->m_karyawan->count_filtered($where);

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