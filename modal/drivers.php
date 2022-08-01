<?php
require_once '../config.php';
require_once '../controller.php';
$db_handle = new Controller();
//  All post method
/**
 * Add new
 */
if (($_SERVER['REQUEST_METHOD'] === "POST") && isset($_POST['action'])) {
    if ($_POST['action'] === 'add-new') {
        $fname = $db_handle->escape_string($_POST['fname']);
        $lname = $db_handle->escape_string($_POST['lname']);
        $username = $db_handle->escape_string($_POST['username']);
        $password = $db_handle->escape_string(md5($_POST['password']));
        $ss_number = $db_handle->escape_string($_POST['ss_number']);
        $email = $db_handle->escape_string($_POST['email']);

        $sql = "INSERT INTO `users`(`fname`, `lname`, `username`, `password`, `ss_number`, `email`)
        VALUES ('$fname', '$lname', '$username', '$password', '$ss_number', '$email')";
        // echo $sql;exit;
        $qry = $db_handle->insertQuery($sql);
        if ($qry) {
            echo "<script>window.location.href = '" . BASEURL . "drivers?status=saved';</script>";
        } else {
            echo "<script>window.location.href = '" . BASEURL . "drivers?status=failed';</script>";
        }
    }
}
/**
 * Edit
 */
if (($_SERVER['REQUEST_METHOD'] === "POST") && isset($_POST['action'])) {
    if ($_POST['action'] === 'edit-driver') {
        $fname = $db_handle->escape_string($_POST['fname']);
        $lname = $db_handle->escape_string($_POST['lname']);
        $username = $db_handle->escape_string($_POST['username']);
        $password = $db_handle->escape_string(md5($_POST['password']));
        $ss_number = $db_handle->escape_string($_POST['ss_number']);
        $email = $db_handle->escape_string($_POST['email']);
        $id = $_POST['id'];
        $sql = "UPDATE `users` SET `fname`='$fname',`lname`='$lname',`username`='$username',`password`='$password',`ss_number`='$ss_number',`email`='$email' WHERE id = '$id'";
        // echo $sql;exit;
        $qry = $db_handle->insertQuery($sql);
        if ($qry) {
            echo "<script>window.location.href = '" . BASEURL . "drivers?status=saved';</script>";
        } else {
            echo "<script>window.location.href = '" . BASEURL . "drivers?status=failed';</script>";
        }
    }
}
/**
 * Delete
 */
if (($_SERVER['REQUEST_METHOD'] === "GET") && isset($_GET['action'])) {
    if ($_GET['action'] == 'delete-this') {
        $id = $_GET['id'];
        $sql = "DELETE FROM `users` WHERE id = '$id'";
        // echo $sql;exit;
        $qry = $db_handle->insertQuery($sql);
        if ($qry) {
            echo "<script>window.location.href = '" . BASEURL . "drivers?status=saved';</script>";
        } else {
            echo "<script>window.location.href = '" . BASEURL . "drivers?status=failed';</script>";
        }
    }
}
// All get method view data
if (($_SERVER['REQUEST_METHOD'] === "GET") && isset($_GET['getData']) && $_GET['getData'] == 'drivers' && $_GET['getType'] == 'edit') {
    $id = $_GET['id'];
    $rows = $db_handle->runOneQuery("SELECT * FROM `users` WHERE id = '$id' LIMIT 0,1");
    if ($rows) {
        $rows['success'] = true;
    }

    echo json_encode($rows);
}