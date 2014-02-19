<?php

namespace FormExample\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use FormExample\Form\ResetPasswordForm;
use FormExample\Form\ResetPasswordInputFilter;

class IndexController extends AbstractActionController
{

    public function indexAction()
    {
        $form = new ResetPasswordForm();

	if ($this->getRequest()->isPost()) {
		$form->setInputFilter(new ResetPasswordInputFilter());
		$form->setData($this->getRequest()->getPost());

		if ($form->isValid()) {
			// process recieved data
		}
	}

        return new ViewModel(array('form' => $form));
    }


}

