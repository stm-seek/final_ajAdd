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

<body>
    <?php

    require_once 'config/db.php';
    session_start();
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
                        <a class="nav-link active" href="report.php">Report</a>
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
                            <button class="btn btn-success" type="button">
                                <i class="bi bi-person-fill"></i>
                                <span class="sr-only">ข้อมูลส่วนตัว</span>
                            </button>
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
                <p class="mt-4">
                    this report page
                <div class="row">
                    <div class="ans">
                        <ul>
                            <li>
                                ข้อ 1
                            </li>
                            <li>
                                ข้อ 2
                            </li>
                            <li>
                                ข้อ 3
                            </li>
                            <li>
                                ข้อ 4
                            </li>
                            <li>
                                ข้อ 5
                            </li>
                            <li>
                                ข้อ 6
                            </li>
                        </ul>
                    </div>
                    <div class="chart" id="piechart"></div>
                </div>
                </p>
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



        // Load google charts
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        // Draw the chart and set the chart values
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Survey', 'Report Surveys'],
                ['ข้อ1', 8],
                ['ข้อ2', 2],
                ['ข้อ3', 2],
                ['ข้อ4', 2],
                ['ข้อ5', 2],
                ['ข้อ6', 8]
            ]);

            // Optional; add a title and set the width and height of the chart
            var options = {
                'title': 'Report Surveys',
                'width': 550,
                'height': 400,
            };

            // Display the chart inside the <div> element with id="piechart"
            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }
    </script>

</body>

</html>