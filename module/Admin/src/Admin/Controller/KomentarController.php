<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class KomentarController extends AbstractActionController
{

    public function indexAction()
    {
    	if (!$this->zfcUserAuthentication()->hasIdentity()) {
            return $this->redirect()->toRoute("zfcuser/login");
        }
        return new ViewModel();
    }

    public function getKomentarTable()
    {
         if (!$this->komentarTable){
             $sm = $this->getServiceLocator();
             $this->komentaget('Kamus\Model\KmentarTable');
         }
         return $this->istilahTable;
    }


}

