<?php

    if(!isset($_SESSION['username'])) {

        header("location: login.php");

    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $username     = $_POST['username'];
        $email        = $_POST['email'];
        $fullname     = $_POST['fullname'];
        $password     = $_POST['password'];
        $hashpassword = sha1($password);

        $errors   = array();

        if (empty($username))  

            $errors[] = 'Username Can\'t Be Empty';

        if (empty($email))

            $errors[] = 'Email Can\'t Be Empty';

        if (empty($fullname))

            $errors[] = 'Full Name Can\'t Be Empty';
        
        if (empty($password))

            $errors[] = 'Password Can\'t Be Empty';
        
        echo "<h1 class='text-center'>Inserted Member</h1>";
        echo "<div class='container'>";
        echo "<div class='row'>";

        foreach($errors as $error)

            echo "<div class='alert alert-danger'>" . $error . "</div>";
                
        if(count($errors) > 0 ) {
            
            redirectHome ('', 'members.php?do=add');
            
        }

        if (count($errors) == 0) {
            
            $count =  checkItem('user_name', 'users', 'user_name', $username);
            
            if($count > 0)
            {
                
                $msg =  '<div class="alert alert-danger">Sorry, This Users Name Already Found</div>';
                
                redirectHome ($msg, 'members.php?do=add', 1);
                
            } else {
                
                $stmt = $conn->prepare("INSERT INTO users(user_name, email, password, full_name, reg_status, reg_date) VALUES (:username, :email, :password, :fullname, 1, now())");
                $stmt->execute(array(
                                'username' => $username,
                                'email'    => $email,
                                'password' => $hashpassword,
                                'fullname' => $fullname
                ));

                $msg = "<div class='alert alert-success'>". $stmt->rowCount() ." Row Inserted</div>";
                                
                redirectHome ($msg, 'members.php', 1);
            
            }
        }
            echo "</div>";
        echo "</div>";

    } else {
        
        $msg =  "<div class='alert alert-danger'>Sorry, You Cant Browse This Page Directly</div>";
        
        redirectHome ($msg, 'index.php', 1);
    }

?>