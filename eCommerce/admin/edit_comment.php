<?php

    if (!$_SESSION['username']) {
        
        header("location: login.php");
        
    }

    $id = isset($_GET['commentid']) && is_numeric($_GET['commentid']) ? intval($_GET['commentid']) : 0;

    $stmt = $conn->prepare("SELECT * FROM comments WHERE comment_id = ?");
    $stmt->execute(array($id));
    $comment = $stmt->fetch();

    if($stmt->rowCount() > 0) {

?>

        
    <section class="edit">
        <h1 class="text-center">Edit Comment</h1>
        <div class="container">
           <div  class="row">
               <form class="form-horizontal" method="post" action="comments.php?do=update">
                   <input type="hidden" name="commentid" value="<?php echo $comment['comment_id'] ?>">
                   <div class="form-group form-group-lg">
                       <label class="col-sm-2 control-label">Comment</label>
                       <div class="col-sm-10">
                           <textarea class="form-control" name="comment" ><?php echo $comment['comment'] ?></textarea>
                       </div>
                   </div>
                   <div class="form-group form-group-lg">
                       <div class="col-sm-10 col-sm-offset-2">
                           <input type="submit" class="form-control btn btn-primary" value="Save">
                       </div>
                   </div>
               </form>
           </div> 
        </div>
    </section>
        
<?php 
    
      } else { 
        
        $msg =  "<div class='alert alert-danger'>This Id Not Exists</div>";
        
        redirectHome ($msg, 'index.php', 1);    
        
        }
?>