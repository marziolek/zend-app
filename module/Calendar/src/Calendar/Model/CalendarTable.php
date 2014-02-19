<?php

namespace Calendar\Model;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Where;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

class CalendarTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
    
    public function fetchAll(/*$paginated = false,*/ $user_id)
    {  
       /* if ($paginated) {
            $asd = new Select('calendar');
            $select = $asd->where(array('user_id' => $user_id));
            //$select = new Select('calendar');
            $resultSetPrototype = new ResultSet();
            $resultSetPrototype->setArrayObjectPrototype(new Calendar());
            $paginatorAdapter = new DbSelect(
                $select,
                $this->tableGateway->getAdapter(),
                $resultSetPrototype
            );
            $paginator = new Paginator($paginatorAdapter);
            return $paginator;
       }*/

        $resultSet = $this->tableGateway->select((array('user_id' => $user_id)));
        return $resultSet;
    }

    public function getCalendar($date, $user_id)
    {
        $rowset = $this->tableGateway->select(array('created_at' => $date,'user_id' => $user_id));
    
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $date");
        }
        return $row;
    }

    public function saveCalendar(Calendar $calendar,$user_id)
    {
         $data = array(
            'event_title' => $calendar->event_title,
            'event_body'  => $calendar->event_body,
            'created_at'  => $calendar->created_at,
            'user_id' => $calendar->user_id,
         );

         $id = (int) $calendar->event_id;
         if ($id == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getCalendar($data['created_at'],$user_id)) {
                 $this->tableGateway->update($data, array('created_at' => $data['created_at'],'user_id' => $user_id));
             } else {
                 throw new \Exception('Calendar id does not exist');
             }
         }
    }
/*    public function deleteCalendar($date)
    {
        $this->tableGateway->delete(array('event_id' => $id));
    }*/
}
