<?php 
session_start();
if (isset($_SESSION['user_id'])){
    header("Location: ./views/view_movie.php");
    exit;
} else {
    header("Location: ./views/view_auth.php");
    exit;
}
?>
