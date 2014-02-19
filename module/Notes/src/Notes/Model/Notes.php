<?php

namespace Notes\Model;

class Notes 
{

    public $note_id;
    public $created_at;
    public $note_title;
    public $note_body;
    public $user_id;

    public function exchangeArray($data)
    {
        $this->note_id = isset($data['note_id'])?$data['note_id']:null;
        $this->created_at = isset($data['created_at'])?$data['created_at']:date('Y-m-d H:i:s');
        $this->note_title = isset($data['note_title'])?$data['note_title']:null;
        $this->note_body = isset($data['note_body'])?$data['note_body']:null;
        $this->user_id = isset($data['user_id'])?$data['user_id']:null;
    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

}
