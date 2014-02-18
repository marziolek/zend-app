<?php
return array(
  'controllers' => array(
    'invokables' => array(
      'Calendar\Controller\Index' => 'Calendar\Controller\IndexController',
    ),
  ),
  'router' => array(
    'routes' => array(
      'calendar' => array(
        'type'    => 'segment',
        'options' => array(
          'route'    => '/calendar[/][:action][/:name]',
          'constraints' => array(
            'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
            'id'     => '[0-9]+',
          ),
          'defaults' => array(
            'controller' => 'Calendar\Controller\Index',
            'action'     => 'index',
          ),
        ),
      ),
    ),
  ),
  'view_manager' => array(
    'template_path_stack' => array(
      'calendar' => __DIR__ . '/../view',
    ),
  ),
);
