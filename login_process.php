<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include "db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM tb_users WHERE username='$username' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        // login dengan plain password
        if ($password === $row['password']) {
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['name']    = $row['name'];

            header("Location: admin.php");
            exit;
        } else {
            echo "⚠️ Password salah!";
        }
    } else {
        echo "⚠️ User tidak ditemukan!";
    }
} else {
    header("Location: login.php");
    exit;
}
