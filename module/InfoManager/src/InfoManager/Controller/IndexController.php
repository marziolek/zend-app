<?php

namespace InfoManager\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
  protected $_contactsTable;

  public function getContactsTable()
  {
    if (!$this->_contactsTable) {
      $sm = $this->getServiceLocator();
      $this->_contactsTable = $sm->get('Contacts\Model\ContactsTable');
    }
    return $this->_contactsTable;
  }
  
  protected $_calendarTable;

  public function getCalendarTable()
  {
    if (!$this->_calendarTable) {
      $sm = $this->getServiceLocator();
      $this->_calendarTable = $sm->get('Calendar\Model\CalendarTable');
    }
    return $this->_calendarTable;
  }
  
  protected $_notesTable;

  public function getNotesTable()
  {
    if (!$this->_notesTable) {
      $sm = $this->getServiceLocator();
      $this->_notesTable = $sm->get('Notes\Model\NotesTable');
    }
    return $this->_notesTable;
  }



  
  public function indexAction()
  {
    $name = (string) $this->params()->fromRoute('name', '');


    if (!$this->zfcUserAuthentication()->hasIdentity())
    {
      return $this->redirect()->toRoute('zfcuser');
    }

    return new ViewModel(
      array(
        'name' => $name,
      )
    );
  }

}

