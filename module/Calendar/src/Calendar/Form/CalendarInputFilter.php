<?php

namespace Calendar\Form;

use Zend\InputFilter\InputFilter;

class CalendarInputFilter extends InputFilter
{
    public function __construct()
    {
        $this->add(array(
            'name' => 'event_title',
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
            'name' => 'event_body',
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
                        'max'      => 200,
                    ),
                ),
            ),
        )); 

    }
}
