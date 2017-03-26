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
            <form class="form-group" action="domain.php" method="post">
                <div class="input-group">
                    <input type="text" name="domain" class="form-control" placeholder="Search for..." required autofocus style="height: 45px">
                    <span class="input-group-btn">
                        <button class="btn btn-lg btn-primary" type="submit" style="height: 45px">Go!</button>
                    </span>
                </div>
            </form>

            <div class="panel panel-default">
                <div class="panel-heading">Domain Experts</div>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <tbody id="table"></tbody>
                        <?php
                            $domain = $_GET['domain'];
                            $pageNow = $_GET['pageNow'] ? $_GET['pageNow'] : 1;
                            $pageSize = 20;
                            $redis = new Redis();
                            $redis->connect("localhost", 6379, 0);
                            $redis->select(1);
                            $count = $redis->lLen($domain);
                            $pageCount = ceil($count/$pageSize);
                            $indexs = $redis->lRange($domain, ($pageNow - 1) * $pageSize, $pageNow * $pageSize - 1);
                            echo "<th>name</th>";
                            echo "<th>H-index</th>";
                            echo "<th>Coauthors</th>";
                            while($index = each($indexs)) {
                                $index_obj = json_decode($index['value']);
                                $redis->select(0);
                                $expert = $redis->get($index_obj->index);
                                $expert_obj = json_decode($expert);
                                echo "<tr>";
                                echo "<td>".$expert_obj->n."</td>";
                                echo "<td>".$expert_obj->hi."</td>";
                                echo "<td><a class='btn btn-success' href='expert.php?index=".$expert_obj->index."'>Coauthors</a></td>";
                                echo "</tr>";
                            }
                        ?>
                    </table>
                </div>
            </div>
        </div>
        <script>
            function getExpertDetails() {

            }
        </script>
        <script src="node_modules/jquery/dist/jquery.min.js"></script>
        <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    </body>
</html>