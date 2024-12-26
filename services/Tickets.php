<?php 
include "../config/config.php";
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');


if (isset($_GET['Cetak'])) {
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    error_log("Input dari fetch: " . $input);

    // Validasi data yang masuk
    // if (!isset($data['massage'])) {
        echo json_encode([
            'success' => false,
            'message' => 'Data tidak lengkap!',
            'data' => $data
        ]);

        $user_id = 2;
        $id_trans = $data['push'];
        
        foreach ($id_trans as $id) {
            mysqli_query($conn, "UPDATE transactions SET status = 'Sudah' WHERE transaction_id = '$id'");
        }
    // }
} else {
    $id = 2;
    
    $sql = mysqli_query($conn, "SELECT transaction_id, title, description, show_time, seat_number, studio_name, transactions.status, transactions.ticket_id 
    FROM transactions 
    INNER JOIN tickets ON transactions.ticket_id = tickets.ticket_id 
    INNER JOIN schedules ON schedules.schedule_id = tickets.schedule_id 
    INNER JOIN movies ON schedules.movie_id = movies.movie_id 
    INNER JOIN seats ON tickets.seat_id = seats.seat_id 
    INNER JOIN studios ON seats.studio_id = studios.studio_id 
    WHERE transactions.user_id = '$id' ORDER BY transactions.transaction_date ASC ");
    
    $data = [];
    if (mysqli_num_rows($sql) > 0) {
        while ($row = mysqli_fetch_assoc($sql)) {
            $data[] = $row; // Tambahkan hasil ke dalam array $data
        }
    }
    
    echo json_encode($data);
}

?>