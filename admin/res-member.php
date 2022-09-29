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

    <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูลสมาชิก</h5>
                    <button type="button" id="close" class="close cd" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="res-member.php" method="POST">
                        <div class="text-start p-4">
                            <div class="form-group col-md-6">
                                <input name="idd" type="hidden" class="form-control" id="inputID">
                            </div>
                            <div class="form-row row mb-4">
                                <div class="form-group col-md-6">
                                    <label for="inputName">ชื่อ</label>
                                    <input name="fname" type="text" class="form-control" id="inputFName" placeholder="ชื่อจริง">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputFName">นามสกุล</label>
                                    <input name="lname" type="text" class="form-control" id="inputLName" placeholder="นามสกุล">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <div class="form-group col-md-6">
                                    <label for="inputPassword">รหัสผ่านเข้าสู่ระบบ</label>
                                    <input name="pass" type="text" class="form-control" id="inputPassword" placeholder="รหัสผ่าน">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <div class="form-group col-md-6">
                                    <label for="inputCeery">อาชีพ</label>
                                    <input name="ceery" type="text" class="form-control" id="inputCeery" placeholder="อาชีพ">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputTypeCom">ประเภทกลุ่มวิสาหกิจ</label>
                                    <select name="typecom" id="inputTypeCom" class="form-control">
                                        <option value="0" selected>เลือกประเภท</option>
                                        <option value="กลุ่มที่1">กลุ่มที่1</option>
                                        <option value="กลุ่มที่2">กลุ่มที่2</option>
                                        <option value="กลุ่มที่3">กลุ่มที่3</option>
                                        <option value="กลุ่มที่4">กลุ่มที่4</option>
                                        <option value="กลุ่มที่5">กลุ่มที่5</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row row mb-4">
                                <div class="form-group col-md-6">
                                    <label for="inputComName">ชื่อกลุ่มวิสาหกิจ</label>
                                    <input name="comname" type="text" class="form-control" id="inputComName" placeholder="ชื่อกลุ่มวิสาหกิจ">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputProduct">สินค้าและบริการ</label>
                                    <input name="pro" type="text" class="form-control" id="inputPro" placeholder="สินค้าและบริการ">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <div class="form-group col-md-6">
                                    <label for="inputAddress">ที่อยู่</label>
                                    <input name="address" type="text" class="form-control" id="inputAddress" placeholder="ที่อยู่">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPhone">เบอร์โทรศัพท์</label>
                                    <input name="phone" type="tel" class="form-control" id="inputPhone" placeholder="เบอร์โทรศัพท์">
                                </div>
                            </div>
                            <div class="form-group row md-4">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail">Email</label>
                                    <input name="email" type="email" class="form-control" id="inputEmail" placeholder="อีเมล์">
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button name="update" type="submit" class="btn btn-success">บันทึกข้อมูล</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="container">
        <h3 class="text-start mt-5 mb-4 fw-bold ">ระบบสารสนเทศเพื่อการจัดการเครือข่ายสินค้าทางการเกษตรจังหวัดสุพรรณบุรี
        </h3>
        <div class="card text-center mb-3 mt-3">
            <div class="card-header test">
                <ul class="nav nav-tabs card-header-tabs " id="navigation">
                    <li class="nav-item">
                        <a class="nav-link " href="res-admin.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="res-question.php">รายงานแบบสำรวจ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="res-member.php">จัดการรายชื่อสมาชิก</a>
                    </li>
                </ul>
                <form action="" method="POST">
                    <button name="logout" class="btn btn-danger my-2 my-sm-0" type="submit">ออกจากระบบ</button>
                </form>
                <!-- <div class="search nav nav-tabs card-header-tabs">
                    
                </div> -->
            </div>
            <div class="tab-content text-start p-3">
                <table id="myTable" class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ชื่อ</th>
                            <th scope="col">นามสกุล</th>
                            <th scope="col">รหัสผ่านเข้าสู่ระบบ</th>
                            <th scope="col">Email</th>
                            <th scope="col">เบอร์โทรศัพท์</th>
                            <th scope="col">Action</th>
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
                                    <td><?= $userData['login'] ?></td>
                                    <td style="display:none;"><?= $userData['occupation'] ?></td>
                                    <td style="display:none;"><?= $userData['enterprise'] ?></td>
                                    <td style="display:none;"><?= $userData['enterprise_type_name'] ?></td>
                                    <td style="display:none;"><?= $userData['product_service'] ?></td>
                                    <td style="display:none;"><?= $userData['address'] ?></td>
                                    <td><?= $userData['email'] ?></td>
                                    <td><?= $userData['phone'] ?></td>
                                    <td>
                                        <a href="?view=<?= $userData['id'] ?>" data-bs-toggle="modal" data-bs-target="#userModal" class="btn btn-primary editbtn">ดูเพิ่มเติม</a>
                                        <a href="?delete=<?= $userData['id'] ?>" id="del" class="btn btn-danger del">ลบผู้ใช้</a> <!-- href="?delete=<?= $userData['id'] ?>" -->
                                    </td>
                                </tr>

                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
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