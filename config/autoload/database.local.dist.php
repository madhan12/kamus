<?php
return array(
    'db' => array(
        'driver'    => 'PdoMysql',
        'hostname'  => 'localhost',
        'database'  => '',
        'username'  => '',
        'password'  => '',
    ),
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
        ),
    ),
);