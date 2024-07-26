<?php

class M_pembelian extends CI_Model { 
	
	//nama tabel
	var $table = 't_pembelian'; 

	//kolom yang di tampilkan
	var $column_order = array(null,'pembelian_nomor','pembelian_status','kontak_nama'); 

	//kolom yang di tampilkan setelah seacrh
	var $column_search = array('pembelian_nomor','pembelian_status','kontak_nama'); 

	//urutan 
	var $order = array('pembelian_id' => 'desc'); 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		
		$this->db->from($this->table);

		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_GET['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_GET['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_GET['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_GET['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_GET['order']['0']['column']], $_GET['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables($where, $like = '')
	{
		$this->_get_datatables_query();
		if($_GET['length'] != -1)
		$this->db->join('t_user', 't_user.user_id = t_pembelian.pembelian_user');
		$this->db->join('t_kontak', 't_kontak.kontak_id = t_pembelian.pembelian_kontak');
		$this->db->where($where);

		//like PBO AND PBP
		if ($like != '') {
			$this->db->like('t_pembelian.pembelian_nomor', $like);
		}

		$this->db->limit($_GET['length'], $_GET['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered($where, $like = '')
	{
		$this->_get_datatables_query();
		$this->db->join('t_user', 't_user.user_id = t_pembelian.pembelian_user');
		$this->db->join('t_kontak', 't_kontak.kontak_id = t_pembelian.pembelian_kontak');
		$this->db->where($where);

		//like PBO AND PBP
		if ($like != '') {
			$this->db->like('t_pembelian.pembelian_nomor', $like);
		}

		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all($where, $like = '')
	{
		$this->db->from($this->table);
		$this->db->join('t_user', 't_user.user_id = t_pembelian.pembelian_user');
		$this->db->join('t_kontak', 't_kontak.kontak_id = t_pembelian.pembelian_kontak');
		$this->db->where($where);

		//like PBO AND PBP
		if ($like != '') {
			$this->db->like('t_pembelian.pembelian_nomor', $like);
		}
		
		return $this->db->count_all_results();
	}

}
