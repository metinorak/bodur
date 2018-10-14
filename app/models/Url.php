<?php
  class Url{
    private $db;

    public function __construct(){
      $this->db = new Database;
    }
    
    public function addUrl($url){
      $code = $this->generateCode($url);

      $this->db->query('INSERT INTO urls(url, code) VALUES(:url, :code)');

      // Bind the values
      $this->db->bind(':url', $url);
      $this->db->bind(':code', $code);

      if($this->db->execute()){
        return $code;
      }
      return false;
    }


    public function getUrl($code){
      $this->db->query('SELECT * FROM urls WHERE code = :code');

      // Bind the values
      $this->db->bind(':code', $code);

      return $this->db->single();
    }

    private function generateCode($url){
      do{
        $code = substr(hash("ripemd128", $url . time()), 0, 6);
      }while($this->isThereThisCode($code));

      return $code;
    }

    private function isThereThisCode($code){
      $this->db->query('SELECT * FROM urls WHERE code = :code');

      // Bind the values
      $this->db->bind(':code', $code);

      $this->db->execute();

      return $this->db->rowCount();
    }

    public function isThereThisUrl($url){
      $this->db->query('SELECT * FROM urls WHERE url = :url');

      // Bind the values
      $this->db->bind(':url', $url);

      $this->db->execute();

      return $this->db->rowCount();
    }

    public function getCode($url){
      $this->db->query('SELECT * FROM urls WHERE url = :url');

      // Bind the values
      $this->db->bind(':url', $url);

      return $this->db->single();
    }

  }