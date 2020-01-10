<?php

    if (!$_SESSION['username']) {
        
        header("location: login.php");
        
    }

    $stmt = $conn->prepare("SELECT C.*, I.item_name, U.user_name  FROM comments C INNER JOIN items I ON I.item_id = C.item_id INNER JOIN users U ON u.user_id = C.user_id ORDER BY comment_id DESC");
    $stmt->execute();
    $comments = $stmt->fetchAll();

?>
<div class="container">
    <div class="row">
        <?php if(!empty($comments)) { ?>
        <h1 class="text-center">Mange Comments</h1>
        <div class="table-responsive">
            <table class="table table-bordered text-center mange-table">
                <tr>
                    <td>#ID</td>
                    <td>Comment</td>
                    <td>Date</td>
                    <td>Item Name</td>
                    <td>User Name</td>
                    <td>Control</td>
                </tr>
                <?php
                
                    foreach($comments as $comment) {
                ?>
                <tr>
                    <td><?php echo $comment['comment_id'] ?></td>
                    <td><?php echo $comment['comment'] ?></td>
                    <td><?php echo $comment['date'] ?></td>
                    <td><?php echo $comment['item_name'] ?></td>
                    <td><?php echo $comment['user_name'] ?></td>
                    <td>
                        <a href="?do=edit&commentid=<?php echo $comment['comment_id'] ?>" class="btn btn-success"><i class="fa fa-edit"></i>Edit</a>
                        <a href="?do=delete&commentid=<?php echo $comment['comment_id'] ?>" class="btn btn-danger confirm"><i class="fa fa-close"></i>Delete</a>
                        <?php
                            if($comment['status'] == 0) {
                        ?>
                        <a href="?do=approve&commentid=<?php echo $comment['comment_id'] ?>" class="btn btn-info"><i class="fa fa-check"></i>Approve</a>
                        <?php } ?>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
        <?php } else {
                    echo "<div class='tbl-empty'>Empty</div>";
                }
        
        ?>
    </div>
</div>