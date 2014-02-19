<?php

namespace Calendar\Form;

use Zend\Form\Form;

class CalendarForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('Calendar');

        $this->add(array(
            'name' => 'event_id',
            'type' => 'hidden',
            'attributes' => array(
                'id' => 'event_id',
            ),
        ));

        $this->add(array(
            'name' => 'created_at',
            'type' => 'hidden',
            'attributes' => array(
                'id' => 'created_at',
            ),
        ));

        $this->add(array(
            'name' => 'event_title',
            'type' => 'text',
            'options' => array(
                'label' => 'Event title',
            ),
            'attributes' => array(
              'id' => 'event_title',
            ),
        ));

        $this->add(array(
            'name' => 'event_body',
            'type' => 'text',
            'options' => array(
                'label' => 'Event body',
            ),
            'attributes' => array(
                'id' => 'event_body',
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
