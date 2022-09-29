<?php
    require_once 'db.php';
    session_start();

    if(isset($_POST['login'])) {
        $username = $_POST['email'];
        $password = $_POST['pass'];

        $stmt = $conn->prepare("SELECT * FROM res_user_admin WHERE username = :username AND password = :password");
        $stmt->bindParam(':username', $username , PDO::PARAM_STR);
        $stmt->bindParam(':password', $password , PDO::PARAM_STR);
        $stmt->execute();

        if($stmt->rowCount() == 1){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['adminName'] = $row['name'];
            $_SESSION['forOne'] = '1';
            header('Location: ../admin/res-admin.php');
        }else{ 
            $_SESSION['invalid'] = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
            header('Location: ../admin/login-admin.php');
            $conn = null;
        } //else
    }


    if(isset($_POST['login_user'])) {
        $email = $_POST['email'];
        $password = $_POST['pass'];

        $stmt = $conn->prepare("SELECT * FROM res_user WHERE email = :email AND login = :password");
        $stmt->bindParam(':email', $email , PDO::PARAM_STR);
        $stmt->bindParam(':password', $password , PDO::PARAM_STR);
        $stmt->execute();

        if($stmt->rowCount() == 1){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $fname = $row['fname'];
            $lname = $row['lname'];
            $_SESSION['user_login'] = $fname . " " . $lname;
            $_SESSION['uid'] = $row['id'];
            $_SESSION['forUser'] = '0';;
            header('Location: ../index.php');
        }else{ 
            $_SESSION['invalid'] = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
            header('Location: ../index.php');
            $conn = null;
        } //else
    }
    

?>