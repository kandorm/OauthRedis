<?php
/**
 * Created by PhpStorm.
 * User: kandorm
 * Date: 17-3-26
 * Time: 下午5:28
 */
include_once "common.php";

$user = null;
if(key_exists('user_id', $_COOKIE)) {
echo $_COOKIE['user_id'];    
$redis->select(3);
    $user_obj = $redis->get($_COOKIE['user_id']);
    if($user_obj != false) {
        $user = json_decode($user_obj, true);
    }
}
?>
