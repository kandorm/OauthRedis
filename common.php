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

$state = "6497121511705809608";
$home_page = "http://oauthredis.southeastasia.cloudapp.azure.com/";

$github_client_id = "a004b15fb67045c7faf6";
$github_client_secret = "cb9f58d5aefcb0d8dd19f4c4b9c9cbc730448ae9";

$github_redirect_url = $home_page."github-oauth.php/";

$user = null;
if(key_exists('user_id', $_COOKIE)) {
    $redis->select(3);
    $user_obj = $redis->get($_COOKIE['user_id']);
    if($user_obj != false) {
        $user = json_decode($user_obj, true);
    }
}
?>
