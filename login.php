<?php
    include_once "common.php";
    $redirect_url = "http://oauthredis.southeastasia.cloudapp.azure.com/github-auth.php";
    $scope = "user:email";
    $path = "https://github.com/login/oauth/authorize?client_id=$github_client_id&redirect_url=$redirect_url&scope=$scope&state=$state&allow_signup=true";
    header("Location:$path");
?>