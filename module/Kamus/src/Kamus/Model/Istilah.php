<?php 
namespace Kamus\Model;

 class Istilah
 {
     public $id;
     public $istilah;
     public $arti;
     public $hit;
     public $tanggal;
     public $update;

     public function exchangeArray($data)
     {
         $this->id     = (!empty($data['id'])) ? $data['id'] : null;
         $this->istilah = (!empty($data['istilah'])) ? $data['istilah'] : null;
         $this->arti  = (!empty($data['arti'])) ? $data['arti'] : null;
         $this->hit  = (!empty($data['hit'])) ? $data['hit'] : null;
         $this->tanggal  = (!empty($data['tanggal'])) ? $data['tanggal'] : null;
         $this->update  = (!empty($data['update'])) ? $data['update'] : null;
         
    }
    
 }
