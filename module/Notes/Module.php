<?php
namespace Notes;

use Notes\Model\Notes;
use Notes\Model\NotesTable;
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
                 'Notes\Model\NotesTable' =>  function($sm) {
                     $tableGateway = $sm->get('NotesTableGateway');
                     $table = new NotesTable($tableGateway);
                     return $table;
                 },
                 'NotesTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Notes());
                     return new TableGateway('notes', $dbAdapter, null, $resultSetPrototype);
                 },
             ),
         );
     }
}
