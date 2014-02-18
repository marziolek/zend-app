<?php

namespace Calendar\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Calendar\Form\CalendarForm;
use Calendar\Form\CalendarInputFilter;
use Calendar\Model\Calendar;
use BmCalendar\Renderer\HtmlCalendar;
use BmCalendar\DayProviderInterface; 
use BmCalendar\Day; 
use BmCalendar\Month;

class IndexController extends AbstractActionController
{
  protected $_calendarTable;

  public function getCalendarTable()
  {
    if (!$this->_calendarTable) {
      $sm = $this->getServiceLocator();
      $this->_calendarTable = $sm->get('Calendar\Model\CalendarTable');
    }
    return $this->_calendarTable;
  }

  public function indexAction()
  {

    if (!$this->zfcUserAuthentication()->hasIdentity())
    {
      return $this->redirect()->toRoute('zfcuser');
    }
    else 
    {

      $name = (string) $this->params()->fromRoute('name', '');
      $year = date('Y');
      $current_month = date('n');

      return new ViewModel(
        array(
          'name' => $name,
          'year' => $year,
          'month' => $current_month,
        )
      );
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
    $form = new CalendarForm();
    $form->get('user_id')->setValue($user_id);
    $form->get('submit')->setValue('Add');

    $request = $this->getRequest();
    if ($request->isPost()) {
      $calendar = new Calendar();
      $form->setInputFilter(new calendarInputFilter());
      $form->setData($request->getPost());
      if ($form->isValid()) {
        $calendar->exchangeArray($form->getData());
        $this->getCalendarTable()->saveCalendar($calendar,$user_id);
        return $this->redirect()->toRoute('calendar');
      }
    }
    return new ViewModel(array('form' => $form));
  }

  public function editAction()
  {
    $id = (int) $this->params()->fromRoute('id', 0);
    if (!$id) {
      return $this->redirect()->toRoute('calendar', array(
        'action' => 'add'
      ));
    }
    $user_id = $this->userId();
    $calendar = $this->getCalendarTable()->getCalendar($id,$user_id);

    $form = new CalendarForm();
    $form->bind($calendar);
    $form->get('submit')->setValue('Update');

    $request = $this->getRequest();
    if ($request->isPost()) {
      $form->setInputFilter(new calendarInputFilter());
      $form->setData($request->getPost());

      if ($form->isValid()) {
        $this->getCalendarTable()->saveCalendar($form->getData(),$user_id);
      } else {
        return new ViewModel(array(
          'id' => $id,
          'form' => $form,
        ));
      }

      return $this->redirect()->toRoute('calendar');
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
      return $this->redirect()->toRoute('calendar');
    }

    $request = $this->getRequest();
    if ($request->isPost()) {
      $delete = $request->getPost('del', 'No');

      if ($delete == 'Yes') {
        $id = (int) $request->getPost('id');
        $this->getCalendarTable()->deleteCalendar($id);
      }

      return $this->redirect()->toRoute('calendar');
    }
    $user_id = $this->userId();

    return new ViewModel(array(
      'id'    => $id,
      'calendar' => $this->getCalendarTable()->getCalendar($id,$user_id)
    ));
  }

}

