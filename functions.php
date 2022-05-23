<?php

require_once "Database.php";

function randomString($n)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $str = '';
    for ($i = 0; $i < $n; $i++) 
    {
        $index = rand(0, strlen($characters) - 1);
        $str .= $characters[$index];
    }

    return $str;
}

function unlinkImage($id)
{
    $db = new Database();

    $statment = $db->pdo->prepare("SELECT * FROM posts WHERE id = :id");
    $statment->bindValue(":id", $id);
    $statment->execute();


    $result = $statment->fetch(PDO::FETCH_ASSOC);

    $currImg =  $result["image"];
    
    if($currImg)
    {
        unlink(__DIR__. "/public/" . $currImg);
    }
}

?>
