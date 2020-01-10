<?php

    if (!$_SESSION['username']) {
        
        header("location: login.php");
        
    }

    $id = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

    $count =  checkItem('user_name', 'users', 'user_id', $id);

    if($count > 0) {
        
        $stmt = $conn->prepare("UPDATE users SET reg_status = 1 WHERE user_id = ? ");
        $stmt->execute(array($id));
?>

        <h1 class="text-center">Activate Member</h1>
        <div class="container">
            <div class="row">
                <div class='alert alert-success'><?php echo $stmt->rowCount() ?> Row Activated</div>
                <?php redirectHome ('', 'members.php', 1) ?>
            </div>
        </div>
        
<?php
            
    } else {
        
        $msg =  "<div class='alert alert-danger'>This Id Not Exists</div>";
        
        redirectHome ($msg, 'index.php', 1);        
        
    }


?>