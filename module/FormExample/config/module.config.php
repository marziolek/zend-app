<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'FormExample\Controller\Index' => 'FormExample\Controller\IndexController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'form-example' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/form-example[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'FormExample\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'album' => __DIR__ . '/../view', #powinno być FormExample
        ),
    ),
);
