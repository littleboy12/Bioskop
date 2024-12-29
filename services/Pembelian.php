<?php
include "../config/config.php";
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');
session_start();

if (isset($_GET['Push'])) {
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    error_log("Input dari fetch: " . $input);

    // Validasi data yang masuk
    if (!isset($data['id_movie'], $data['seat_data'], $data['ticket_id_data'], $data['studio_id'], $data['harga_ticket'])) {
        echo json_encode([
            'success' => false,
            'message' => 'Data tidak lengkap!',
            'data' => $data
        ]);
        exit;
    }

    try {
        // Ambil data dari request
        $user = $_SESSION['user_id'];  // ID user sementara
        $id_movie = $data['id_movie'];
        $seat = $data['seat_data'];
        $ticket = $data['ticket_id_data'];  // Array of ticket_id
        $studio = $data['studio_id'];
        $harga = $data['harga_ticket'];

        mysqli_begin_transaction($conn);

        // Loop semua data seat dan ticket
        // foreach ($seat as $seat_item) {
            foreach ($ticket as $id_ticket) {  // Ambil langsung id_ticket dari array
                $id_seat = $seat_item['seat_id'];

                // Query untuk insert transaksi
                $query = mysqli_query($conn, "INSERT INTO `transactions` (`user_id`, `ticket_id`, `total_price`, `status`) 
                                              VALUES ('$user', '$id_ticket', '$harga', 'Belum')");

                if ($query) {
                    $query_trans = mysqli_query($conn, "SELECT ticket_id FROM transactions");

                    if (mysqli_num_rows($query_trans) > 0 ) {
                        while ($row = mysqli_fetch_array($query_trans)) {
                            $id = $row['ticket_id'];
                            mysqli_query($conn, "UPDATE `tickets` SET `status`='booked' WHERE `ticket_id` = '$id'");
                        }
                    }
                }
            }
        // }

        mysqli_commit($conn);

        echo json_encode([
            'success' => true,
            'message' => 'Semua transaksi berhasil disimpan!',
            'data' => $data
        ]);

    } catch (Exception $e) {
        mysqli_rollback($conn);
        error_log("Transaksi gagal: " . $e->getMessage());
        echo json_encode([
            'success' => false,
            'message' => $e->getMessage()
        ]);
    }
}
?>
