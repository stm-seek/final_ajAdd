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
    <link href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>



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

    if (isset($_POST['logout'])) {
        session_destroy();
        header('location: login-admin.php');
    }

    if (isset($_POST['update'])) {
        $id = $_POST['idd'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $pass = $_POST['pass'];
        $ceery = $_POST['ceery'];
        $typecom = $_POST['typecom'];
        $comname = $_POST['comname'];
        $pro = $_POST['pro'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];

        $sql = $conn->query("UPDATE `res_user` SET `fname` = '$fname', `lname` = '$lname', `login` = '$pass', `occupation` = '$ceery', `enterprise` = '$comname', `enterprise_type_name` = '$typecom', `product_service` = '$pro', `address` = '$address', `email` = '$email', `phone` = '$phone' WHERE `res_user`.`id` = $id");

        $sql->execute();

        if ($sql) {
            $_SESSION['success'] = "Update data successfully";
        } else {
            $_SESSION['error'] = "Fail to update data";
        }
    }

    if (isset($_GET['delete'])) {
        $delID = $_GET['delete'];
        $sql = $conn->query("DELETE FROM res_user WHERE id = $delID");
        $sql->execute();

        if ($sql) {
            $_SESSION['delsuccess'] = "Delete data successfully";
        } else {
            $_SESSION['delerror'] = "Fail to delete data";
        }
    }

    if (isset($_SESSION['success'])) {
        $mes = $_SESSION['success'];
        echo "<script>Swal.fire({
                icon: 'success',
                title: '$mes',
                text: 'อัพเดทข้อมูลสำเร็จแล้ว',
                showConfirmButton: false,
                timer: 2500
            })</script>";
        unset($_SESSION['success']);
    }

    if (isset($_SESSION['error'])) {
        $mes = $_SESSION['error'];
        echo "<script>Swal.fire({
                icon: 'success',
                title: '$mes',
                text: 'อัพเดทข้อมูลไม่สำเร็จ',
                showConfirmButton: false,
                timer: 2500
            })</script>";
        unset($_SESSION['success']);
    }

    if (isset($_SESSION['delsuccess'])) {
        $mes = $_SESSION['delsuccess'];
        echo "<script>Swal.fire({
                icon: 'success',
                title: '$mes',
                text: 'ลบข้อมูลสำเร็จแล้ว',
                showConfirmButton: false,
                timer: 2500
            })</script>";
        unset($_SESSION['delsuccess']);
        header("refresh:1; url=res-member.php");
    }

    if (isset($_SESSION['delerror'])) {
        $mes = $_SESSION['delerror'];
        echo "<script>Swal.fire({
                icon: 'success',
                title: '$mes',
                text: 'ลบข้อมูลไม่สำเร็จ',
                showConfirmButton: false,
                timer: 2500
            })</script>";
        unset($_SESSION['delerror']);
        header("refresh:1; url=res-member.php");
    }
    ?>

    <div class="container container-admin">
        <h3 class="text-start mt-5 mb-4 fw-bold ">ระบบสารสนเทศเพื่อการจัดการเครือข่ายสินค้าทางการเกษตรจังหวัดสุพรรณบุรี
        </h3>
        <div class="card text-center mb-3 mt-3">
            <div class="card-header test">
                <ul class="nav nav-tabs card-header-tabs " id="navigation">
                    <li class="nav-item">
                        <a class="nav-link " href="res-admin.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="res-question.php">รายงานแบบสำรวจ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="res-member.php">จัดการรายชื่อสมาชิก</a>
                    </li>
                </ul>
                <form action="" method="POST">
                    <button name="logout" class="btn btn-danger my-2 my-sm-0" type="submit">ออกจากระบบ</button>
                </form>
            </div>
            <div class="tab-content text-start p-4">
                <div class="row">
                    <div class="col-6">
                        <table id="myTable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">ชื่อ</th>
                                    <th scope="col">นามสกุล</th>
                                    <th scope="col">แบบสอบถาม</th>
                                    <th scope="col">สถานะ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $stmt = $conn->query("SELECT * FROM res_user");
                                $stmt->execute();

                                $users = $stmt->fetchAll();

                                if (!$users) {
                                    echo "<tr><td colspan='6' class='text-center'>No user found</td></tr>";
                                } else {
                                    foreach ($users as $userData) {
                                ?>
                                        <tr>
                                            <th scope="row"><?= $userData['id'] ?></th>
                                            <td style="display:none;"><?= $userData['id'] ?></td>
                                            <td><?= $userData['fname'] ?></td>
                                            <td><?= $userData['lname'] ?></td>
                                            <td>
                                                <?php
                                                if ($userData['isCommit'] == 1) { ?>
                                                    <a href="?view=<?= $userData['id'] ?>" class="btn btn-primary editbtn">ดูเพิ่มเติม</a>
                                                <?php } else { 
                                                    echo "<button disabled class='btn btn-primary editbtn'>ดูเพิ่มเติม</button>";
                                                }
                                                ?>
                                                
                                            </td>
                                            <td>
                                                <?php
                                                if ($userData['isCommit'] == 1) {
                                                    echo "<button disabled class='btn btn-success w-75'>ทำแล้ว</button>";
                                                } else {
                                                    echo "<button disabled class='btn btn-danger w-75'>ยังไม่ทำ</button>";
                                                }
                                                ?>
                                            </td>
                                        </tr>

                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-6">
                        <?php
                        if (isset($_GET['view'])) {
                            $id = $_GET['view'];
                            $stmt = $conn->query("SELECT ru.fname AS name, ss.name AS question, sl.answer AS answer FROM `survey_line` sl JOIN res_user ru ON ru.id = sl.user_id JOIN survey ss ON ss.id = sl.survey_id WHERE ru.id = $id");

                            if ($stmt) {
                                $result = $stmt->fetchAll();

                        ?>
                                <form action="config/insert_survey.php" method="POST" autocomplete="off">
                                    <div class="text-start p-4">
                                        <div class="form-row row mb-4">
                                            <div class="form-group col-md-6">
                                                <h5 for="inputName">1. กลุ่มลูกค้าของธุรกิจ</h5>
                                                <div class="form-group autocomplete">
                                                    <input disabled class="form-control mr-sm-2" name="i122" id="ans1" type="search" value=<?= $result[0]['answer']; ?>>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <h5 for="inputName">2. คุณค่าของสินค้าและบริการของธุรกิจ</h5>
                                                <input disabled class="form-control mr-sm-2" name="i122" id="ans1" type="search" value=<?= $result[1]['answer']; ?>>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <h5 for="inputName">3. ช่องทางการเข้าถึงลูกค้าหรือการนำเสนอสินค้า</h5>
                                            <div class="form-group col-md-6">
                                                <label for="i31">1. Awareness ลูกค้าจะรับรู้ถึงสินค้าและบริการของเราได้อย่างไร</label>
                                                <input disabled class="form-control mr-sm-2" name="i122" id="ans1" type="search" value=<?= $result[2]['answer']; ?>>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="i32">2. Evaluation ลูกค้าจะมองเห็นคุณค่าในสินค้าและบริการของเราได้ทางใดบ้าง</label>
                                                <input disabled class="form-control mr-sm-2" name="i122" id="ans1" type="search" value=<?= $result[3]['answer']; ?>>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <div class="form-group col-md-6">
                                                <label for="i33">3. Purchase ช่องทางใดบ้างที่ลูกค้าจะสามารถซื้อสินค้าและบริการจากเราได้</label>
                                                <input disabled class="form-control mr-sm-2" name="i122" id="ans1" type="search" value=<?= $result[4]['answer']; ?>>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="i34">4. Delivery ช่องทางใดบ้างที่เราสามารถส่งมอบสินค้าและบริการของเราให้ลูกค้าได้</label>
                                                <input disabled class="form-control mr-sm-2" name="i122" id="ans1" type="search" value=<?= $result[5]['answer']; ?>>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <div class="form-group col-md-6">
                                                <label for="i35">5. After-sale เราดูแลลูกค้าหลังการขายอย่างไร</label>
                                                <input disabled class="form-control mr-sm-2" name="i122" id="ans1" type="search" value=<?= $result[6]['answer']; ?>>
                                            </div>
                                        </div>
                                        <div class="form-row row mb-4">
                                            <div class="form-group col-md-6">
                                                <h5 for="inputName">4. ความสัมพันธ์กับลูกค้า</h5>
                                                <label class="form-check-label" for="select2">
                                                    ผู้ประกอบการมีวิธีการสร้างความสัมพันธ์กับลูกค้าแบบใด
                                                </label>
                                                <input disabled class="form-control mr-sm-2" name="i122" id="ans1" type="search" value=<?= $result[7]['answer']; ?>>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <h5 for="inputName">5. รายรับของธุรกิจ</h5>
                                                <label class="form-check-label" for="select3">
                                                    ผู้ประกอบการมีรายรับผ่านช่องทางใด
                                                </label>
                                                <input disabled class="form-control mr-sm-2" name="i122" id="ans1" type="search" value=<?= $result[8]['answer']; ?>>
                                            </div>
                                        </div>
                                        <div class="form-row row mb-4">
                                            <div class="form-group col-md-6">
                                                <h5>6. รายจ่าย ต้นทุน</h5>
                                                <label class="form-check-label">
                                                    ผู้ประกอบการมีรายจ่ายหรือต้นทุนใด <Strong>เลือกได้มากกว่า 1 ข้อ</Strong>
                                                </label>
                                                <textarea disabled class="form-control" rows="4" cols="50" name="i122" id="ans1" type="search"><?php echo $result[9]['answer']; ?></textarea>
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
                                                    <input disabled class="form-control mr-sm-2" name="i122" id="ans1" type="search" value=<?= $result[10]['answer']; ?>>
                                                </div>
                                                <label class="form-check-label pt-2">
                                                    2. ทรัพยากรที่ต้องการเพิ่ม
                                                </label>
                                                <div id="myDiv2">
                                                    <input disabled class="form-control mr-sm-2" name="i122" id="ans1" type="search" value=<?= $result[11]['answer']; ?>>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <div class="form-group col-md-6">
                                                <h5>8. กิจกรรมหลักของธุรกิจ</h5>
                                                <label for="i8">ผู้ประกอบการมีกิจกรรมใดที่ช่วยขับเคลื่อนธุรกิจ</label>
                                                <input disabled class="form-control mr-sm-2" name="i122" id="ans1" type="search" value=<?= $result[12]['answer']; ?>>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <h5>9. ผู้ร่วมงานหลัก</h5>
                                                <label for="i9">ผู้ประกอบการมีคู่ค้า หรือหน่วยงานสนับสนุนธุรกิจใดบ้าง</label>
                                                <input disabled class="form-control mr-sm-2" name="i122" id="ans1" type="search" value=<?= $result[13]['answer']; ?>>
                                            </div>
                                        </div>
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


    </div>

    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script>
        $('#navigation li a').click(function() {
            $('#navigation li a').removeClass('active');
            $(this).addClass('active');
        });

        $('#close').click(function() {
            $('#userModal').modal('hide')
        })

        $(document).ready(function() {
            $('.editbtn').on('click', function() {
                $tr = $(this).closest('tr');

                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();

                //console.log(data);
                $('#inputID').val(data[0]);
                $('#inputFName').val(data[1]);
                $('#inputLName').val(data[2]);
                $('#inputPassword').val(data[3]);
                $('#inputCeery').val(data[4]);
                $('#inputComName').val(data[5]);
                $('#inputTypeCom').val(data[6]);
                $('#inputPro').val(data[7]);
                $('#inputAddress').val(data[8]);
                $('#inputEmail').val(data[9]);
                $('#inputPhone').val(data[10]);
            });
        });

        $(document).ready(function() {
            $('.del').on('click', function(e) {
                e.preventDefault();

                $tr = $(this).closest('tr');

                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();

                var uid = data[0];

                Swal.fire({
                    title: 'Are you sure?',
                    text: "คุณต้องการที่จะลบข้อมูลหรือไม่!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "?delete=" + uid;
                    }
                })
            })
        })
    </script>

</body>

</html>