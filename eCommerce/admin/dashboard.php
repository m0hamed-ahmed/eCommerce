<?php
    session_start();

    if($_SESSION['username']) {
        
        $pageTitle = 'Dashboard';
        
        include 'init.php';
        
    $limit_user = 5;

    $latest_users = latestCount('*', 'users', 'user_id', $limit_user);
        
    $limit_item = 5;

    $latest_items = latestCount('*', 'items', 'item_id', $limit_item);
        
    $limit_comment = 5;

    $latest_comment = latestCount('*', 'comments', 'comment_id', $limit_comment);
  
?>

<section class="text-center statistic">
    <div class="container">
        <h1>Dashboard</h1>
        <div class="row">
            <div class="col-sm-3">
                <div class="stats members">
                    <i class="fa fa-users"></i>
                    <div class="info">
                        Total Members<span><a href="members.php"><?php echo countMembers('user_id', 'users') ?></a></span>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="stats pending">
                    <i class="fa fa-user-plus"></i>
                    <div class="info">
                        Pending Members <span><a href="members.php?page=pending"><?php echo checkItem('reg_status', 'users', 'reg_status', 0) ?></a></span>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="stats items">
                    <i class="fa fa-tag"></i>
                    <div class="info">
                        Total Items <span><a href="items.php"><?php echo countMembers('item_id', 'items')?></a></span>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="stats comments">
                    <i class="fa fa-comments"></i>
                    <div class="info">
                        Total Comments <span><a href="comments.php"><?php echo countMembers('comment_id', 'comments')?></a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="latest">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-users"></i>                    
                        <?php
                            if(!empty($latest_users)) {
                                $limit_user = countMembers('user_id', 'users') < 5 ? countMembers('user_id', 'users') : $limit_user;
                                echo "<span class='toggle-plus'><i class='fa fa-plus pull-right'></i></span>";
                                echo "Latest $limit_user Registerd Users";
                            } else {
                                echo "Users";
                              } 
                        ?>
                        
                    </div>
                    <div class="panel-body">
                        <ul class="list-unstyled latest-users">
                        <?php
                            if(!empty($latest_users)) {
                                foreach ($latest_users as $user) {

                                    echo "<li>";
                                        echo "<a href='members.php?do=edit&userid=".$user['user_id']."' class='touser'>";
                                            echo $user['user_name'];
                                        echo "</a>";
                                        echo "<a href='members.php?do=edit&userid=".$user['user_id']."' class='btn btn-success pull-right'>";
                                            echo "<i class='fa fa-edit'></i> Edit";
                                        echo "</a>";
                                        if ($user['reg_status'] == 0) {
                                            echo "<a href='members.php?do=activate&userid=".$user['user_id']."' class='btn btn-info pull-right activate'>";
                                            echo "<i class='fa fa-check'></i> Activate</a>";
                                        }
                                    echo "</li>";
                                }
                            } else {
                                echo "<strong>No Found Registerd Users</strong>";
                            }
                        ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-tag"></i>
                        <?php
                            if(!empty($latest_items)) {
                                $limit_item = countMembers('item_id', 'items') < 5 ? countMembers('item_id', 'items') : $limit_item;
                                echo "<span class='toggle-plus'><i class='fa fa-plus pull-right'></i></span>";
                                echo "Latest $limit_item Items";
                            } else {
                                echo "Items";
                              } 
                        ?>
                    </div>
                    <div class="panel-body">
                        <ul class="list-unstyled latest-users">
                        <?php
                            if(!empty($latest_items)) {
                                
                                foreach ($latest_items as $item) {
                                    echo "<li>";
                                        echo "<a href='items.php?do=edit&itemid=".$item['item_id']."' class='touser'>";
                                            echo $item['item_name'];
                                        echo "</a>";
                                        echo "<a href='items.php?do=edit&itemid=".$item['item_id']."' class='btn btn-success pull-right'>";
                                            echo "<i class='fa fa-edit'></i> Edit";
                                        echo"</a>";
                                        if ($item['approve'] == 0) {
                                            echo "<a href='items.php?do=approve&itemid=".$item['item_id']."' class='btn btn-info pull-right activate'><i class='fa fa-check'></i> Approve</a>";
                                        }
                                    echo "</li>";
                                }
                            } else {
                                echo "<strong>No Items Found</strong>";
                            }
                        ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-comments"></i>
                        
                        <?php
                            if(!empty($latest_comment)) {
                                $limit_comment = countMembers('comment_id', 'comments') < 5 ? countMembers('comment_id', 'comments') : $limit_comment;
                                echo "<span class='toggle-plus'><i class='fa fa-plus pull-right'></i></span>";
                                echo "Latest $limit_comment Comments";
                            } else {
                                echo "Comments";
                              } 
                        ?>
                    </div>
                    <div class="panel-body">
                        <ul class="list-unstyled latest-users">
                        <?php
                            if(!empty($latest_comment)) {
                                
                                foreach ($latest_comment as $comment) {

                                    $stmt = $conn->prepare("SELECT user_name FROM users WHERE user_id = ?");
                                    $stmt->execute(array($comment['user_id']));
                                    $user = $stmt->fetch();

                                    echo "<div class='box-comment'>";
                                        echo "<span>";
                                            echo "<a href='comments.php?do=edit&commentid=".$comment['comment_id']."' class='touser'>". $user['user_name'] ."</a>";
                                        echo "</span>";
                                        echo "<p>". $comment['comment'] ."</p>";
                                    echo "</div>";
                                }
                            } else {
                                echo "<strong>No Comments Found</strong>";
                            }
                        ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</section>

<?php
        
        include $tmbl .'footer.php';
            
    } else {
        
        header("location: login.php");
        
        exit();
        
    }
?>