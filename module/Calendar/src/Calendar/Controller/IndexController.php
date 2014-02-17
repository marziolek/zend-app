<?php

namespace Calendar\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use BmCalendar\Renderer\HtmlCalendar;
use BmCalendar\DayProviderInterface; 
use BmCalendar\Day; 
use BmCalendar\Month;

class IndexController extends AbstractActionController
{

  public function indexAction()
  {

    if (!$this->zfcUserAuthentication()->hasIdentity())
    {
      return $this->redirect()->toRoute('zfcuser');
    }
    else 
    {

    $name = (string) $this->params()->fromRoute('name', '');
    $date = '2014, 02';

    return new ViewModel(
      array(
        'name' => $name,
        'date' => $date,
      )
    );
    }
  }


}

