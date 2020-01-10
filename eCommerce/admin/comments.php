<?php

    session_start();

    $pageTitle = 'Comments';

    if (isset($_SESSION['username'])) {
        
        include 'init.php';
        
        $do = isset($_GET['do']) ? $_GET['do'] : 'Mange';
        
        if ($do == 'Mange') {
            
            include 'mange_comment.php';
            
        } elseif ($do == 'edit') { // Edit Page
            
            include 'edit_comment.php';
        
        } elseif ($do == 'update') { // Update Page
            
            include 'update_comment.php';
            
        } elseif ($do == 'delete') { // Delete Page
            
            include 'delete_comment.php';
            
        } elseif ($do == 'approve') { // Activate Page
            
            include 'approve_comment.php';
            
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