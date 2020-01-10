<?php

    session_start();

    $pageTitle = 'Categories';

    if (isset($_SESSION['username'])) {
        
        include 'init.php';
        
        $do = isset($_GET['do']) ? $_GET['do'] : 'mange';
        
        if ($do == 'mange') {
            
            include 'mange_category.php';
            
        } elseif ($do == 'add'){ // Add Page
            
            include 'add_category.php';
            
        } elseif ($do == 'insert'){ // Insert Page
            
            include 'insert_category.php';
            
        } elseif ($do == 'edit') { // Edit Page
            
            include 'edit_category.php';
        
        } elseif ($do == 'update') { // Update Page
            
            include 'update_category.php';
            
        } elseif ($do == 'delete') { // Delete Page
            
            include 'delete_category.php';
            
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