<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Kamus\Model\Istilah;          // <-- Add this import
use Admin\Form\IstilahForm; 

class IstilahController extends AbstractActionController
{

	protected $istilahTable;

    public function indexAction()
    {
    	if (!$this->zfcUserAuthentication()->hasIdentity()) {
            return $this->redirect()->toRoute("zfcuser/login");
        }

        $form = new IstilahForm();
    	$request = $this->getRequest();
    	 if ($request->isPost()) {
         	 $istilah = new Istilah();
             $form->setInputFilter($istilah->getInputFilter());
             $form->setData($request->getPost());
             if ($form->isValid()) {
                 $istilah->exchangeArray($form->getData());
                $this->getIstilahTable()->saveIstilah($istilah);
                 // Redirect to list of albums
                return $this->redirect()->toRoute('admin/istilah');
             } 
         }

        return array('form' => $form);
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

