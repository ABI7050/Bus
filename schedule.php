<?php require_once 'pageheader.php';?>
<!-- Main content -->
<!-- Header -->
<div class="header bg-danger pb-6">
    <div class="container-fluid">
        <div class="header-body">
        </div>
    </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <?php if ($db_handle->check_admin()) {?>
                    <button type='button' data-toggle="modal" data-target="#modal-add" class="btn btn-info mb-3 float-right">Add New</button>
                    <?php }?>
                    <h3 class="mb-0">Upcoming Schedule Details</h3>
                    <div class="table-responsive py-4">
                        <table class="table table-flush table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Bus No / Capacity</th>
                                    <th>Driver Name</th>
                                    <th>Departure</th>
                                    <th>Arrival</th>
                                    <?php if ($db_handle->check_admin()) {?>
                                    <th>Action</th>
                                    <?php }?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                    if ($db_handle->check_admin()) {
                                        $users = $db_handle->runQuery('SELECT bus.bus_number,bus.bus_capacity,users.fname,users.lname,schedule.* FROM `schedule` JOIN bus ON bus.bus_id = schedule.bus_id JOIN users ON
                                    users.id = schedule.driver_id');
                                    } else {
                                        $users = $db_handle->runQuery("SELECT bus.bus_number,bus.bus_capacity,users.fname,users.lname,schedule.* FROM `schedule` JOIN bus ON bus.bus_id = schedule.bus_id JOIN users ON
                                    users.id = schedule.driver_id AND users.id = '" . $_SESSION['userId'] . "' ");
                                    }
                                foreach ($users as $user) {?>
                                <tr>
                                    <td><?=$i;?></td>
                                    <td><?=$user['bus_number']?> / Capacity - <?=$user['bus_capacity']?></td>
                                    <td><?=$user['fname'] . ' ' . $user['lname'];?></td>
                                    <td><?=$user['start_date'];?> - <?=$user['start_time'];?></td>
                                    <td><?=$user['end_date'];?> - <?=$user['end_time'];?></td>
                                    <?php if ($db_handle->check_admin()) {?>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" data-toggle="modal" data-target="#modal-edit" data-id='<?=$user['schedule_id']?>' class="btn btn-sm btn-warning editModal">
                                                <i class="fas fa-edit"></i>
                                                Edit</button>
                                            <button type="button" data-toggle="modal" data-target="#modal-delete" data-id='<?=$user['schedule_id']?>' class="btn btn-sm btn-danger deleteModal">
                                                <i class="fas fa-trash-alt"></i>
                                                Delete</button>
                                        </div>
                                    </td>
                                    <?php }?>
                                </tr>
                                <?php $i++;}?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Add modal -->
    <div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal-lg  modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-default">Create New schedule</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <small>Required All details mandatory</small>
                    <form method="POST" action="./modal/schedule.php">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="hidden" name="action" value='add-new'>
                                    <label for="bus_id" class="form-control-label">Bus Number</label>
                                    <select name="bus_id" class='form-control'>
                                        <option value="" hidden selected>Select One</option>
                                        <?php $bus_row = $db_handle->runQuery("SELECT * FROM bus");
                                        foreach ($bus_row as $bus) {?>
                                        <option value="<?=$bus['bus_id']?>"><?=$bus['bus_number'] . ' - Capacity ' . $bus['bus_capacity']?></option>
                                        <?php }?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="driver_id" class="form-control-label">Driver Name</label>
                                    <select name="driver_id" class='form-control'>
                                        <option value="" hidden selected>Select One</option>
                                        <?php $bus_row = $db_handle->runQuery("SELECT * FROM users");
                                        foreach ($bus_row as $bus) {?>
                                        <option value="<?=$bus['id']?>"><?=$bus['fname'] . ' ' . $bus['lname']?></option>
                                        <?php }?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="start_date" class="form-control-label">Departure Date</label>
                                    <input class="form-control" type="date" min='<?=date('Y-m-d')?>' name="start_date" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="start_date" class="form-control-label">Departure Time</label>
                                    <input class="form-control" type="time" name="start_time" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="start_date" class="form-control-label">Arrival Date</label>
                                    <input class="form-control" type="date" min='<?=date('Y-m-d')?>' name="end_date" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="start_date" class="form-control-label">Arrival Time</label>
                                    <input class="form-control" type="time" name="end_time" required>
                                </div>
                                <div class="col-md-12">
                                    <br>
                                    <button type="button" class="btn btn-link  mr-auto" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success float-right ml-auto"><i class="fas fa-check-circle"></i> Create</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit modal -->
    <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal-lg  modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-default">Edit Schedule Details</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="./modal/schedule.php">
                        <div class="form-group" id='edit-schedule'>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="bus_id" class="form-control-label">Bus Number</label>
                                    <input type="hidden" name="action" value='edit-schedule'>
                                    <input type="hidden" name="id" value=''>
                                    <select name="bus_id" class='form-control'>
                                        <option value="" hidden>Select One</option>
                                        <?php $bus_row = $db_handle->runQuery("SELECT * FROM bus");
                                        foreach ($bus_row as $bus) {?>
                                        <option value="<?=$bus['bus_id']?>"><?=$bus['bus_number'] . ' - Capacity ' . $bus['bus_capacity']?></option>
                                        <?php }?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="driver_id" class="form-control-label">Driver Name</label>
                                    <select name="driver_id" class='form-control'>
                                        <option value="" hidden>Select One</option>
                                        <?php $bus_row = $db_handle->runQuery("SELECT * FROM users");
                                        foreach ($bus_row as $bus) {?>
                                        <option value="<?=$bus['id']?>"><?=$bus['fname'] . ' ' . $bus['lname']?></option>
                                        <?php }?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="start_date" class="form-control-label">Departure Date</label>
                                    <input class="form-control" type="date" name="start_date" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="start_date" class="form-control-label">Departure Time</label>
                                    <input class="form-control" type="time" name="start_time" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="start_date" class="form-control-label">Arrival Date</label>
                                    <input class="form-control" type="date" name="end_date" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="start_date" class="form-control-label">Arrival Time</label>
                                    <input class="form-control" type="time" name="end_time" required>
                                </div>
                                <div class="col-md-12">
                                    <br>
                                    <button type="button" class="btn btn-link  mr-auto" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success float-right ml-auto"><i class="fas fa-check-circle"></i> Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Delete modal  -->
    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="modal-warning" aria-hidden="true">
        <div class="modal-dialog modal-dark  modal-dialog-centered modal-" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-default">Alert!</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="py-1 text-center">
                        <i class="fas fa-exclamation-triangle fa-3x"></i>
                        <h4 class="mt-4 text-white">Are you sure to delete?</h4>
                        <small>Once you done, it cannot be recover!</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary  mr-auto" data-dismiss="modal">Close</button>
                    <a id='deleteBtn' href="" class="btn btn-danger ml-auto"><i class="fas fa-trash"></i> Delete</a>
                </div>
            </div>
        </div>
    </div>

    <?php require_once 'pagefooter.php';?>
    <!-- Page script -->
    <script>
    $(document).ready(function() {
        const baseUrl = "<?=BASEURL?>";
        // Edit
        $('.editModal').click(function(e) {
            e.preventDefault();
            let id = $(this).attr('data-id');
            $.ajax({
                type: "GET",
                url: "modal/schedule.php",
                data: {
                    getData: "schedule",
                    getType: "edit",
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        let div = "#edit-schedule ";
                        $(div + "select[name='bus_id']").val(response.bus_id);
                        $(div + "select[name='driver_id']").val(response.driver_id);
                        $(div + "input[name='start_date']").val(response.start_date);
                        $(div + "input[name='start_time']").val(response.start_time);
                        $(div + "input[name='end_date']").val(response.end_date);
                        $(div + "input[name='end_time']").val(response.end_time);
                        $(div + "input[name='id']").val(response.schedule_id);
                    }
                }
            });
        });

        // Delete
        $('.deleteModal').click(function(e) {
            e.preventDefault();
            let id = $(this).attr('data-id');
            $('#deleteBtn').attr('href', baseUrl +
                "modal/schedule.php?action=delete-this&id=" + id);
        });
    });
    </script>