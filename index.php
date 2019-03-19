<?php
require_once("lib/tpl.php");


$cmd = isset($_GET["cmd"]) ? $_GET["cmd"] : "view";


if ($cmd === "view") {



    print render_template("list.html");

} else if ($cmd === "add") {

    print render_template("add.html");

}
