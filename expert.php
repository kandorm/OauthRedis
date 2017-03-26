<?php include_once "common.php"; ?>
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
        <?php if($user != null):?>
        <div class="container">
            <div class="panel panel-default">
                <div class="panel-heading">Coauthors</div>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <?php
                            $index = $_GET['index'];
			    $pageNow = $_GET['pageNow'] ? $_GET['pageNow'] : 1;
			    $pageSize = 20;
                            $redis->select(2);
                            $count = $redis->lLen($index);
			    $pageCount = ceil($count/$pageSize);
                            $indexs = $redis->lRange($index, ($pageNow - 1) * $pageSize, $pageNow * $pageSize - 1);
                            echo "<th>Name</th>";
                            echo "<th>Collaborations</th>";
                            while($expert_index = each($indexs)) {
                                $index_obj = json_decode($expert_index['value']);
                                $redis->select(0);
                                $expert = $redis->get($index_obj->index);
                                $expert_obj = json_decode($expert);
                                echo "<tr>";
                                echo "<td>".$expert_obj->n."</td>";
                                echo "<td>".$index_obj->collaborations."</td>";
                                echo "</tr>";
                        }
                        ?>
                    </table>
                </div>
            </div>
	   <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li>
                        <a href="expert.php?index=<?php echo $index;?>&pageNow=<?php echo $pageNow == 1 ? 1:$pageNow-1?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php
                    for($i=($pageNow-2 < 1 ? 1 : $pageNow-2); $i<=$pageCount && $i<=$pageNow+2; $i++) {
                        if($i == $pageNow) {
                            $class = "class=\"active\"";
                        }
                        else {
                            $class = "";
                        }
                        echo "<li ".$class."><a href='expert.php?index=$index&pageNow=$i'>$i</a></li>";
                    }
                    ?>
                    <li>
                        <a href="expert.php?index=<?php echo $index?>&pageNow=<?php if($pageCount!= 0)echo $pageNow == $pageCount ? $pageCount : $pageNow + 1?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <?php else: echo "Permision Denied!"?>
        <?php endif;?>

        <script src="node_modules/jquery/dist/jquery.min.js"></script>
        <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    </body>
</html>
