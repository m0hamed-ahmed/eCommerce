<?php

    if(!isset($_SESSION['username'])) {

        header("location: login.php");

    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        

        $userid       = $_POST['userid'];
        $username     = $_POST['username'];
        $email        = $_POST['email'];
        $fullname     = $_POST['fullname'];
        $oldpassword  = $_POST['oldpassword'];
        $newpassword  = $_POST['newpassword'];
        $hashpassword = sha1($newpassword);

        $pass = '';

        if(empty($newpassword))
            $pass = $oldpassword;
        else
            $pass = $hashpassword;

        $errors   = array();

        if (empty($username))  

            $errors[] = 'Username Can\'t Be Empty';

        if (empty($email))

            $errors[] = 'Email Can\'t Be Empty';

        if (empty($fullname))

            $errors[] = 'Full Name Can\'t Be Empty';
        
        echo "<h1 class='text-center'>Upadte Member</h1>";
        echo "<div class='container'>";
        echo "<div class='row'>";

        foreach($errors as $error)

            echo "<div class='alert alert-danger'>" . $error . "</div>";
        
        if (empty($errors)) {
            
            $stmt = $conn->prepare("SELECT * FROM users WHERE user_name = ? AND user_id != ?");
            $stmt->execute(array($username, $userid));
            $user = $stmt->rowCount();
            
            if($user > 0) {
                
                $msg =  '<div class="alert alert-danger">Sorry, This Users Name Already Found</div>';
                
                redirectHome ($msg, "members.php?do=edit&userid=$userid", 1);
                
            } else {
                
                $stmt = $conn->prepare("UPDATE users SET user_name = ? , email = ? , full_name = ? , password = ? WHERE user_id = ?");
                $stmt->execute(array($username, $email, $fullname, $pass, $userid));

                $msg =  "<div class='alert alert-success'>". $stmt->rowCount() ." Row Updated</div>"; 

                redirectHome ($msg, 'members.php', 1);
            }
                
        }


    } else {

        $msg =  "<div class='alert alert-danger'>Sorry, You Cant Browse This Page Directly</div>";
            
        redirectHome ($msg, 'index.php', 1);
    }

?>
        
    </div>
</div>