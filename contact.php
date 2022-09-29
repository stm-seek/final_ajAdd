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

    <link href="css/style.css" rel="stylesheet">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>

</head>
<?php
    require_once 'config/db.php';
    session_start();
    if (isset($_POST['logout'])) {
        session_destroy();
        header('location: index.php');
    }
    ?>
<body>
    <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">เข้าสู่ระบบเพื่อใช้งาน</h5>
                    <button type="button" id="close" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="config/login.php" method="POST">
                        <div class="form-group pt-2">
                            <label for="exampleInputEmail1">อีเมล์เข้าสู่ระบบ</label>
                            <input require name="email" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                        </div>
                        <div class="form-group pt-3 pb-3">
                            <label for="exampleInputPassword1">รหัสผ่านเข้าสู่ระบบ</label>
                            <input require name="pass" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        </div>
                        <div class="modal-footer">
                            <button name="login_user" type="submit" class="btn btn-primary">เข้าสู่ระบบ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ลงทะเบียนเพื่อใช้งาน</h5>
                    <button type="button" id="closeCreate" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="config/create_user.php" method="POST">
                        <div class="text-start p-3">
                            <div class="form-row row mb-4">
                                <div class="form-group col-md-6">
                                    <label for="inputName">ชื่อ</label>
                                    <input require type="text" class="form-control" name="inputFName" id="inputFName" placeholder="ชื่อจริง">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputFName">นามสกุล</label>
                                    <input require type="text" class="form-control" name="inputLName" id="inputLName" placeholder="นามสกุล">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail">Email</label>
                                    <input require type="email" class="form-control" name="inputEmail" id="inputEmail" placeholder="อีเมล์">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword">รหัสผ่านเข้าสู่ระบบ</label>
                                    <input require type="password" class="form-control" name="inputPassword" id="inputPassword" placeholder="รหัสผ่าน">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <div class="form-group col-md-6">
                                    <label for="inputCeery">อาชีพ</label>
                                    <input require type="text" class="form-control" name="inputCeery" id="inputCeery" placeholder="อาชีพ">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputTypeCom">ประเภทกลุ่มวิสาหกิจ</label>
                                    <input require type="text" class="form-control" name="inputTypeCom" id="inputTypeCom" placeholder="ประเภทกลุ่มวิสาหกิจ">
                                </div>
                            </div>
                            <div class="form-row row mb-4">
                                <div class="form-group col-md-6">
                                    <label for="inputComName">ชื่อกลุ่มวิสาหกิจ</label>
                                    <input require type="text" class="form-control" name="inputComName" id="inputComName" placeholder="ชื่อกลุ่มวิสาหกิจ">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPro">สินค้าและบริการ</label>
                                    <input require class="form-control" name="inputPro" id="inputPro" type="search" dir="ltr" spellcheck=false autocorrect="off" autocomplete="off" autocapitalize="off">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <div class="form-group col-md-6">
                                    <label for="inputAddress">ที่อยู่</label>
                                    <input require type="text" class="form-control" name="inputAddress" id="inputAddress" placeholder="ที่อยู่">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPhone">เบอร์โทรศัพท์</label>
                                    <input require type="tel" class="form-control" name="inputPhone" id="inputPhone" placeholder="เบอร์โทรศัพท์">
                                </div>
                            </div>
                            <!-- <div class="form-group row md-4">
                            <div class="form-group col-md-6">
                                <label for="inputEmail">Email</label>
                                <input type="email" class="form-control" id="inputEmail" placeholder="อีเมล์">
                            </div>
                        </div> -->
                            <div class="form-group mt-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="gridCheck">
                                    <label class="form-check-label" for="gridCheck">
                                        ยอมรับข้อตกลง
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button name="create_user" type="submit" class="btn btn-primary">ลงทะเบียน</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container">
        <?php

        if (isset($_SESSION['forUser'])) {
            $name = $_SESSION['user_login'];
            echo "<script>
        const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      })

      Toast.fire({
        icon: 'success',
        title: 'เข้าสู่ระบบสำเร็จ $name'
      })</script>";

            unset($_SESSION['forUser']);
        }

        if (isset($_SESSION['invalid'])) {
            echo "<script>Swal.fire({
            icon: 'error',
            title: 'เข้าสู่ระบบไม่สำเร็จ',
            text: 'Email หรือ Password ไม่ถูกต้อง',
            showConfirmButton: false,
            timer: 2500
        })</script>";
            unset($_SESSION['invalid']);
        }

        if (isset($_SESSION['insert_success'])) {
            echo "<script>Swal.fire({
        icon: 'success',
        title: 'สำเร็จ',
        text: 'ลงทะเบียนสำเร็จแล้ว',
        showConfirmButton: false,
        timer: 2500
    })</script>";
            unset($_SESSION['insert_success']);
        }

        if (isset($_SESSION['insert_error'])) {
            echo "<script>Swal.fire({
        icon: 'error',
        title: 'เกิดข้อผิดพลาด',
        text: 'ลงทะเบียนไม่สำเร็จ',
        showConfirmButton: false,
        timer: 2500
    })</script>";
            unset($_SESSION['insert_error']);
        }

        if (isset($_SESSION['empty'])) {
            echo "<script>Swal.fire({
        icon: 'error',
        title: 'เกิดข้อผิดพลาด',
        text: 'กรุณากรอกข้อมูลให้ครบถ้วน',
        showConfirmButton: false,
        timer: 2500
    })</script>";
            unset($_SESSION['empty']);
        }


        ?>
        <h3 class="text-start mt-5 mb-4 fw-bold ">ระบบสารสนเทศเพื่อการจัดการเครือข่ายสินค้าทางการเกษตรจังหวัดสุพรรณบุรี
        </h3>
        <div class="card text-center mb-3 mt-3">
            <div class="card-header test">
                <ul class="nav nav-tabs card-header-tabs " id="navigation">
                    <li class="nav-item">
                        <a class="nav-link " href="index.php">หน้าแรก</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="canvas.php">Canvas</a>
                    </li>
                    <?php if (!empty($_SESSION['uid'])) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="survey.php">ระบบประเมิน</a>
                        </li>
                    <?php } ?>

                    <li class="nav-item">
                        <a class="nav-link active" href="contact.php">ติดต่อเรา</a>
                    </li>
                </ul>
                <div class="nav nav-tabs card-header-tabs">
                    <?php
                    if (!isset($_SESSION['user_login'])) {
                    ?>
                        <button class="btn btn-success userbtn" data-bs-toggle="modal" data-bs-target="#userModal">เข้าสู่ระบบ</button>
                        <button class="btn btn-primary userbtn" data-bs-toggle="modal" data-bs-target="#createUserModal">ลงทะเบียน</button>
                    <?php
                    } else {
                    ?>
                        <form action="" method="POST">
                            <!-- <button name="logout" class="btn btn-danger userbtn">ออกจากระบบ</button> -->
                            <a href="profile.php" class="btn btn-success dropdown-toggle" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bi bi-person-fill"></i>
                                <span class="sr-only">ข้อมูลส่วนตัว</span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="profile.php">ข้อมูลส่วนตัว</a>
                                <a class="dropdown-item" href="update_profile.php">แก้ไขข้อมูลส่วนตัว</a>
                                <a class="dropdown-item" href="#">ดาวน์โหลดรายงาน</a>
                            </div>
                            <button name="logout" class="btn btn-danger">
                                <i class="bi bi-box-arrow-right"></i>
                                <span class="sr-only">ออกจากระบบ</span>
                            </button>
                            <!--  <button name="profile" class="btn btn-success userbtn">ข้อมูลส่วนตัว</button> -->
                        </form>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="tab-content text-start p-3">
                <div class="contact-wraper">
                    <div class="card contact-c">
                        <div class="card-header">
                            <h2>ติดต่อเรา</h2>
                        </div>
                        <div class="card-body">
                            <form action="">
                                <div class="form-row row pb-4">
                                    <div class="form-group col-md-6">
                                        <label for="inputName">ชื่อ</label>
                                        <input type="text" class="form-control" id="inputName" placeholder="ชื่อจริง">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPhone">เบอร์โทรศัพท์</label>
                                        <input type="tel" class="form-control" id="inputPhone" placeholder="เบอร์โทรศัพท์">
                                    </div>
                                </div>
                                <div class="form-row row pb-4">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail">Email</label>
                                        <input type="email" class="form-control" id="inputEmail" placeholder="อีเมล์">
                                    </div>
                                </div>
                                <div class="form-row row pb-4">
                                    <div class="form-group">
                                        <label for="inputMessage">ข้อความ</label>
                                        <textarea class="form-control" id="inputMessage" rows="3"></textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success mb-2 ">ส่งข้อความ</button>
                            </form>
                        </div>
                    </div>
                    <div class="myContact">
                        <div class="contact-data">
                            <div class="address">
                                <div class="icons">
                                    <i class="bi bi-house-fill"></i>
                                    <div class="text">
                                        <h5>ที่อยู่</h5>
                                    </div>
                                </div>
                                295 ถนนนครราชสีมา แขวง ดุสิต เขตดุสิต กรุงเทพมหานคร 10300
                            </div>
                            <div class="address">
                                <div class="icons">
                                    <i class="bi bi-telephone-fill"></i>
                                    <div class="text">
                                        <h5>เบอร์ติดต่อ</h5>
                                    </div>
                                </div>
                                082-208-1111
                            </div>
                            <div class="address">
                                <div class="icons">
                                    <i class="bi bi-envelope-fill"></i>
                                    <div class="text">
                                        <h5>อีเมล์</h5>
                                    </div>
                                </div>
                                <a href="">test_dusit@email.com</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

    <script>
        $('#navigation li a').click(function() {
            $('#navigation li a').removeClass('active');
            $(this).addClass('active');
        });
    </script>

</body>

</html>