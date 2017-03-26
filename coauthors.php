<?php

function getExpert($index) {
    $redis = RedisConnect::getRedisInstance()->getRedisConn();
    $redis->select(0);
    $result = $redis->get($index);
    return $result;
}

function getCoauthors($index, $start, $end) {
    $redis = RedisConnect::getRedisInstance()->getRedisConn();
    $redis->select(2);
    $result = $redis->lRange($index, $start, $end);
    return $result;
}

$index = $_GET['author'] ? $_GET['author'] : "0";
$start = $_GET['start'] ? $_GET['start'] : 0;
$end = $_GET['end'] ? $_GET['end'] : 20;
$coauthors = getCoauthors($index, 0, 20);
while($coauthor = each($coauthors)) {
    $coauthor_obj = json_decode($coauthor['value']);
    $expert = getExpert($coauthor_obj->index);
    $expert_obj = json_decode($expert);
    var_dump($expert_obj);
}
?>