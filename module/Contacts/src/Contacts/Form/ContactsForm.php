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
            'name' => 'contact_description',
            'type' => 'text',
            'options' => array(
                'label' => 'Description',
            ),
            'attributes' => array(
                'id' => 'contact_description',
            ),
        ));

        $this->add(array(
            'name' => 'contact_email',
            'type' => 'text',
            'options' => array(
                'label' => 'Email',
            ),
            'attributes' => array(
                'id' => 'contact_email',
            ),
        ));

        $this->add(array(
            'name' => 'contact_phone',
            'type' => 'text',
            'options' => array(
                'label' => 'Phone',
            ),
            'attributes' => array(
                'id' => 'contact_phone',
            ),
        ));

        $this->add(array(
            'name' => 'contact_phone2',
            'type' => 'text',
            'options' => array(
                'label' => 'Phone 2',
            ),
            'attributes' => array(
                'id' => 'contact_phone2',
            ),
        ));

        $this->add(array(
            'name' => 'contact_street',
            'type' => 'text',
            'options' => array(
                'label' => 'Street',
            ),
            'attributes' => array(
                'id' => 'contact_street',
            ),
        ));

        $this->add(array(
            'name' => 'contact_city',
            'type' => 'text',
            'options' => array(
                'label' => 'City',
            ),
            'attributes' => array(
                'id' => 'contact_city',
            ),
        ));

        $this->add(array(
            'name' => 'contact_postal_code',
            'type' => 'text',
            'options' => array(
                'label' => 'Postal code',
            ),
            'attributes' => array(
                'id' => 'contact_postal_code',
            ),
        ));

        $this->add(array(
            'name' => 'contact_country',
            'type' => 'text',
            'options' => array(
                'label' => 'Country',
            ),
            'attributes' => array(
                'id' => 'contact_country',
            ),
        ));

        $this->add(array(
            'name' => 'contact_facebook',
            'type' => 'text',
            'options' => array(
                'label' => 'Facebook profile',
            ),
            'attributes' => array(
                'id' => 'contact_facebook',
            ),
        ));

        $this->add(array(
            'name' => 'contact_google',
            'type' => 'text',
            'options' => array(
                'label' => 'Google profile',
            ),
            'attributes' => array(
                'id' => 'contact_google',
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
