<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Guestbook\Controller\Index' => 'Guestbook\Controller\IndexController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'guestbook' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/guestbook[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Guestbook\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'guestbook' => __DIR__ . '/../view',
        ),
    ),

    'service_manager' => array(
        'factories' => array(
            'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
        ),
    ),

    'navigation' => array(
        'default' => array(
            array(
                'label' => 'Home',
                'route' => 'home',
            ),
            array(
               'label' => 'Guestbook',
               'route' => 'guestbook',
               'pages' => array(
                    array(
                        'label' => 'Add',
                        'route' => 'guestbook',
                        'action' => 'add',
                    ),
                    array(
                        'label' => 'Edit',
                        'route' => 'guestbook',
                        'action' => 'edit',
                    ),
                    array(
                        'label' => 'Delete',
                        'route' => 'guestbook',
                        'action' => 'delete',
                    ),
                ),
            ),
            array(
                'label' => 'Hello World',
                'route' => 'hello-world',
            ),
            array(
                'label' => 'Form Example',
                'route' => 'form-example',
            ),
        ),
    ),
);
