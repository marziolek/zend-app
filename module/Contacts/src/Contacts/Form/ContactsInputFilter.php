<?php

namespace Contacts\Form;

use Zend\InputFilter\InputFilter;

class ContactsInputFilter extends InputFilter
{
    public function __construct()
    {
        $this->add(array(
            'name' => 'contact_name',
            'required' => true,
            'filters' => array(
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min'      => 3,
                        'max'      => 80,
                    ),
                ),
            ),
        )); 

        $this->add(array(
            'name' => 'contact_surname',
            'required' => false,
            'filters' => array(
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min'      => 2,
                        'max'      => 1000,
                    ),
                ),
            ),
        )); 

    }
}
