<?php
class Demo extends CI_Controller{

	function __construct(){ 
		parent::__construct();
	} 
	function url($url1 = '',$url2 = '',$url3 = ''){
		
		$this->session->set_flashdata('gagal','INI HANYA DEMO');

		redirect(base_url(@$url1.'/'.@$url2.'/'.@$url3));
	} 
}