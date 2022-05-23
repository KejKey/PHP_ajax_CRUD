<?php

$conn = mysqli_connect("localhost", "root", "", "cookbook_db");;

$query = "SELECT * FROM posts WHERE id LIKE ".$_POST["id"];

$result = mysqli_query($conn, $query);

echo json_encode(mysqli_fetch_all($result, MYSQLI_ASSOC));

?>