<?php

namespace Kamus\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


class IndexController extends AbstractActionController
{
	protected $istilahTable;

    public function indexAction()
    {
        $table = $this->getIstilahTable();
        $index = $this->params()->fromQuery('index'); //GET
        $search = $this->params()->fromQuery('search'); //GET

        if ($index != null) {
            $istilah = $table->getByIndex($index);
        } elseif ($search != null) {
            $istilah = $table->getBySearch($search);
            
        }

// print_r($istilah->count())
        return new ViewModel(array(
            'istilah' => $istilah
        ));
    }

    public function detailAction()
    {
        $id = $this->params()->fromRoute('id');
        $istilah = $this->getIstilahTable()->getIstilah($id);

        return new ViewModel(array(
            'istilah' => $istilah
        ));
    }

    public function loginAction()
    {
    	
    }

    public function getIstilahTable()
    {
         if (!$this->istilahTable) {
             $sm = $this->getServiceLocator();
             $this->istilahTable = $sm->get('Kamus\Model\IstilahTable');
         }
         return $this->istilahTable;
    }


}
