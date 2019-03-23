<?php
require_once("lib/tpl.php");
require_once("Contact.php");
const CONTACT_FILE  = "Contacts.txt";


$cmd = isset($_GET["cmd"]) ? $_GET["cmd"] : "view";


if ($cmd === "view") {
    $contacts = readContact();

    print render_template("list.html", ['$contacts'  => $contacts]);

} else if ($cmd === "add") {

    print render_template("add.html");

}else if ($cmd === "add-contact"){
     $firstName = $_POST["firstName"];

     file_put_contents(CONTACT_FILE, $firstName . ";", FILE_APPEND);

     $lastName = $_POST["lastName"];

     file_put_contents(CONTACT_FILE, $lastName . ";", FILE_APPEND);

     $phone = $_POST["phone"];

     file_put_contents(CONTACT_FILE, $phone . PHP_EOL, FILE_APPEND);
     $contacts = readContact();

     print render_template("list.html", ['$contacts' => $contacts]);
}


function readContact()
{
    $lines = file(CONTACT_FILE);

       foreach ($lines as $line) {

            $parts = explode(";", trim($line));

            list($firstName, $lastName, $phone) = $parts;

            $contacts[] = new Contact($firstName, $lastName, $phone);
    }
    return $contacts;
}