<?php
require_once 'config.php';
session_start();
unset($_SESSION['userId']);
unset($_SESSION['name']);
unset($_SESSION['role']);
echo "<script>window.location.href = '" . BASEURL . "index';</script>";