<?php

require_once 'db.php';
session_start();

if (isset($_POST['create_user'])) {
    $fname = $_POST['inputFName'];
    $lname = $_POST['inputLName'];
    $email = $_POST['inputEmail'];
    $password = $_POST['inputPassword'];
    $ceery = $_POST['inputCeery'];
    $typeCom = $_POST['inputTypeCom'];
    $comName = $_POST['inputComName'];
    $product = $_POST['inputPro'];
    $address = $_POST['inputAddress'];
    $phone = $_POST['inputPhone'];

    if (
        !empty($fname) and
        !empty($lname) and
        !empty($email) and
        !empty($password) and
        !empty($ceery) and
        !empty($typeCom) and
        !empty($comName) and
        !empty($product) and
        !empty($address) and
        !empty($phone)
    ) 
    {
        $sql = $conn->query(
            "INSERT INTO res_user (fname, lname, login, email, occupation, enterprise, enterprise_type_name, product_service, address, phone)
            VALUE('$fname','$lname','$password','$email','$ceery','$comName','$typeCom','$product','$address','$phone')"
        );

        if($sql) {
            $_SESSION['insert_success'] = "true";
            header("location: ../index.php");
        }else {
            $_SESSION['insert_error'] = "true";
            header("location: ../index.php");
        }
    } else {
        $_SESSION['empty'] = "true";
        header("location: ../index.php");
    }
}
