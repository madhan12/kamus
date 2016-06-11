<?php 
namespace Kamus\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql;
use Zend\Db\ResultSet\ResultSet;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;


class IstilahTable 
{
     protected $tableGateway;
     public $halaman = FALSE;

     public function __construct(TableGateway $tableGateway)
    {
         $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
         // if ($halaman) {
         //     // create a new Select object for the table album
         //     $select = new Sql\Select('istilah');
         //     // create a new result set based on the Album entity
         //     $resultSetPrototype = new ResultSet();
         //     $resultSetPrototype->setArrayObjectPrototype(new Istilah());
         //     // create a new pagination adapter object
         //     $adapterHalaman = new DbSelect(
         //         // our configured select object
         //         $select,
         //         // the adapter to run it against
         //         $this->tableGateway->getAdapter(),
         //         // the result set to hydrate
         //         $resultSetPrototype
         //     );
         //     $paginator = new Paginator($adapterHalaman);
         //     return $paginator;
         // }
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
            'arti'    => $istilah->arti,
            'hit'     => $istilah->hit,
            'tanggal' => $istilah->tanggal,
            'update'  => $istilah->update,
         );

         if (is_null($data['tanggal'])) {
            $data['tanggal'] = date('Y-m-d H:i:s');
        } 

         $id = (int) $istilah->id;
         if ($id == 0) {
             $data['arti'] = htmlspecialchars($data['arti']);
             $this->tableGateway->insert($data);
        } else {
             if ($this->getIstilah($id)) {
                 $this->tableGateway->update($data, array('id' => $id));
             } else {
                 throw new \Exception('Istilah id does not exist');
            }
        }
    }

    public function getByIndex($index)
    {
        $index = strtolower($index);
        $sql = new Sql\Sql($this->tableGateway->getAdapter());
        $select = $sql->select();
        $select->from($this->tableGateway->getTable());
        $select->columns(array('*'))->where->like('istilah.istilah', $index . '%');
        $selectString = $sql->buildSqlString($select);
        $statement = $sql->prepareStatementForSqlObject($select);
        return $statement->execute();
 
         if ($halaman) {
             // create a new Select object for the table album
             $select = new Sql\Select('istilah');
             // create a new result set based on the Album entity
             $resultSetPrototype = new ResultSet();
             $resultSetPrototype->setArrayObjectPrototype(new Istilah());
             // create a new pagination adapter object
             $adapterPerhalaman = new DbSelect(
                 // our configured select object
                 $select,
                 // the adapter to run it against
                 $this->tableGateway->getAdapter(),
                 // the result set to hydrate
                 $resultSetPrototype
             );
             $paginator = new Paginator($adapterPerhalaman);
             return $paginator;
         }
    }

     public function getBySearch($search)
    {
        $search = strtolower($search);
        $sql = new Sql\Sql($this->tableGateway->getAdapter());
        $select = $sql->select();
        $select->from($this->tableGateway->getTable());
        $select->columns(array('*'))->where->like('istilah.istilah', '%' . $search . '%');
        $selectString = $sql->buildSqlString($select);
        $statement = $sql->prepareStatementForSqlObject($select);
        return $statement->execute();
    }

    public function hapusIstilah($id)
    {
         $this->tableGateway->delete(array('id' => $id));
    }

    public function updateHit(Istilah $istilah)
    {
        $istilah->hit += 1;
        $this->saveIstilah($istilah);
    }

    public function getLatest($limit)
    {
        $rowset = $this->tableGateway->select(function (Sql\Select $select) use ($limit) {
            $select->columns(array('id','istilah'));
            $select->order('tanggal DESC');
            $select->limit($limit);
        });
        return $rowset;
    }

    public function getPopuler($limit)
    {

        $rowset = $this->tableGateway->select(function (Sql\Select $select) use ($limit) {
            $select->columns(array('id','istilah'));
            $select->order('hit DESC');
            $select->limit($limit);   
        });
        return $rowset;
    }

    public function getTotal()
    {
         $select= new Sql\Select('istilah');
        // $select = 
        $select->columns(array(
                "total" => new \Zend\Db\Sql\Expression("COUNT(*)")
            )); 

        // return $select;

        $adapter = $this->tableGateway->getAdapter();
        $sql = new Sql\Sql($adapter);
        $statement = $sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        return $results->current()['total'];
    }

}