<?php
/**
 * Created by PhpStorm.
 * User: kandorm
 * Date: 17-3-26
 * Time: 下午7:31
 */
$redis = new Redis();
$redis->connect("localhost", 6379, 0);
$redis->auth("d-wan142014011290");

$state = random_int(0, PHP_INT_MAX);

$home_page = "http://oauthredis.southeastasia.cloudapp.azure.com/";

$github_client_id = "a004b15fb67045c7faf6";
$github_client_secret = "cb9f58d5aefcb0d8dd19f4c4b9c9cbc730448ae9";
?>