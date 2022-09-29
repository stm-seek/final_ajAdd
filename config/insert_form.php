<?php
require_once 'db.php';
/* require_once 'db-nonePOD.php'; */
session_start();

if (isset($_POST['test'])) {
    $a1 = $_POST['txt1'];
    $stmt = $conn->query("INSERT INTO test (name) VALUE('$a1')");
    //$stmt->execute();

    if ($stmt) {
        $_SESSION['success'] = "ส่งคำตอบสำเร็จ";
        header("location: ../survey.php");
    }
}
