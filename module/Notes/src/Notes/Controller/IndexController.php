<?php

namespace Notes\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Notes\Form\NotesForm;
use Notes\Form\NotesInputFilter;
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

  public function indexAction()
  {   
    if (!$this->zfcUserAuthentication()->hasIdentity())
    {
      return $this->redirect()->toRoute('zfcuser');
    }
    else 
    {
      $user_id = $this->userId();
      $paginator = $this->getNotesTable()->fetchAll(true,$user_id);
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
    $form = new NotesForm();
    $form->get('user_id')->setValue($user_id); 
    $form->get('submit')->setValue('Add');

    $request = $this->getRequest();
    if ($request->isPost()) {
      $notes = new Notes();
      $form->setInputFilter(new notesInputFilter());
      $form->setData($request->getPost());
      if ($form->isValid()) {
        $notes->exchangeArray($form->getData());
        $this->getNotesTable()->saveNotes($notes,$user_id);
        return $this->redirect()->toRoute('notes');
      }
    }
    return new ViewModel(array('form' => $form));
  }

  public function editAction()
  {
    $id = (int) $this->params()->fromRoute('id', 0);
    if (!$id) {
      return $this->redirect()->toRoute('notes', array(
        'action' => 'add'
      ));
    }
    $user_id = $this->userId();
    $notes = $this->getNotesTable()->getNotes($id,$user_id);

    $form = new NotesForm();
    $form->bind($notes);
    $form->get('submit')->setValue('Update');

    $request = $this->getRequest();
    if ($request->isPost()) {
      $form->setInputFilter(new notesInputFilter());
      $form->setData($request->getPost());

      if ($form->isValid()) {
        $this->getNotesTable()->saveNotes($form->getData(),$user_id);
      } else {
        return new ViewModel(array(
          'id' => $id,
          'form' => $form,
        ));
      }

      return $this->redirect()->toRoute('notes');
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
      return $this->redirect()->toRoute('notes');
    }

    $request = $this->getRequest();
    if ($request->isPost()) {
      $delete = $request->getPost('del', 'No');

      if ($delete == 'Yes') {
        $id = (int) $request->getPost('id');
        $this->getNotesTable()->deleteNotes($id);
      }

      return $this->redirect()->toRoute('notes');
    }
    $user_id = $this->userId();

    return new ViewModel(array(
      'id'    => $id,
      'notes' => $this->getNotesTable()->getNotes($id,$user_id)
    ));
  }


}
