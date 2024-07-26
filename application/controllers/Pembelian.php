<?php
class Pembelian extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('m_pembelian'); 
	} 
	function transaksi(){ 
		if ( $this->session->userdata('login') == 1) {
			$data['title'] = 'Pembelian';

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('pembelian/transaksi');
		    $this->load->view('v_template_admin/admin_footer');

		} 
		else{  
			redirect(base_url('login'));  
		}
	}
	function transaksi_get($like = ''){

		$level = $this->session->userdata('level');
		$user = $this->session->userdata('id');

		if ($level == 1) {
			//admin
			$where = array('pembelian_hapus' => 0);
		}else{
			//user
			$where = array('pembelian_hapus' => 0, 'pembelian_user' => $user);
		}

	    $data = $this->m_pembelian->get_datatables($where, $like);
		$total = $this->m_pembelian->count_all($where, $like);
		$filter = $this->m_pembelian->count_filtered($where, $like);

		$output = array(
			"draw" => $_GET['draw'],
			"recordsTotal" => $total,
			"recordsFiltered" => $filter,
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	} 
	function transaksi_add(){
		if ( $this->session->userdata('login') == 1) {
			$data['title'] = 'Pembelian';

			//generate nomor
			$get = $this->query_builder->count("SELECT * FROM t_pembelian");
			$data['nomor'] = 'PB-'.date('dmy').'-'.($get + 1);

			//kontak
			$data['kontak_data'] = $this->query_builder->view("SELECT * FROM t_kontak WHERE kontak_jenis = 's' AND kontak_hapus = 0");

			//kategori
			$data['kategori_data'] = $this->query_builder->view("SELECT * FROM t_barang_kategori WHERE barang_kategori_id != 1 AND barang_kategori_id != 4");

			//barang
			$data['barang_data'] = $this->query_builder->view("SELECT * FROM t_barang WHERE barang_kategori IN(2,3,5)");

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('pembelian/transaksi_add');
		    $this->load->view('v_template_admin/admin_footer');

		} 
		else{
			redirect(base_url('login'));
		}
	}
	function get_barang($kategori){

		$data = $this->query_builder->view("SELECT * FROM t_barang WHERE barang_kategori ='$kategori'");
		echo json_encode($data);
	}
	function transaksi_save($url){

		$nomor = strip_tags($_POST['nomor']);

		//pembelian
		$set1 = array(
						'pembelian_user' => $this->session->userdata('id'),
						'pembelian_kontak' => strip_tags($_POST['kontak']),
						'pembelian_sales' => strip_tags($_POST['sales']),
						'pembelian_nomor' => $nomor,
						'pembelian_jatuh_tempo' => strip_tags($_POST['jatuh_tempo']),
						'pembelian_keterangan' => strip_tags($_POST['keterangan']),
						'pembelian_ppn' => strip_tags($_POST['ppn']),
						'pembelian_qty' => strip_tags(str_replace(',', '', $_POST['qty_akhir'])),
						'pembelian_total' => strip_tags(str_replace(',', '', $_POST['total'])),
					);

		$save = $this->query_builder->add('t_pembelian',$set1);

		if ($save == 1) {
			
			$num = count($_POST['barang']);

			for ($i = 0; $i < $num; ++$i) {

				$kategori = strip_tags($_POST['kategori'][$i]);

				if ($kategori == 5) {
					// ayam
					$keluar = (DateTime::createFromFormat('Y-m-d', date('Y-m-d')))->modify('+913 day')->format('Y-m-d');
				}else{
					//bukan
					$keluar = '';
				}
				
				//barang
				$set2 = array(
								'pembelian_barang_nomor' => $nomor,
								'pembelian_barang_kategori' => $kategori,
								'pembelian_barang_barang' => strip_tags($_POST['barang'][$i]),
								'pembelian_barang_harga' => strip_tags(str_replace(',', '', $_POST['harga'][$i])),
								'pembelian_barang_diskon' => strip_tags(str_replace(',', '', $_POST['diskon'][$i])),
								'pembelian_barang_qty' => strip_tags(str_replace(',', '', $_POST['qty'][$i])),
								'pembelian_barang_subtotal' => strip_tags(str_replace(',', '', $_POST['subtotal'][$i])),
								'pembelian_barang_keluar' => $keluar,
							);

				$this->query_builder->add('t_pembelian_barang',$set2);	
			}

			//update stok
			$this->stok->update_barang();

			$this->session->set_flashdata('success','Data berhasil di rubah');

		} else {

			$this->session->set_flashdata('gagal','Data gagal di rubah');
		}

		redirect(base_url('pembelian/'.$url));
	}
	function transaksi_delete($id, $url){

		$set = ['pembelian_hapus' => 1];
		$where = ['pembelian_id' => $id];
		$del = $this->query_builder->update('t_pembelian',$set,$where);
		if ($del == 1) {
			
			//update stok
			$this->stok->update_barang();
			
			$this->session->set_flashdata('success','Data berhasil di rubah');

		} else {

			$this->session->set_flashdata('gagal','Data gagal di rubah');
		}

		redirect(base_url('pembelian/'.$url));

	}
	function transaksi_print($id){
		$data['title'] = 'Pembelian';
		$data['data'] = $this->query_builder->view("SELECT * FROM t_pembelian as a JOIN t_pembelian_barang as b ON a.pembelian_nomor = b.pembelian_barang_nomor JOIN t_barang as c ON b.pembelian_barang_barang = c.barang_id JOIN t_user as d ON a.pembelian_user = d.user_id JOIN t_kontak as e ON a.pembelian_kontak = e.kontak_id WHERE a.pembelian_id = '$id'");
		$this->load->view('pembelian/transaksi_print',$data);
	}
	function transaksi_view($id){

		if ( $this->session->userdata('login') == 1) {

			$data['title'] = 'Pembelian';
			$data['view'] = '1';

			//data
			$data['data'] = $this->query_builder->view("SELECT * FROM t_pembelian as a JOIN t_pembelian_barang as b ON a.pembelian_nomor = b.pembelian_barang_nomor JOIN t_barang as c ON b.pembelian_barang_barang = c.barang_id JOIN t_user as d ON a.pembelian_user = d.user_id JOIN t_kontak as e ON a.pembelian_kontak = e.kontak_id WHERE a.pembelian_id = '$id'");

			//kontak
			$data['kontak_data'] = $this->query_builder->view("SELECT * FROM t_kontak WHERE kontak_jenis = 's' AND kontak_hapus = 0");

			//kategori
			$data['kategori_data'] = $this->query_builder->view("SELECT * FROM t_barang_kategori");

			//barang
			$data['barang_data'] = $this->query_builder->view("SELECT * FROM t_barang WHERE barang_kategori IN(2,3,5)");

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('pembelian/transaksi_add');
		    $this->load->view('pembelian/transaksi_edit');
		    $this->load->view('v_template_admin/admin_footer');

		} 
		else{
			redirect(base_url('login'));
		}
	}

	///////////////// PEMBELIAN OBAT /////////////////

	function Obat(){ 
		if ( $this->session->userdata('login') == 1) {
			$data['title'] = 'Pembelian Obat';

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('pembelian/obat');
		    $this->load->view('v_template_admin/admin_footer');

		} 
		else{ 
			redirect(base_url('login'));  
		}
	}
	function obat_add(){
		if ( $this->session->userdata('login') == 1) {
			$data['title'] = 'Pembelian Obat';

			//generate nomor
			$get = $this->query_builder->count("SELECT * FROM t_pembelian");
			$data['nomor'] = 'PBO-'.date('dmy').'-'.($get + 1);

			//kontak
			$data['kontak_data'] = $this->query_builder->view("SELECT * FROM t_kontak WHERE kontak_jenis = 's' AND kontak_hapus = 0");

			//barang
			$data['barang_data'] = $this->query_builder->view("SELECT * FROM t_barang WHERE barang_kategori IN(4)");

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('pembelian/obat_add');
		    $this->load->view('v_template_admin/admin_footer');

		} 
		else{
			redirect(base_url('login'));
		}
	}
	function obat_view($id){

		if ( $this->session->userdata('login') == 1) {

			$data['title'] = 'Pembelian';
			$data['view'] = '1';

			//data
			$data['data'] = $this->query_builder->view("SELECT * FROM t_pembelian as a JOIN t_pembelian_barang as b ON a.pembelian_nomor = b.pembelian_barang_nomor JOIN t_barang as c ON b.pembelian_barang_barang = c.barang_id JOIN t_user as d ON a.pembelian_user = d.user_id JOIN t_kontak as e ON a.pembelian_kontak = e.kontak_id WHERE a.pembelian_id = '$id'");

			//kontak
			$data['kontak_data'] = $this->query_builder->view("SELECT * FROM t_kontak WHERE kontak_jenis = 's' AND kontak_hapus = 0");

			//kategori
			$data['kategori_data'] = $this->query_builder->view("SELECT * FROM t_barang_kategori");

			//barang
			$data['barang_data'] = $this->query_builder->view("SELECT * FROM t_barang WHERE barang_kategori IN(4)");

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('pembelian/obat_add');
		    $this->load->view('pembelian/transaksi_edit');
		    $this->load->view('v_template_admin/admin_footer');

		} 
		else{
			redirect(base_url('login'));
		}
	}

	///////////////// PEMBELIAN PAKAN /////////////////

	function pakan(){ 
		if ( $this->session->userdata('login') == 1) {
			$data['title'] = 'Pembelian Pakan';

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('pembelian/pakan');
		    $this->load->view('v_template_admin/admin_footer');

		} 
		else{ 
			redirect(base_url('login'));  
		}
	}
	function pakan_add(){
		if ( $this->session->userdata('login') == 1) {
			$data['title'] = 'Pembelian Obat';

			//generate nomor
			$get = $this->query_builder->count("SELECT * FROM t_pembelian");
			$data['nomor'] = 'PBP-'.date('dmy').'-'.($get + 1);

			//kontak
			$data['kontak_data'] = $this->query_builder->view("SELECT * FROM t_kontak WHERE kontak_jenis = 's' AND kontak_hapus = 0");

			//barang
			$data['barang_data'] = $this->query_builder->view("SELECT * FROM t_barang WHERE barang_kategori IN(3)");

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('pembelian/pakan_add');
		    $this->load->view('v_template_admin/admin_footer');

		} 
		else{
			redirect(base_url('login'));
		}
	}
	function pakan_view($id){

		if ( $this->session->userdata('login') == 1) {

			$data['title'] = 'Pembelian Pakan';
			$data['view'] = '1';

			//data
			$data['data'] = $this->query_builder->view("SELECT * FROM t_pembelian as a JOIN t_pembelian_barang as b ON a.pembelian_nomor = b.pembelian_barang_nomor JOIN t_barang as c ON b.pembelian_barang_barang = c.barang_id JOIN t_user as d ON a.pembelian_user = d.user_id JOIN t_kontak as e ON a.pembelian_kontak = e.kontak_id WHERE a.pembelian_id = '$id'");

			//kontak
			$data['kontak_data'] = $this->query_builder->view("SELECT * FROM t_kontak WHERE kontak_jenis = 's' AND kontak_hapus = 0");

			//kategori
			$data['kategori_data'] = $this->query_builder->view("SELECT * FROM t_barang_kategori");

			//barang
			$data['barang_data'] = $this->query_builder->view("SELECT * FROM t_barang WHERE barang_kategori IN(3)");

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('pembelian/pakan_add');
		    $this->load->view('pembelian/transaksi_edit');
		    $this->load->view('v_template_admin/admin_footer');

		} 
		else{
			redirect(base_url('login'));
		}
	}
}