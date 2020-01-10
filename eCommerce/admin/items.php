<?php

    session_start();

    $pageTitle = 'Items';

    if (isset($_SESSION['username'])) {
        
        include 'init.php';
        
        $do = isset($_GET['do']) ? $_GET['do'] : 'mange';
        
        if ($do == 'mange') {
            
            include 'mange_items.php';
            
        } elseif ($do == 'add'){ // Add Page
            
            include 'add_items.php';
            
        } elseif ($do == 'insert'){ // Insert Page
            
            include 'insert_items.php';
            
        } elseif ($do == 'edit') { // Edit Page
            
            include 'edit_items.php';
        
        } elseif ($do == 'update') { // Update Page
            
            include 'update_items.php';
            
        } elseif ($do == 'delete') { // Delete Page
            
            include 'delete_items.php';
            
        } elseif ($do == 'approve') { // Delete Page
            
            include 'approve_items.php';
            
        } else {
            
            $msg =  "<div class='alert alert-danger'>No do this</div>";
            
            redirectHome($msg, 'index.php');
            
        }
        
        include $tmbl . 'footer.php';
        
    } else {
        
        header("location: login.php");
        
        exit();
        
    }
?>