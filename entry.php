<?php
    include_once "common.php";
    if($_GET['type'] == 'logout') {
        setcookie("user_id", null);
        $user = null;
        header("Location:".$home_page);
    }
    else {
        $scope = "user:email";
        $path = "https://github.com/login/oauth/authorize?client_id=$github_client_id&redirect_url=$github_redirect_url&scope=$scope&state=$state&allow_signup=true";
        header("Location:$path");
    }
?>