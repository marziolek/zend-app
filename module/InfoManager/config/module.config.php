<?php


return array(
  'controllers' => array(
    'invokables' => array(
      'InfoManager\Controller\Index' => 'InfoManager\Controller\IndexController',
    ),
  ),
  'router' => array(
    'routes' => array(
      'info-manager' => array(
        'type'    => 'segment',
        'options' => array(
          'route'    => '/info-manager[/][:action][/:name]',
          'constraints' => array(
            'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
            'name'     => '[a-zA-Z][a-zA-Z0-9_-]*',
          ),
          'defaults' => array(
            'controller' => 'InfoManager\Controller\Index',
            'action'     => 'index',
          ),
        ),
      ),
    ),
  ),
  'view_manager' => array(
    'template_path_stack' => array(
      'info-manager' => __DIR__ . '/../view',
    ),
  ),
);
