<?php
    session_start();
    require_once 'config.php';
    require_once "controller.php";
    $db_handle = new Controller();
    // PHP login and register script
    if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST['action'])) {
        if ($_POST['username'] === 'admin') {
            $username = $_POST['username'];
            $password = md5($_POST['password']);
            $sql = "SELECT * FROM `admin` WHERE `username` = '$username' AND `password` = '$password' LIMIT 0,1";
            $cnt = $db_handle->numRows($sql);
            if ($cnt > 0) {
                $row = $db_handle->runOneQuery($sql);
                $_SESSION['userId'] = $row['id'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['role'] = $row['usertype'];
                echo "<script>window.location.href = '" . BASEURL . "dashboard';</script>";
            } else {
                echo "<script>alert('Username / Password is incorrect');</script>";
            }
        } else {
            $username = $_POST['username'];
            $password = md5($_POST['password']);
            $sql = "SELECT * FROM users WHERE `username` = '$username' AND `password` = '$password' LIMIT 0,1";
            $cnt = $db_handle->numRows($sql);
            if ($cnt > 0) {
                $row = $db_handle->runOneQuery($sql);
                $_SESSION['userId'] = $row['id'];
                $_SESSION['name'] = $row['fname'] . ' ' . $row['lname'];
                $_SESSION['role'] = 0;
                echo "<script>window.location.href = '" . BASEURL . "dashboard';</script>";
            } else {
                echo "<script>alert('Username / Password is incorrect');</script>";
            }
        }
    }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title><?php echo TITLE; ?> </title>
    <!-- Favicon -->
    <link rel="icon" href="assets/img/brand/favicon.png" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="assets/vendor/nucleo/css/nucleo.css" type="text/css">
    <link rel="stylesheet" href="assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
    <!-- Page plugins -->
    <!-- Argon CSS -->
    <link rel="stylesheet" href="assets/css/argon.css?v=1.2.0" type="text/css">>
    <link rel="stylesheet" href="assets/css/custom.css" type="text/css">
    <style>
    .bg-gradient-primary {
        background: linear-gradient(87deg, #d0142c 0, #d0142c 100%) !important;
    }
    </style>
</head>

<body class="bg-default">
    <!-- Main content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">

            <div class="separator separator-bottom separator-skew zindex-100">
                <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div>
        </div>
        <!-- Page content -->
        <div class="container mt--8 pb-5">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="card bg-secondary border-0 mb-0">
                        <div class="card-body px-lg-5 py-lg-5">
                            <div class="logo">
                                <h3>Bus Schedule Project</h3>
                            </div>
                            <div class="text-center text-muted mb-4">
                                <small>sign in with credentials</small>
                            </div>
                            <form role="form" action='<?php echo $_SERVER['PHP_SELF']; ?>' method='POST'>
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                        </div>
                                        <input class="form-control" name='username' placeholder="Username" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                        </div>
                                        <input class="form-control" name='password' placeholder="Password" type="password">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" name='action' value='submit' class="btn btn-primary my-4">Sign
                                        in</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="py-5" id="footer-main">
        <div class="container">
            <div class="row align-items-center justify-content-xl-between">
                <div class="col-md-12">
                    <div class="copyright text-center  text-muted">
                        &copy; <?=date('Y');?> <a href="<?php echo CMPYLINK; ?>" class="font-weight-bold ml-1" target="_blank"><?php echo CMPYNAME; ?></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Argon Scripts -->
    <!-- Core -->
    <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/js-cookie/js.cookie.js"></script>
    <script src="../assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
    <script src="../assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
    <!-- Argon JS -->
    <script src="../assets/js/argon.js?v=1.2.0"></script>
</body>

</html>