<?php
    include_once "common.php";

    $index = $_GET['author'] ? $_GET['author'] : "0";
    $start = $_GET['start'] ? $_GET['start'] : 0;
    $end = $_GET['end'] ? $_GET['end'] : 20;
    $redis->select(2);
    $coauthors = $redis->lRange($index, $start, $end);
    if($coauthors != false) {
        die(json_encode($coauthors));
    }
    else {
        die(json_encode([]));
    }
?>