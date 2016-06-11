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
             //grab the paginator from the AlbumTable
         // $paginator = $this->getIstilahTable()->getByIndex(true);
         // // set the current page to what has been passed in query string, or to 1 if none set
         // $paginator->setCurrentPageNumber((int) $this->params()->fromQuery('page', 1));
         // // set the number of items per page to 10
         // $paginator->setItemCountPerPage(3);
         
         // return new ViewModel(array(
         // 'istilah' => $paginator
         // ));
        
        } elseif ($search != null) {
            $istilah = $table->getBySearch($search);       
        }
        
        return new ViewModel(array(
            'istilah' => $istilah
        ));
    }

    public function detailAction()
    {
        $id = $this->params()->fromRoute('id');
        $istilah = $this->getIstilahTable()->getIstilah($id);

        $this->getIstilahTable()->updateHit($istilah);

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
