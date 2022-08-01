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
        $bus_number = $db_handle->escape_string($_POST['bus_number']);
        $bus_capacity = $db_handle->escape_string($_POST['bus_capacity']);
        $bus_make = $db_handle->escape_string($_POST['bus_make']);
        $bus_model = $db_handle->escape_string($_POST['bus_model']);

        $sql = "INSERT INTO `bus`(`bus_number`, `bus_capacity`, `bus_make`,`bus_model`)
        VALUES ('$bus_number','$bus_capacity','$bus_make','$bus_model')";
        // echo $sql;exit;
        $qry = $db_handle->insertQuery($sql);
        if ($qry) {
            echo "<script>window.location.href = '" . BASEURL . "buses?status=saved';</script>";
        } else {
            echo "<script>window.location.href = '" . BASEURL . "buses?status=failed';</script>";
        }
    }
}
/**
 * Edit
 */
if (($_SERVER['REQUEST_METHOD'] === "POST") && isset($_POST['action'])) {
    if ($_POST['action'] === 'edit-bus') {
        $bus_number = $db_handle->escape_string($_POST['bus_number']);
        $bus_capacity = $db_handle->escape_string($_POST['bus_capacity']);
        $bus_make = $db_handle->escape_string($_POST['bus_make']);
        $bus_model = $db_handle->escape_string($_POST['bus_model']);
        $id = $_POST['id'];

        $sql = "UPDATE `bus` SET `bus_number`='$bus_number',`bus_capacity`='$bus_capacity',`bus_make`='$bus_make',`bus_model`='$bus_model' WHERE bus_id = '$id'";
        // echo $sql;exit;
        $qry = $db_handle->insertQuery($sql);
        if ($qry) {
            echo "<script>window.location.href = '" . BASEURL . "buses?status=saved';</script>";
        } else {
            echo "<script>window.location.href = '" . BASEURL . "buses?status=failed';</script>";
        }
    }
}
/**
 * Delete
 */
if (($_SERVER['REQUEST_METHOD'] === "GET") && isset($_GET['action'])) {
    if ($_GET['action'] == 'delete-this') {
        $id = $_GET['id'];
        $sql = "DELETE FROM `bus` WHERE bus_id = '$id'";
        // echo $sql;exit;
        $qry = $db_handle->insertQuery($sql);
        if ($qry) {
            echo "<script>window.location.href = '" . BASEURL . "buses?status=saved';</script>";
        } else {
            echo "<script>window.location.href = '" . BASEURL . "buses?status=failed';</script>";
        }
    }
}
// All get method view data
if (($_SERVER['REQUEST_METHOD'] === "GET") && isset($_GET['getData']) && $_GET['getData'] == 'bus' && $_GET['getType'] == 'edit') {
    $id = $_GET['id'];
    $rows = $db_handle->runOneQuery("SELECT * FROM `bus` WHERE bus_id = '$id' LIMIT 0,1");
    if ($rows) {
        $rows['success'] = true;
    }

    echo json_encode($rows);
}