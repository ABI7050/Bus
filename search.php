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
                    <label for="form-label">Search schedule</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Bus Number / Driver name" name='search_key' id='search_key'>
                        <div class="input-group-append">
                            <button class='btn btn-success' id='search'>Search</button>
                        </div>
                    </div>
                    <label for="form-label">Search by Date</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">From</span>
                        </div>
                        <input type="date" class="form-control" name='from_date' id='from_date'>
                        <div class="input-group-prepend">
                            <span class="input-group-text">To</span>
                        </div>
                        <input type="date" class="form-control" name='to_date' id='to_date'>
                        <div class="input-group-append">
                            <button class='btn btn-success' id='search-date'>Search</button>
                        </div>
                    </div>
                    <h3 class="mb-0">Schedule Details</h3>
                    <div class="table-responsive py-4">
                        <table class="table table-flush table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Bus No / Capacity</th>
                                    <th>Driver Name</th>
                                    <th>Departure</th>
                                    <th>Arrival</th>
                                </tr>
                            </thead>
                            <tbody id='table-content'>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once 'pagefooter.php';?>
    <!-- Page script -->
    <script>
    $(document).ready(function() {
        const baseUrl = "<?=BASEURL?>";
        $('#search').click(function(e) {
            e.preventDefault();
            let key = $('#search_key').val();
            if (key == "" || key == null) {
                alert('Please type Driver name or Bus no');
                return;
            }
            $('#table-content').empty();
            $.ajax({
                type: "GET",
                url: "modal/schedule.php",
                data: {
                    getData: "schedule",
                    getType: "search",
                    key: key
                },
                dataType: "json",
                success: function(response) {
                    if (response['status']) {
                        $('#table-content').html(response['html']);
                        let div = "#edit-schedule ";
                        $(div + "select[name='bus_id']").val(response.bus_id);
                        $(div + "select[name='driver_id']").val(response.driver_id);
                        $(div + "input[name='start_date']").val(response.start_date);
                        $(div + "input[name='start_time']").val(response.start_time);
                        $(div + "input[name='end_date']").val(response.end_date);
                        $(div + "input[name='end_time']").val(response.end_time);
                        $(div + "input[name='id']").val(response.schedule_id);
                    } else {
                        alert("No scheduels Found");
                    }
                }
            });
        });

        $('#search-date').click(function(e) {
            e.preventDefault();
            let from_date = $('#from_date').val();
            let to_date = $('#to_date').val();
            if (from_date == "" || from_date == null) {
                alert('Please choose date');
                return;
            }
            $('#table-content').empty();
            $.ajax({
                type: "GET",
                url: "modal/schedule.php",
                data: {
                    getData: "schedule",
                    getType: "search_date",
                    from_date: from_date,
                    to_date: to_date
                },
                dataType: "json",
                success: function(response) {
                    if (response['status']) {
                        $('#table-content').html(response['html']);
                        let div = "#edit-schedule ";
                        $(div + "select[name='bus_id']").val(response.bus_id);
                        $(div + "select[name='driver_id']").val(response.driver_id);
                        $(div + "input[name='start_date']").val(response.start_date);
                        $(div + "input[name='start_time']").val(response.start_time);
                        $(div + "input[name='end_date']").val(response.end_date);
                        $(div + "input[name='end_time']").val(response.end_time);
                        $(div + "input[name='id']").val(response.schedule_id);
                    } else {
                        alert("No scheduels Found");
                    }
                }
            });
        });
    });
    </script>