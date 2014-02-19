<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Contacts\Controller\Index' => 'Contacts\Controller\IndexController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'contacts' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/contacts[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Contacts\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'contacts' => __DIR__ . '/../view',
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
               'label' => 'Contacts',
               'route' => 'contacts',
               'pages' => array(
                    array(
                        'label' => 'Add',
                        'route' => 'contacts',
                        'action' => 'add',
                    ),
                    array(
                        'label' => 'Edit',
                        'route' => 'contacts',
                        'action' => 'edit',
                    ),
                    array(
                        'label' => 'Delete',
                        'route' => 'contacts',
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
