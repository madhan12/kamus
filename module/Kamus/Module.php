<?php
namespace Kamus;

// Add these import statements:
use Kamus\Model\Istilah;
use Kamus\Model\IstilahTable;
use Kamus\Model\Komentar;
use Kamus\Model\KomentarTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    // Add this method:
    public function getServiceConfig()
    {
         return array(
             'factories' => array(
                'IstilahTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Istilah());
                     return new TableGateway('istilah', $dbAdapter, null, $resultSetPrototype);
                 },
                 'Kamus\Model\IstilahTable' =>  function($sm) {
                     $tableGateway = $sm->get('IstilahTableGateway');
                     $table = new IstilahTable($tableGateway);
                     return $table;
                 },
                 
                 'KomentarTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Komentar());
                     return new TableGateway('komentar', $dbAdapter, null, $resultSetPrototype);
                 },
                 'Kamus\Model\KomentarTable' =>  function($sm) {
                     $tableGateway = $sm->get('KomentarTableGateway');
                     $table = new KomentarTable($tableGateway);
                     return $table;
                 },
                 
             ),
         );
     }
}
