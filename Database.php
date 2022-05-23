<?php


class Database
{
    var $pdo;


    public function __construct()
    {
        $this->pdo = new PDO("mysql:host=localhost;port=3306;dbname=cookbook_db", "root", "");
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getData($statment)
    {
        $statment = $this->pdo->prepare("SELECT * FROM posts");
        $statment->execute();

        return $statment->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteData($id)
    {
        $statment = $this->pdo->prepare("DELETE FROM posts WHERE id = :id");
        $statment->bindValue(":id", $id);
        $statment->execute();
    }

    public function createData($data)
    {
        $statment = $this->pdo->prepare("INSERT INTO posts(user_id, image, recipe, title, create_date)
        VALUES(:user_id, :image, :recipe, :title, :date) 
        ");

        $statment->bindValue(":user_id", $data['user_id']);
        $statment->bindValue(":image", $data['imagePath']);
        $statment->bindValue(":recipe", $data['recipe']);
        $statment->bindValue(":title", $data['title']);
        $statment->bindValue(":date", date("Y-m-d H:i:s"));
        $statment->bindValue(":user_id", $data['user_id']);

        $statment->execute();
    }

    public function updateData($data)
    {
        $statment = $this->pdo->prepare("UPDATE posts SET title = :title, 
        image = :image, 
        recipe = :recipe, 
        user_id = :user_id WHERE id = :id");

        $statment->bindValue(":id", $data['id']);
        $statment->bindValue(":image", $data['imagePath']);
        $statment->bindValue(":recipe", $data['recipe']);
        $statment->bindValue(":title", $data['title']);
        $statment->bindValue(":user_id", $_SESSION['user_id']);

        $statment->execute();
    }

    public function getUser($user)
    {
        $statment = $this->pdo->prepare("SELECT salt, hash FROM users WHERE name = :name");
        $statment->bindValue(":name", $user['name']);
        $statment->execute();
        $pass = $statment->fetch(PDO::FETCH_ASSOC);

        if(!$pass) return false;
        
        $hashtPass = hash("sha256", $user['password'].$pass['salt']);
        
        if(hash_equals($hashtPass, $pass['hash']))
        {
            $statment = $this->pdo->prepare("SELECT id, name, editor FROM users WHERE name = :name");
            $statment->bindValue(":name", $user['name']);
            $statment->execute();
    
            return $statment->fetch(PDO::FETCH_ASSOC);
        }
        return false;           
    }

}

?>