<?php
require_once 'db.php';
session_start();

if (isset($_POST['submitForm'])) {
    $id;
    $ans11 = '';
    $ans21 = '';
    $ans31 = '';
    $ans32 = '';
    $ans33 = '';
    $ans34 = '';
    $ans35 = '';
    $ans41 = '';
    $ans51 = '';
    $ans61 = '';
    $ans71 = '';
    $ans72 = '';
    $ans81 = '';
    $ans91 = '';

    if ($_POST['i11'] == 'on') {
        $ans11 = $_POST['i122'];
    } else {
        $ans11 = $_POST['i11'];
    }

    if ($_POST['i21'] == 'on') {
        $ans21 = $_POST['i222'];
    } else {
        $ans21 = $_POST['i21'];
    }

    $id = $_SESSION['uid'];
    $ans31 = $_POST['i31'];
    $ans32 = $_POST['i32'];
    $ans33 = $_POST['i33'];
    $ans34 = $_POST['i34'];
    $ans35 = $_POST['i35'];
    $ans41 = $_POST['i41'];
    $ans51 = $_POST['i51'];
    $ans61 = $_POST['dummyCheckboxResult'];
    $ans71 = $_POST['dummy71Result'];
    $ans72 = $_POST['dummy72Result'];
    $ans81 = $_POST['i81'];
    $ans91 = $_POST['i91'];

    $ans =
        [
            $ans11,
            $ans21,
            $ans31,
            $ans32,
            $ans33,
            $ans34,
            $ans35,
            $ans41,
            $ans51,
            $ans61,
            $ans71,
            $ans72,
            $ans81,
            $ans91,
        ];

    $checkUID = $conn->query("SELECT * FROM res_user WHERE id = $id and isCommit = 1");

    if ($checkUID->rowCount() != 0) {
        $_SESSION['aleady_commit'] = "true";
        header("location: ../survey.php");
    } else {
        for ($i = 0; $i < 14; $i++) {
            $index = $i + 1;
            $sql = $conn->query("INSERT INTO survey_line (survey_id, user_id, answer) VALUE($index, $id, '$ans[$i]')");
        }

        $commit = $conn->query("UPDATE `res_user` SET `isCommit` = 1 WHERE `res_user`.`id` = $id");

        if ($sql and $commit) {
            $_SESSION['insert_survey_success'] = "true";
            header("location: ../survey.php");
        } else {
            $_SESSION['insert_survey_error'] = "true";
            header("location: ../survey.php");
        }
    }
}
