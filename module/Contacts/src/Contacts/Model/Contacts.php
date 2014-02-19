<?php

namespace Contacts\Model;

class Contacts 
{

    public $contact_id;
    public $created_at;
    public $contact_name;
    public $contact_surname;
    public $contact_street;
    public $contact_city;
    public $contact_postal_code;
    public $contact_country;
    public $contact_description;
    public $contact_phone;
    public $contact_phone2;
    public $contact_photo;
    public $contact_email;
    public $contact_facebook;
    public $contact_google;
    public $user_id;

    public function exchangeArray($data)
    {
        $this->contact_id = isset($data['contact_id'])?$data['contact_id']:null;
        $this->created_at = isset($data['created_at'])?$data['created_at']:date('Y-m-d H:i:s');
        $this->contact_name = isset($data['contact_name'])?$data['contact_name']:null;
        $this->contact_surname = isset($data['contact_surname'])?$data['contact_surname']:null;
        $this->contact_street = isset($data['contact_street'])?$data['contact_street']:null;
        $this->contact_city = isset($data['contact_city'])?$data['contact_city']:null;
        $this->contact_postal_code = isset($data['contact_postal_code'])?$data['contact_postal_code']:null;
        $this->contact_country = isset($data['contact_country'])?$data['contact_country']:null;
        $this->contact_description = isset($data['contact_description'])?$data['contact_description']:null;
        $this->contact_phone = isset($data['contact_phone'])?$data['contact_phone']:null;
        $this->contact_phone2 = isset($data['contact_phone2'])?$data['contact_phone2']:null;
        $this->contact_photo = isset($data['contact_photo'])?$data['contact_photo']:null;
        $this->contact_email = isset($data['contact_email'])?$data['contact_email']:null;
        $this->contact_facebook = isset($data['contact_facebook'])?$data['contact_facebook']:null;
        $this->contact_google = isset($data['contact_google'])?$data['contact_google']:null;
        $this->user_id = isset($data['user_id'])?$data['user_id']:null;
    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

}
