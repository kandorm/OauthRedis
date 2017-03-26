<?php include_once "common.php"?>
<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>OauthRedis</title>

        <link href="node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <nav class="navbar navbar-inverse">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">OauthRedis</a>
                </div>
                <?php if($user != null): ?>
                <div id="navbar" class="navbar-collapse collapse">
                    <form class="navbar-form navbar-right">
                        <a class="btn btn-primary" href="entry.php?type=logout" role="button">Logout</a>
                    </form>
                </div>
                <?php endif;?>
            </div>
        </nav>
        <div class="container">
            <?php if($user != null):?>
            <h1 style="text-align: center; margin-top: 150px">OauthRedis</h1>
            <form class="form-group" action="domain.php" style="margin-top: 50px" method="get">
                <div class="input-group">
                    <input type="text" name="domain" id="inputDomain" class="form-control" placeholder="Search for..." required autofocus style="height: 45px">
                    <span class="input-group-btn">
                    <button class="btn btn-lg btn-primary" type="submit" style="height: 45px">Go!</button>
                </span>
                </div>
            </form>
            <?php else:?>
            <div class="vertical-center" style="text-align: center; margin-top: 200px">
                <h1>Welcome to OauthRedis! Please sign in first!</h1>
                <a class="btn btn-success btn-lg" href="entry.php">Sign in with Github</a>
            </div>
            <?php endif;?>
        </div>

        <script src="node_modules/jquery/dist/jquery.min.js"></script>
        <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    </body>
</html>
