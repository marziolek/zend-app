<?php
namespace Contacts;

use Contacts\Model\Contacts;
use Contacts\Model\ContactsTable;
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
                 'Contacts\Model\ContactsTable' =>  function($sm) {
                     $tableGateway = $sm->get('ContactsTableGateway');
                     $table = new ContactsTable($tableGateway);
                     return $table;
                 },
                 'ContactsTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Contacts());
                     return new TableGateway('contacts', $dbAdapter, null, $resultSetPrototype);
                 },
             ),
         );
     }
}
