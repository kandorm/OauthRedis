<?php include_once "user.php"?>
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
                <div id="navbar" class="navbar-collapse collapse">
                    <form class="navbar-form navbar-right">
                        <a class="btn btn-primary" href="login.php" role="button">Sign in</a>
                    </form>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="panel panel-default">
                <div class="panel-heading">Coauthors</div>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <?php
                            $index = $_GET['index'];
                            $redis = new Redis();
                            $redis->connect("localhost", 6379, 0);
                            $redis->select(2);
                            $count = $redis->lLen($index);
                            $indexs = $redis->lRange($index, 0, $count);
                            echo "<th>name</th>";
                            echo "<th>collaborations</th>";
                            while($index = each($indexs)) {
                                $index_obj = json_decode($index['value']);
                                $redis->select(0);
                                $expert = $redis->get($index_obj->index);
                                $expert_obj = json_decode($expert);
                                echo "<tr>";
                                echo "<td>".$expert_obj->n."</td>";
                                echo "<td>".$index_obj->collaborations."</td>";
                                #echo "<td><a class='btn btn-success' href='expert.php?index=".$expert_obj->index."'>Coauthors</a></td>";
                                echo "</tr>";
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>

        <script src="node_modules/jquery/dist/jquery.min.js"></script>
        <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    </body>
</html>