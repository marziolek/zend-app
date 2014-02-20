<?php

namespace Admin\Model;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

class AdminTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
    
    public function fetchAll($paginated = false)
    {  
        if ($paginated) {
            $select = new Select('user');
            $resultSetPrototype = new ResultSet();
            $resultSetPrototype->setArrayObjectPrototype(new Admin());
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


    public function getAdmin($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('user_id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveAdmin(Admin $admin)
    {
         $data = array(
            'username' => $admin->username,
            'email'  => $admin->email,
//            'password'  => $admin->password,
            'display_name' => $admin->display_name,
            'user_id' => $admin->user_id
         );

         $id = (int) $admin->user_id;
         var_dump($id);
         if ($id == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getAdmin($id)) {
                 $this->tableGateway->update($data, array('user_id' => $id));
             } else {
                 throw new \Exception('Admin id does not exist');
             }
         }
    }
    public function deleteAdmin($id)
    {
        $this->tableGateway->delete(array('user_id' => $id));
    }
}
