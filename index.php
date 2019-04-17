<?php
require_once("lib/tpl.php");
require_once("Contact.php");
require_once("contactDao.php");

$connection = new sqliteContactDao();
$id = $connection->GetId();

$cmd = isset($_GET["cmd"]) ? $_GET["cmd"] : "view";


if ($cmd === "view") {
    $contacts = $connection->GetContact();
    $data['$contacts'] = $contacts;

     print render_template("list.html", $data);

} else if ($cmd === "add") {

    print render_template("add.html");

}else if ($cmd === "add-contact"){


    $firstname = $_POST["firstName"];
    $lastname = $_POST["lastName"];
    $number1 = $_POST["phone1"];
    $number2 = $_POST["phone2"];
    $number3 = $_POST["phone3"];

    if (isset($firstname) && isset($lastname)) {
        $connection->saveContact($firstname, $lastname);
    }
    if (isset($number1)) {
        $connection->saveNumber($id, $number1);
    }
    if (isset($number2)) {
        $connection->saveNumber($id, $number2);
    }
    if (isset($number3)) {
        $connection->saveNumber($id, $number3);
    }
    header("Location: ?cmd=view");
}

