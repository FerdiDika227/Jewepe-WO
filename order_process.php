<?php
include "db.php";

$catalogue_id  = $_POST['catalogue_id'] ?? '';
$name          = $_POST['name'] ?? '';
$email         = $_POST['email'] ?? '';
$phone_number  = $_POST['phone_number'] ?? '';
$wedding_date  = $_POST['wedding_date'] ?? '';

header('Content-Type: application/json'); // biar fetch bisa parse JSON

$sql = "INSERT INTO tb_order 
        (catalogue_id, name, email, phone_number, wedding_date, status, created_at) 
        VALUES ('$catalogue_id', '$name', '$email', '$phone_number', '$wedding_date', 'requested', NOW())";

if (mysqli_query($conn, $sql)) {
    echo json_encode(["success" => true]);
    exit;
} else {
    echo json_encode(["success" => false, "error" => mysqli_error($conn)]);
    exit;
}
?>
