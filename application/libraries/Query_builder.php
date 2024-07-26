 <?php
class Query_builder{ 
  protected $sql;
  function __construct(){
        $this->sql = &get_instance();
    }
  function login($table,$email,$pass){
   return $this->sql->db->query("SELECT * FROM $table WHERE user_email = '$email' AND user_password = '$pass'")->result_array();
  }
  function view($query){  
    return
    $this->sql->db->query($query)->result_array();
  }
  function view_row($query){ 
    return 
    $this->sql->db->query($query)->row_array();
  }
  function count($query){ 
    return
    $this->sql->db->query($query)->num_rows();
  }
  function add($table,$set){
    $this->sql->db->set($set);

    if ($this->sql->db->insert($table)) {
      $db = 1;
    } else {
      $db = 0;
    }
    
    return $db;
  }
  function update($table,$set,$where){
    $this->sql->db->set($set);
    $this->sql->db->where($where);

    if ($this->sql->db->update($table)) {
      $db = 1;
    } else {
      $db = 0;
    }

    return $db;
  }
  function delete($table,$where){
    $this->sql->db->where($where);

    if ($this->sql->db->delete($table)) {
      $db = 1;
    } else {
      $db = 0;
    }

    return $db;
  }
}