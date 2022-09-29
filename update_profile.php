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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>

<body>
    <?php
    require_once 'config/db.php';
    session_start();

    if (isset($_POST['update_user'])) {
        if (!empty($_SESSION['uid'])) {
            $id = $_SESSION['uid'];
            $inputFName = $_POST['inputFName'];
            $inputLName = $_POST['inputLName'];
            $inputEmail = $_POST['inputEmail'];
            $inputPassword = $_POST['inputPassword'];
            $inputCeery = $_POST['inputCeery'];
            $inputTypeCom = $_POST['inputTypeCom'];
            $inputComName = $_POST['inputComName'];
            $inputPro = $_POST['inputPro'];
            $inputAddress = $_POST['inputAddress'];
            $inputPhone = $_POST['inputPhone'];

            $sql = $conn->query("UPDATE `res_user` SET `fname` = '$inputFName', `lname` = '$inputLName', `login` = '$inputPassword', `occupation` = '$inputCeery', `enterprise` = '$inputComName', `enterprise_type_name` = '$inputTypeCom', `product_service` = '$inputPro', `address` = '$inputAddress', `email` = '$inputEmail', `phone` = '$inputPhone' WHERE `res_user`.`id` = $id");

            if ($sql) {
                echo "<script>Swal.fire({
                    icon: 'success',
                    title: 'อัพเดทสำเร็จ',
                    text: 'อัพเดทข้อมูลสำเร็จแล้ว',
                    showConfirmButton: false,
                    timer: 2500
                })</script>";
            } else {
                echo "<script>Swal.fire({
                    icon: 'error',
                    title: 'เกิดข้อผิดพลาด',
                    text: 'อัพเดทข้อมูลไม่สำเร็จ',
                    showConfirmButton: false,
                    timer: 2500
                })</script>";
            }
        }
    }
    ?>
    <div class="container">
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
                        <a class="nav-link" href="contact.php">ติดต่อเรา</a>
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
                            <!-- <button class="btn btn-success" type="button">
                                <i class="bi bi-person-fill"></i>
                                <span class="sr-only">ข้อมูลส่วนตัว</span>
                            </button> -->
                            <a href="profile.php" class="btn btn-success dropdown-toggle" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bi bi-person-fill"></i>
                                <span class="sr-only">ข้อมูลส่วนตัว</span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="profile.php">ข้อมูลส่วนตัว</a>
                                <a class="dropdown-item" href="#">แก้ไขข้อมูลส่วนตัว</a>
                                <a class="dropdown-item" href="#">ดาวน์โหลดรายงาน</a>
                            </div>
                            <button name="logout" class="btn btn-danger" type="button">
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
                <div class="greeting">
                    <h4>แก้ไขข้อมูลส่วนตัว</h4>
                </div>
                <?php
                if (!empty($_SESSION['uid'])) {
                    $uid = $_SESSION['uid'];
                    $stmt = $conn->query("SELECT * FROM res_user WHERE id = $uid");

                    if ($stmt) {
                        $result = $stmt->fetch();
                ?>
                        <form action="" method="POST">
                            <div class="text-start p-3">
                                <div class="form-row row mb-4">
                                    <div class="form-group col-md-6">
                                        <label for="inputName">ชื่อ</label>
                                        <input value=<?= $result['fname'] ?> type="text" class="form-control" name="inputFName" id="inputFName" placeholder="ชื่อจริง">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputFName">นามสกุล</label>
                                        <input value=<?= $result['lname'] ?> type="text" class="form-control" name="inputLName" id="inputLName" placeholder="นามสกุล">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail">Email</label>
                                        <input value=<?= $result['email'] ?> type="email" class="form-control" name="inputEmail" id="inputEmail" placeholder="อีเมล์">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword">รหัสผ่านเข้าสู่ระบบ</label>
                                        <input value=<?= $result['login'] ?> type="password" class="form-control" name="inputPassword" id="inputPassword" placeholder="รหัสผ่าน">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <div class="form-group col-md-6">
                                        <label for="inputCeery">อาชีพ</label>
                                        <input value=<?= $result['occupation'] ?> type="text" class="form-control" name="inputCeery" id="inputCeery" placeholder="อาชีพ">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputTypeCom">ประเภทกลุ่มวิสาหกิจ</label>
                                        <input value=<?= $result['enterprise'] ?> type="text" class="form-control" name="inputTypeCom" id="inputTypeCom" placeholder="ประเภทกลุ่มวิสาหกิจ">
                                    </div>
                                </div>
                                <div class="form-row row mb-4">
                                    <div class="form-group col-md-6">
                                        <label for="inputComName">ชื่อกลุ่มวิสาหกิจ</label>
                                        <input value=<?= $result['enterprise_type_name'] ?> type="text" class="form-control" name="inputComName" id="inputComName" placeholder="ชื่อกลุ่มวิสาหกิจ">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPro">สินค้าและบริการ</label>
                                        <input value=<?= $result['product_service'] ?> class="form-control" name="inputPro" id="inputPro" type="search" dir="ltr" spellcheck=false autocorrect="off" autocomplete="off" autocapitalize="off">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <div class="form-group col-md-6">
                                        <label for="inputAddress">ที่อยู่</label>
                                        <input value=<?= $result['address'] ?> type="text" class="form-control" name="inputAddress" id="inputAddress" placeholder="ที่อยู่">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPhone">เบอร์โทรศัพท์</label>
                                        <input value=<?= $result['phone'] ?> type="tel" class="form-control" name="inputPhone" id="inputPhone" placeholder="เบอร์โทรศัพท์">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button name="update_user" type="submit" class="btn btn-success">บันทึกข้อมูล</button>
                            </div>
                        </form>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script>
        $('#navigation li a').click(function() {
            $('#navigation li a').removeClass('active');
            $(this).addClass('active');
        });
    </script>

</body>

</html>