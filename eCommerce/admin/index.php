<?php 

    if (isset($_SESSION['username'])) {
        
        include 'init.php';
        
    } else {
        
        header("location: login.php");
        
    }

?>

<?php include $tmbl . 'footer.php'; ?>