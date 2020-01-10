<?php

    if (!$_SESSION['username']) {
        
        header("location: login.php");
        
    }

    $id = isset($_GET['commentid']) && is_numeric($_GET['commentid']) ? intval($_GET['commentid']) : 0;

    $count =  checkItem('comment', 'comments', 'comment_id', $id);

    if($count > 0) {
        
        $stmt = $conn->prepare("DELETE FROM comments WHERE comment_id = $id ");
        $stmt->execute();
?>

        <h1 class="text-center">Deleted Comment</h1>
        <div class="container">
            <div class="row">
                <div class='alert alert-success'><?php echo $stmt->rowCount() ?> Row Deleted</div>
                <?php redirectHome ('', 'comments.php', 1) ?>
            </div>
        </div>
        
<?php
            
    } else {
        
        $msg =  "<div class='alert alert-danger'>This Id Not Exists</div>";
        
        redirectHome ($msg, 'index.php', 1);

    }


?>