 <?php
class Stok{  
  protected $sql;
  function __construct(){
        $this->sql = &get_instance();
  }
  function update_barang(){ 
   
      $pembelian = $this->sql->db->query("SELECT b.pembelian_barang_barang AS barang, SUM(b.pembelian_barang_qty) AS jumlah FROM t_pembelian AS a JOIN t_pembelian_barang AS b ON a.pembelian_nomor = b.pembelian_barang_nomor WHERE a.pembelian_hapus = 0 GROUP BY b.pembelian_barang_barang")->result_array();

      $penjualan = $this->sql->db->query("SELECT b.penjualan_barang_barang AS barang, SUM(b.penjualan_barang_qty) AS jumlah FROM t_penjualan AS a JOIN t_penjualan_barang AS b ON a.penjualan_nomor = b.penjualan_barang_nomor WHERE a.penjualan_hapus = 0 GROUP BY b.penjualan_barang_barang")->result_array();
      
      $recording = $this->sql->db->query("SELECT b.recording_barang_barang AS barang, b.recording_barang_kategori AS kategori, SUM(b.recording_barang_jumlah) AS jumlah FROM t_recording AS a JOIN t_recording_barang AS b ON a.recording_nomor = b.recording_barang_nomor WHERE a.recording_hapus = 0 GROUP BY b.recording_barang_barang")->result_array();

      //recording produksi 

      //0 stok barang
      $this->sql->db->query("UPDATE t_barang SET barang_stok = 0");

      //pembelian
      foreach ($pembelian as $val) {
        $jumlah = $val['jumlah'];  
        $barang = $val['barang'];

        $set = array(
                      'barang_stok' => $jumlah
                    ); 
        $this->sql->db->set($set);
        $this->sql->db->WHERE(['barang_id' => $barang]);
        $this->sql->db->update('t_barang');

      }

      //penjualan
      foreach ($penjualan as $val) {
        $jumlah = $val['jumlah'];  
        $barang = $val['barang'];

        $this->sql->db->query("UPDATE t_barang SET barang_stok = barang_stok - {$jumlah} WHERE barang_id = {$barang}");
      }

      //recording kurangi stok
      foreach ($recording as $val) {
        
        $barang = $val['barang'];
        $kategori = $val['kategori'];
        $jumlah = $val['jumlah'];

        switch ($kategori) {
          case 'obat':
            
            $this->sql->db->query("UPDATE t_barang SET barang_stok = barang_stok - {$jumlah} WHERE barang_id = {$barang}");

            break;
          
          case 'telur':
            
            $this->sql->db->query("UPDATE t_barang SET barang_stok = barang_stok + {$jumlah} WHERE barang_id = {$barang}");

            break;

          case 'pakan':
            
            $this->sql->db->query("UPDATE t_barang SET barang_stok = barang_stok - {$jumlah} WHERE barang_id = {$barang}");

            break;

          case 'kotoran':
            
            $this->sql->db->query("UPDATE t_barang SET barang_stok = barang_stok + {$jumlah} WHERE barang_id = {$barang}");

            break;
        }

      }

      return;
  }

  function all(){
    $this->update_barang();
  }

}