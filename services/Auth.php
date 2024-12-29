<?php
include "../config/config.php";
session_start();



$error = [];
$data = [];
if (isset($_POST['login'])) {
    $email = $_POST['login_email'];
    $password = $_POST['login_password'];
    if (!empty($email) && !empty($password)) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error['emailErr'] = "Email tidak valid.";
            $data['dataEmail'] = $email; // Menyimpan input sebelumnya
        }

        if (strlen($email) > 255) {
            $error['emailErr'] = "Email tidak boleh lebih dari 255 karakter.";
        }

        if (strlen($password) < 6) {
            $error['passErr'] = "Password harus mengandung setidaknya satu huruf kecil.";
        } elseif (!preg_match('/[0-9]/', $password)) {
            $error['passErr'] = "Password harus mengandung setidaknya satu angka.";
        }

        if (empty($error)) {
            $cekEmail = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
            $sqlPass = mysqli_query($conn, "SELECT * FROM users WHERE password = '$password'");

            if (mysqli_num_rows($cekEmail) > 0) {
                if (mysqli_num_rows($sqlPass) > 0) {
                    $row = mysqli_fetch_array($cekEmail);
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['nama'] = $row['name'];
                    $_SESSION['email'] = $row['email'];
                    
                    header("Location: view_movie.php");
                      
                } else {
                    $error['passErr'] = "Password salah.";
                }
            } else {
                $error['emailErr'] = "Email salah.";
            }
        }
    } else {
        if (empty($email)) {
            $error['emailErr'] = "Email tidak boleh kosong.";
        }
        if (empty($password)) {
            $error['passErr'] = "Password tidak boleh kosong.";
        }
    }

    $data['dataEmail'] = $email;
} else if(isset($_POST['register'])) {
    $name = $_POST['register_name'];
    $email = $_POST['register_email'];
    $password = $_POST['register_password'];
    $re_password = $_POST['re_register_password'];
    $cek_captcha = $_POST['cek_captha'];
    $captcha = $_SESSION['captcha_code'];

    if (!empty($name) && !empty($email) && !empty($password)) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error['emailErr'] = "Email tidak valid.";
            $data['dataEmail'] = $email; // Menyimpan input sebelumnya
        }

        if (strlen($email) > 255) {
            $error['emailErr'] = "Email tidak boleh lebih dari 255 karakter.";
        }

        if (strlen($password) < 6) {
            $error['passErr'] = "Password harus 6 Karakter.";
        } elseif (!preg_match('/[0-9]/', $password)) {
            $error['passErr'] = "Password harus mengandung setidaknya satu angka.";
        } elseif ($password != $re_password) {
            $error['passErr'] = "Password tidak sama.";
        } elseif ($cek_captcha != $captcha) {
            $error['captchaErr'] = "Captcha salah.";
        }

        if (empty($error)) {
            $sql = mysqli_query($conn, "INSERT INTO `users`(`name`, `email`, `password`, `role`) VALUES ('$name','$email','$password','customer')");

            if ($sql) {
                    $_SESSION['nama'] = $name;
                    $_SESSION['email'] = $email;
                    $data = [];
                    $error = [];
                    header("Location: view_movie.php");
                    exit;
                } else {
                    $error['passErr'] = "Password salah.";
                }
            }
        
    } else {
        if (empty($name)) {
            $error['nameErr'] = "Nama tidak boleh kosong.";
        }
        if (empty($email)) {
            $error['emailErr'] = "Email tidak boleh kosong.";
        }
        if (empty($password)) {
            $error['passErr'] = "Password tidak boleh kosong.";
        }
        if (empty($cek_captcha)) {
            $error['captchaErr'] = "Captcha tidak boleh kosong.";
        }
    }

    $data['dataName'] = $name;
    $data['dataEmail'] = $email;
    
}
