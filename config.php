<?php
date_default_timezone_set("Asia/Kolkata"); //India time (GMT+5:30)
$today = date('d-m-Y');
$time = date('h:i:s a');
$dateTime = $today . "/" . $time;

define("TITLE", 'Bus Schedule Project');            // Site Title
define("BASEURL", 'https://zivi.app/bus-project/'); // Base Url Defined

// Company name and website link
define("CMPYNAME", "Google");             // Company name defined
define("CMPYLINK", "http://google.com/"); // Company link Defined

function base_url() {
    return BASEURL;
}