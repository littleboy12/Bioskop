<?php 
// include "../layout/header.php";
if (isset($_SESSION['user_id'])) {
    header("Location: view_movie.php");
    echo "KOSONG";
}
require_once "../services/Auth.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Film List</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
</head>

<div class="container mt-5 d-flex justify-content-center">
    <div class="card shadow-lg" style="width: 30rem; border-radius: 10px;">
        <div class="card-body p-4">
            <ul class="nav nav-pills nav-justified mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="login-tab" data-bs-toggle="pill" data-bs-target="#login" type="button" role="tab">
                        Login
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="register-tab" data-bs-toggle="pill" data-bs-target="#register" type="button" role="tab">
                        Register
                    </button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <!-- Login Form -->
                <div class="tab-pane fade show active" id="login" role="tabpanel">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="loginEmail" class="form-label">Email address</label>
                            <input type="text" class="form-control mb-2" name="login_email" value="<?= $data['dataEmail'] ?? '' ?>" placeholder="Enter your email">
                            <?php if (isset($error['emailErr'])): ?>
                                <span style="color: red;" class="mx-2"><?php echo $error['emailErr']; ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="loginPassword" class="form-label">Password</label>
                            <input type="password" class="form-control mb-2" name="login_password" placeholder="Enter your password">
                            <?php if (isset($error['passErr'])): ?>
                                <span style="color: red;" class="mx-2"><?php echo $error['passErr']; ?></span>
                            <?php endif; ?>
                        </div>
                        <input type="submit" class="btn btn-primary w-100 mt-3" name="login" value="Login">
                    </form>
                </div>
                <!-- Register Form -->
                <div class="tab-pane fade" id="register" role="tabpanel">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="registerName" class="form-label">Full Name</label>
                            <input type="text" class="form-control mb-2" name="register_name" value="<?= $data['dataName'] ?? '' ?>" placeholder="Enter your full name">
                            <?php if (isset($error['nameErr'])): ?>
                                <span style="color: red;" class="mx-2"><?php echo $error['nameErr']; ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="registerEmail" class="form-label">Email address</label>
                            <input type="text" class="form-control mb-2" name="register_email" value="<?= $data['dataEmail'] ?? '' ?>" placeholder="Enter your email">
                            <?php if (isset($error['emailErr'])): ?>
                                <span style="color: red;" class="mx-2"><?php echo $error['emailErr']; ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="registerPassword" class="form-label">Password</label>
                            <input type="password" class="form-control mb-2" name="register_password" placeholder="Create a password">
                            <?php if (isset($error['passErr'])): ?>
                                <span style="color: red;" class="mx-2"><?php echo $error['passErr']; ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="registerConfirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control mb-2" name="re_register_password" placeholder="Confirm your password">
                            <?php if (isset($error['passErr'])): ?>
                                <span style="color: red;" class="mx-2"><?php echo $error['passErr']; ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <img src="../services/captcha.php" alt="captcha" width="100">
                            <input type="text" class="form-control mt-3 mb-2" name="cek_captha" placeholder="Entry your captcha">
                            <?php if (isset($error['captchaErr'])): ?>
                                <span style="color: red;" class="mx-2"><?php echo $error['captchaErr']; ?></span>
                            <?php endif; ?>
                        </div>
                        <input type="submit" class="btn btn-success w-100 mt-3" name="register" value="Register">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- <?php include "../layout/footer.php" ?> -->