<?php 

class Server {
  protected $url;

  function __construct(){
        $this->url = &get_instance();
    }

    function online() {
      $target = 'https://bukacoding.my.id/demo/sispap/';
      return $target;
    }
    function offline() {
      $target = base_url();
      return $target;
    }
}