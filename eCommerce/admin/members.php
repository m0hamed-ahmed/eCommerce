<?php

    session_start();

    $pageTitle = 'Members';

    if (isset($_SESSION['username'])) {
        
        include 'init.php';
        
        $do = isset($_GET['do']) ? $_GET['do'] : 'Mange';
        
        if ($do == 'Mange') {
            
            include 'mange.php';
            
        } elseif ($do == 'add'){ // Add Page
            
            include 'add.php';
            
        } elseif ($do == 'insert'){ // Insert Page
            
            include 'insert.php';
            
        } elseif ($do == 'edit') { // Edit Page
            
            include 'edit.php';
        
        } elseif ($do == 'update') { // Update Page
            
            include 'update.php';
            
        } elseif ($do == 'delete') { // Delete Page
            
            include 'delete.php';
            
        } elseif ($do == 'activate') { // Activate Page
            
            include 'activate.php';
            
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