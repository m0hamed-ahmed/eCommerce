<?php

    if (!$_SESSION['username']) {
        
        header("location: login.php");
        
    }

    $id = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

    $stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
    $stmt->execute(array($id));
    $row = $stmt->fetch();

    if($stmt->rowCount() > 0) {

?>

        
    <section class="edit">
        <h1 class="text-center">Edit Member</h1>
        <div class="container">
           <div  class="row">
               <form class="form-horizontal" method="post" action="members.php?do=update">
                   <input type="hidden" name="userid" value="<?php echo $row['user_id'] ?>">
                   <div class="form-group form-group-lg">
                       <label class="col-sm-2 control-label">Username</label>
                       <div class="col-sm-10">
                           <input type="text" class="form-control" name="username" value="<?php echo $row['user_name'] ?>" autocomplete="off" required="required">
                       </div>
                   </div>
                   <div class="form-group form-group-lg">
                       <label class="col-sm-2 control-label">Password</label>
                       <div class="col-sm-10">
                           <input type="hidden" name="oldpassword" value="<?php echo $row['password'] ?>">
                           <input type="password" class="form-control" name="newpassword" autocomplete="new-password">
                       </div>
                   </div>
                   <div class="form-group form-group-lg">
                       <label class="col-sm-2 control-label">Email</label>
                       <div class="col-sm-10">
                           <input type="email" class="form-control" name="email" value="<?php echo $row['email'] ?>" autocomplete="off" required="required">
                       </div>
                   </div>
                   <div class="form-group form-group-lg">
                       <label class="col-sm-2 control-label">Full Name</label>
                       <div class="col-sm-10">
                           <input type="text" class="form-control" name="fullname" value="<?php echo $row['full_name'] ?>" autocomplete="off" required="required">
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