<?php
/**
 * Created by PhpStorm.
 * User: Laptop
 * Date: 19.03.2019
 * Time: 16:41
 */

class Contact
{
    public $firstName;
    public $lastName;
    public $phone;


    public function __construct($firstName, $lastName, $phone)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->phone = $phone;
    }
}