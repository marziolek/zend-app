<?php

namespace InfoManager\Form;

use Zend\InputFilter\InputFilter;

class InfoManagerInputFilter extends InputFilter
{
    public function __construct()
    {
        $this->add(array(
            'name' => 'nick',
            'required' => true,
            'filters' => array(
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min'      => 2,
                        'max'      => 20,
                    ),
                ),
            ),
        )); 

        $this->add(array(
            'name' => 'comment',
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

        $this->add(array(
            'name' => 'is_active',
            'required' => true,
            'filters'  => array(
                array('name' => 'Int'),
            ),
        )); 
    }
}
