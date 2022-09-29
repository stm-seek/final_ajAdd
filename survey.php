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
    <script src="asset/dropdown.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.7/dist/css/autoComplete.01.min.css">

</head>

<body>
    <?php
    require_once 'config/db.php';
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
                        <a class="nav-link" href="index.php">หน้าแรก</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="canvas.php">Canvas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="survey.php">ระบบประเมิน</a>
                    </li>

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

            <?php

            if (isset($_SESSION['insert_survey_success'])) {
                echo "<script>Swal.fire({
                        icon: 'success',
                        title: 'ส่งคำตอบเรียบร้อยแล้ว',
                        text: 'ส่งคำตอบสำเร็จแล้ว',
                        showConfirmButton: false,
                        timer: 2500
                    })</script>";
                unset($_SESSION['insert_survey_success']);
            }
            if (isset($_SESSION['insert_survey_error'])) {
                echo "<script>Swal.fire({
                        icon: 'error',
                        title: 'เกิดข้อผิดพลาด',
                        text: 'ส่งคำตอบไม่สำเร็จ',
                        showConfirmButton: false,
                        timer: 2500
                    })</script>";
                unset($_SESSION['insert_survey_error']);
            }
            if (isset($_SESSION['aleady_commit'])) {
                echo "<script>Swal.fire({
                        icon: 'error',
                        title: 'เกิดข้อผิดพลาด',
                        text: 'คุณได้ทำการส่งแบบสำรวจเรียบร้อยแล้ว',
                        showConfirmButton: false,
                        timer: 2500
                    })</script>";
                unset($_SESSION['aleady_commit']);
            }
            ?>

            <form action="config/insert_survey.php" method="POST" autocomplete="off">
                <div class="text-start p-4">
                    <div class="form-row row mb-4">
                        <div class="form-group col-md-6">
                            <h5 for="inputName">1. กลุ่มลูกค้าของธุรกิจ</h5>
                            <div class="form-check pb-1">
                                <input class="form-check-input" type="radio" value="ลูกค้าทั่วไป" name="i11" id="id11" checked>
                                <label class="form-check-label" for="id11">
                                    ลูกค้าทั่วไป
                                </label>
                            </div>
                            <div class="form-check pb-1">
                                <input class="form-check-input" type="radio" name="i11" id="id12">
                                <label class="form-check-label" for="id12">
                                    ลูกค้าเฉพาะกลุ่ม โปรดระบุ
                                </label>
                            </div>
                            <div class="form-group autocomplete">
                                <input class="form-control mr-sm-2" name="i122" id="input1" type="search" placeholder="เช่น ทางศาสนา, เกษตรอินทรีย์, แม่บ้าน" aria-label="ค้นหา...">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <h5 for="inputName">2. คุณค่าของสินค้าและบริการของธุรกิจ</h5>
                            <div class="form-check pb-1">
                                <input class="form-check-input" type="radio" value="สินค้าตรงตามความต้องการ" name="i21" id="id21" checked>
                                <label class="form-check-label" for="id21">
                                    สินค้าตรงตามความต้องการ
                                </label>
                            </div>
                            <div class="form-check pb-1">
                                <input class="form-check-input" type="radio" name="i21" id="id22">
                                <label class="form-check-label" for="id22">
                                    สินค้าและบริการ
                                </label>
                            </div>
                            <select name="i222" id="select1" class="form-control">
                                <option value="0" selected>โปรดระบุ</option>
                                <option value="มีความแปลกใหม่">มีความแปลกใหม่</option>
                                <option value="มีประสิทธิภาพ">มีประสิทธิภาพ</option>
                                <option value="ราคาเหมาะสม">ราคาเหมาะสม</option>
                                <option value="ช่วยลดต้นทุน">ช่วยลดต้นทุน</option>
                                <option value="ช่วยลดความเสี่ยง">ช่วยลดความเสี่ยง</option>
                                <option value="เพิ่มความสะดวกสบาย">เพิ่มความสะดวกสบาย</option>
                                <option value="ออกแบบทันสมัย">ออกแบบทันสมัย</option>
                                <option value="ปรับเปลี่ยนตามความต้องการของผู้บริโภค">ปรับเปลี่ยนตามความต้องการของผู้บริโภค</option>
                                <option value="มีแบรนด์ที่ชัดเจน">มีแบรนด์ที่ชัดเจน</option>
                            </select>
                            <!-- <div class="form-group autocomplete">
                                style="width:300px;" 
                                <input class="form-control mr-sm-2" id="input2" type="search" placeholder="สินค้าและบริการ" aria-label="ค้นหา...">
                            </div> -->
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <h5 for="inputName">3. ช่องทางการเข้าถึงลูกค้าหรือการนำเสนอสินค้า</h5>
                        <div class="form-group col-md-6">
                            <label for="i31">1. Awareness ลูกค้าจะรับรู้ถึงสินค้าและบริการของเราได้อย่างไร</label>
                            <input placeholder="โปรดระบุ..." class="form-control" id="i31" list="d31" name="i31" />
                            <datalist class="myDatalist" id="d31">
                                <option value="หน้าร้าน">
                                <option value="งานแสดงสินค้า">
                                <option value="ตลาดออนไลน์">
                                <option value="โซเชียลมีเดีย">
                                <option value="เว็บไซต์">
                                <option value="YouTube">
                                <option value="โทรทัศน์">
                                <option value="วิทยุ">
                                <option value="สิ่งพิมพ์">
                                <option value="พรีเซนต์เตอร์">
                            </datalist>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="i32">2. Evaluation ลูกค้าจะมองเห็นคุณค่าในสินค้าและบริการของเราได้ทางใดบ้าง</label>
                            <input placeholder="โปรดระบุ..." class="form-control" id="i32" list="d32" name="i32" />
                            <datalist class="myDatalist" id="d32">
                                <option value="หน้าร้าน">
                                <option value="งานแสดงสินค้า">
                                <option value="ตลาดออนไลน์">
                                <option value="โซเชียลมีเดีย">
                                <option value="เว็บไซต์">
                                <option value="YouTube">
                                <option value="โทรทัศน์">
                                <option value="วิทยุ">
                                <option value="สิ่งพิมพ์">
                                <option value="พรีเซนต์เตอร์">
                            </datalist>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <div class="form-group col-md-6">
                            <label for="i33">3. Purchase ช่องทางใดบ้างที่ลูกค้าจะสามารถซื้อสินค้าและบริการจากเราได้</label>
                            <input placeholder="โปรดระบุ..." class="form-control" id="i33" list="d33" name="i33" />
                            <datalist class="myDatalist" id="d33">
                                <option value="หน้าร้าน">
                                <option value="งานแสดงสินค้า">
                                <option value="ตลาดออนไลน์">
                                <option value="โซเชียลมีเดีย">
                                <option value="เว็บไซต์">
                                <option value="เว็บอีคอมเมิร์ช">
                                <option value="โทรทัศน์">
                                <option value="เว็บอีคอมเมิร์ช">
                            </datalist>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="i34">4. Delivery ช่องทางใดบ้างที่เราสามารถส่งมอบสินค้าและบริการของเราให้ลูกค้าได้</label>
                            <input placeholder="โปรดระบุ..." class="form-control" id="i34" list="d34" name="i34" />
                            <datalist class="myDatalist" id="d34">
                                <option value="หน้าร้าน">
                                <option value="งานแสดงสินค้า">
                                <option value="ขนส่งเอกชน">
                                <option value="โซเชียลมีเดีย">
                                <option value="เว็บไซต์">
                                <option value="YouTube">
                            </datalist>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <div class="form-group col-md-6">
                            <label for="i35">5. After-sale เราดูแลลูกค้าหลังการขายอย่างไร</label>
                            <input placeholder="โปรดระบุ..." class="form-control" id="i35" list="d35" name="i35" />
                            <datalist class="myDatalist" id="d35">
                                <option value="หน้าร้าน">
                                <option value="การโทรศัพท์">
                                <option value="บ้านลูกค้า">
                                <option value="โซเชียลมีเดีย">
                                <option value="จัดงานสังสรรค์">
                                <option value="การรับประกันสินค้า">
                                <option value="ส่งของขวัญ">
                                <option value="เปลี่ยนสินค้าหรือซ่อมฟรี">
                            </datalist>
                        </div>
                    </div>
                    <div class="form-row row mb-4">
                        <div class="form-group col-md-6">
                            <h5 for="inputName">4. ความสัมพันธ์กับลูกค้า</h5>
                            <label class="form-check-label" for="select2">
                                ผู้ประกอบการมีวิธีการสร้างความสัมพันธ์กับลูกค้าแบบใด
                            </label>
                            <select name="i41" id="select2" class="form-control">
                                <option value="0" selected>โปรดระบุ</option>
                                <option value="การให้ความช่วยเหลือส่วนบุคคลตามความต้องการ">การให้ความช่วยเหลือส่วนบุคคลตามความต้องการ</option>
                                <option value="การบริการตนเองผ่านระบบสารสนเทศ">การบริการตนเองผ่านระบบสารสนเทศ</option>
                                <option value="การบริการด้วยระบบอัตโนมัติ เช่น Line, Chatbot">การบริการด้วยระบบอัตโนมัติ เช่น Line, Chatbot</option>
                                <option value="การให้บริการแบบเชื่อมต่อถึงกันเป็นชุมชน (community) บนโซเชียลมีเดีย">การให้บริการแบบเชื่อมต่อถึงกันเป็นชุมชน (community) บนโซเชียลมีเดีย</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <h5 for="inputName">5. รายรับของธุรกิจ</h5>
                            <label class="form-check-label" for="select3">
                                ผู้ประกอบการมีรายรับผ่านช่องทางใด
                            </label>
                            <select name="i51" id="select3" class="form-control">
                                <option value="0" selected>โปรดระบุ</option>
                                <option value="จากค่าบริการ">จากค่าบริการ</option>
                                <option value="การบริการตนเองผ่านระบบสารสนเทศ">การบริการตนเองผ่านระบบสารสนเทศ</option>
                                <option value="จากการขายสินค้า">จากการขายสินค้า</option>
                                <option value="จากการร่วมลงทุนหรือสหกรณ์">จากการร่วมลงทุนหรือสหกรณ์</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row row mb-4">
                        <div class="form-group col-md-6">
                            <h5>6. รายจ่าย ต้นทุน</h5>
                            <label class="form-check-label">
                                ผู้ประกอบการมีรายจ่ายหรือต้นทุนใด <Strong>เลือกได้มากกว่า 1 ข้อ</Strong>
                            </label>
                            <div class="form-check pb-2 pt-2">
                                <input class="form-check-input" type="checkbox" name="i61" value="ค่าบำรุงรักษาเรื่องจักร เครื่องใช้ไฟฟ้า" id="c1">
                                <label class="form-check-label" for="c1">
                                    1. ค่าบำรุงรักษาเรื่องจักร เครื่องใช้ไฟฟ้า
                                </label>
                            </div>
                            <div class="form-check pb-2">
                                <input class="form-check-input" type="checkbox" name="i62" value="ค่าเช่าสำนักงาน" id="c2">
                                <label class="form-check-label" for="c2">
                                    2. ค่าเช่าสำนักงาน
                                </label>
                            </div>
                            <div class="form-check pb-2">
                                <input class="form-check-input" type="checkbox" name="i63" value="การทำโฆษณา ประชาสัมพันธ์" id="c3">
                                <label class="form-check-label" for="c3">
                                    3. การทำโฆษณา ประชาสัมพันธ์
                                </label>
                            </div>
                            <div class="form-check pb-2">
                                <input class="form-check-input" type="checkbox" name="i64" value="งบรับรองลูกค้า" id="c4">
                                <label class="form-check-label" for="c4">
                                    4. งบรับรองลูกค้า
                                </label>
                            </div>
                            <div class="form-check pb-2">
                                <input class="form-check-input" type="checkbox" name="i65" value="ค่าน้ำ ค่าไฟ ค่าสาธารณูโภค" id="c5">
                                <label class="form-check-label" for="c5">
                                    5. ค่าน้ำ ค่าไฟ ค่าสาธารณูโภค
                                </label>
                            </div>
                            <div class="form-check pb-2">
                                <input class="form-check-input" type="checkbox" name="i66" value="ค่าจ้างพนักงาน" id="c6">
                                <label class="form-check-label" for="c6">
                                    6. ค่าจ้างพนักงาน
                                </label>
                            </div>
                            <div class="form-check pb-2">
                                <input class="form-check-input" type="checkbox" name="i67" value="ค่าเช่าอินเทอร์เน็ต" id="c7">
                                <label class="form-check-label" for="c7">
                                    7. ค่าเช่าอินเทอร์เน็ต
                                </label>
                            </div>
                            <div class="form-check pb-2">
                                <input class="form-check-input" type="checkbox" name="i68" value="ค่าเดินทาง ค่าน้ำมัน ค่าขนส่งสินค้า" id="c8">
                                <label class="form-check-label" for="c8">
                                    8. ค่าเดินทาง ค่าน้ำมัน ค่าขนส่งสินค้า
                                </label>
                            </div>
                            <div class="form-check pb-2">
                                <label class="form-check-label" for="c9">
                                    9. อื่นๆ โปรดระบุ
                                </label>
                                <input type="text" class="form-control" id="c9" name="i69" placeholder="อื่นๆ โปรดระบุ..">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <h5>7. ทรัพยากรหลัก</h5>
                            <label class="form-check-label">
                                ผู้ประกอบการมีทรัพยากรหลักใดบ้างและมีทรัพย์กรใดบ้างที่ต้องการเพิ่มเติมเพื่อใช้ในการประกอบธุรกิจ <Strong>เลือกได้มากกว่า 1 ข้อ</Strong>
                            </label>
                            <label class="form-check-label pt-2">
                                1. ทรัพยากรที่มีอยู่
                            </label>
                            <div id="myDiv1">
                                <input onchange="newTextBox(this)" placeholder="โปรดระบุ..." class="form-control mt-2" id="71txt_1" list="d710" name="i71_1" />
                            </div>
                            <label class="form-check-label pt-2">
                                2. ทรัพยากรที่ต้องการเพิ่ม
                            </label>
                            <div id="myDiv2">
                                <input onchange="newTextBox2(this)" placeholder="โปรดระบุ..." class="form-control mt-2" id="72txt_1" list="d720" name="i72_1" />
                            </div>
                            <datalist class="myDatalist" id="d710">
                                <option value="คน">
                                <option value="เครื่องจักร">
                                <option value="เงินทุน">
                                <option value="ทรัพย์สินทางปัญญา">
                                <option value="ที่ดิน">
                            </datalist>
                            <datalist class="myDatalist" id="d720">
                                <option value="คน">
                                <option value="เครื่องจักร">
                                <option value="เงินทุน">
                                <option value="ทรัพย์สินทางปัญญา">
                                <option value="ที่ดิน">
                                <option value="โรงงาน">
                            </datalist>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <div class="form-group col-md-6">
                            <h5>8. กิจกรรมหลักของธุรกิจ</h5>
                            <label for="i8">ผู้ประกอบการมีกิจกรรมใดที่ช่วยขับเคลื่อนธุรกิจ</label>
                            <input name="i81" type="text" class="form-control" id="i8" placeholder="โปรดระบุ...">
                        </div>
                        <div class="form-group col-md-6">
                            <h5>9. ผู้ร่วมงานหลัก</h5>
                            <label for="i9">ผู้ประกอบการมีคู่ค้า หรือหน่วยงานสนับสนุนธุรกิจใดบ้าง</label>
                            <input name="i91" type="text" class="form-control" id="i9" placeholder="โปรดระบุ...">
                        </div>
                    </div>
                    <div class="dummy">
                        <input id="dummyCheckboxResult" name="dummyCheckboxResult" type="hidden" value="" class="form-control">
                        <input id="dummy71Result" name="dummy71Result" type="hidden" value="" class="form-control">
                        <input id="dummy72Result" name="dummy72Result" type="hidden" value="" class="form-control">
                    </div>
                </div>
                <button id="loading" class="btn btn-success mb-4 loading" type="button">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    <span class="sr-only">กำลังส่งคำตอบ...</span>
                </button>
                <button type="submit" id="handleSubmit" name="submitForm" class="btn btn-success mb-4">ส่งข้อมูลคำตอบ</button>
            </form>
        </div>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.7/dist/autoComplete.min.js"></script>

    <script>
        $('#navigation li a').click(function() {
            $('#navigation li a').removeClass('active');
            $(this).addClass('active');
        });

        $(document).ready(function() {
            $('#input1').click(function() {
                $('#id12').trigger('click');
            });
        });

        $(document).ready(function() {
            $('#select1').click(function() {
                $('#id22').trigger('click');
            });
        });

        $(document).ready(function() {
            $('#handleSubmit').click(function(e) {
                //e.preventDefault();
                $('#handleSubmit').addClass('loading');
                $('#loading').removeClass('loading');
                var c1 = $('#c1:checked').val();
                var c2 = $('#c2:checked').val();
                var c3 = $('#c3:checked').val();
                var c4 = $('#c4:checked').val();
                var c5 = $('#c5:checked').val();
                var c6 = $('#c6:checked').val();
                var c7 = $('#c7:checked').val();
                var c8 = $('#c8:checked').val();
                var c9 = $('#c9').val();
                var test = [
                    c1,
                    c2,
                    c3,
                    c4,
                    c5,
                    c6,
                    c7,
                    c8,
                    c9
                ]

                var res = [];
                let txt = '';


                test.map((value => {
                    if (value != undefined) {
                        if (value != "") {
                            txt += value + ",";
                        }
                    }
                }))


                let myDiv1 = $("#myDiv1 input[name='i71_1']").length - 1;
                let myDiv2 = $("#myDiv2 input[name='i72_1']").length - 1;
                const elements = [];
                var txtmyDiv1 = '';
                var txtmyDiv2 = '';

                for (let i = 1; i <= myDiv1; i++) {
                    txtmyDiv1 += document.getElementById(`71txt_${i}`).value + ",";
                }

                for (let i = 1; i <= myDiv2; i++) {
                    txtmyDiv2 += document.getElementById(`72txt_${i}`).value + ",";
                }

                $('#dummyCheckboxResult').val(txt.slice(0, -1));
                $('#dummy71Result').val(txtmyDiv1.slice(0, -1));
                $('#dummy72Result').val(txtmyDiv2.slice(0, -1));

                /* console.log(txtmyDiv1.slice(0, -1));
                console.log(txtmyDiv2.slice(0, -1));
                console.log(txt.slice(0, -1)); */

                setTimeout(function() {
                    $('#handleSubmit').removeClass('loading');
                    $('#loading').addClass('loading');
                }, 2000)

            });
        });

        function handleQuery() {
            var c1 = $('#c1:checked').val();
            var c2 = $('#c2:checked').val();
            var c3 = $('#c3:checked').val();
            var c4 = $('#c4:checked').val();
            var c5 = $('#c5:checked').val();
            var c6 = $('#c6:checked').val();
            var c7 = $('#c7:checked').val();
            var c8 = $('#c8:checked').val();
            var c9 = $('#c9').val();
            var test = [
                c1,
                c2,
                c3,
                c4,
                c5,
                c6,
                c7,
                c8,
                c9
            ]

            var res = [];
            let txt = '';


            test.map((value => {
                if (value != undefined) {
                    if (value != "") {
                        txt += value + "|";
                    }
                }
            }))


            let myDiv1 = $("#myDiv1 input[name='i71_1']").length - 1;
            let myDiv2 = $("#myDiv2 input[name='i72_1']").length - 1;
            const elements = [];
            var txtmyDiv1 = '';
            var txtmyDiv2 = '';

            for (let i = 1; i <= myDiv1; i++) {
                txtmyDiv1 += document.getElementById(`71txt_${i}`).value + "|";
            }

            for (let i = 1; i <= myDiv2; i++) {
                txtmyDiv2 += document.getElementById(`72txt_${i}`).value + "|";
            }

            $('#dummyCheckboxResult').val(txt.slice(0, -1));
            $('#dummy71Result').val(txtmyDiv1.slice(0, -1));
            $('#dummy72Result').val(txtmyDiv2.slice(0, -1));
            console.log(txtmyDiv1.slice(0, -1));
            console.log(txtmyDiv2.slice(0, -1));
            console.log(txt.slice(0, -1));

        }


        function newTextBox(element) {
            if (!element.value) {
                element.parentNode.removeChild(element.nextElementSibling);
                return;
            } else if (element.nextElementSibling)
                return;
            var newTxt = element.cloneNode();
            newTxt.id = '71txt_' + (parseInt(element.id.substring(element.id.indexOf('_') + 1)) + 1);
            newTxt.value = '';
            element.parentNode.appendChild(newTxt);
        }

        function newTextBox2(element) {
            if (!element.value) {
                element.parentNode.removeChild(element.nextElementSibling);
                return;
            } else if (element.nextElementSibling)
                return;
            var newTxt = element.cloneNode();
            newTxt.id = '72txt_' + (parseInt(element.id.substring(element.id.indexOf('_') + 1)) + 1);
            newTxt.value = '';
            element.parentNode.appendChild(newTxt);
        }


        var input1 = [
            "ทางศาสนา",
            "เกษตรอินทรีย์",
            "แม่บ้าน"
        ]
        var input2 = [
            'มีความแปลกใหม่ ',
            'มีประสิทธิภาพ ',
            'ราคาเหมาะสม ',
            'ช่วยลดต้นทุน',
            'ช่วยลดความเสี่ยง ',
            'เพิ่มความสะดวกสบาย ',
            'ออกแบบทันสมัย',
            'ปรับเปลี่ยนตามความต้องการของผู้บริโภค ',
            'มีแบรนด์ที่ชัดเจน',
        ]

        autocomplete(document.getElementById("input1"), input1);
        //autocomplete(document.getElementById("input2"), input2);
    </script>

</body>

</html>