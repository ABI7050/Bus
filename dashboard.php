<?php require_once 'pageheader.php';?>
<!-- Main content -->
<!-- Header -->

<head>

</head>
<div class="header bg-danger pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <?php if ($db_handle->check_admin()) {?>
            <div class="row">
                <div class="col-xl-4 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">No of Buses Available</h5>
                                    <span class="h2 font-weight-bold mb-0"><?php echo $db_handle->getCount('bus'); ?></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                        <i class="fas fa-bus-alt"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">No of Drivers Available</h5>
                                    <span class="h2 font-weight-bold mb-0"><?php echo $db_handle->getCount('users'); ?></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                        <i class="far fa-id-badge"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">No of Schedule Planned</h5>
                                    <span class="h2 font-weight-bold mb-0">
                                        <?php echo $db_handle->getCount('schedule'); ?></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                        <i class="far fa-calendar-alt"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php }?>
        </div>
    </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card">
                    <div class="card-body">
                        <h4>Today Scheduled Buses</h4>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Bus No</th>
                                    <th>Driver</th>
                                    <th>Departure Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                    $dat = date('Y-m-d');
                                    if ($db_handle->check_admin()) {
                                        $rows = $db_handle->runQuery("SELECT bus.bus_number,bus.bus_capacity,users.fname,users.lname,schedule.* FROM `schedule` JOIN bus ON bus.bus_id = schedule.bus_id JOIN users ON
                                    users.id = schedule.driver_id WHERE schedule.start_date = '$dat'");
                                    } else {
                                        $rows = $db_handle->runQuery("SELECT bus.bus_number,bus.bus_capacity,users.fname,users.lname,schedule.* FROM `schedule` JOIN bus ON bus.bus_id = schedule.bus_id JOIN users ON
                                    users.id = schedule.driver_id WHERE schedule.start_date = '$dat' AND users.id = '" . $_SESSION['userId'] . "' ");
                                    }
                                foreach ($rows as $row) {?>
                                <tr>
                                    <td scope="row"><?=$i?></td>
                                    <td><?=$row['bus_number']?></td>
                                    <td><?=$row['fname'] . ' ' . $row['lname'];?></td>
                                    <td><?=$row['start_time']?></td>
                                </tr>
                                <?php $i++;}?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card ">
                <div class="card-body">
                    <h4>This week Scheduled Buses</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Bus No</th>
                                <th>Driver</th>
                                <th>Departure Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                                $dat = date('Y-m-d');
                                $week_no = 7 - date('N');
                                $week = date('Y-m-d', strtotime($dat . ' + ' . $week_no . ' day'));
                                if ($db_handle->check_admin()) {
                                    $rows = $db_handle->runQuery("SELECT bus.bus_number,bus.bus_capacity,users.fname,users.lname,schedule.* FROM `schedule` JOIN bus ON bus.bus_id = schedule.bus_id JOIN users ON
                                    users.id = schedule.driver_id WHERE schedule.start_date >= '$dat' AND schedule.start_date <= '$week' ");
                                } else {
                                    $rows = $db_handle->runQuery("SELECT bus.bus_number,bus.bus_capacity,users.fname,users.lname,schedule.* FROM `schedule` JOIN bus ON bus.bus_id = schedule.bus_id JOIN users ON
                                    users.id = schedule.driver_id WHERE schedule.start_date >= '$dat' AND schedule.start_date <= '$week' AND users.id = '" . $_SESSION['userId'] . "' ");
                                }

                            foreach ($rows as $row) {?>
                            <tr>
                                <td scope="row"><?=$i?></td>
                                <td><?=$row['bus_number']?></td>
                                <td><?=$row['fname'] . ' ' . $row['lname'];?></td>
                                <td><?=$row['start_time']?></td>
                            </tr>
                            <?php $i++;}?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once 'pagefooter.php';?>
<script>
</script>