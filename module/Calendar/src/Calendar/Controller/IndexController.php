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
      $today = date('Y-m-j');
      $months =  $this->params()->fromRoute('date',0);
          
        preg_match('/(\d*).(\d*)/', $months, $matches);

      $monthsBackward = $matches[1];
      $monthsForward= $matches[2];
      
      $back=$monthsBackward+1;
      $BF=$back.'-'.$monthsForward;

      $forw=$monthsForward+1;
      $FB=$monthsBackward.'-'.$forw;

        $backward = -1-$monthsBackward.' months';
        $forward = 1+$monthsForward.' months';
        $tenDaysBack = strtotime($backward);
        $endTime = strtotime($forward);
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
          'backward' => $BF,
          'forward' => $FB,
          'calendar' => $calendar,
          'records' => $records,
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

  public function monthsAction() 
  {
    if (!$this->zfcUserAuthentication()->hasIdentity())
    {
      return $this->redirect()->toRoute('zfcuser');
    }
    else 
    {
      $user_id = $this->userId();
      $records = $this->getCalendarTable()->fetchAll($user_id);
      $today = date('Y-m-j');
      $months =  $this->params()->fromRoute('date',0);
          
        preg_match('/(\d*).(\d*)/', $months, $matches);

      $monthsBackward = $matches[1];
      $monthsForward= $matches[2];
      
      $back=$monthsBackward+1;
      $BF=$back.'-'.$monthsForward;

      $forw=$monthsForward+1;
      $FB=$monthsBackward.'-'.$forw;

        $backward = -1-$monthsBackward.' months';
        $forward = 1+$monthsForward.' months';
        $tenDaysBack = strtotime($backward);
        $endTime = strtotime($forward);
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
          'backward' => $BF,
          'forward' => $FB,
          'calendar' => $calendar,
          'records' => $records,
        )
      );
    } 
    
  }
} 
