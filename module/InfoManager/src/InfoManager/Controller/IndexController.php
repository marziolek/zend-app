<?php

namespace InfoManager\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
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

