<?php 
namespace Kamus\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

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
         $this->id      = (!empty($data['id'])) ? $data['id'] : null;
         $this->istilah = (!empty($data['istilah'])) ? $data['istilah'] : null;
         $this->arti    = (!empty($data['arti'])) ? $data['arti'] : null;
         $this->hit     = (!empty($data['hit'])) ? $data['hit'] : null;
         $this->tanggal = (!empty($data['tanggal'])) ? $data['tanggal'] : null;
         $this->update  = (!empty($data['update'])) ? $data['update'] : null;
         
    }

    // Add content to these methods:
     public function setInputFilter(InputFilterInterface $inputFilter)
     {
         throw new \Exception("Tidak Dapat Digunakan");
     }

     public function getInputFilter()
     {
         if (!$this->inputFilter) {
             $inputFilter = new InputFilter();

             $inputFilter->add(array(
                 'name'     => 'istilah',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 3,
                             'max'      => 32,
                         ),
                     ),
                 ),
             ));

             $inputFilter->add(array(
                 'name'     => 'arti',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                         ),
                     ),
                 ),
             ));

             $this->inputFilter = $inputFilter;
         }

         return $this->inputFilter;
     }
 }
