<?php
class User {
    public $username;
    public $password;
    public $phone;
    public $email;

    public function __construct($username, $password, $phone, $email) {
        $this->username = $username;
        $this->password = $password;
        $this->phone = $phone;
        $this->email = $email;
    }
}
