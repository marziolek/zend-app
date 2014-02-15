<?php

namespace Guestbook\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Guestbook\Form\GuestbookForm;
use Guestbook\Form\GuestbookInputFilter;
use Guestbook\Model\Guestbook;


class IndexController extends AbstractActionController
{

    protected $_guestbookTable;

    public function getGuestbookTable()
    {
        if (!$this->_guestbookTable) {
            $sm = $this->getServiceLocator();
            $this->_guestbookTable = $sm->get('Guestbook\Model\GuestbookTable');
        }
        return $this->_guestbookTable;
    }

    public function indexAction()
    {   
        $paginator = $this->getGuestbookTable()->fetchAll(true);
        $paginator->setCurrentPageNumber((int) $this->params()->fromQuery('page', 1));
        $paginator->setItemCountPerPage(5);

        return new ViewModel(array(
            'paginator' => $paginator,
        ));
    }

    public function addAction()
    {
        $form = new GuestbookForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $guestbook = new Guestbook();
            $form->setInputFilter(new guestbookInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $guestbook->exchangeArray($form->getData());
                $this->getGuestbookTable()->saveGuestbook($guestbook);
                return $this->redirect()->toRoute('guestbook');
            }
        }
        return new ViewModel(array('form' => $form));
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('guestbook', array(
                'action' => 'add'
            ));
        }
        $guestbook = $this->getGuestbookTable()->getGuestbook($id);

        $form = new GuestbookForm();
        $form->bind($guestbook);
        $form->get('submit')->setValue('Update');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter(new guestbookInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getGuestbookTable()->saveGuestbook($form->getData());
            } else {
                return new ViewModel(array(
                    'id' => $id,
                    'form' => $form,
                ));
            }

            return $this->redirect()->toRoute('guestbook');
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
            return $this->redirect()->toRoute('guestbook');
        }
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $delete = $request->getPost('del', 'No');

            if ($delete == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->getGuestbookTable()->deleteGuestbook($id);
            }

            return $this->redirect()->toRoute('guestbook');
        }

        return new ViewModel(array(
            'id'    => $id,
            'guestbook' => $this->getGuestbookTable()->getGuestbook($id)
        ));
    }


}
