<?php
/**
 * Created by PhpStorm.
 * User: Laptop
 * Date: 16.04.2019
 * Time: 15:35
 */

class sqliteContactDao{

    const URL = "sqlite:data.sqlite";

    private $connection;

    function __construct(){
        $this->connection = new PDO(self::URL);
        $this->connection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    function connection() {
        return $this->connection;
    }

    function saveContact($firstName, $lastName){
        $addContact = $this->connection->prepare("insert into contacts(firstName, lastName) VALUES (:firstName, :lastName)");
        $addContact->bindValue(':firstName', $firstName);
        $addContact->bindValue(':lastName', $lastName);
        $addContact->execute();
    }


    function saveNumber($id, $phone){
        $addPhone = $this->connection->prepare("insert into phones(id, phone) VALUES (:id, :phone)");
        $addPhone->bindValue(':id', $id);
        $addPhone->bindValue(':phone', $phone);
        $addPhone->execute();


    }


    function GetContact(){
        $statement = $this ->connection->prepare("SELECT contacts.id, contacts.firstName, contacts.lastName, phones.phone as phone FROM contacts LEFT JOIN phones on contacts.id = phones.id;");
        $statement->execute();

        $result = [];

        foreach ($statement as $row){
            $id = $row['id'];

            if (isset($result[$id])){

                $result[$id]->phone[] = $row['phone'];
            } else {
                $person = new Contact();
                $person ->id = $id;
                $person ->firstName = $row['firstName'];
                $person ->lastName = $row['lastName'];
                $person ->phone[] = $row['phone'];
                $result[$id] = $person;


            }
        }
        return $result;
    }



    function GetId(){
        $id = $this->connection->prepare("Select * from contacts");
        $id->execute();

        $idCount= 0;
        foreach ($id as $row){
            $idCount = $row['id'];

        }
        $idCount++;
        return  $idCount;
    }
}