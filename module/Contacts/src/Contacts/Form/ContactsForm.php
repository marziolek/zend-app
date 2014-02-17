<?php

namespace Contacts\Form;

use Zend\Form\Form;

class ContactsForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('Contacts');

        $this->add(array(
            'name' => 'contact_id',
            'type' => 'hidden',
            'attributes' => array(
                'id' => 'contact_id',
            ),
        ));

        $this->add(array(
            'name' => 'contact_name',
            'type' => 'text',
            'options' => array(
                'label' => 'Name',
            ),
            'attributes' => array(
              'id' => 'contact_name',
            ),
        ));

        $this->add(array(
            'name' => 'contact_surname',
            'type' => 'text',
            'options' => array(
                'label' => 'Surname',
            ),
            'attributes' => array(
                'id' => 'contact_surname',
            ),
        ));

        $this->add(array(
            'name' => 'user_id',
            'type' => 'hidden',
            'attributes' => array(
              'id' => 'user_id',
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Submit',
                'id' => 'submit',
             ),
         ));

    }
}
