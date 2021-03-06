<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

return array(
     'module_layouts' => array(
        'Admin' => 'layout/admin',
        'Kamus' => 'layout/kamus'
        ),
     
    'router' => array(
        'routes' => array(
           
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'home' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/[:action[/:id]]',
                    'defaults' => array(
                        'controller' => 'Kamus\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),

            'komentar' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/komentar[/:action[/:id]]',
                    'defaults' => array(
                        'controller' => 'Kamus\Controller\Komentar',
                        'action'     => 'index',
                    ),
                ),
            ),

            'kamus' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Kamus\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/kamus[/:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
           
        ),
        'factories' => array(
          
        ),
    ),
    
    'controllers' => array(
        'invokables' => array(
            'Kamus\Controller\Index' => "Kamus\Controller\IndexController",
            'Kamus\Controller\Komentar' => "Kamus\Controller\KomentarController"
            
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
                'getLatestIstilah'  => 'Kamus\View\Helper\LatestIstilah',
                'getIstilahPopuler' => 'Kamus\View\Helper\IstilahPopuler',
                'getTotalIstilah'   => 'Kamus\View\Helper\TotalIstilah',
            ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
        	'layout/kamus'        => __DIR__ . '/../view/layout/layout.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
);
