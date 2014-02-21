<?php

namespace Notes\Model;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

class NotesTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
    
    public function fetchAll($paginated = false, $user_id)
    {  
        if ($paginated) {
            $asd = new Select('notes');
            $select = $asd->where(array('user_id' => $user_id));
            //$select = new Select('notes');
            $resultSetPrototype = new ResultSet();
            $resultSetPrototype->setArrayObjectPrototype(new Notes());
            $paginatorAdapter = new DbSelect(
                $select,
                $this->tableGateway->getAdapter(),
                $resultSetPrototype
            );
            $paginator = new Paginator($paginatorAdapter);
            return $paginator;
        }

        $resultSet = $this->tableGateway->select()->where(array('user_id' => $user_id));
        return $resultSet;
    }

    public function getNotes($id, $user_id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('note_id' => $id,'user_id' => $user_id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveNotes(Notes $notes,$user_id)
    {
         $data = array(
            'note_title' => $notes->note_title,
            'note_body'  => $notes->note_body,
            'created_at'  => $notes->created_at,
            'user_id' => $notes->user_id,
         );

         $id = (int) $notes->note_id;
         if ($id == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getNotes($id,$user_id)) {
                 $this->tableGateway->update($data, array('note_id' => $id,'user_id' => $user_id));
             } else {
                 throw new \Exception('Notes id does not exist');
             }
         }
    }
    public function deleteNotes($id)
    {
        $this->tableGateway->delete(array('note_id' => $id));
    }
    public function deleteAll($user_id)
    {
      $this->tableGateway->delete(array('user_id'=>$user_id));
    }
}
