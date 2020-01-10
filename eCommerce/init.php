<?php
    
    // Routes

    $lang = 'includes/languages/';   // Language Directory
    $tmbl = 'includes/templates/';   // Templates Directory
    $func = 'includes/functions/';   // Functions Directory
    $css  = 'theme/css/';            // CSS Directory
    $js   = 'theme/js/';             // JS Directory

    include 'admin/connection.php';
    include $lang . 'english.php';
    include $func . 'functions.php';
    include $tmbl . 'header.php';

?>