<?php

require_once "Database.php";
require_once "functions.php";

class Validate
{
    var $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function validateUser($user)
    {
        if (!$user['name'] || !$user['password']) return  false;

        $loggedUser = $this->db->getUser($user);

        if (!$loggedUser) return  false;

        $_SESSION['user_name'] = $loggedUser['name'];
        $_SESSION['user_id'] = $loggedUser['id'];

        return true;
    }

    public function validateInsert()
    {
        $image = $_FILES['image'] ?? '';

        if (!$_POST["title"] || !$_POST['recipe'] || !$image || !$image['tmp_name']) return false;

        $title = $_POST["title"];
        $user_id = $_SESSION['user_id'];
        $recipe = $_POST['recipe'];

        if (!is_dir(__DIR__ . '/public/images')) mkdir(__DIR__ . '/public/images');


        $imagePath = "images/" . randomString(8) . '/' . $image['name'];
        mkdir(dirname(__DIR__ . "/public/" . $imagePath));
        move_uploaded_file($image['tmp_name'], __DIR__ . "/public/" . $imagePath);


        $data = [
            'title' => $title,
            'user_id' => $user_id,
            'recipe' => $recipe,
            'imagePath' => $imagePath
        ];

        return $data;
    }

    public function validateUpdate()
    {
        $db = new Database();
        $image = $_FILES['image'] ?? '';

        if (!$_POST["title"] || !$_POST['recipe'] ) return false;

        $title = $_POST["title"];
        $user_id = $_SESSION['user_id'];
        $recipe = $_POST['recipe'];



        if (!is_dir(__DIR__ . '/public/images')) mkdir(__DIR__ . '/public/images');

        if ($image && $image['tmp_name']) 
        {

            unlinkImage($_POST['id']);
            
            $imagePath = "images/" . randomString(8) . '/' . $image['name'];
            mkdir(dirname(__DIR__ . "/public/" . $imagePath));
            move_uploaded_file($image['tmp_name'], __DIR__ . "/public/" . $imagePath);

            $statment = $db->pdo->prepare("UPDATE posts SET title = :title, 
                image = :image, 
                recipe = :recipe, 
                user_id = :user_id WHERE id = :id");

            $statment->bindValue(":id", $_POST['id']);
            $statment->bindValue(":image", $imagePath);
            $statment->bindValue(":recipe", $recipe);
            $statment->bindValue(":title", $title);
            $statment->bindValue(":user_id", $_SESSION['user_id']);

            $statment->execute();

        } 
        else 
        {

            $statment = $db->pdo->prepare("UPDATE posts SET title = :title, 
            recipe = :recipe, 
            user_id = :user_id WHERE id = :id");

            $statment->bindValue(":id", $_POST['id']);
            $statment->bindValue(":recipe", $recipe);
            $statment->bindValue(":title", $title);
            $statment->bindValue(":user_id", $_SESSION['user_id']);

            $statment->execute();
        }

        return true;
    }
}
