<?php
/**
 * Created by PhpStorm.
 * User: kandorm
 * Date: 17-3-26
 * Time: 下午6:57
 */
include_once "tools.php";
include_once "common.php";


$code = $_GET['code'];
if($state != $_GET['state']) {
die("state:".$state." ".$_GET['state']);
}

$access_token_url = "https://github.com/login/oauth/access_token";
$result = curl_post($access_token_url, [
    "client_id" => $github_client_id,
    "client_secret" => $github_client_secret,
    "code" => $code,
    "redirect_url" => $home_page,
    "state" => $state,
]);

$result_param_list = explode('&', $result);
$params = array();
foreach ($result_param_list as $param) {
    $value = explode('=', $param);
    if (count($value) < 2)continue;
    $params[$value[0]] = $value[1];
}
$access_token = $params['access_token'];
$user_info_url = "https://api.github.com/user";
$user_info = curl_get($user_info_url, [
    "access_token" => $access_token,
]);

$user_obj = json_decode($user_info, true);

if(!key_exists('email', $user_obj))
    die("Permision Denied!");
$user_id = $user_obj['id'];


$redis->select(3);
$redis->set($user_id, json_encode($user_obj, true));
setcookie("user_id", $user_id, time()+3600);
header("Location:$home_page");

?>
