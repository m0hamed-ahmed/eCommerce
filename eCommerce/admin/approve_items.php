<?php

    if (!$_SESSION['username']) {
        
        header("location: login.php");
        
    }

    $id = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;

    $count =  checkItem('item_name', 'items', 'item_id', $id);

    if($count > 0) {
        
        $stmt = $conn->prepare("UPDATE items SET approve = 1 WHERE item_id = ? ");
        $stmt->execute(array($id));
?>

        <h1 class="text-center">Approve Item</h1>
        <div class="container">
            <div class="row">
                <div class='alert alert-success'><?php echo $stmt->rowCount() ?> Row Approved</div>
                <?php redirectHome ('', 'items.php', 1) ?>
            </div>
        </div>
        
<?php
            
    } else {
        
        $msg =  "<div class='alert alert-danger'>This Id Not Exists</div>";
        
        redirectHome ($msg, 'index.php', 1);        
        
    }


?>