<?php
return array(
'module_layouts' => array(
        'Admin' => 'layout/admin',
        'Kamus' => 'layout/kamus'
        ),

'router' => array(
        'routes' => array(
            'admin' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/admin',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '[/:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
 					'istilah' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/istilah[/:action]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            	 'controller'    => 'Istilah',
                        		 'action'        => 'index',
                            ),
                        ),
                    ),


 					'komentar' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/komentar[/:action]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            	 'controller'    => 'Komentar',
                        		 'action'        => 'index',
                            ),
                        ),
                    ),

                ),
            ),
        ),
    ),
	
	'controllers' => array(
        'invokables' => array(
            'Admin\Controller\Index' => "Admin\Controller\IndexController",
            'Admin\Controller\Istilah' => "Admin\Controller\IstilahController",
            'Admin\Controller\Komentar' => "Admin\Controller\KomentarController"
        ),
    ),
    
	  'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
           'layout/admin'           => __DIR__ . '/../view/layout/layout.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),

);
