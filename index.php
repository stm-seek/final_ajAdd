<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="Content-Type" content="text/html; charset=utf-8" />
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
    <script src="asset/dropdown.js"></script>
    <link href="http://cdn.syncfusion.com/20.2.0.43/js/web/flat-azure/ej.web.all.min.css" rel="stylesheet" />
    <script src="http://cdn.syncfusion.com/js/assets/external/jquery-1.10.2.min.js"></script>
    <!-- <script src="http://cdn.syncfusion.com/20.2.0.43/js/web/ej.web.all.min.js"></script> -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.7/dist/css/autoComplete.min.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.7/dist/css/autoComplete.01.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<?php
require_once 'config/db-nonePOD.php';
session_start();

if (isset($_POST['logout'])) {
    session_destroy();
    header('location: index.php');
}
?>
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
                                <input require class="form-control" name="inputCeery" id="inputCeery" type="search" dir="ltr" spellcheck=false autocorrect="off" autocomplete="off" autocapitalize="off">
                                <!-- <input require type="text" class="form-control" name="inputCeery" id="inputCeery" placeholder="อาชีพ"> -->
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

<body>
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
                        <a class="nav-link active" href="index.php">หน้าแรก</a>
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
                        </form>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="tab-content text-start p-3">
                <p class="mt-4">
                    โครงการวิจัยเรื่อง "การพัฒนาข้อมูลและฐานข้อมูลบนระบบสารสนเทศ
                    เพื่อเพิ่มคักยภายการบริหารจัดการเครือข่ายสินค้าเกษตรและสินค้าเด่นประจำอำเภอ จังหวัดสุพรรณบุรี"
                    เงินการศึกษา
                    เพื่อศึกษาสภาพและศักยภาพของสมาชิกเครื่อข่ายสินค้าทางการเกษตรและพัฒนระบบการจัดการเครื่อข่ายสินค้าทางการเกษตร
                    เพื่อพัฒนาฐานข้อมูลด้าบการเกษตรให้มีความ ถูกต้อง แม่นยำ เชื่อถือได้และสามารถนำมาใช้ประโยชน์สำหรับการ
                    การเกษตร ส่งเสริม ให้เกษตรกรสามารถเข้าถึงและใช้ประโยชน์จากข้อมูลและเทคโนโลยีได้อย่างทั่วถึง
                    ส่งเสริมการผลิต สินค้าเกษตรและอาหารให้ได้คุณภาพมาตรฐานและความปลอดภัยและการบริโภค
                </p>
            </div>
        </div>

        <div class="container rr">
            <div class="col-sm-4">
                <div class="card w-75 cc" style="width: 18rem;">
                    <img class="card-img-top " src="https://images.unsplash.com/photo-1560493676-04071c5f467b?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1974&q=80" alt="Card image cap">
                    <div class="card-body">
                        <p class="card-text overflow-auto">Business Model Canvas ช่วยให้ทุกคนสามารถเข้าใจชัดเจนเกี่ยวกับแผนกลยุทธ์ของธุรกิจไปในแนวทางเดียวกัน</p>
                        <div class="button-list">
                            <div class="start-b">
                                <a href="#"><i class="bi bi-star m-lg-1"></i></a>
                                <a href="#"><i class="bi bi-share m-lg-1"></i></a>
                            </div>
                            <a href="#"><i class="bi bi-three-dots"></i></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card w-75 cc" style="width: 18rem;">
                    <img class="card-img-top " src="https://images.unsplash.com/photo-1535379453347-1ffd615e2e08?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1974&q=80" alt="Card image cap">
                    <div class="card-body overflow-auto">
                        <p class="card-text">Business Model Canvas ทำให้เห็นภาพรวมของธุรกิจได้อย่างรวดเร็วและไม่มีข้อมูลที่ไม่จำเป็นในแผนภาพ เมื่อเทียบกับโมเดลธุรกิจแบบดั้งเดิม</p>
                        <div class="button-list">
                            <div class="start-b">
                                <a href="#"><i class="bi bi-star m-lg-1"></i></a>
                                <a href="#"><i class="bi bi-share m-lg-1"></i></a>
                            </div>
                            <a href="#"><i class="bi bi-three-dots"></i></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card w-75 cc" style="width: 18rem;">
                    <img class="card-img-top " src="https://images.unsplash.com/photo-1499529112087-3cb3b73cec95?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1074&q=80" alt="Card image cap">
                    <div class="card-body">
                        <p class="card-text overflow-auto">Business Model Canvas สามารถใช้ได้ตั้งแต่ Startup ที่พึ่งก่อตั้งไปจนถึงบริษัทขนาดใหญ่ก็ใช้ BMC</p>
                        <div class="button-list">
                            <div class="start-b">
                                <a href="#"><i class="bi bi-star m-lg-1"></i></a>
                                <a href="#"><i class="bi bi-share m-lg-1"></i></a>
                            </div>
                            <a href="#"><i class="bi bi-three-dots"></i></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- <script src="https://code.jquery.com/jquery-3.6.1.js"
        integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script> -->

    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.7/dist/autoComplete.min.js"></script>



    <script>
        $('#navigation li a').click(function() {
            $('#navigation li a').removeClass('active');
            $(this).addClass('active');
        });

        $('#close').click(function() {
            $('#userModal').modal('hide')
        })

        $('#closeCreate').click(function() {
            $('#createUserModal').modal('hide')
        })

        const autoCompleteJS = new autoComplete({
            selector: "#inputPro",
            placeHolder: "กรุณาเลือก...",
            data: {
                src: ['รับจ้างเพาะต้นข้าวและรับจ้างโยนข้าว',
                    'ประดิษฐ์ลงลายและอบทำเครื่องเบญจรงค์ทอง',
                    'เครื่องทำน้ำมันไบโอดีเซล',
                    'ผลิตจานปั้นปุ๋ย',
                    'ออมสินปูนปลาสเตอร์',
                    'แชมพูสมุนไพร แชมพูอาบน้ำสุนัข น้ำยาเอนกประสงค์ ครี',
                    'แชมพู , ครีมนวด , ยาสีฟัน , สบู่ขมิ้น ฯ',
                    'สบู่ฟักข้าว (ชนิดก้อน,เหลว)   โลชั่นบำรุงผิว',
                    'เถาวัลย์เปรียง',
                    'ขนมปัง (ปังโก้อู่ทอง)',
                    'เลี้ยงเป็ด',
                    'ทำเฟอร์นิเจอร์',
                    'ผลิตเสื้อผ้าลายไทย',
                    'ก้อนเชื้อเห็ด, ดอกเห็ด',
                    'เพาะเห็ดนางฟ้า',
                    'ปลูกเมล่อนปลอดสารพิษ',
                    'ปลูกแตงกวา',
                    'นวดแผนไทย',
                    'เลี้ยงแพะขยายพันธุ์',
                    'แพะเนื้อ',
                    'เลี้ยงแพะเนื้อ/แพะนม',
                    'การเลี้ยงแพะเนื้อ',
                    'เลี้ยงวัว',
                    'เลี้ยงโคเนื้อ',
                    'เลี้ยงโคแม่พันธุ์',
                    'ผลิตโคเนื้อเพื่อจำหน่าย',
                    'เลี้ยงโคเพื่อจำหน่าย',
                    'เลี้ยงโคขุน พ่อพันธุ์ แม่พันธุ์ จำหน่าย',
                    'เลี้ยงโค',
                    'การเลี้ยงโคเนื้อ',
                    'การเลี้ยงโค',
                    'เลี้ยงโคเนื้อ',
                    'เลี้ยงโคเนื้อ,โคขุน',
                    'โคขุน',
                    'เลี้ยงวัวไล่ทุ่ง',
                    'เลี้ยงโคขุน',
                    'เลี้ยงโคเนื้อ',
                    'เลี้ยงโคขุน',
                    'เลี้ยงโคนม',
                    'โรงสีข้าวชุมชน',
                    'เลี้ยงไก่ ชำแหละไก่ส่งจำหน่ายตลาดครบวงจร',
                    'กล้วยฉาบ',
                    'มะขามแช่อิ่ม',
                    'กล้วยกวน',
                    'กล้วยเลย์ กล้วยเบรคแตก',
                    'กล้วยอบม้วน',
                    'กล้วยกวน  มะขามแก้วรสกล้วย',
                    'กล้วยอบม้วน  ',
                    'กล้วยตาก',
                    'กล้วยม้วนกรอบ',
                    'กล้วยหักมุกฉาบ',
                    'กล้วยกวน',
                    'ฝรั่งแช่บ๊วย',
                    'ปลูกพืชผัก-ผลไม้ปลอดสารพิษ',
                    'แปรรูปหน่อไม้',
                    'เกษตรผสมผสาน',
                    'เลี้ยงไหมเพื่อเอาเส้นใย',
                    'กระเจี๊ยบแดงแห้ง',
                    'กระบือ',
                    'กล้วยน้ำว้า',
                    'การแปรรูปผลผลิตเกษตรอินทรีย์',
                    'กลุ่มผู้ใช้น้ำ',
                    'ผลิตปุ๋ยอินทรีย์',
                    'ไข่นกกระจอกเทศ',
                    'ผลิตเครื่องสำอาง แปรรูปน้ำมันนกกระจอกเทศ ',
                    'เลี้ยงนกกระจอกเทศ กวาง กระต่าย จระเข้',
                    'ปั่นถุงพลาสติก',
                    'เลี้ยงกุ้งก้ามกราม',
                    'ขนมไทย',
                    'ขนมชั้น หม้อแกง เม็ดขนุน สังขยา ข้าวเหนียวหน้าปลาแ',
                    'ขนมจีน กระยาสารท ขนมชั้น ขนมวุ้น',
                    'ทองม้วน',
                    'ขนมไทย  หมี่กรอบ  ขนมสาลี  กระยาสาร์ท',
                    'ขนมไทย',
                    'ขนมไทย',
                    'ผลิตขนมไทย',
                    'รับจัด - ออกงานพิธีต่างๆ',
                    'วุ้นในลูกมะพร้าว',
                    'ขนมเปี๊ยะใส้ต่าง ๆ , ขนมลูกเต๋า , ขนมโก๋หิมะ , ขนม',
                    'เย็บผ้าห่มจากเศษผ้าสำลี ',
                    'เย็บผ้าด้นมือเป็นของใช้ต่าง ๆ เช่น ปลอกหมอน ผ้าห่ม',
                    'เย็บผ้าห่ม',
                    'ผลิตผ้าห่มเศรษฐกิจ',
                    'ช้อนส้อมสแตนเลส',
                    'ช้อนสแตนเลส',
                    'ถังไวน์สแตนเลส',
                    'ถาดสแตนเลส',
                    'โบว์ใส่ผลไม้สแตนเลส',
                    'มีดสแตนเลส',
                    'เสื้อสกรีน แก้วน้ำสกรีน  พวงกุญแจสกรีน เข็มกลัดสกร',
                    'ผักผลไม้ประดิษฐ์',
                    'ข้าวคั่ว',
                    'ขนมจีน',
                    'ปลูกข้าวปลอดสารพิษ',
                    'ผลิตข้าวถุงปลอดสารพิษ',
                    'ข้าวเหนียว',
                    'ข้าวโพดหวาน',
                    'ปลูกข้าวโพดหวาน',
                    'ปลูกข้าวโพดหวาน',
                    'ปลูกข้าวโพดหวาน',
                    'ผลิตข้าวเพื่อบริโภค',
                    'ปลูกข้าวปลอดภัยจากสารพิษ , ',
                    'การผลิตขยายแมลงศัตรูธรรมชาติ และเชื้อจุลินทรีย์',
                    'การผลิตข้าวปลอดภัยต่อสารพิษ',
                    'การผลิตข้าวอินทรีย์ปลอดสารพิษ',
                    'ทำนา',
                    'ทำข้าวอินทรีย์',
                    'ผลิตข้าวไรซ์เบอรี่',
                    'แปรรูปข้าวบรรจุถุง',
                    'ผลิตข้าวสารและข้าวกล้องปลอดภัยจากสารพิษ',
                    'ข้าวขาว,ข้าวกล้อง,ข้าวอินทรีย์',
                    'ผักคะน้าอินทรีย์',
                    'ดอกไม้จัน',
                    'ทำดอกกุหลาบผ้าใยบัว ดอกทานตะวัน ดอกพุทธรักษา ดอกมะ',
                    'ดอกไม้ประดิษฐ์',
                    'ผลิตดอกไม้ประดิษฐ์',
                    'ดอกไม้ประดิษฐ์',
                    'ปลูกดาวเรือง',
                    'ปลูกถั่วฝักยาว, ปลูกมะเขือ',
                    'ถ่านอัดแท่ง',
                    'ผลิตของชำร่วย',
                    'ตะกร้า กระเช้า กระปุกมีฝา',
                    'การแปรรูปผักตบชวา',
                    'ผลิตภัณฑ์จักสานจากพลาสติก และไหมพรม',
                    'หมวกสานจากพลาสติก',
                    'ตระกร้าเชือกมัดฟาง',
                    'ผลิตเปลญวน',
                    'ผลิตเปลญวน',
                    'กระเป๋าจากเชือกมัดฟาง ',
                    'กระเป๋า',
                    'ไม้กวาดดอกหญ้า',
                    'ไม้กวาดดอกหญ้า',
                    'พานหวาย แจกันหวาย ตะกร้าผลไม้',
                    'น้ำดื่มบรรจุถ้วย',
                    'การผลิตน้ำดื่มแก้วและน้ำบรรจุขวด',
                    'ทำน้ำดื่มบรรจุภัณฑ์',
                    'น้ำดื่มบรรจุแก้ว',
                    'น้ำดื่มเพื่อบริโภคและจำหน่าย',
                    'ผลิตน้ำดื่มบรรจุขวดขนาด1ลิตร',
                    'ผลิตน้ำดื่มบรรจุถังแก้วพลาสติก',
                    'ผลิตน้ำดื่มบรรจุถังขนาด20ลิต',
                    'น้ำปลา',
                    'น้ำปลา ',
                    'น้ำผลไม้ต่าง ๆ',
                    'น้ำอ้อย , น้ำผลไม้พร้อมดื่ม ',
                    'น้ำมะพร้าวพร้อมดื่ม',
                    'ทำน้ำพริก',
                    'น้ำพริกต่างๆ',
                    'น้ำพริกชนิดต่าง ๆ ',
                    'น้ำลูกยอ น้ำกระชายดำ',
                    'จัดอบรมให้ความรู้ด้านการลดต้นทุนการทำนา',
                    'เตยหอม บัวบก ชะพลู หญ้านาง',
                    'เลี้ยงปลาในกระชัง',
                    'เลี้ยงปลากระชัง',
                    'สารไล่แมลง',
                    'การผลิตน้ำส้มควันไม้',
                    'ผลิตสารสกัดชีวภาพและสารชีวภัณฑ์จำหน่าย',
                    'ฮอร์โมนจากพืช',
                    'น้ำส้มควันไม้ , น้ำหมักชีวภาพ',
                    'น้ำหมักชีวภาพ',
                    'ปุ๋ยน้ำชีวภาพ ',
                    'ปุ๋ยน้ำเปิดตาดอกก เร่งผล',
                    'ผลิตปุ๋ยอัดเม็ดชีวภาพ',
                    'การผลิตปุ๋ยน้ำชีวภาพ',
                    'ปุ๋ยชีวภาพอัดเม็ด',
                    'ปุ๋ยหมักชีวภาพ',
                    'ปุ๋ยหมัก ',
                    'ปุ๋ยอินทรีย์อัดเม็ด (ออแกรนิค)',
                    'ปุ๋ยอินทรีย์อัดเม็ด',
                    'ผลิตปุ๋ยอินทรีย์',
                    'ผลิตปุ๋ยอินทรีย์อัดเม็ด',
                    'ทำปุ๋ยอินทรีย์',
                    'ปุ๋ยอินทรีย์อัดเม็ด',
                    'ปุ๋ยอินทรีย์',
                    'ปุ๋ยหมัก',
                    'การทำปุ๋ยหมัก',
                    'ปุ๋ยหมัก ปุ๋ยอัดเม็ด',
                    'การทำปุ๋ยหมัก,ปุ๋ยคอก',
                    'กลุ่มผลิตปุ๋ยอินทรีย์ อัดเม็ด ก่อตั้ง พ.ศ.2554',
                    'ปุ๋ยอินทรีย์',
                    'ปุ๋ยอินทรีย์',
                    'ปุ๋ยอินทรีย์ชีวภาพ',
                    'ปุ๋ยอินทรีย์',
                    'ปุ๋ยอินทรีย์อัดเม็ด',
                    'ไข่เค็มใบเตย',
                    'ไข่เค็ม',
                    'การทำไข่เค็มรสน้ำผึ้ง',
                    'กระเป๋า เข็มขัด รองเท้า ',
                    'น้ำยาล้างจาน, น้ำยาซักผ้า, น้ำยาปรับผ้านุ่ม, น้ำยา',
                    'น้ำยาล้างจาน',
                    'น้ำยาล้างจาน ยาสระผม',
                    'สบู่ แชมพูสระผม ครีมนวดผม',
                    'ผลิตภัณฑ์ใช้ในครัวเรือน',
                    'แปรรูปสมุนไพรไทย',
                    'แปรรูปสมุนไพร คลอไรฟิลผง สารสะกัดตะไคร้หอม หว่านหา',
                    'แปรรุปอาหาร',
                    'ข้าวสารบรรจุถุง',
                    'ผลิตอาหาร',
                    'ขายเนื้อนกกระจอกเทศ  ',
                    'ผลิตภัณฑ์จากหมู',
                    'แปรรูปกล้วย',
                    'น้ำดื่มฟักข้าว เพื่อสุขภาพ',
                    'แปรรูปจากกล้วยน้ำว้า, กล้วยหอม, กล้วยหักมุก',
                    'ผลิตพืชปลอดภัยจากสารพิษ',
                    'ผลิตผักอินทรีย์(ผักสวนครัว)',
                    'ผ้าทอ',
                    'สวนฝรั่ง',
                    'ปลูกฝรั่งกิมจู',
                    'ปลูกพริก',
                    'น้ำพริกแกง',
                    'พริกแกง',
                    ' พวงหรีดดอกไม้จัน,ตะกร้าเชือกฟาง',
                    ' พวงหรีด',
                    'การผลิตเมล็ดพันธุ์ข้าวสวนแตง',
                    'ผลิตข้าวพันธุ์ดี',
                    'ผลิตพันธุ์ข้าวพันธุ์ดี',
                    'ผลิตเมล็ดพันธุ์ข้าวพันธุ์ดี',
                    'เมล็ดพันธุ์ข้าว',
                    'ผลิตเมล็ดพันธุ์ข้าว',
                    'จำหน่ายเมล็ดพันธุ์ข้าว',
                    'ปลูกข้าวพันธุ์ดีไว้ทำแปลงพันธุ์',
                    'ผลิตข้าวเมล็ดพันธุ์ดีจำหน่ายให้สมาชิกและเครือข่าย',
                    'ผลิตพันธุ์ข้าวชุมชน',
                    'ชาใบหม่อน',
                    'ข้าวโพดผักสด',
                    'ฟักทองฉาบ',
                    'ปลูกผักเพื่อจำหน่าย',
                    'ปลูกผักพื้นบ้านแปรรูปจำหน่าย',
                    'ปลูกผัก',
                    'ผลิตมะม่วงคุณภาพดี มีความปลอดภัยได้มาตรฐานและเพิ่ม',
                    'ทำสวนมะม่วง',
                    'ปลูกมันสำปะหลัง',
                    'ยาหม่องน้ำ พิมเสน',
                    'รองเท้าหนังชาย',
                    'ร้านค้าชุมชน',
                    'ขายของชำ',
                    'ปุ๋ยเคมี เคมีเกษตร เครื่องอุปโภค บริโภค',
                    'รวบรวมและจำหน่ายผลผลิตทางการเกษตรและปัจจัยการผลิตก',
                    'ใบย่านางแห้ง',
                    'ใบรางจืดแห้ง',
                    'ปอกะบิด',
                    'ฝางเสน',
                    'เม็ดมะรุมแห้ง',
                    'เม็ดหมามุ่ยดิบ',
                    'พืชผักต่างๆ',
                    'แค็ปหมูไร้มัน',
                    'หมูหวาน , หมูสวรรค์',
                    'หมูสวรรค์',
                    'หมูเส้น',
                    'ปลาจ่อม',
                    'ปลาร้า',
                    'ปลาส้ม',
                    'ปลาจ้อ  แหนมปลา  ปลายอ  ทอดมันปลา',
                    'ปลาร้า',
                    'ปลาร้า',
                    'ปลูกสับปะรด',
                    'เลี้ยงสุกร',
                    'สุกรขุน',
                    'เลี้ยงสุกร',
                    'เลี้ยงสุกรป่า',
                    'เลี้ยงสุกร',
                    'การเลี้ยงสุกร',
                    'เลี้ยงสุกร',
                    'ผลิตข้าวปลอดสารพิษ',
                    'สุราแช่พื้นเมือง , สุรากลั่นชุมชน',
                    'หน่อไม้ฝรั่ง',
                    'หมากแห้ง',
                    'ทำไร่อ้อย',
                    'อ้อยโรงงาน',
                    'อ้อยโรงงาน',
                    'อ้อยโรงงาน',
                    'ปลูกอ้อย',
                    'ปลูกอ้อยอินทรีย์',
                    'ปลูกอ้อยโรงงาน',
                    'ปลูกอ้อยโรงงาน',
                    'อ้อยโรงงาน',
                    'อ้อยโรงงาน',
                    'การปลูกอ้อย',
                    'ปลูกอ้อย',
                    'อ้อยโรงงาน',
                    'ทำการเกษตรไร่อ้อย',
                    'ปลูกอ้อย',
                    'ปลูกอ้อยโรงงาน',
                    'ปลูกอ้อยโรงงาน',
                    'ปลูกอ้อยเพื่อส่งโรงงานน้ำตาล',
                    'ปลูกอ้อยส่งโรงงาน',
                    'ดอกอัญชันแห้ง',
                    'อาหารโคขุน',
                    'อาหารสุกร',
                ],
                cache: true,
            },
            resultItem: {
                highlight: true
            },
            events: {
                input: {
                    selection: (event) => {
                        const selection = event.detail.selection.value;
                        autoCompleteJS.input.value = selection;
                    }
                }
            }
        });

        
        const autoInputCeery = new autoComplete({
            selector: "#inputCeery",
            placeHolder: "กรุณาเลือกอาชีพของคุณ",
            data: {
                src: [
                    "เกษตรกร",
                    "ปศุสัตว์",
                    "บุคลากรภาครัฐ",
                    "บุคลากรภาคเอกชน",
                    "การประมง",
                    "อาหารและเครื่องดื่ม",
                    "ช่าง",
                    "นักออกแบบ",
                ],
                cache: true,
            },
            resultItem: {
                highlight: true
            },
            events: {
                input: {
                    selection: (event) => {
                        const selection = event.detail.selection.value;
                        autoInputCeery.input.value = selection;
                    }
                }
            }
        });
    </script>

</body>

</html>