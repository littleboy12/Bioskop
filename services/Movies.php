<?php 
include "../config/config.php";
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = mysqli_query($conn, "SELECT * FROM movies WHERE movie_id = '$id'");
    $data = [];
    if (mysqli_num_rows($sql) > 0) {
        while ($row = mysqli_fetch_assoc($sql)) {
            $data[] = $row;
        }
    }
    echo json_encode($data);
    exit;
} else if (isset($_GET["search"])) {
    $q = $_GET["search"];

    $sql = mysqli_query($conn, "SELECT movie_id, title, description, poster_url, release_date as rilis FROM movies WHERE title LIKE '%$q%' ");
    $data = [];
    if (mysqli_num_rows($sql) > 0) {
        while ($row = mysqli_fetch_assoc($sql)) {
            $data[] = $row;
        }
    }
    echo json_encode($data);
    exit;

} else {
    $sql = mysqli_query($conn, "SELECT movie_id, title, description, poster_url, release_date as rilis FROM movies ");
    
    $data = [];
    if (mysqli_num_rows($sql) > 0) {
        while ($row = mysqli_fetch_assoc($sql)) {
            $data[] = $row;
        }
    }
    
    echo json_encode($data);
    exit;
}

?>
