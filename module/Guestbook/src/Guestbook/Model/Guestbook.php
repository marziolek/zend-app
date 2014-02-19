<?php

namespace Guestbook\Model;

class Guestbook 
{

    public $id;
    public $created_at;
    public $is_active;
    public $nick;
    public $comment;

    public function exchangeArray($data)
    {
        $this->id = isset($data['id'])?$data['id']:null;
        $this->created_at = isset($data['created_at'])?$data['created_at']:date('Y-m-d H:i:s');
        $this->is_active = isset($data['is_active'])?$data['is_active']:0;
        $this->nick = isset($data['nick'])?$data['nick']:null;
        $this->comment = isset($data['comment'])?$data['comment']:null;
    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

}
