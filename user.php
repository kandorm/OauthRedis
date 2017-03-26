<?php
/**
 * Created by PhpStorm.
 * User: kandorm
 * Date: 17-3-26
 * Time: 下午5:28
 */
include_once "common.php";

$user = null;
if(key_exists('access_token', $_COOKIE)) {
    $redis->select(3);
    $user_obj = $redis->get($_COOKIE['access_token']);
    if($user_info != false) {
        $user = json_decode($user_obj, true);
    }
}
?>