<?php
namespace Calendar;

use Calendar\Model\Calendar;
use Calendar\Model\CalendarTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    public function getServiceConfig()
    {
      return array(
        'factories' => array(
          'Calendar\Model\CalendarTable' =>  function($sm) {
            $tableGateway = $sm->get('CalendarTableGateway');
            $table = new CalendarTable($tableGateway);
            return $table;
          },
            'CalendarTableGateway' => function ($sm) {
              $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
              $resultSetPrototype = new ResultSet();
              $resultSetPrototype->setArrayObjectPrototype(new Calendar());
              return new TableGateway('calendar', $dbAdapter, null, $resultSetPrototype);
            },
            ),
          );
    }

}
