<?php 

    session_start();
    $pageTitle = 'Item';
    include 'init.php';

    $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? $_GET['itemid'] : 0;
    
    $stmt = $conn->prepare("SELECT I.*, C.category_name, U.user_name FROM items I INNER JOIN categories C ON I.category_id = C.category_id INNER JOIN users U ON I.member_id = U.user_id WHERE item_id = ? AND approve = 1");

    $stmt->execute(array($itemid));
    
    $count = $stmt->rowCount();

    if($count > 0) {

    $item = $stmt->fetch();

?>
<div class="item">
    <div class="container">
        <div class="row">
            <h1 class="text-center"><?php echo $item['item_name'] ?></h1>
            <div class="col-sm-3">
                <img src="item.png" class="img-responsive img-thumbnail">
            </div>
            <div class="col-sm-9">
                <h2><?php echo $item['item_name'] ?></h2>
                <p><?php echo $item['description'] ?></p>
                <ul class="list-unstyled">
                    <li><i class="fa fa-calendar fa-fw"></i><span>Added Date</span> : <?php echo $item['date'] ?></li>
                    <li><i class="fa fa-money fa-fw"></i><span>Price</span> : <?php echo $item['price'] ?></li>
                    <li><i class="fa fa-building fa-fw"></i><span>Made In</span> : <?php echo $item['country_made'] ?></li>
                    <li><i class="fa fa-tags fa-fw"></i><span>Category</span> : <?php echo "<a href='categories.php?catid=".$item['category_id']."'>" . $item['category_name'] . "</a>" ?></li>
                    <li><i class="fa fa-user fa-fw"></i><span>Added By</span> : <?php echo $item['user_name'] ?></li>
                </ul>
            </div>
        </div>
        <hr class="custom-hr">
        <div class="row">
            <div class="col-sm-offset-3 col-sm-6 add-comm">
            <?php
                if(isset($_SESSION['user'])) {
                    
                    if($_SERVER['REQUEST_METHOD'] == 'POST'):
                                                
                        $comment = $_POST['comment'];
                        
                        if(!empty($comment)) {
                        
                            $stmt = $conn->prepare("INSERT INTO comments (comment, status, date, item_id, user_id)
                                                    VALUES (?, 0, now(), ?, ?)");
                            $stmt->execute(array($comment, $itemid, $_SESSION['uid']));
                            
                            if($stmt)
                                $msg =  "<div class='alert alert-success'>Comment Added</div>";
                            
                        } else
                            $msg =  "<div class='alert alert-danger'>Enter Comment</div>";
                        
                    endif;
            ?>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']. '?itemid=' . $itemid?>">
                    <textarea class="form-control" name="comment" rows="6" placeholder="Write Your Comment" required="required"></textarea>
                    <input type="submit" class="btn btn-primary" value="Add Comment">
                </form>
            <?php
                if(isset($msg))
                    echo $msg;
                
                } else
                    echo "<a href='login.php'>Login</a> or <a href='login.php'>Register</a> First";
            ?>
            </div>
        </div>
        <hr class="custom-hr">
            <h1 class="text-center">Comments</h1>
            <?php
                $stmt = $conn->prepare("SELECT * FROM comments C INNER JOIN users U ON C.user_id = U.user_id WHERE C.item_id = ? ORDER BY comment_id DESC");

                $stmt->execute(array($itemid));

                $comments = $stmt->fetchAll();
        
                if ($stmt->rowCount() > 0) {
        
                    foreach($comments as $comment) {
            ?>
                    <div class="row user-comment">
                        <div class="col-sm-3">
                            <img src="item.png" class="img-responsive img-thumbnail img-circle center-block">
                            <p class="user"><?php echo $comment['user_name'] ?></p>
                        </div>
                        <div class="col-sm-9">
                            <p class="comment-content"><?php echo $comment['comment'] ?></p>
                        </div>
                    </div>
                    <hr class="custom-hr">
            <?php
                    }
                } else {
                    echo "<div class='col-sm-9 col-sm-offset-3'><div class='no-comments'>No Found Comment On This Item</div></div>";
                }
            ?>   
    </div>
</div>

<?php
    } else {
        echo "<div class='alert alert-danger'>This ID not found or The ad is pending review</div>";
    }
    include $tmbl . 'footer.php';
?>