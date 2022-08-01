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
                    <h3 class="mb-0">Drivers Details</h3>
                    <div class="table-responsive py-4">
                        <table class="table table-flush table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Social Security</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                    $users = $db_handle->runQuery('SELECT * FROM `users`');
                                foreach ($users as $user) {?>
                                <tr>
                                    <td><?=$i;?></td>
                                    <td><?=$user['fname'];?></td>
                                    <td><?=$user['lname'];?></td>
                                    <td><?=$user['email'];?></td>
                                    <td><?=$user['ss_number'];?></td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" data-toggle="modal" data-target="#modal-edit" data-id='<?=$user['id']?>' class="btn btn-sm btn-warning editModal">
                                                <i class="fas fa-edit"></i>
                                                Edit</button>
                                            <button type="button" data-toggle="modal" data-target="#modal-delete" data-id='<?=$user['id']?>' class="btn btn-sm btn-danger deleteModal">
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
                    <h6 class="modal-title" id="modal-title-default">Create New Driver Details</h6>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <small>Required All details mandatory</small>
                    <form method="POST" action="./modal/drivers.php">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="fname" class="form-control-label">First Name</label>
                                    <input type="hidden" name="action" value='add-new'>
                                    <input class="form-control" type="text" name="fname" placeholder='ex: John ' required>
                                </div>
                                <div class="col-md-6">
                                    <label for="lname" class="form-control-label">Last Name</label>
                                    <input class="form-control" type="text" name="lname" placeholder='ex : Nick' required>
                                </div>
                                <div class="col-md-6">
                                    <label for="username" class="form-control-label">Username</label>
                                    <input class="form-control" type="text" name="username" placeholder='ex : john@123' required>
                                </div>
                                <div class="col-md-6">
                                    <label for="password" class="form-control-label">Password</label>
                                    <input class="form-control" type="password" name="password" placeholder='*****' required>
                                </div>
                                <div class="col-md-6">
                                    <label for="ss_number" class="form-control-label">Social Security Number</label>
                                    <input class="form-control" type="text" name="ss_number" placeholder='ex : 21514***' required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-control-label">Email</label>
                                    <input class="form-control" type="email" name="email" placeholder='ex : jophn@gmail.com' required>
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
                    <h6 class="modal-title" id="modal-title-default">Edit Driver Details</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="./modal/drivers.php">
                        <div class="form-group" id='edit-user'>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="fname" class="form-control-label">First Name</label>
                                    <input type="hidden" name="action" value='edit-driver'>
                                    <input type="hidden" name="id" value=''>
                                    <input class="form-control" type="text" name="fname" placeholder='ex: John ' required>
                                </div>
                                <div class="col-md-6">
                                    <label for="lname" class="form-control-label">Last Name</label>
                                    <input class="form-control" type="text" name="lname" placeholder='ex : Nick' required>
                                </div>
                                <div class="col-md-6">
                                    <label for="username" class="form-control-label">Username</label>
                                    <input class="form-control" type="text" name="username" placeholder='ex : john@123' required>
                                </div>
                                <div class="col-md-6">
                                    <label for="password" class="form-control-label">Password</label>
                                    <input class="form-control" type="password" name="password" placeholder='*****' required>
                                </div>
                                <div class="col-md-6">
                                    <label for="ss_number" class="form-control-label">Social Security Number</label>
                                    <input class="form-control" type="text" name="ss_number" placeholder='ex : 21514***' required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-control-label">Email</label>
                                    <input class="form-control" type="email" name="email" placeholder='ex : jophn@gmail.com' required>
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
                url: "modal/drivers.php",
                data: {
                    getData: "drivers",
                    getType: "edit",
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        let div = "#edit-user ";
                        $(div + "input[name='fname']").val(response.fname);
                        $(div + "input[name='lname']").val(response.lname);
                        $(div + "input[name='username']").val(response.username);
                        $(div + "input[name='password']").val(response.password);
                        $(div + "input[name='ss_number']").val(response.ss_number);
                        $(div + "input[name='email']").val(response.email);
                        $(div + "input[name='id']").val(response.id);
                    }
                }
            });
        });

        // Delete
        $('.deleteModal').click(function(e) {
            e.preventDefault();
            let id = $(this).attr('data-id');
            $('#deleteBtn').attr('href', baseUrl +
                "modal/drivers.php?action=delete-this&id=" + id);
        });
    });
    </script>