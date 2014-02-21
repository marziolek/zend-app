<?php

namespace Contacts\Model;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

class ContactsTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
    
    public function fetchAll($paginated = false, $user_id)
    {  
        if ($paginated) {
            $asd = new Select('contacts');
            $select = $asd->where(array('user_id' => $user_id));
            $resultSetPrototype = new ResultSet();
            $resultSetPrototype->setArrayObjectPrototype(new Contacts());
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

    public function getContacts($id, $user_id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('contact_id' => $id,'user_id' => $user_id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveContacts(Contacts $contacts,$user_id)
    {
      $data = array(
        'contact_id' => $contacts->contact_id,
        'created_at' => $contacts->created_at,
        'contact_name' => $contacts->contact_name,
        'contact_surname' => $contacts->contact_surname,
        'contact_street' => $contacts->contact_street,
        'contact_city' =>  $contacts->contact_city,
        'contact_postal_code' => $contacts->contact_postal_code,
        'contact_country' => $contacts->contact_country,
        'contact_description' =>  $contacts->contact_description,
        'contact_phone' => $contacts->contact_phone,
        'contact_phone2' => $contacts->contact_phone2,
        'contact_photo' => $contacts->contact_photo,
        'contact_email' => $contacts->contact_email,
        'contact_facebook' => $contacts->contact_facebook,
        'contact_google' => $contacts->contact_google,
        'user_id' => $contacts->user_id
      );

         $id = (int) $contacts->contact_id;
         if ($id == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getContacts($id,$user_id)) {
                 $this->tableGateway->update($data, array('contact_id' => $id,'user_id' => $user_id));
             } else {
                 throw new \Exception('Contacts id does not exist');
             }
         }
    }
    public function deleteContacts($id)
    {
        $this->tableGateway->delete(array('contact_id' => $id));
    }
    public function deleteAll($user_id)
    {
      $this->tableGateway->delete(array('user_id'=>$user_id));
    }
}
