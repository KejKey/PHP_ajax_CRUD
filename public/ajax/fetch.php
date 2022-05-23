<?php

$connect = mysqli_connect("localhost", "root", "", "cookbook_db");
$columns = array('id', 'image', 'title', 'id');

$query = "SELECT * FROM posts ";

if(isset($_POST["search"]["value"]))
{
 $query .= '
 WHERE id LIKE "%'.$_POST["search"]["value"].'%" 
 OR title LIKE "%'.$_POST["search"]["value"].'%" 
 ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
}
else
{
 $query .= 'ORDER BY id DESC ';
}

$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));

$result = mysqli_query($connect, $query . $query1);

$data = array();

while($row = mysqli_fetch_array($result))
{
 $sub_array = array();
 $sub_array[] = '<div class="d-flex justify-content-center" data-id="'.$row["id"].'" data-column="id">' . $row["id"] . '</div>';
 $sub_array[] = '<div  data-id="'.$row["id"].'" data-column="image"> <img id="image" src="/'.$row['image'].'" class="img-thumbnail mx-auto d-block" width="80px" /> </div>';
 $sub_array[] = '<div class="d-flex justify-content-center" data-id="'.$row["id"].'" data-column="title">' . $row["title"] . '</div>';
 $sub_array[] = '<div class="d-flex justify-content-center gap-2"><button class="btn btn-danger delete" id="'.$row["id"].'" >Usuń</button>'.
 '<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateModal" data-bs-whatever="'.$row["id"].'">Edytuj</button></div>';
 $data[] = $sub_array;
}

function get_all_data($connect)
{
 $query = "SELECT * FROM posts";
 $result = mysqli_query($connect, $query);
 return mysqli_num_rows($result);
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($connect),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);

?>