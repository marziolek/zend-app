<?php

namespace FormExample\Form;

use Zend\Form\Form;

class ResetPasswordForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('resetPassword');

        $this->add(array(
            'name' => 'email',
            'type' => 'Email',
            'options' => array(
                'label' => 'Enter Your E-mail',
            ),
            'attributes' => array(
                'id' => 'email',
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Send',
                'id' => 'submit',
             ),
         ));

    }
}
