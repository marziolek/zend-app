<?php

namespace FormExample\Form;

use Zend\InputFilter\InputFilter;

class ResetPasswordInputFilter extends InputFilter
{
    public function __construct()
    {
        $this->add(array(
            'name' => 'email',
            'required' => true,
            'filters' => array(
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array('name' => 'EmailAddress'),
            ),
        )); 
    }
}
