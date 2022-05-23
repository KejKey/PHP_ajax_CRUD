<?php

$id = $_POST['id'] ?? '';


if(!$id) die(header("HTTP/1.0 404 Not Found"));

require_once  "../../Database.php";
require_once "../../functions.php";
$db = new Database();

unlinkImage($id);


$statment = $db->pdo->prepare("DELETE FROM posts WHERE id = :id");
$statment->bindValue(":id", $id);
$statment->execute();



?>