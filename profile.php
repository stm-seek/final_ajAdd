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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <?php
    require_once 'config/db.php';
    session_start();
    if (empty($_SESSION['uid'])) {
        echo "<script>Swal.fire({
            icon: 'error',
            title: 'เกิดข้อผิดพลาด',
            text: 'กรุณาเข้าสู่ระบบก่อนใช้งานหน้านี้',
            showConfirmButton: false,
            timer: 2500
        })</script>";
        header("refresh: 2.5; url=index.php ");
        exit();
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
                                <a class="dropdown-item" href="update_profile.php">แก้ไขข้อมูลส่วนตัว</a>
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
                <div class="menu row display-flex justify-between">
                    <div class="title-txt">
                        <div class="title-body">
                            <h4>ข้อมูลส่วนตัว</h4>
                        </div>
                    </div>
                    <div class="body-txt">
                        <div class="p-3">
                            <div class="form-group row mb-4">
                                <div class="form-group border rounded p-2 col-md-6">
                                    <?php
                                    if (!empty($_SESSION['uid'])) {
                                        $uid = $_SESSION['uid'];
                                        $stmt = $conn->query("SELECT * FROM res_user WHERE id = $uid");

                                        if ($stmt) {
                                            $result = $stmt->fetch();
                                    ?>
                                            <form>
                                                <div class="text-start p-3">
                                                    <div class="form-row row mb-4">
                                                        <div class="form-group col-md-6">
                                                            <label for="inputName">ชื่อ</label>
                                                            <input type="text" class="form-control" name="inputFName" id="inputFName" disabled value=<?= $result['fname']?>>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="inputFName">นามสกุล</label>
                                                            <input type="text" class="form-control" name="inputLName" id="inputLName" disabled value=<?= $result['lname']?>>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-4">
                                                        <div class="form-group col-md-6">
                                                            <label for="inputEmail">Email</label>
                                                            <input type="email" class="form-control" name="inputEmail" id="inputEmail" disabled value=<?= $result['email']?>>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="inputPassword">รหัสผ่านเข้าสู่ระบบ</label>
                                                            <input type="password" class="form-control" name="inputPassword" id="inputPassword" disabled value=<?= $result['login']?>>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-4">
                                                        <div class="form-group col-md-6">
                                                            <label for="inputCeery">อาชีพ</label>
                                                            <input type="text" class="form-control" name="inputCeery" id="inputCeery" disabled value=<?= $result['occupation']?>>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="inputTypeCom">ประเภทกลุ่มวิสาหกิจ</label>
                                                            <input type="text" class="form-control" name="inputTypeCom" id="inputTypeCom" disabled value=<?= $result['enterprise']?>>
                                                        </div>
                                                    </div>
                                                    <div class="form-row row mb-4">
                                                        <div class="form-group col-md-6">
                                                            <label for="inputComName">ชื่อกลุ่มวิสาหกิจ</label>
                                                            <input type="text" class="form-control" name="inputComName" id="inputComName" disabled value=<?= $result['enterprise_type_name']?>>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="inputPro">สินค้าและบริการ</label>
                                                            <input class="form-control" name="inputPro" id="inputPro" disabled value=<?= $result['product_service']?>>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-4">
                                                        <div class="form-group col-md-6">
                                                            <label for="inputAddress">ที่อยู่</label>
                                                            <input type="text" class="form-control" name="inputAddress" id="inputAddress" disabled value=<?= $result['address']?>>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="inputPhone">เบอร์โทรศัพท์</label>
                                                            <input type="tel" class="form-control" name="inputPhone" id="inputPhone" disabled value=<?= $result['phone']?>>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>

                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <div class="form-group col-md-5">
                                    <div class="chart" id="piechart"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
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

        var data1 = 0;
        var data2 = 0;
        var data3 = 0;
        var data4 = 0;
        var data5 = 0;
        var data6 = 0;
        var data7 = 0;
        var data8 = 0;

        fetch('http://localhost/web-aj-autthadej/frontend/config/data_api.php')
            .then((response) => response.json())
            .then(function(data) {
                data1 = data[0]['เกษตรกร']
                data2 = data[0]['ปศุสัตว์']
                data3 = data[0]['บุคลากรภาครัฐ']
                data4 = data[0]['บุคลากรภาคเอกชน']
                data5 = data[0]['การประมง']
                data6 = data[0]['อาหารและเครื่องดื่ม']
                data7 = data[0]['ช่าง']
                data8 = data[0]['นักออกแบบ']
            });

        // Load google charts
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        // Draw the chart and set the chart values
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Survey', 'Report Surveys'],
                ['เกษตรกร', data1],
                ['ปศุสัตว์', data2],
                ['บุคลากรภาครัฐ', data3],
                ['บุคลากรภาคเอกชน', data4],
                ['การประมง', data5],
                ['อาหารและเครื่องดื่ม', data6],
                ['ช่าง', data7],
                ['นักออกแบบ', data8]
            ]);

            // Optional; add a title and set the width and height of the chart
            var options = {
                width: 600,
                height: 500,
                title: 'สถิติหมวดหมู่อาชีพ',
            };

            // Display the chart inside the <div> element with id="piechart"
            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);

        }
    </script>

</body>

</html>