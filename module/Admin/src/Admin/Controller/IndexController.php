<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    protected $istilahTable;

    public function indexAction()
    {
    	if (!$this->zfcUserAuthentication()->hasIdentity()) {
            return $this->redirect()->toRoute("zfcuser/login");
        }
     

        return new ViewModel(array(
        	'istilah' => $this->getIstilahTable()->fetchAll()
    	));
    	
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

