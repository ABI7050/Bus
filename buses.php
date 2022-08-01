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
                    <button type='button' data-toggle="modal" data-target="#modal-add" class="btn btn-info mb-3 float-right">Add New</button>
                    <h3 class="mb-0">Bus Details</h3>
                    <div class="table-responsive py-4">
                        <table class="table table-flush table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Bus No</th>
                                    <th>Capacity</th>
                                    <th>Make</th>
                                    <th>Model</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                    $users = $db_handle->runQuery('SELECT * FROM `bus`');
                                foreach ($users as $user) {?>
                                <tr>
                                    <td><?=$i;?></td>
                                    <td><?=$user['bus_number'];?></td>
                                    <td><?=$user['bus_capacity'];?></td>
                                    <td><?=$user['bus_make'];?></td>
                                    <td><?=$user['bus_model'];?></td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" data-toggle="modal" data-target="#modal-edit" data-id='<?=$user['bus_id']?>' class="btn btn-sm btn-warning editModal">
                                                <i class="fas fa-edit"></i>
                                                Edit</button>
                                            <button type="button" data-toggle="modal" data-target="#modal-delete" data-id='<?=$user['bus_id']?>' class="btn btn-sm btn-danger deleteModal">
                                                <i class="fas fa-trash-alt"></i>
                                                Delete</button>
                                        </div>
                                    </td>
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
                    <h6 class="modal-title" id="modal-title-default">Add New Bus Details</h6>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <small>Required All details mandatory</small>
                    <form method="POST" action="./modal/buses.php">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="bus_number" class="form-control-label">Bus Number</label>
                                    <input type="hidden" name="action" value='add-new'>
                                    <input class="form-control" type="text" name="bus_number" placeholder='ex: BUS 1254 ' required>
                                </div>
                                <div class="col-md-6">
                                    <label for="bus_capacity" class="form-control-label">Capacity</label>
                                    <input class="form-control" type="text" name="bus_capacity" placeholder='ex : 60' required>
                                </div>
                                <div class="col-md-6">
                                    <label for="bus_make" class="form-control-label">Make of Bus</label>
                                    <input class="form-control" type="text" name="bus_make" placeholder='ex : 2020' required>
                                </div>
                                <div class="col-md-6">
                                    <label for="bus_make" class="form-control-label">Bus Model</label>
                                    <input class="form-control" type="text" name="bus_model" placeholder='ex : Lite' required>
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
                    <h6 class="modal-title" id="modal-title-default">Edit Bus Details</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="./modal/buses.php">
                        <div class="form-group" id='edit-bus'>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="bus_number" class="form-control-label">Bus Number</label>
                                    <input type="hidden" name="action" value='edit-bus'>
                                    <input type="hidden" name="id" value=''>
                                    <input class="form-control" type="text" name="bus_number" placeholder='ex: BUS 1254 ' required>
                                </div>
                                <div class="col-md-6">
                                    <label for="bus_capacity" class="form-control-label">Capacity</label>
                                    <input class="form-control" type="text" name="bus_capacity" placeholder='ex : 60' required>
                                </div>
                                <div class="col-md-6">
                                    <label for="bus_make" class="form-control-label">Make of Bus</label>
                                    <input class="form-control" type="text" name="bus_make" placeholder='ex : 2020' required>
                                </div>
                                <div class="col-md-6">
                                    <label for="bus_make" class="form-control-label">Bus Model</label>
                                    <input class="form-control" type="text" name="bus_model" placeholder='ex : Lite' required>
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
                url: "modal/buses.php",
                data: {
                    getData: "bus",
                    getType: "edit",
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        let div = "#edit-bus ";
                        $(div + "input[name='bus_number']").val(response.bus_number);
                        $(div + "input[name='bus_capacity']").val(response.bus_capacity);
                        $(div + "input[name='bus_make']").val(response.bus_make);
                        $(div + "input[name='bus_model']").val(response.bus_model);
                        $(div + "input[name='id']").val(response.bus_id);
                    }
                }
            });
        });

        // Delete
        $('.deleteModal').click(function(e) {
            e.preventDefault();
            let id = $(this).attr('data-id');
            $('#deleteBtn').attr('href', baseUrl +
                "modal/buses.php?action=delete-this&id=" + id);
        });
    });
    </script>