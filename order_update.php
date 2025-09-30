<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include "db.php";

$id     = $_GET['id'] ?? 0;
$status = $_GET['status'] ?? '';

if ($id > 0 && in_array($status, ['approved','rejected'])) {
    $sql = "UPDATE tb_order SET status='$status', updated_at=NOW() WHERE order_id='$id'";
    if (mysqli_query($conn, $sql)) {
        header("Location: admin_order.php");
        exit;
    } else {
        die("SQL Error: " . mysqli_error($conn));
    }
} else {
    die("Permintaan tidak valid.");
}
?>
