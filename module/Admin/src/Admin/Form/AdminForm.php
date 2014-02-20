<?php

namespace Admin\Form;

use Zend\Form\Form;

class AdminForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('Admin');

        $this->add(array(
            'name' => 'user_id',
            'type' => 'hidden',
            'attributes' => array(
                'id' => 'user_id',
            ),
        ));

        $this->add(array(
            'name' => 'username',
            'type' => 'hidden',
            'attributes' => array(
                'id' => 'username',
            ),
        ));

        $this->add(array(
            'name' => 'email',
            'type' => 'text',
            'options' => array(
                'label' => 'Email',
            ),
            'attributes' => array(
                'id' => 'email',
            ),
        ));

        $this->add(array(
            'name' => 'display_name',
            'type' => 'text',
            'options' => array(
                'label' => 'Display name',
            ),
            'attributes' => array(
                'id' => 'display_name',
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
