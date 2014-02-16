<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Notes\Controller\Index' => 'Notes\Controller\IndexController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'notes' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/notes[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Notes\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'notes' => __DIR__ . '/../view',
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
               'label' => 'Notes',
               'route' => 'notes',
               'pages' => array(
                    array(
                        'label' => 'Add',
                        'route' => 'notes',
                        'action' => 'add',
                    ),
                    array(
                        'label' => 'Edit',
                        'route' => 'notes',
                        'action' => 'edit',
                    ),
                    array(
                        'label' => 'Delete',
                        'route' => 'notes',
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
