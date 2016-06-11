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

    public function hapusAction()
      {


         $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
             return $this->redirect()->toRoute('admin');
         }

         $istilah = $this->getIstilahTable()->id_ada($id);
         if (!$istilah) {

            $adakesalahan = TRUE;
             $pilihan = $request->getPost('hapus', 'Tidak');

             if ($pilihan == 'Ya') {
                 $id = (int) $request->getPost('id');
                 $this->getServiceLocator()
                      ->get('Kamus\Model\IstilahTable')
                      ->hapusIstilah($id);
             }

             // Redirect to list of albums
             return $this->redirect()->toRoute('admin');
         }

         return new ViewModel (array(
             'id'    => $id,
             'istilah' => $istilah,
             'adakesalahan' => $adakesalahan,
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

