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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>
    <?php
    require_once '../config/db.php';
    session_start();

    if (empty($_SESSION['adminName'])) {
        echo "<script>Swal.fire({
            icon: 'error',
            title: 'Access denied',
            text: 'You not have permission to access this page',
            showConfirmButton: false,
            timer: 2500
        })</script>";
        header('refresh:2.5; url=login-admin.php');
        exit();
    }

    if(isset($_SESSION['forOne'])) {
        $name = $_SESSION['adminName'];
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

        unset($_SESSION['forOne']);
    }

    if (isset($_POST['logout'])) {
        session_destroy();
        header('location: login-admin.php');
    }

    ?>

    <div class="container">
        <h3 class="text-start mt-5 mb-4 fw-bold ">ระบบสารสนเทศเพื่อการจัดการเครือข่ายสินค้าทางการเกษตรจังหวัดสุพรรณบุรี
        </h3>
        <div class="card text-center mb-3 mt-3">
            <div class="card-header test">
                <ul class="nav nav-tabs card-header-tabs " id="navigation">
                    <li class="nav-item">
                        <a class="nav-link active" href="res-admin.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="res-question.php">รายงานแบบสำรวจ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="res-member.php">จัดการรายชื่อสมาชิก</a>
                    </li>
                </ul>
                <form action="" method="POST">
                    <button name="logout" class="btn btn-danger my-2 my-sm-0" type="submit">ออกจากระบบ</button>
                </form>
                <!-- <div class="search nav nav-tabs card-header-tabs">
                    
                </div> -->
            </div>
            <div class="tab-content text-start p-3">
                <!-- <div class="chart" id="piechart"></div> -->
                <!-- <canvas id="myChart" width="200" height="200"></canvas> -->

                <div class="admin-zone">
                    <div class="header-dash">
                        <div class="regis-person">
                            <div class="card card-con card-admin">
                                <div class="card-body body-admin">
                                    <div class="title">
                                        <?php
                                        $stmt = $conn->query("SELECT COUNT(id) FROM res_user");
                                        $stmt->execute();
                                        $result = $stmt->fetch();

                                        if ($result) {
                                        ?>
                                            <input value="<?= $result[0]; ?>" style="display: none;" type="hidden" id="Tperson"></input>
                                            <h2 class="card-title mb-2"><?= $result[0]; ?></h2>
                                        <?php } ?>
                                        <p class="card-text">คนที่ลงทะเบียน</p>
                                    </div>
                                    <div class="icon">
                                        <i class="bi bi-person-plus-fill"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="commit-person">
                            <div class="card card-con card-commit">
                                <div class="card-body body-commit">
                                    <div class="title">
                                        <?php
                                        $stmt = $conn->query("SELECT COUNT(isCommit) FROM res_user WHERE isCommit = 1");
                                        $stmt->execute();
                                        $result = $stmt->fetch();

                                        if ($result) {
                                        ?>
                                            <input value="<?= $result[0]; ?>" style="display: none;" type="hidden" id="Tcommit"></input>
                                            <h2 class="card-title mb-2"><?= $result[0]; ?></h2>
                                        <?php } ?>
                                        <p class="card-text">คนที่ตอบแบบสำรวจ</p>
                                    </div>
                                    <div class="icon">
                                        <i class="bi bi-card-checklist"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="percen-person">
                            <div class="card card-con card-percen">
                                <div class="card-body body-percen">
                                    <div class="title">
                                        <h2 id="Tpercen" class="card-title mb-2"></h2>
                                        <p class="card-text">ร้อยละของคนที่ตอบ</p>
                                    </div>
                                    <div class="icon">
                                        <i class="bi bi-percent"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="chart mt-4">
                        <div id="columnchart_material" style="width: 100%; height: 400px;"></div>
                        <!-- <canvas id="myChart" width="350" height="200"></canvas> -->
                        <div class="d-flex justify-content-end b-load">
                            <a href="#" class="btn btn-success">ดาวน์โหลดข้อมูล</a>
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

        var totalPerson = $('#Tperson').val();
        var totalCommit = $('#Tcommit').val();
        var percens = totalCommit / totalPerson;
        $('#Tpercen').html((percens.toFixed(2) * 100) + "%");

        /* var test = document.getElementById("Tperson").value; */
        
        //draw chart
        google.charts.load('current', {
            'packages': ['bar']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['ข้อคำถาม', 'ตัวเลือก 1', 'ตัวเลือก 2', 'ตัวเลือก 3', 'ตัวเลือก 4'],
                ['ข้อ 1', 5, 4, 6, 2],
                ['ข้อ 2', 2, 4, 6, 4],
                ['ข้อ 3', 5, 5, 6, 8],
                ['ข้อ 4', 3, 4, 7, 8],
                ['ข้อ 5', 5, 4, 6, 1],
                ['ข้อ 6', 5, 8, 5, 8],
                ['ข้อ 7', 2, 4, 6, 8],
                ['ข้อ 8', 5, 4, 1, 7],
                ['ข้อ 9', 3, 2, 6, 3],

            ]);

            var options = {
                titleTextStyle: {
                    fontName: 'Prompt',
                    fontSize: '22',
                    bold: true
                },
                hAxis: {
                    textStyle: {
                        fontName: 'Prompt',
                    },
                    titleTextStyle: {
                        fontName: 'Prompt',
                        fontSize: '18',
                    }
                },
                vAxis: {
                    textStyle: {
                        fontName: 'Prompt',
                    },
                    titleTextStyle: {
                        fontName: 'Prompt',
                    }
                },
                legend: {
                    textStyle: {
                        fontName: 'Prompt',

                    }
                },
                chart: {
                    title: 'จำนวนคนตอบแบบสำรวจ',
                },
            };

            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>

</body>

</html>