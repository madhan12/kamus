<?php 
namespace Kamus\Model;

 use Zend\Db\TableGateway\TableGateway;

 class IstilahTable
 {
     protected $tableGateway;

     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }

     public function fetchAll()
     {
         $resultSet = $this->tableGateway->select();
         return $resultSet;
     }

     public function getIstilah($id)
     {
         $id  = (int) $id;
         $rowset = $this->tableGateway->select(array('id' => $id));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $id");
         }
         return $row;
     }

     public function saveIstilah(Istilah $istilah)
     {
         $data = array(
            'istilah' => $istilah->istilah,
            'arti' => $istilah->arti,
            'hit' => $istilah->hit,
            'tanggal' => $istilah->tanggal,
            'update' => $istilah->update,
         );

         $id = (int) $istilah->id;
         if ($id == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getIstilah($id)) {
                 $this->tableGateway->update($data, array('id' => $id));
             } else {
                 throw new \Exception('Istilah id does not exist');
             }
         }
     }

     public function deleteIstilah($id)
     {
         $this->tableGateway->delete(array('id' => (int) $id));
     }
 }