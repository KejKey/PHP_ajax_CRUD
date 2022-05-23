<?php


require_once "../../Validate.php";
session_start();

$id = $_POST['id'] ?? "";

//if(!$id) die(header("HTTP/1.0 404 Not Found"));

$validate = new Validate();

$error = $validate->validateUpdate();

if(!$error) die(header("HTTP/1.0 404 Not Found"));

?>