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
        $bus_id = $db_handle->escape_string($_POST['bus_id']);
        $driver_id = $db_handle->escape_string($_POST['driver_id']);
        $start_date = $db_handle->escape_string($_POST['start_date']);
        $end_date = $db_handle->escape_string($_POST['end_date']);
        $start_time = $db_handle->escape_string($_POST['start_time']);
        $end_time = $db_handle->escape_string($_POST['end_time']);

        $sql = "INSERT INTO `schedule`( `start_date`, `end_date`, `start_time`, `end_time`, `driver_id`, `bus_id`)
        VALUES ('$start_date', '$end_date', '$start_time', '$end_time', '$driver_id', '$bus_id')";
        // echo $sql;exit;
        $qry = $db_handle->insertQuery($sql);
        if ($qry) {
            echo "<script>window.location.href = '" . BASEURL . "schedule?status=saved';</script>";
        } else {
            echo "<script>window.location.href = '" . BASEURL . "schedule?status=failed';</script>";
        }
    }
}
/**
 * Edit
 */
if (($_SERVER['REQUEST_METHOD'] === "POST") && isset($_POST['action'])) {
    if ($_POST['action'] === 'edit-schedule') {
        $bus_id = $db_handle->escape_string($_POST['bus_id']);
        $driver_id = $db_handle->escape_string($_POST['driver_id']);
        $start_date = $db_handle->escape_string($_POST['start_date']);
        $end_date = $db_handle->escape_string($_POST['end_date']);
        $start_time = $db_handle->escape_string($_POST['start_time']);
        $end_time = $db_handle->escape_string($_POST['end_time']);
        $id = $_POST['id'];

        $sql = "UPDATE `schedule` SET `start_date`='$start_date',`end_date`='$end_date',`start_time`='$start_time',`end_time`='$end_time',`driver_id`='$driver_id',`bus_id`='$bus_id' WHERE schedule_id = '$id'";
        // echo $sql;exit;
        $qry = $db_handle->insertQuery($sql);
        if ($qry) {
            echo "<script>window.location.href = '" . BASEURL . "schedule?status=saved';</script>";
        } else {
            echo "<script>window.location.href = '" . BASEURL . "schedule?status=failed';</script>";
        }
    }
}
/**
 * Delete
 */
if (($_SERVER['REQUEST_METHOD'] === "GET") && isset($_GET['action'])) {
    if ($_GET['action'] == 'delete-this') {
        $id = $_GET['id'];
        $sql = "DELETE FROM `schedule` WHERE schedule_id = '$id'";
        // echo $sql;exit;
        $qry = $db_handle->insertQuery($sql);
        if ($qry) {
            echo "<script>window.location.href = '" . BASEURL . "schedule?status=saved';</script>";
        } else {
            echo "<script>window.location.href = '" . BASEURL . "schedule?status=failed';</script>";
        }
    }
}
// All get method view data
if (($_SERVER['REQUEST_METHOD'] === "GET") && isset($_GET['getData']) && $_GET['getData'] == 'schedule' && $_GET['getType'] == 'edit') {
    $id = $_GET['id'];
    $rows = $db_handle->runOneQuery("SELECT * FROM `schedule` WHERE schedule_id = '$id' LIMIT 0,1");
    if ($rows) {
        $rows['success'] = true;
    }

    echo json_encode($rows);
}

// All get method view data
if (($_SERVER['REQUEST_METHOD'] === "GET") && isset($_GET['getData']) && $_GET['getData'] == 'schedule' && $_GET['getType'] == 'search') {
    $key = $_GET['key'];
    $sql_driver = "SELECT bus.bus_number,bus.bus_capacity,users.fname,users.lname,schedule.* FROM `schedule` JOIN bus ON bus.bus_id = schedule.bus_id JOIN users ON
        users.id = schedule.driver_id WHERE users.fname LIKE '$key%' OR users.lname LIKE '$key%' ";
    $sql_bus = "SELECT bus.bus_number,bus.bus_capacity,users.fname,users.lname,schedule.* FROM `schedule` JOIN bus ON bus.bus_id = schedule.bus_id JOIN users ON
        users.id = schedule.driver_id WHERE bus.bus_number LIKE '$key%'";
    // echo $sql_bus;
    if ($db_handle->numRows($sql_driver) > 0) {
        $rows = $db_handle->runQuery($sql_driver);
    } else if ($db_handle->numRows($sql_bus) > 0) {
        $rows = $db_handle->runQuery($sql_bus);
    } else {
        $rows = [];
    }

    $i = 1;
    $html = '';
    foreach ($rows as $row) {
        $html .= "<tr>";
        $html .= "<td>" . $i . "</td>";
        $html .= " <td>" . $row['bus_number'] . " / Capacity - " . $row['bus_capacity'] . "</td>";
        $html .= " <td>" . $row['fname'] . " " . $row['lname'] . "</td>";
        $html .= " <td>" . $row['start_date'] . " - " . $row['start_time'] . "</td>";
        $html .= " <td>" . $row['end_date'] . " - " . $row['end_time'] . "</td>";
        $html .= "</tr>";
        $i++;
    }

    if ($rows) {
        $response['status'] = true;
        $response['html'] = $html;
    } else {
        $response['status'] = false;
    }

    echo json_encode($response);
}

// All get method view data
if (($_SERVER['REQUEST_METHOD'] === "GET") && isset($_GET['getData']) && $_GET['getData'] == 'schedule' && $_GET['getType'] == 'search_date') {
    $from_date = $_GET['from_date'];
    $to_date = $_GET['to_date'];
    $sql_date = "SELECT bus.bus_number,bus.bus_capacity,users.fname,users.lname,schedule.* FROM `schedule` JOIN bus ON bus.bus_id = schedule.bus_id JOIN users ON
        users.id = schedule.driver_id WHERE schedule.start_date >= '$from_date' OR schedule.end_date <= '$to_date'";
    if ($db_handle->numRows($sql_date) > 0) {
        $rows = $db_handle->runQuery($sql_date);
    } else {
        $rows = [];
    }

    $i = 1;
    $html = '';
    foreach ($rows as $row) {
        $html .= "<tr>";
        $html .= "<td>" . $i . "</td>";
        $html .= " <td>" . $row['bus_number'] . " / Capacity - " . $row['bus_capacity'] . "</td>";
        $html .= " <td>" . $row['fname'] . " " . $row['lname'] . "</td>";
        $html .= " <td>" . $row['start_date'] . " - " . $row['start_time'] . "</td>";
        $html .= " <td>" . $row['end_date'] . " - " . $row['end_time'] . "</td>";
        $html .= "</tr>";
        $i++;
    }

    if ($rows) {
        $response['status'] = true;
        $response['html'] = $html;
    } else {
        $response['status'] = false;
    }

    echo json_encode($response);
}