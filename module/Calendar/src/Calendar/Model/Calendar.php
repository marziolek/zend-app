<?php

namespace Calendar\Model;

class Calendar 
{

    public $event_id;
    public $created_at;
    public $event_title;
    public $event_body;
    public $user_id;

    public function exchangeArray($data)
    {
        $this->event_id = isset($data['event_id'])?$data['event_id']:null;
        $this->created_at = isset($data['created_at'])?$data['created_at']:date('Y-m-d H:i:s');
        $this->event_title = isset($data['event_title'])?$data['event_title']:null;
        $this->event_body = isset($data['event_body'])?$data['event_body']:null;
        $this->user_id = isset($data['user_id'])?$data['user_id']:null;
    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

}
