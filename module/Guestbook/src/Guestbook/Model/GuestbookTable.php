<?php

namespace Guestbook\Model;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

class GuestbookTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll($paginated = false)
    {
        if ($paginated) {
            $select = new Select('infomanager');
            $resultSetPrototype = new ResultSet();
            $resultSetPrototype->setArrayObjectPrototype(new Guestbook());
            $paginatorAdapter = new DbSelect(
                $select,
                $this->tableGateway->getAdapter(),
                $resultSetPrototype
            );
            $paginator = new Paginator($paginatorAdapter);
            return $paginator;
        }

        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getGuestbook($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveGuestbook(Guestbook $guestbook)
    {
         $data = array(
            'nick' => $guestbook->nick,
            'comment'  => $guestbook->comment,
            'is_active'  => $guestbook->is_active,
            'created_at'  => $guestbook->created_at,
         );

         $id = (int) $guestbook->id;
         if ($id == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getGuestbook($id)) {
                 $this->tableGateway->update($data, array('id' => $id));
             } else {
                 throw new \Exception('Guestbook id does not exist');
             }
         }
    }
    public function deleteGuestbook($id)
    {
        $this->tableGateway->delete(array('id' => $id));
    }
}
