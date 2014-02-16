<?php

namespace Notes\Form;

use Zend\Form\Form;

class NotesForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('Notes');

        $this->add(array(
            'name' => 'note_id',
            'type' => 'hidden',
            'attributes' => array(
                'id' => 'note_id',
            ),
        ));

        $this->add(array(
            'name' => 'note_title',
            'type' => 'text',
            'options' => array(
                'label' => 'Note title',
            ),
            'attributes' => array(
              'id' => 'note_title',
            ),
        ));

        $this->add(array(
            'name' => 'note_body',
            'type' => 'text',
            'options' => array(
                'label' => 'Note body',
            ),
            'attributes' => array(
                'id' => 'note_body',
            ),
        ));

        $this->add(array(
            'name' => 'user_id',
            'type' => 'hidden',
            'attributes' => array(
              'value' => $this->user_id,
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
