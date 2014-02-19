<?php

namespace Notes\Form;

use Zend\InputFilter\InputFilter;

class NotesInputFilter extends InputFilter
{
    public function __construct()
    {
        $this->add(array(
            'name' => 'note_title',
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
            'name' => 'note_body',
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
