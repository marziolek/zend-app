<?php
return array(
  'controllers' => array(
    'invokables' => array(
      'Profile\Controller\Index' => 'Profile\Controller\IndexController',
    ),
  ),
  'router' => array(
    'routes' => array(
      'profile' => array(
        'type'    => 'segment',
        'options' => array(
          'route'    => '/profile[/][:action][/:name]',
          'constraints' => array(
            'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
            'name'     => '[a-zA-Z][a-zA-Z0-9_-]*',
          ),
          'defaults' => array(
            'controller' => 'Profile\Controller\Index',
            'action'     => 'index',
          ),
        ),
      ),
    ),
  ),
  'view_manager' => array(
    'template_path_stack' => array(
      'profile' => __DIR__ . '/../view',
    ),
  ),
);
