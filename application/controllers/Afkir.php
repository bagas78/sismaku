<?php
class Afkir extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('m_afkir');
	}  
	function index(){
		$data['title'] = 'Afkir';

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('afkir/index');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function get_data(){

		$where = array('afkir_hapus' => 0);

	    $data = $this->m_afkir->get_datatables($where);
		$total = $this->m_afkir->count_all($where);
		$filter = $this->m_afkir->count_filtered($where);

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