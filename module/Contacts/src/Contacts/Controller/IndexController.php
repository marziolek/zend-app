<?php

namespace Contacts\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Contacts\Form\ContactsForm;
use Contacts\Form\ContactsInputFilter;
use Contacts\Model\Contacts;


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

  public function indexAction()
  {   
    if (!$this->zfcUserAuthentication()->hasIdentity())
    {
      return $this->redirect()->toRoute('zfcuser');
    }
    else 
    {
      $user_id = $this->zfcUserAuthentication()->getIdentity()->getId();
      $paginator = $this->getContactsTable()->fetchAll(true,$user_id);
      $paginator->setCurrentPageNumber((int) $this->params()->fromQuery('page', 1));
      $paginator->setItemCountPerPage(5);

      return new ViewModel(array(
        'paginator' => $paginator,
      ));
    }
  }
  
  public function userId() 
  {
     if ($this->zfcUserAuthentication()->hasIdentity())
     {
        $user_id = $this->zfcUserAuthentication()->getIdentity()->getId();
     }
     return $user_id;
  }

  public function addAction()
  {
    $user_id = $this->userId();
    $form = new ContactsForm();
    $form->get('user_id')->setValue($user_id); 
    $form->get('submit')->setValue('Add');

    $request = $this->getRequest();
    if ($request->isPost()) {
      $contacts = new Contacts();
      $form->setInputFilter(new contactsInputFilter());
      $form->setData($request->getPost());
      if ($form->isValid()) {
        $contacts->exchangeArray($form->getData());
        $this->getContactsTable()->saveContacts($contacts,$user_id);
        return $this->redirect()->toRoute('contacts');
      }
    }
    return new ViewModel(array('form' => $form));
  }

  public function editAction()
  {
    $id = (int) $this->params()->fromRoute('id', 0);
    if (!$id) {
      return $this->redirect()->toRoute('contacts', array(
        'action' => 'add'
      ));
    }
    $user_id = $this->userId();
    $contacts = $this->getContactsTable()->getContacts($id,$user_id);

    $form = new ContactsForm();
    $form->bind($contacts);
    $form->get('submit')->setValue('Update');

    $request = $this->getRequest();
    if ($request->isPost()) {
      $form->setInputFilter(new contactsInputFilter());
      $form->setData($request->getPost());

      if ($form->isValid()) {
        $this->getContactsTable()->saveContacts($form->getData(),$user_id);
      } else {
        return new ViewModel(array(
          'id' => $id,
          'form' => $form,
        ));
      }

      return $this->redirect()->toRoute('contacts');
    }

    return new ViewModel(array(
      'id' => $id,
      'form' => $form,
    ));
  }

  public function deleteAction()
  {
    $id = (int) $this->params()->fromRoute('id', 0);
    if (!$id) {
      return $this->redirect()->toRoute('contacts');
    }

    $request = $this->getRequest();
    if ($request->isPost()) {
      $delete = $request->getPost('del', 'No');

      if ($delete == 'Yes') {
        $id = (int) $request->getPost('id');
        $this->getContactsTable()->deleteContacts($id);
      }

      return $this->redirect()->toRoute('contacts');
    }
    $user_id = $this->userId();

    return new ViewModel(array(
      'id'    => $id,
      'contacts' => $this->getContactsTable()->getContacts($id,$user_id)
    ));
  }


}
