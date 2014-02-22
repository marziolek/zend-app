<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Admin\Form\AdminForm;
use Admin\Form\AdminInputFilter;
use Admin\Model\Admin;
use Calendar\Model\Calendar;
use Contacts\Model\Contacts;
use Notes\Model\Notes;


class IndexController extends AbstractActionController
{
  protected $_notesTable;

  public function getNotesTable()
  {
    if (!$this->_notesTable) {
      $sm = $this->getServiceLocator();
      $this->_notesTable = $sm->get('Notes\Model\NotesTable');
    }
    return $this->_notesTable;
  }
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

  protected $_userTable;

  public function getAdminTable()
  {
    if (!$this->_userTable) {
      $sm = $this->getServiceLocator();
      $this->_userTable = $sm->get('Admin\Model\AdminTable');
    }
    return $this->_userTable;
  }

  public function indexAction()
  {
    if ($this->zfcUserAuthentication()->hasIdentity()) 
    {
      if ($this->zfcUserAuthentication()->getIdentity()->getId() != 2)
      {
        return $this->redirect()->toRoute('zfcuser');
      }
      else 
      {
        $paginator = $this->getAdminTable()->fetchAll(true);
        $paginator->setCurrentPageNumber((int) $this->params()->fromQuery('page', 1));
        $paginator->setItemCountPerPage(5);
        return new ViewModel(array(
          'paginator' => $paginator,
        ));
      }
    }
    else 
    {
      return $this->redirect()->toRoute('zfcuser');
    }
  }

  public function deleteAction()
  {
    if ($this->zfcUserAuthentication()->hasIdentity()) 
    {
      if ($this->zfcUserAuthentication()->getIdentity()->getId() != 2)
      {
        return $this->redirect()->toRoute('zfcuser');
      }
      else 
      {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
          return $this->redirect()->toRoute('admin');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
          $delete = $request->getPost('del', 'No');

          if ($id != 2) {
            if ($delete == 'Yes') {
              $id = (int) $request->getPost('user_id');
              $this->getCalendarTable()->deleteAll($id);
              $this->getContactsTable()->deleteAll($id);
              $this->getNotesTable()->deleteAll($id);
              $this->getAdminTable()->deleteAdmin($id);
            }
          } 

          return $this->redirect()->toRoute('admin');
        }

        return new ViewModel(array(
          'user_id'    => $id,
          'admin' => $this->getAdminTable()->getAdmin($id)
        ));
      }
    }
    else 
    {
      return $this->redirect()->toRoute('zfcuser');
    }
  }



}

