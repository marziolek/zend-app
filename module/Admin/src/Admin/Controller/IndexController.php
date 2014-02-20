<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Admin\Form\AdminForm;
use Admin\Form\AdminInputFilter;
use Admin\Model\Admin;

class IndexController extends AbstractActionController
{

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

    $paginator = $this->getAdminTable()->fetchAll(true);
    $paginator->setCurrentPageNumber((int) $this->params()->fromQuery('page', 1));
    $paginator->setItemCountPerPage(5);
    return new ViewModel(array(
      'paginator' => $paginator,
    ));
  }
  public function addAction()
  {
    $form = new AdminForm();
    $form->get('submit')->setValue('Add');

    $request = $this->getRequest();
    if ($request->isPost()) {
      $admin = new Admin();
      $form->setInputFilter(new adminInputFilter());
      $form->setData($request->getPost());
        //var_dump($form);
      if ($form->isValid()) {
        $admin->exchangeArray($form->getData());
        $this->getAdminTable()->saveAdmin($admin);
        return $this->redirect()->toRoute('admin');
      }
    }
    return new ViewModel(array('form' => $form));
  }

 /* public function editAction()
  {
    $id = (int) $this->params()->fromRoute('id', 0);
    if (!$id) {
      return $this->redirect()->toRoute('admin', array(
        'action' => 'add'
      ));
    }
    $admin = $this->getAdminTable()->getAdmin($id);
    $form = new AdminForm();
    $form->bind($admin);
    $form->get('submit')->setValue('Update');

    $request = $this->getRequest();
    if ($request->isPost()) {
      $form->setInputFilter(new adminInputFilter());
      $form->setData($request->getPost());

      if ($form->isValid()) {
        $this->getAdminTable()->saveAdmin($form->getData());
      } else {
        var_dump($this->getAdminTable()->saveAdmin($form->getData()));
        return new ViewModel(array(
          'user_id' => $id,
          'form' => $form,
        ));
      }

      return $this->redirect()->toRoute('admin');

      return new ViewModel(array(
        'user_id' => $id,
        'form' => $form,
      ));
    }

      return new ViewModel(array(
        'user_id' => $id,
        'form' => $form,
      ));
  }
  */
  public function deleteAction()
  {
    $id = (int) $this->params()->fromRoute('id', 0);
    if (!$id) {
      return $this->redirect()->toRoute('admin');
    }

    $request = $this->getRequest();
    if ($request->isPost()) {
      $delete = $request->getPost('del', 'No');

      if ($delete == 'Yes') {
        $id = (int) $request->getPost('user_id');
        $this->getAdminTable()->deleteAdmin($id);
      }

      return $this->redirect()->toRoute('admin');
    }

    return new ViewModel(array(
      'user_id'    => $id,
      'admin' => $this->getAdminTable()->getAdmin($id)
    ));
  }



}

