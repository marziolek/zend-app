<?php

namespace Calendar\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Calendar\Form\CalendarForm;
use Calendar\Form\CalendarInputFilter;
use Calendar\Model\Calendar;

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
      $user_id = $this->userId();
      $records = $this->getCalendarTable()->fetchAll($user_id);
      /*$paginator = $this->getCalendarTable()->fetchAll(true,$user_id);
      $paginator->setCurrentPageNumber((int) $this->params()->fromQuery('page', 1));
      $paginator->setItemCountPerPage(5);*/
      $today = date('Y-m-j');

      $monthsBackward = 0;
      $monthsForward = 0;
      if ((int) $this->params()->fromQuery('b'))
      {
        $monthsBackward = (int) $this->params()->fromQuery('b');
        $monthsBackward++;
      } elseif ((int) $this->params()->fromQuery('f'))
      {
        $monthsForward = (int) $this->params()->fromQuery('f');
        $monthsForward++;
      }
        $backward = -1-$monthsBackward.' months';
        $forward = 1+$monthsForward.' months';
        $tenDaysBack = strtotime($backward);
        $endTime = strtotime($forward);
       var_dump($backward); 
       var_dump($forward); 
      $calendar = array();
      while($tenDaysBack <= $endTime)
      {
        $thisDate = date('Y-m-d', $tenDaysBack);
        $thisDay = date('d', $tenDaysBack);
        $thisMonth = date('M', $tenDaysBack);
        $thisYear = date('Y', $tenDaysBack);
        array_push($calendar, array($thisDay,$thisMonth,$thisYear));

        $tenDaysBack = strtotime('+1 day', $tenDaysBack); // increment for loop
      }

      return new ViewModel(
        array(
          'back' => $monthsBackward,
          'forward' => $monthsForward,
          'calendar' => $calendar,
          'records' => $records,
          //'paginator' => $paginator,
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
    $date = $this->params()->fromRoute('date');
    if (!$date) {
      return $this->redirect()->toRoute('calendar');
    }
    $form->get('created_at')->setValue($date);
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
    return new ViewModel(array(
      'date' => $date,
      'form' => $form,
    ));
  }

  public function editAction()
  {
    $date = $this->params()->fromRoute('date',0);
    if (!$date) {
      return $this->redirect()->toRoute('calendar');
    }
    $user_id = $this->userId();
    $calendar = $this->getCalendarTable()->getCalendar($date,$user_id);

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
          'date' => $date,
          'form' => $form,
        ));
      }

      return $this->redirect()->toRoute('calendar');
    }

    return new ViewModel(array(
      'date' => $date,
      'form' => $form,
    ));
  }

/*  public function deleteAction()
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
 */
}
