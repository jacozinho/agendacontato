<?php

return array(
     'controllers' => array(
         'invokables' => array(
             'Contato\Controller\Home' => 'Contato\Controller\HomeController',
         ),
     ),         
  

// The following section is new and should be added to your file
     'router' => array(
         'routes' => array(                         
             'home' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/[page/:page]',
                    'defaults' => array(
                        'controller' => 'Contato\Controller\Home',
                        'action'     => 'index',
                        'module'     => 'contato',
                    ),
                ),
            ),
             
         ),
     ),    
    
    #definir e gerenciar servicos
    'service_manager' => array(
        'factories' => array(
            'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
        ),
    ),
    
     'view_manager' => array(
        'display_not_found_reason'  => true,
        'display_exceptions'        => true,
        'doctype'                   => 'HTML5',
        'not_found_template'        => 'error/404',
        'exception_template'        => 'error/index',
        'template_map'              => array(
            'layout/layout'         => __DIR__ . '/../view/layout/layout.phtml',
            'contato/home/index'    => __DIR__ . '/../view/contato/home/index.phtml',
            'error/404'             => __DIR__ . '/../view/error/404.phtml',
            'error/index'           => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
     ),       
 );