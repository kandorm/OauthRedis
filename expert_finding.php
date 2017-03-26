<?php
    include_once "common.php";

    $domain = $_GET['domain'] ? $_GET['domain'] : "";
    $start = $_GET['start'] ? $_GET['start'] : 0;
    $end = $_GET['end'] ? $_GET['end'] : 20;
    $redis->select(1);
    $experts = $redis->lRange($domain, $start, $end);
    if($experts != false) {
        die(json_encode($experts));
    }
    else {
        die(json_encode([]));
    }
?>