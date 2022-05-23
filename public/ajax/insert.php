<?php

require_once "../../Validate.php";
session_start();


$validate = new Validate();

$date = $validate->validateInsert();

if($date==false) die(header("HTTP/1.0 404 Not Found"));
else $validate->db->createData($date);


?>