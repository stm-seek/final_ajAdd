<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบสารสนเทศเพื่อการจัดการเครือข่ายสินค้า</title>
    <!-- ระบบสารสนเทศเพื่อการจัดการเครือข่ายสินค้าทางการเกษตรจังหวัดสุพรรณบุรี -->

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <link href="../css/style.css" rel="stylesheet">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

    <?php 
        require_once '../config/db.php';
        session_start();

        if(isset($_SESSION['invalid'])){
            $mes = $_SESSION['invalid'];
            echo "<script>Swal.fire({
                icon: 'error',
                title: 'เข้าสู่ระบบไม่สำเร็จ',
                text: '$mes',
                showConfirmButton: false,
                timer: 2500
            })</script>";
            unset($_SESSION['invalid']);
        }
    ?>

    <div class="container">
        <div class="card card-admin-login shadow-lg p-3 mb-5 bg-white rounded">
            <div class="card-body">
                <h2 class="card-title">เข้าสู่ระบบสำหรับ Admin</h2>
                <h5 class="card-subtitle mb-2 text-muted">ระบบสารสนเทศเพื่อการจัดการเครือข่ายสินค้า</h5>

                <form action="../config/login.php" method="POST">
                    <div class="form-group pt-4">
                        <label for="exampleInputEmail1">อีเมล์เข้าสู่ระบบ</label>
                        <input name="email" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                    </div>
                    <div class="form-group pt-4">
                        <label for="exampleInputPassword1">รหัสผ่านเข้าสู่ระบบ</label>
                        <input name="pass" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <div class="d-flex justify-content-end">
                        <button name="login" type="submit" class="btn btn-primary mt-4">เข้าสู่ระบบ</button>
                    </div>
                </form>

                <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

</body>

</html>