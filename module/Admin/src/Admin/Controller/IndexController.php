<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{

    public function indexAction()
    {
    	if (!$this->zfcUserAuthentication()->hasIdentity()) {
            return $this->redirect()->toRoute("zfcuser/login");
        }
     

        return new ViewModel();
    }


}

