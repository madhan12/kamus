<?php 
namespace Admin\Form;

 use Zend\Form\Form;

 class IstilahForm extends Form
 {
     public function __construct($id = null)
     {
         // we want to ignore the name passed
         parent::__construct('istilah');

         $this->add(array(
             'name' => 'istilah',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Istilah',
             ),
         ));
        
         $this->add(array(
             'name' => 'arti',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Arti',
             ),
         ));
         
     }
 }