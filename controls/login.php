
<?php
require_once "../Validate.php";

session_start();

$userError = true;
if(isset($_SESSION["user_name"]) && isset($_SESSION['user_id'] ))
{
    header("Location: index.php");
    exit;
}

$userError = true;

if ($_SERVER['REQUEST_METHOD'] === "POST") 
{    
    $user = [
        'name' => $_POST['name'] ?? '',
        'password' => $_POST['password'] ?? ''
    ];

    $validate = new Validate();

    $userError = $validate->validateUser($user);

    if($userError)
    {
        header("Location:index.php");
        exit;
    }

}

?>