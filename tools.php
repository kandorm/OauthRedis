<?php
/**
 * Created by PhpStorm.
 * User: kandorm
 * Date: 17-3-26
 * Time: 下午7:33
 */
function curl_get($url, $params = null) {
    $ch = curl_init();
    if($params != null) {
        $url .= "?";
        foreach ($params as $key => $value) {
            $url .= "$key=$value&";
        }
    }
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_USERAGENT, "OauthRedis");
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}
function curl_post($url, $data) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_USERAGENT, "OauthRedis");
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}
?>
