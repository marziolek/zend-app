<?php

namespace InfoManager\Form;

use Zend\Form\Form;

class InfoManagerForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('InfoManager');

        $this->add(array(
            'name' => 'id',
            'type' => 'hidden',
            'attributes' => array(
                'id' => 'id',
            ),
        ));

        $this->add(array(
            'name' => 'nick',
            'type' => 'text',
            'options' => array(
                'label' => 'Enter Your Nickname',
            ),
            'attributes' => array(
                'id' => 'nick',
            ),
        ));

        $this->add(array(
            'name' => 'is_active',
            'type' => 'checkbox',
            'options' => array(
                'label' => 'Active?',
            ),
            'attributes' => array(
                'id' => 'is_active',
            ),
        ));

        $this->add(array(
            'name' => 'comment',
            'type' => 'text',
            'options' => array(
                'label' => 'Enter Your comment',
            ),
            'attributes' => array(
                'id' => 'comment',
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
