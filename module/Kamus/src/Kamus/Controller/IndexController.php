<?php

namespace Kamus\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


class IndexController extends AbstractActionController
{
	protected $istilahTable;

    public function indexAction()
    {
    	
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
