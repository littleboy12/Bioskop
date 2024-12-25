<?php 
include "../config/config.php";
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');


if(isset($_GET['Jadwal'])) {
    $jadwal = $_GET['Jadwal'];
    $sql = mysqli_query($conn, "SELECT * FROM schedules INNER JOIN movies ON schedules.movie_id = movies.movie_id WHERE movies.movie_id = '$jadwal'");
    $data = [];
    if (mysqli_num_rows($sql) > 0) {
        while ($row = mysqli_fetch_assoc($sql)) {
            $data[] = $row;
        }
    }
    echo json_encode($data);
    exit;

} else if(isset($_GET['tickets'])) {
    $id_jadwal = $_GET['tickets'];
    $sql = mysqli_query($conn, "SELECT * FROM tickets INNER JOIN schedules ON tickets.schedule_id = schedules.schedule_id WHERE tickets.schedule_id = schedules.schedule_id = '$id_jadwal'");
    $data = [];
    if (mysqli_num_rows($sql) > 0) {
        while ($row = mysqli_fetch_assoc($sql)) {
            $data[] = $row;
        }
    }
    echo json_encode($data);
    exit;

} else {
    $sql = mysqli_query($conn, "SELECT * FROM seats");
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